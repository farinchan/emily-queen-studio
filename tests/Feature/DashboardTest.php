<?php

namespace Tests\Feature;

use App\Livewire\Dashboard;
use App\Models\User;
use App\Models\Visitor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_dashboard_page_can_be_rendered(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route('admin.dashboard'))
            ->assertStatus(200);
    }

    public function test_dashboard_calculates_visitor_analytics(): void
    {
        Visitor::create([
            'ip' => '192.168.1.1',
            'country' => 'Indonesia',
            'city' => 'Jakarta',
            'platform' => 'macOS',
            'browser' => 'Chrome',
            'device' => 'Desktop',
        ]);

        Visitor::create([
            'ip' => '192.168.1.2',
            'country' => 'Indonesia',
            'city' => 'Bandung',
            'platform' => 'Android',
            'browser' => 'Chrome',
            'device' => 'Mobile',
        ]);

        $user = User::factory()->create();

        Livewire::actingAs($user)
            ->test(Dashboard::class)
            ->assertSet('totalVisitors', 2)
            ->assertSet('todayVisitors', 2)
            ->assertSet('uniqueVisitors', 2);
    }

    public function test_home_page_logs_visitor(): void
    {
        $this->get(route('home'))
            ->assertStatus(200);

        $this->assertDatabaseHas('visitors', [
            'ip' => '127.0.0.1',
        ]);
    }
}
