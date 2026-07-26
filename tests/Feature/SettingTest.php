<?php

namespace Tests\Feature;

use App\Livewire\Setting as SettingComponent;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use Tests\TestCase;

class SettingTest extends TestCase
{
    use RefreshDatabase;

    public function test_setting_page_can_be_rendered(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route('admin.settings.index'))
            ->assertStatus(200);
    }

    public function test_settings_can_be_updated_and_saved(): void
    {
        Storage::fake('public');
        $user = User::factory()->create();

        $logo = UploadedFile::fake()->image('logo.png');
        $favicon = UploadedFile::fake()->image('favicon.png');

        Livewire::actingAs($user)
            ->test(SettingComponent::class)
            ->set('site_name', 'Emily Queen Studio Official')
            ->set('site_description', 'Studio Fotografi & Videografi Terbaik')
            ->set('site_keyword', 'wedding, studio, photography')
            ->set('address', 'Jl. Sudirman No. 88, Jakarta')
            ->set('maps_embed', '<iframe src="https://maps.google.com"></iframe>')
            ->set('instagram', 'https://instagram.com/emilyqueen')
            ->set('facebook', 'https://facebook.com/emilyqueen')
            ->set('youtube', 'https://youtube.com/@emilyqueen')
            ->set('whatsapp', '6281234567890')
            ->set('site_logo', $logo)
            ->set('site_favicon', $favicon)
            ->call('save')
            ->assertDispatched('notify');

        $this->assertEquals('Emily Queen Studio Official', Setting::get('site_name'));
        $this->assertEquals('Studio Fotografi & Videografi Terbaik', Setting::get('site_description'));
        $this->assertEquals('wedding, studio, photography', Setting::get('site_keyword'));
        $this->assertEquals('Jl. Sudirman No. 88, Jakarta', Setting::get('address'));
        $this->assertEquals('<iframe src="https://maps.google.com"></iframe>', Setting::get('maps_embed'));
        $this->assertEquals('https://instagram.com/emilyqueen', Setting::get('instagram'));
        $this->assertEquals('https://facebook.com/emilyqueen', Setting::get('facebook'));
        $this->assertEquals('https://youtube.com/@emilyqueen', Setting::get('youtube'));
        $this->assertEquals('6281234567890', Setting::get('whatsapp'));
        $this->assertNotNull(Setting::get('site_logo'));
        $this->assertNotNull(Setting::get('site_favicon'));
    }
}
