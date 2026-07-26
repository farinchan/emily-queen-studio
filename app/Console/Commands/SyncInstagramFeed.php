<?php

namespace App\Console\Commands;

use App\Jobs\SyncInstagramFeedJob;
use App\Models\InstagramAccount;
use App\Services\InstagramSyncService;
use Illuminate\Console\Command;
use Throwable;

class SyncInstagramFeed extends Command
{
    protected $signature = 'instagram:sync {--full : Run a full sync of all available pages} {--queue : Dispatch sync to the queue}';
    protected $description = 'Synchronise Instagram media posts into local database';

    public function handle(InstagramSyncService $syncService): int
    {
        $account = InstagramAccount::query()->first();

        if (! $account || ! $account->isConnected()) {
            $this->info('No connected Instagram account found. Skipping feed sync.');
            return self::SUCCESS;
        }

        $full = (bool) $this->option('full');
        $queue = (bool) $this->option('queue');

        if ($queue) {
            SyncInstagramFeedJob::dispatch($account->id, $full);
            $this->info('Instagram sync job dispatched to queue.');
            return self::SUCCESS;
        }

        $this->info('Starting synchronous Instagram feed sync...');

        try {
            $result = $syncService->sync($account, $full);

            if ($result->status === 'failed') {
                $this->error('Sync failed: '.$result->error);
                return self::FAILURE;
            }

            $this->info("Sync completed successfully! Fetched: {$result->fetchedCount}, Inserted: {$result->insertedCount}, Updated: {$result->updatedCount}");
            return self::SUCCESS;
        } catch (Throwable $e) {
            $this->error('Sync failed with exception: '.$e->getMessage());
            return self::FAILURE;
        }
    }
}
