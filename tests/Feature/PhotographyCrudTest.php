<?php

namespace Tests\Feature;

use App\Livewire\Photography as PhotographyComponent;
use App\Livewire\PhotographyBuilder;
use App\Models\Photography;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use Tests\TestCase;

class PhotographyCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_photography_page_can_be_rendered(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route('admin.photographies.index'))
            ->assertStatus(200);
    }

    public function test_can_create_photography_with_auto_generated_slug(): void
    {
        Storage::fake('public');

        $file = UploadedFile::fake()->image('photo1.jpg');

        Livewire::test(PhotographyComponent::class)
            ->set('title', 'Wedding Outdoor')
            ->set('subtitle', 'Momen indah di alam bebas')
            ->set('description', 'Dokumentasi lengkap momen pernikahan outdoor.')
            ->set('keywordsInput', 'wedding, outdoor, romantic')
            ->set('image', $file)
            ->call('savePhotography')
            ->assertDispatched('close-drawer')
            ->assertDispatched('notify');

        $this->assertDatabaseHas('photographies', [
            'title' => 'Wedding Outdoor',
            'slug' => 'wedding-outdoor',
            'subtitle' => 'Momen indah di alam bebas',
            'description' => 'Dokumentasi lengkap momen pernikahan outdoor.',
        ]);

        $photo = Photography::where('title', 'Wedding Outdoor')->first();
        $this->assertEquals(['wedding', 'outdoor', 'romantic'], $photo->keywords);
        $this->assertEquals('wedding-outdoor', $photo->slug);
    }

    public function test_can_update_photography(): void
    {
        $photo = Photography::create([
            'title' => 'Foto Lama',
            'slug' => 'foto-lama',
            'subtitle' => 'Sub lama',
            'keywords' => ['tag1', 'tag2'],
            'image' => 'photographies/old.jpg',
        ]);

        Livewire::test(PhotographyComponent::class)
            ->call('openEditModal', $photo->id)
            ->set('title', 'Foto Baru')
            ->call('savePhotography')
            ->assertDispatched('close-drawer')
            ->assertDispatched('notify');

        $this->assertDatabaseHas('photographies', [
            'id' => $photo->id,
            'title' => 'Foto Baru',
            'slug' => 'foto-baru',
        ]);
    }

    public function test_builder_page_can_be_rendered(): void
    {
        $user = User::factory()->create();
        $photo = Photography::create([
            'title' => 'Foto Layout',
            'slug' => 'foto-layout',
            'image' => 'photographies/layout.jpg',
        ]);

        $this->actingAs($user)
            ->get(route('admin.photographies.builder', $photo))
            ->assertStatus(200);
    }

    public function test_can_save_grapesjs_content_via_builder(): void
    {
        $photo = Photography::create([
            'title' => 'Foto Builder',
            'slug' => 'foto-builder',
            'image' => 'photographies/builder.jpg',
        ]);

        $htmlContent = '<section><h1>Custom GrapesJS Content via Dedicated Builder</h1></section>';

        Livewire::test(PhotographyBuilder::class, ['photography' => $photo])
            ->call('saveContent', $htmlContent)
            ->assertDispatched('notify');

        $this->assertDatabaseHas('photographies', [
            'id' => $photo->id,
            'content' => $htmlContent,
        ]);
    }

    public function test_can_delete_photography(): void
    {
        $photo = Photography::create([
            'title' => 'Foto Hapus',
            'slug' => 'foto-hapus',
            'image' => 'photographies/delete.jpg',
        ]);

        Livewire::test(PhotographyComponent::class)
            ->call('deletePhotography', $photo->id)
            ->assertDispatched('notify');

        $this->assertDatabaseMissing('photographies', [
            'id' => $photo->id,
        ]);
    }

    public function test_can_bulk_delete_photographies(): void
    {
        $p1 = Photography::create(['title' => 'Foto 1', 'slug' => 'foto-1', 'image' => 'photographies/1.jpg']);
        $p2 = Photography::create(['title' => 'Foto 2', 'slug' => 'foto-2', 'image' => 'photographies/2.jpg']);

        Livewire::test(PhotographyComponent::class)
            ->set('selectedItems', [(string) $p1->id, (string) $p2->id])
            ->call('deleteSelected')
            ->assertDispatched('notify');

        $this->assertDatabaseMissing('photographies', ['id' => $p1->id]);
        $this->assertDatabaseMissing('photographies', ['id' => $p2->id]);
    }
}
