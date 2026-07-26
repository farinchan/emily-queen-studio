<?php

namespace App\Livewire;

use App\Models\Visitor;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Dashboard')]
class Dashboard extends Component
{
    public int $totalVisitors = 0;
    public int $todayVisitors = 0;
    public int $uniqueVisitors = 0;
    public string $topDevice = 'Desktop';

    public array $chartDays = [];
    public array $chartData = [];

    public array $topCountries = [];
    public array $deviceBreakdown = [];
    public array $browserBreakdown = [];
    public array $platformBreakdown = [];

    public function mount(): void
    {
        $this->loadDashboardData();
    }

    public function loadDashboardData(): void
    {
        $this->totalVisitors = Visitor::count();
        $this->todayVisitors = Visitor::whereDate('created_at', Carbon::today())->count();
        $this->uniqueVisitors = Visitor::distinct('ip')->count('ip');

        $mostDevice = Visitor::select('device', DB::raw('count(*) as total'))
            ->whereNotNull('device')
            ->groupBy('device')
            ->orderByDesc('total')
            ->first();

        $this->topDevice = $mostDevice ? $mostDevice->device : 'Desktop';

        // Daily Visitors Trend (Last 7 Days)
        $days = [];
        $counts = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            $days[] = $date->format('d M');
            $counts[] = Visitor::whereDate('created_at', $date)->count();
        }

        $this->chartDays = $days;
        $this->chartData = $counts;

        // Top Countries
        $this->topCountries = Visitor::select('country', DB::raw('count(*) as total'))
            ->whereNotNull('country')
            ->groupBy('country')
            ->orderByDesc('total')
            ->take(5)
            ->get()
            ->toArray();

        // Device Breakdown
        $this->deviceBreakdown = Visitor::select('device', DB::raw('count(*) as total'))
            ->whereNotNull('device')
            ->groupBy('device')
            ->orderByDesc('total')
            ->get()
            ->toArray();

        // Browser Breakdown
        $this->browserBreakdown = Visitor::select('browser', DB::raw('count(*) as total'))
            ->whereNotNull('browser')
            ->groupBy('browser')
            ->orderByDesc('total')
            ->get()
            ->toArray();

        // Platform Breakdown
        $this->platformBreakdown = Visitor::select('platform', DB::raw('count(*) as total'))
            ->whereNotNull('platform')
            ->groupBy('platform')
            ->orderByDesc('total')
            ->get()
            ->toArray();
    }

    public function render()
    {
        $recentVisitors = Visitor::latest()->take(8)->get();

        return view('livewire.dashboard', [
            'recentVisitors' => $recentVisitors,
        ]);
    }
}
