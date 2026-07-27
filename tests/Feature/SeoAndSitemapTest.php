<?php

namespace Tests\Feature;

use App\Models\Photography;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SeoAndSitemapTest extends TestCase
{
    use RefreshDatabase;

    public function test_sitemap_returns_valid_xml(): void
    {
        Photography::create([
            'title' => 'Test Photography Story',
            'slug' => 'test-photography-story',
            'image' => 'https://example.com/photo.jpg',
            'subtitle' => 'Subtitle text',
            'description' => 'Description text',
        ]);

        $response = $this->get('/sitemap.xml');

        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'application/xml');
        $response->assertSee(url('/'));
        $response->assertSee(route('about'));
        $response->assertSee(route('contact'));
        $response->assertSee(route('photography.show', 'test-photography-story'));
    }

    public function test_robots_txt_returns_text_plain(): void
    {
        $response = $this->get('/robots.txt');

        $response->assertStatus(200);
        $this->assertStringContainsString('text/plain', $response->headers->get('Content-Type'));
        $response->assertSee('User-agent: *');
        $response->assertSee('Disallow: /admin/');
        $response->assertSee(url('/sitemap.xml'));
    }

    public function test_front_head_renders_seo_meta_tags(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('<meta name="description"', false);
        $response->assertSee('<meta name="robots"', false);
        $response->assertSee('<link rel="canonical"', false);
        $response->assertSee('<meta property="og:title"', false);
        $response->assertSee('<meta name="twitter:card"', false);
        $response->assertSee('application/ld+json', false);
    }

    public function test_admin_and_auth_render_noindex_meta(): void
    {
        $loginResponse = $this->get('/login');
        $loginResponse->assertStatus(200);
        $loginResponse->assertSee('<meta name="robots" content="noindex, nofollow"', false);
    }
}
