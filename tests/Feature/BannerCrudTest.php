<?php

namespace Tests\Feature;

use App\Livewire\Banner as BannerComponent;
use App\Models\Banner;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use Tests\TestCase;

class BannerCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_banner_page_can_be_rendered(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route('admin.banners.index'))
            ->assertStatus(200);
    }

    public function test_can_create_banner(): void
    {
        Storage::fake('public');

        $file = UploadedFile::fake()->image('banner1.jpg');

        Livewire::test(BannerComponent::class)
            ->set('title', 'Promo Special')
            ->set('label', 'Summer Sale')
            ->set('subtitle', 'Diskon hingga 50%')
            ->set('link', '/promo')
            ->set('image', $file)
            ->call('saveBanner')
            ->assertDispatched('close-drawer')
            ->assertDispatched('notify');

        $this->assertDatabaseHas('banners', [
            'title' => 'Promo Special',
            'label' => 'Summer Sale',
            'subtitle' => 'Diskon hingga 50%',
            'link' => '/promo',
        ]);
    }

    public function test_can_update_banner(): void
    {
        $banner = Banner::create([
            'title' => 'Banner Lama',
            'label' => 'Label',
            'image' => 'banners/old.jpg',
        ]);

        Livewire::test(BannerComponent::class)
            ->call('openEditModal', $banner->id)
            ->set('title', 'Banner Baru')
            ->call('saveBanner')
            ->assertDispatched('close-drawer')
            ->assertDispatched('notify');

        $this->assertDatabaseHas('banners', [
            'id' => $banner->id,
            'title' => 'Banner Baru',
        ]);
    }

    public function test_can_delete_banner(): void
    {
        $banner = Banner::create([
            'title' => 'Banner Hapus',
            'image' => 'banners/delete.jpg',
        ]);

        Livewire::test(BannerComponent::class)
            ->call('deleteBanner', $banner->id)
            ->assertDispatched('notify');

        $this->assertDatabaseMissing('banners', [
            'id' => $banner->id,
        ]);
    }

    public function test_can_bulk_delete_banners(): void
    {
        $b1 = Banner::create(['title' => 'Banner 1', 'image' => 'banners/1.jpg']);
        $b2 = Banner::create(['title' => 'Banner 2', 'image' => 'banners/2.jpg']);

        Livewire::test(BannerComponent::class)
            ->set('selectedBanners', [(string) $b1->id, (string) $b2->id])
            ->call('deleteSelected')
            ->assertDispatched('notify');

        $this->assertDatabaseMissing('banners', ['id' => $b1->id]);
        $this->assertDatabaseMissing('banners', ['id' => $b2->id]);
    }
}
