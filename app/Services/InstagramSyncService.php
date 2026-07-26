<?php

namespace App\Services;

use App\Models\InstagramAccount;
use App\Models\InstagramMedia;
use App\Models\InstagramSyncLog;
use App\Support\InstagramMediaMapper;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Throwable;

class InstagramSyncResult
{
    public function __construct(
        public int $fetchedCount = 0,
        public int $insertedCount = 0,
        public int $updatedCount = 0,
        public string $status = 'success',
        public ?string $error = null
    ) {}
}

class InstagramSyncService
{
    public function __construct(
        protected InstagramApiService $apiService
    ) {}

    public function sync(InstagramAccount $account, bool $fullSync = false): InstagramSyncResult
    {
        $lock = Cache::lock('instagram-feed-sync', 300);

        if (! $lock->get()) {
            Log::info('Instagram sync lock currently held, skipping duplicate sync execution.', [
                'account_id' => $account->id,
            ]);

            return new InstagramSyncResult(
                status: 'running',
                error: 'Sync is already in progress.'
            );
        }

        $syncLog = InstagramSyncLog::create([
            'instagram_account_id' => $account->id,
            'started_at' => Carbon::now(),
            'status' => 'running',
        ]);

        $account->update([
            'last_sync_status' => 'running',
            'last_sync_error' => null,
        ]);

        $fetchedCount = 0;
        $insertedCount = 0;
        $updatedCount = 0;

        try {
            // 1. Refresh Account Profile
            try {
                $profile = $this->apiService->getProfile($account->access_token);
                $account->update([
                    'username' => $profile['username'] ?? $account->username,
                    'name' => $profile['name'] ?? $account->name,
                    'account_type' => $profile['account_type'] ?? $account->account_type,
                    'profile_picture_url' => $profile['profile_picture_url'] ?? $account->profile_picture_url,
                    'media_count' => $profile['media_count'] ?? $account->media_count,
                ]);
            } catch (Throwable $pe) {
                Log::warning('Instagram profile refresh during sync failed', [
                    'error' => $pe->getMessage(),
                ]);
            }

            $limit = config('services.instagram.sync_limit', 100);
            $afterCursor = null;
            $hasMore = true;

            while ($hasMore) {
                $response = $this->apiService->getMediaPage($account->access_token, $limit, $afterCursor);
                $items = $response['data'] ?? [];

                if (empty($items)) {
                    break;
                }

                $pageFetchedCount = count($items);
                $fetchedCount += $pageFetchedCount;
                $newItemsInPage = 0;

                foreach ($items as $item) {
                    if (! isset($item['id'], $item['media_type'], $item['permalink'], $item['timestamp'])) {
                        continue;
                    }

                    $mapped = InstagramMediaMapper::map($item, $account->id);

                    $existing = InstagramMedia::where('instagram_media_id', $mapped['instagram_media_id'])->first();

                    if (! $existing) {
                        InstagramMedia::create($mapped);
                        $insertedCount++;
                        $newItemsInPage++;
                    } else {
                        // Preserve local is_visible state
                        unset($mapped['is_visible']);
                        $existing->update($mapped);
                        $updatedCount++;
                    }
                }

                // Incremental mode: if no new items inserted on this page and not fullSync, we can stop
                if (! $fullSync && $newItemsInPage === 0) {
                    Log::info('Incremental sync reached existing posts, stopping early.', [
                        'account_id' => $account->id,
                        'fetched_count' => $fetchedCount,
                    ]);
                    break;
                }

                $afterCursor = $response['paging']['cursors']['after'] ?? null;
                $hasMore = ! empty($afterCursor) && isset($response['paging']['next']);
            }

            $account->update([
                'last_synced_at' => Carbon::now(),
                'last_sync_status' => 'success',
                'last_sync_error' => null,
            ]);

            $syncLog->update([
                'completed_at' => Carbon::now(),
                'status' => 'success',
                'fetched_count' => $fetchedCount,
                'inserted_count' => $insertedCount,
                'updated_count' => $updatedCount,
            ]);

            $this->clearCache();

            return new InstagramSyncResult(
                fetchedCount: $fetchedCount,
                insertedCount: $insertedCount,
                updatedCount: $updatedCount,
                status: 'success'
            );
        } catch (Throwable $e) {
            Log::error('Instagram feed sync failed', [
                'account_id' => $account->id,
                'error' => $e->getMessage(),
            ]);

            $account->update([
                'last_sync_status' => 'failed',
                'last_sync_error' => $e->getMessage(),
            ]);

            $syncLog->update([
                'completed_at' => Carbon::now(),
                'status' => 'failed',
                'error_message' => $e->getMessage(),
            ]);

            return new InstagramSyncResult(
                fetchedCount: $fetchedCount,
                insertedCount: $insertedCount,
                updatedCount: $updatedCount,
                status: 'failed',
                error: $e->getMessage()
            );
        } finally {
            $lock->release();
        }
    }

    public function clearCache(): void
    {
        Cache::forget('instagram:account');
        Cache::forget('instagram:feed:count');
        for ($i = 1; $i <= 10; $i++) {
            Cache::forget("instagram:feed:page:{$i}");
        }
    }
}
