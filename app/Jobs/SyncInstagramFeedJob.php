<?php

namespace App\Jobs;

use App\Models\InstagramAccount;
use App\Services\InstagramSyncService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Throwable;

class SyncInstagramFeedJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries = 3;
    public array $backoff = [60, 180, 600];

    public function __construct(
        public int $accountId,
        public bool $fullSync = false
    ) {}

    public function handle(InstagramSyncService $syncService): void
    {
        $account = InstagramAccount::find($this->accountId);

        if (! $account || ! $account->isConnected()) {
            Log::info('Instagram sync job skipped, no connected account found.', [
                'account_id' => $this->accountId,
            ]);
            return;
        }

        $result = $syncService->sync($account, $this->fullSync);

        if ($result->status === 'failed') {
            Log::error('Instagram sync job failed execution', [
                'account_id' => $this->accountId,
                'error' => $result->error,
            ]);
            if ($this->attempts() >= $this->tries) {
                $account->update([
                    'last_sync_status' => 'failed',
                    'last_sync_error' => $result->error,
                ]);
            }
        }
    }

    public function failed(Throwable $exception): void
    {
        $account = InstagramAccount::find($this->accountId);
        if ($account) {
            $account->update([
                'last_sync_status' => 'failed',
                'last_sync_error' => $exception->getMessage(),
            ]);
        }
    }
}
