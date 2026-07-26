<?php

namespace Tests\Feature;

use App\Livewire\Profile as ProfileComponent;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    public function test_profile_page_can_be_rendered(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route('admin.profile'))
            ->assertStatus(200);
    }

    public function test_user_can_update_profile_information(): void
    {
        Storage::fake('public');

        $user = User::create([
            'name' => 'Nama Lama',
            'email' => 'lama@example.com',
            'password' => bcrypt('password123'),
        ]);

        $file = UploadedFile::fake()->image('avatar.jpg');

        $this->actingAs($user);

        Livewire::test(ProfileComponent::class)
            ->set('name', 'Nama Baru')
            ->set('email', 'baru@example.com')
            ->set('position', 'Senior Manager')
            ->set('instagram', 'namabaru')
            ->set('about', 'Bio singkat baru.')
            ->set('image', $file)
            ->call('updateProfile')
            ->assertDispatched('notify');

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'Nama Baru',
            'email' => 'baru@example.com',
            'position' => 'Senior Manager',
            'instagram' => 'namabaru',
            'about' => 'Bio singkat baru.',
        ]);
    }

    public function test_user_can_change_password(): void
    {
        $user = User::create([
            'name' => 'User Test',
            'email' => 'testpass@example.com',
            'password' => Hash::make('old-password-123'),
        ]);

        $this->actingAs($user);

        Livewire::test(ProfileComponent::class)
            ->set('current_password', 'old-password-123')
            ->set('new_password', 'new-password-456')
            ->set('new_password_confirmation', 'new-password-456')
            ->call('updatePassword')
            ->assertDispatched('notify');

        $this->assertTrue(Hash::check('new-password-456', $user->fresh()->password));
    }

    public function test_user_cannot_change_password_with_invalid_current_password(): void
    {
        $user = User::create([
            'name' => 'User Test',
            'email' => 'testpass2@example.com',
            'password' => Hash::make('old-password-123'),
        ]);

        $this->actingAs($user);

        Livewire::test(ProfileComponent::class)
            ->set('current_password', 'wrong-current-password')
            ->set('new_password', 'new-password-456')
            ->set('new_password_confirmation', 'new-password-456')
            ->call('updatePassword')
            ->assertHasErrors(['current_password']);

        $this->assertTrue(Hash::check('old-password-123', $user->fresh()->password));
    }

    public function test_other_browser_sessions_can_be_logged_out(): void
    {
        $user = User::create([
            'name' => 'User Session Test',
            'email' => 'session@example.com',
            'password' => Hash::make('password123'),
        ]);

        DB::table('sessions')->insert([
            'id' => 'other-session-id-123',
            'user_id' => $user->id,
            'ip_address' => '127.0.0.1',
            'user_agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7)',
            'payload' => 'dummy',
            'last_activity' => time(),
        ]);

        Livewire::actingAs($user)
            ->test(ProfileComponent::class)
            ->set('logout_password', 'password123')
            ->call('logoutOtherSessions')
            ->assertDispatched('notify');

        $this->assertDatabaseMissing('sessions', [
            'id' => 'other-session-id-123',
        ]);
    }
}
