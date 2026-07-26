<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\InstagramCallbackRequest;
use App\Jobs\SyncInstagramFeedJob;
use App\Models\InstagramAccount;
use App\Services\InstagramApiService;
use App\Services\InstagramAuthService;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Throwable;

class InstagramController extends Controller
{
    public function redirect(Request $request, InstagramAuthService $authService): RedirectResponse
    {
        $state = Str::random(40);
        $request->session()->put('instagram_oauth_state', $state);

        Log::info('Initiating Instagram OAuth connection', [
            'user_id' => $request->user()?->id,
        ]);

        return redirect()->away($authService->authorizationUrl($state));
    }

    public function callback(
        InstagramCallbackRequest $request,
        InstagramAuthService $authService,
        InstagramApiService $apiService
    ): RedirectResponse {
        $savedState = $request->session()->pull('instagram_oauth_state');

        if (! $savedState || ! $request->state || ! hash_equals($savedState, $request->state)) {
            Log::warning('Instagram OAuth callback state mismatch or missing.');
            return redirect()->route('admin.instagram.index')
                ->with('error', 'Invalid OAuth state token. Please try connecting again.');
        }

        if ($request->filled('error')) {
            $description = $request->input('error_description', 'User cancelled authorization or access was denied.');
            Log::warning('Instagram OAuth authorization error returned.', ['error' => $description]);
            return redirect()->route('admin.instagram.index')
                ->with('error', 'Instagram connection failed: '.$description);
        }

        $code = $request->input('code');
        if (! $code) {
            return redirect()->route('admin.instagram.index')
                ->with('error', 'Authorization code not provided by Instagram.');
        }

        try {
            // 1. Exchange code for short-lived token
            $shortTokenData = $authService->exchangeCode($code);
            $shortToken = $shortTokenData['access_token'] ?? null;
            $userIgId = (string) ($shortTokenData['user_id'] ?? '');

            if (! $shortToken) {
                throw new \Exception('Short-lived access token not received from Instagram.');
            }

            // 2. Exchange short-lived token for long-lived token
            $longTokenData = $authService->exchangeLongLivedToken($shortToken);
            $longToken = $longTokenData['access_token'] ?? null;
            $expiresIn = $longTokenData['expires_in'] ?? null;

            if (! $longToken) {
                throw new \Exception('Long-lived access token not received from Instagram.');
            }

            $expiresAt = $expiresIn
                ? Carbon::now()->addSeconds((int) $expiresIn)
                : Carbon::now()->addDays(60);

            // 3. Fetch profile details
            $profile = $apiService->getProfile($longToken);
            $instagramUserId = (string) ($profile['id'] ?? $userIgId);

            // 4. Save account transactionally (single account enforcement)
            $account = DB::transaction(function () use ($instagramUserId, $profile, $longToken, $expiresAt) {
                // Delete existing account & cascade media
                InstagramAccount::query()->delete();

                return InstagramAccount::create([
                    'instagram_user_id' => $instagramUserId,
                    'username' => $profile['username'] ?? null,
                    'name' => $profile['name'] ?? null,
                    'account_type' => $profile['account_type'] ?? 'BUSINESS',
                    'profile_picture_url' => $profile['profile_picture_url'] ?? null,
                    'media_count' => $profile['media_count'] ?? 0,
                    'access_token' => $longToken,
                    'token_expires_at' => $expiresAt,
                    'connected_at' => Carbon::now(),
                    'last_sync_status' => 'never',
                ]);
            });

            Log::info('Instagram account connected successfully', [
                'account_id' => $account->id,
                'username' => $account->username,
            ]);

            // 5. Dispatch initial full sync
            SyncInstagramFeedJob::dispatch($account->id, true);

            return redirect()->route('admin.instagram.index')
                ->with('success', 'Akun Instagram (@'.$account->username.') berhasil dihubungkan! Sinkronisasi awal postingan sedang berjalan di latar belakang.');
        } catch (Throwable $e) {
            Log::error('Instagram OAuth callback processing failed', [
                'error' => $e->getMessage(),
            ]);

            return redirect()->route('admin.instagram.index')
                ->with('error', 'Gagal menghubungkan akun Instagram: '.$e->getMessage());
        }
    }

    public function sync(Request $request): RedirectResponse
    {
        $account = InstagramAccount::query()->first();

        if (! $account || ! $account->isConnected()) {
            return redirect()->route('admin.instagram.index')
                ->with('error', 'Belum ada akun Instagram yang terhubung.');
        }

        SyncInstagramFeedJob::dispatch($account->id, true);

        return redirect()->route('admin.instagram.index')
                ->with('success', 'Sinkronisasi postingan Instagram telah dimulai di latar belakang.');
    }

    public function disconnect(Request $request): RedirectResponse
    {
        $account = InstagramAccount::query()->first();

        if ($account) {
            $username = $account->username;
            DB::transaction(function () use ($account) {
                $account->delete(); // Cascade deletes media & logs
            });

            Log::info('Instagram account disconnected', [
                'username' => $username,
            ]);
        }

        return redirect()->route('admin.instagram.index')
            ->with('success', 'Akun Instagram berhasil diputuskan.');
    }
}
