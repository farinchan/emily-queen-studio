<?php

namespace Database\Seeders;

use App\Models\Banner;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'name' => 'Fajri Rinaldi Chan',
            'email' => 'fajri@gariskode.com',
            'password' => bcrypt('password'),
            'about' => 'I am a passionate software developer with a love for creating innovative solutions.',
            'instagram' => 'https://www.instagram.com/fajri_chan/',
        ]);

        Banner::create([
            'label' => 'Prewedding · Cappadocia',
            'title' => 'Side by Side',
            'subtitle' => 'Sebastian & Linda · A celebration filled with grace',
            'image' => 'https://images.unsplash.com/photo-1519741497674-611481863552?auto=format&fit=crop&w=2200&q=90',
            'link' => '/collections/summer-sale',
        ]);

        Banner::create([
            'label' => 'Wedding · Jakarta',
            'title' => 'Promises, Kept',
            'subtitle' => 'Sebastian &amp; Linda · A celebration filled with grace',
            'image' => 'https://images.unsplash.com/photo-1522673607200-164d1b6ce486?auto=format&fit=crop&w=2200&q=90',
            'link' => '/collections/summer-sale',
        ]);

        Banner::create([
            'label' => 'Family · Portraiture',
            'title' => 'Forever Found',
            'subtitle' => 'A collection of laughter, tenderness, and home',
            'image' => 'https://images.unsplash.com/photo-1544078751-58fee2d8a03b?auto=format&fit=crop&w=2200&q=90',
            'link' => '/collections/summer-sale',
        ]);

        Banner::create([
            'label' => 'Editorial · Bali',
            'title' => 'Unseen Beginnings',
            'subtitle' => 'A modern romance shaped by tradition and light',
            'image' => 'https://images.unsplash.com/photo-1523438885200-e635ba2c371e?auto=format&fit=crop&w=2200&q=90',
            'link' => '/collections/summer-sale',
        ]);


    }
}
