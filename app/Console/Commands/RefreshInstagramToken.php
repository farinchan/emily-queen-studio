<?php

namespace App\Console\Commands;

use App\Models\InstagramAccount;
use App\Services\InstagramAuthService;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Throwable;

class RefreshInstagramToken extends Command
{
    protected $signature = 'instagram:refresh-token {--force : Force token refresh regardless of expiration date}';
    protected $description = 'Refresh long-lived Instagram access token before it expires';

    public function handle(InstagramAuthService $authService): int
    {
        $account = InstagramAccount::query()->first();

        if (! $account || ! $account->isConnected()) {
            $this->info('No connected Instagram account found. Skipping token refresh.');
            return self::SUCCESS;
        }

        $force = (bool) $this->option('force');

        if (! $force && ! $account->tokenExpiresSoon(10)) {
            $this->info('Instagram access token does not require refresh yet.');
            return self::SUCCESS;
        }

        $this->info('Refreshing Instagram long-lived access token...');

        try {
            $response = $authService->refreshLongLivedToken($account->access_token);

            $newToken = $response['access_token'] ?? null;
            $expiresIn = $response['expires_in'] ?? null;

            if (! $newToken) {
                $this->error('Failed to retrieve new access token from Instagram API.');
                return self::FAILURE;
            }

            $expiresAt = $expiresIn ? Carbon::now()->addSeconds($expiresIn) : Carbon::now()->addDays(60);

            $account->update([
                'access_token' => $newToken,
                'token_expires_at' => $expiresAt,
            ]);

            Log::info('Instagram long-lived token successfully refreshed.', [
                'account_id' => $account->id,
                'expires_at' => $expiresAt->toIso8601String(),
            ]);

            $this->info("Token successfully refreshed. Expires at: {$expiresAt->toDateTimeString()}");
            return self::SUCCESS;
        } catch (Throwable $e) {
            Log::error('Instagram token refresh command failed', [
                'account_id' => $account->id,
                'error' => $e->getMessage(),
            ]);

            $this->error('Failed to refresh token: '.$e->getMessage());
            return self::FAILURE;
        }
    }
}
