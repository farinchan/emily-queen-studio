<?php

namespace Tests\Feature;

use App\Jobs\SyncInstagramFeedJob;
use App\Livewire\InstagramFeed;
use App\Models\InstagramAccount;
use App\Models\InstagramMedia;
use App\Models\User;
use App\Services\InstagramApiService;

use App\Services\InstagramSyncService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Queue;
use Livewire\Livewire;

use Tests\TestCase;

class InstagramFeedFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_access_admin_instagram_page(): void
    {
        $this->get(route('admin.instagram.index'))
            ->assertRedirect(route('login'));
    }

    public function test_admin_can_view_instagram_page(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route('admin.instagram.index'))
            ->assertStatus(200);
    }

    public function test_oauth_redirect_generates_state_and_redirects(): void
    {
        $user = User::factory()->create();

        config([
            'services.instagram.app_id' => '123456789',
            'services.instagram.redirect_uri' => 'http://localhost/instagram/callback',
        ]);

        $response = $this->actingAs($user)
            ->get(route('admin.instagram.connect'));

        $response->assertRedirect();
        $this->assertNotNull(session('instagram_oauth_state'));
        $this->assertStringContainsString('instagram.com/oauth/authorize', $response->headers->get('Location'));
    }

    public function test_callback_rejects_invalid_state(): void
    {
        $user = User::factory()->create();
        session(['instagram_oauth_state' => 'valid-state-123']);

        $response = $this->actingAs($user)
            ->get(route('instagram.callback', [
                'code' => 'dummy-code',
                'state' => 'wrong-state-456',
            ]));

        $response->assertRedirect(route('admin.instagram.index'));
        $response->assertSessionHas('error');
    }

    public function test_successful_callback_stores_encrypted_account_and_dispatches_sync(): void
    {
        Queue::fake();
        $user = User::factory()->create();
        session(['instagram_oauth_state' => 'valid-state-123']);

        Http::fake([
            'api.instagram.com/oauth/access_token' => Http::response([
                'access_token' => 'short-token-123',
                'user_id' => '99887766',
            ], 200),
            'graph.instagram.com/access_token*' => Http::response([
                'access_token' => 'long-lived-token-abc',
                'expires_in' => 5184000, // 60 days
            ], 200),
            'graph.instagram.com/me*' => Http::response([
                'id' => '99887766',
                'username' => 'emilyqueen_studio',
                'name' => 'Emily Queen Studio',
                'account_type' => 'BUSINESS',
                'profile_picture_url' => 'https://example.com/avatar.jpg',
                'media_count' => 42,
            ], 200),
        ]);

        $response = $this->actingAs($user)
            ->get(route('instagram.callback', [
                'code' => 'auth-code-789',
                'state' => 'valid-state-123',
            ]));

        $response->assertRedirect(route('admin.instagram.index'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('instagram_accounts', [
            'instagram_user_id' => '99887766',
            'username' => 'emilyqueen_studio',
        ]);

        $account = InstagramAccount::first();
        $this->assertEquals('long-lived-token-abc', $account->access_token);

        Queue::assertPushed(SyncInstagramFeedJob::class, function ($job) use ($account) {
            return $job->accountId === $account->id && $job->fullSync === true;
        });
    }

    public function test_sync_service_upserts_media_items(): void
    {
        $account = InstagramAccount::create([
            'instagram_user_id' => '12345',
            'username' => 'testuser',
            'access_token' => 'valid-token',
            'connected_at' => now(),
        ]);

        Http::fake([
            'graph.instagram.com/me?*' => Http::response([
                'id' => '12345',
                'username' => 'testuser',
                'media_count' => 1,
            ], 200),
            'graph.instagram.com/me/media*' => Http::response([
                'data' => [
                    [
                        'id' => 'media_1001',
                        'caption' => 'Beautiful photoshoot session',
                        'media_type' => 'IMAGE',
                        'media_product_type' => 'FEED',
                        'media_url' => 'https://example.com/photo.jpg',
                        'permalink' => 'https://instagram.com/p/1001',
                        'timestamp' => '2026-07-25T10:00:00+0000',
                        'username' => 'testuser',
                    ],
                ],
            ], 200),
        ]);

        /** @var InstagramSyncService $syncService */
        $syncService = app(InstagramSyncService::class);
        $result = $syncService->sync($account, true);

        $this->assertEquals('success', $result->status);
        $this->assertEquals(1, $result->insertedCount);

        $this->assertDatabaseHas('instagram_media', [
            'instagram_media_id' => 'media_1001',
            'caption' => 'Beautiful photoshoot session',
        ]);
    }

    public function test_disconnect_deletes_account_and_media(): void
    {
        $user = User::factory()->create();

        $account = InstagramAccount::create([
            'instagram_user_id' => '12345',
            'username' => 'testuser',
            'access_token' => 'token',
        ]);

        InstagramMedia::create([
            'instagram_account_id' => $account->id,
            'instagram_media_id' => 'm1',
            'media_type' => 'IMAGE',
            'permalink' => 'https://instagram.com/p/m1',
            'posted_at' => now(),
        ]);

        $response = $this->actingAs($user)
            ->delete(route('admin.instagram.disconnect'));

        $response->assertRedirect();
        $this->assertDatabaseMissing('instagram_accounts', ['id' => $account->id]);
        $this->assertDatabaseMissing('instagram_media', ['instagram_media_id' => 'm1']);
    }

    public function test_public_feed_displays_stored_media_without_calling_meta_api(): void
    {
        Http::fake(); // If Meta API is called, HTTP fake will record it

        $account = InstagramAccount::create([
            'instagram_user_id' => '12345',
            'username' => 'testuser',
            'access_token' => 'token',
        ]);

        InstagramMedia::create([
            'instagram_account_id' => $account->id,
            'instagram_media_id' => 'm100',
            'caption' => 'Public Post Caption',
            'media_type' => 'IMAGE',
            'media_url' => 'https://example.com/image.jpg',
            'permalink' => 'https://instagram.com/p/m100',
            'posted_at' => now(),
            'is_visible' => true,
        ]);

        $response = $this->get(route('instagram.feed'));

        $response->assertStatus(200);
        $response->assertSee('Public Post Caption');

        Http::assertNothingSent();
    }

    public function test_refresh_token_artisan_command(): void
    {
        $account = InstagramAccount::create([
            'instagram_user_id' => '12345',
            'username' => 'testuser',
            'access_token' => 'old-token',
            'token_expires_at' => Carbon::now()->addDays(5),
        ]);

        Http::fake([
            'graph.instagram.com/refresh_access_token*' => Http::response([
                'access_token' => 'new-refreshed-token',
                'expires_in' => 5184000,
            ], 200),
        ]);

        $exitCode = Artisan::call('instagram:refresh-token');

        $this->assertEquals(0, $exitCode);
        $this->assertEquals('new-refreshed-token', $account->fresh()->access_token);
    }
}
