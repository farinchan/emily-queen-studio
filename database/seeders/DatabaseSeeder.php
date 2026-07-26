<?php

namespace Database\Seeders;

use App\Models\Banner;
use App\Models\Photography;
use App\Models\User;
use App\Models\Visitor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        if (!Role::where('name', 'admin')->exists()) {
            Role::create(['name' => 'admin']);
        }

        if (!User::where('email', 'fajri@gariskode.com')->exists()) {
            User::create([
                'order' => 1,
                'position' => 'Administrator',
                'name' => 'Fajri Rinaldi Chan',
                'email' => 'fajri@gariskode.com',
                'password' => bcrypt('password'),
                'about' => 'I am a passionate software developer with a love for creating innovative solutions.',
                'instagram' => 'https://www.instagram.com/fajri_chan/',
                'is_show' => true,
            ])->assignRole('admin');
        }

        if (Banner::count() === 0) {
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

        if (Photography::count() === 0) {
            Photography::create([
                'image' => 'https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=2200&q=90',
                'title' => 'Elegant Wedding',
                'subtitle' => 'Timeless vows, beautifully captured forever.',
            ]);

            Photography::create([
                'image' => 'https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=2200&q=90',
                'title' => 'Warm Family',
                'subtitle' => 'Cherished moments, laughter, and love.',
            ]);

            Photography::create([
                'image' => 'https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=2200&q=90',
                'title' => 'Graduation Photo',
                'subtitle' => 'Memories of graduation filled with spirit and pride.',
            ]);

            Photography::create([
                'image' => 'https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=2200&q=90',
                'title' => 'Joyful Milestone',
                'subtitle' => 'Your achievement, framed with style.',
            ]);

            Photography::create([
                'image' => 'https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=2200&q=90',
                'title' => 'Office Group Photo',
                'subtitle' => 'A warm moment of teamwork and togetherness.',
            ]);
        }

        // Seed Sample Visitors if empty
        if (Visitor::count() === 0) {
            $countries = [
                ['Indonesia', 'Jakarta', 'DKI Jakarta'],
                ['Indonesia', 'Bandung', 'Jawa Barat'],
                ['Indonesia', 'Surabaya', 'Jawa Timur'],
                ['Indonesia', 'Denpasar', 'Bali'],
                ['United States', 'New York', 'NY'],
                ['Singapore', 'Singapore', 'Singapore'],
                ['Japan', 'Tokyo', 'Kanto'],
                ['United Kingdom', 'London', 'England'],
            ];

            $devices = ['Desktop', 'Mobile', 'Tablet'];
            $browsers = ['Chrome', 'Safari', 'Firefox', 'Edge'];
            $platforms = ['Windows', 'macOS', 'iOS', 'Android', 'Linux'];

            for ($i = 30; $i >= 0; $i--) {
                $countPerDay = rand(5, 25);
                $date = Carbon::now()->subDays($i);

                for ($j = 0; $j < $countPerDay; $j++) {
                    $loc = $countries[array_rand($countries)];
                    Visitor::create([
                        'ip' => rand(100, 200).'.'.rand(10, 200).'.'.rand(1, 250).'.'.rand(1, 250),
                        'country' => $loc[0],
                        'city' => $loc[1],
                        'region' => $loc[2],
                        'user_agent' => 'Mozilla/5.0 Sample Agent',
                        'platform' => $platforms[array_rand($platforms)],
                        'browser' => $browsers[array_rand($browsers)],
                        'device' => $devices[array_rand($devices)],
                        'created_at' => $date->copy()->addMinutes(rand(0, 1430)),
                        'updated_at' => $date,
                    ]);
                }
            }
        }
    }
}
