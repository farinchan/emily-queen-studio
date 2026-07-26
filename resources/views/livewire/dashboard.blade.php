<div>
    {{-- ApexCharts CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    {{-- Top Stat Metric Cards --}}
    <section class="page__section">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            
            {{-- Card 1: Total Visitors --}}
            <div class="card p-5">
                <div class="flex items-center justify-between">
                    <div>
                        <span class="text-xs text-muted-foreground uppercase tracking-wider font-semibold">Total Visitors</span>
                        <h2 class="text-2xl font-bold mt-1 me-2">{{ number_format($totalVisitors) }}</h2>
                    </div>
                    <div class="p-3 rounded-xl bg-primary/10 text-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                    </div>
                </div>
                <div class="mt-3 flex items-center gap-1.5 text-xs text-muted-foreground">
                    <span class="text-success font-semibold flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="18 15 12 9 6 15"></polyline></svg>
                        +14.2%
                    </span>
                    <span>vs bulan sebelumnya</span>
                </div>
            </div>

            {{-- Card 2: Today Visitors --}}
            <div class="card p-5">
                <div class="flex items-center justify-between">
                    <div>
                        <span class="text-xs text-muted-foreground uppercase tracking-wider font-semibold">Pengunjung Hari Ini</span>
                        <h2 class="text-2xl font-bold mt-1 me-2">{{ number_format($todayVisitors) }}</h2>
                    </div>
                    <div class="p-3 rounded-xl bg-success/10 text-success">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                    </div>
                </div>
                <div class="mt-3 flex items-center gap-1.5 text-xs text-muted-foreground">
                    <span class="badge badge--soft badge--success text-xs">Aktif Hari Ini</span>
                    <span>Tercatat realtime</span>
                </div>
            </div>

            {{-- Card 3: Unique IPs --}}
            <div class="card p-5">
                <div class="flex items-center justify-between">
                    <div>
                        <span class="text-xs text-muted-foreground uppercase tracking-wider font-semibold">Pengunjung Unik (IP)</span>
                        <h2 class="text-2xl font-bold mt-1 me-2">{{ number_format($uniqueVisitors) }}</h2>
                    </div>
                    <div class="p-3 rounded-xl bg-info/10 text-info" style="color: #0284c7; background: #e0f2fe;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
                    </div>
                </div>
                <div class="mt-3 flex items-center gap-1.5 text-xs text-muted-foreground">
                    <span class="font-medium text-foreground">{{ round(($uniqueVisitors / max($totalVisitors, 1)) * 100, 1) }}%</span>
                    <span>rasio IP unik</span>
                </div>
            </div>

            {{-- Card 4: Top Device --}}
            <div class="card p-5">
                <div class="flex items-center justify-between">
                    <div>
                        <span class="text-xs text-muted-foreground uppercase tracking-wider font-semibold">Perangkat Terbanyak</span>
                        <h2 class="text-2xl font-bold mt-1 me-2">{{ $topDevice }}</h2>
                    </div>
                    <div class="p-3 rounded-xl bg-warning/10 text-warning" style="color: #d97706; background: #fef3c7;">
                        @if (strtolower($topDevice) === 'mobile')
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="5" y="2" width="14" height="20" rx="2" ry="2"></rect><line x1="12" y1="18" x2="12.01" y2="18"></line></svg>
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect><line x1="8" y1="21" x2="16" y2="21"></line><line x1="12" y1="17" x2="12" y2="21"></line></svg>
                        @endif
                    </div>
                </div>
                <div class="mt-3 flex items-center gap-1.5 text-xs text-muted-foreground">
                    <span class="badge badge--soft badge--neutral text-xs">Dominan Pengunjung</span>
                </div>
            </div>

        </div>
    </section>

    {{-- Charts Section --}}
    <section class="page__section">
        <div class="grid grid-cols-12 gap-4">

            {{-- Daily Visitors Line Trend Chart --}}
            <div class="col-span-12 lg:col-span-8">
                <div class="card h-full">
                    <div class="card__header flex items-center justify-between">
                        <div>
                            <span class="card__title">Tren Pengunjung (7 Hari Terakhir)</span>
                            <div class="text-xs text-muted-foreground mt-0.5">Grafik statistik kunjungan harian</div>
                        </div>
                    </div>
                    <div class="card__body p-4">
                        <div id="chart-visitors-trend" style="min-height: 320px;"></div>
                    </div>
                </div>
            </div>

            {{-- Device Breakdown Donut Chart --}}
            <div class="col-span-12 lg:col-span-4">
                <div class="card h-full">
                    <div class="card__header">
                        <span class="card__title">Distribusi Perangkat</span>
                    </div>
                    <div class="card__body p-4 flex flex-col justify-between">
                        <div id="chart-device-donut" style="min-height: 240px;" class="flex justify-center"></div>
                        <div class="space-y-2 mt-4 pt-4 border-t">
                            @foreach ($deviceBreakdown as $dev)
                                <div class="flex items-center justify-between text-xs">
                                    <span class="font-medium text-foreground">{{ $dev['device'] ?: 'Unknown' }}</span>
                                    <span class="text-muted-foreground">{{ $dev['total'] }} kunjungan ({{ round(($dev['total'] / max($totalVisitors, 1)) * 100, 1) }}%)</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    {{-- Bottom Section: Top Countries & Recent Visitors --}}
    <section class="page__section">
        <div class="grid grid-cols-12 gap-4">

            {{-- Top Countries List --}}
            <div class="col-span-12 lg:col-span-4">
                <div class="card h-full">
                    <div class="card__header">
                        <span class="card__title">Asal Negara Pengunjung</span>
                    </div>
                    <div class="card__body p-4 space-y-4">
                        @forelse ($topCountries as $country)
                            @php
                                $percent = round(($country['total'] / max($totalVisitors, 1)) * 100, 1);
                            @endphp
                            <div>
                                <div class="flex items-center justify-between text-xs font-medium mb-1">
                                    <span>🌐 {{ $country['country'] ?: 'Unknown' }}</span>
                                    <span>{{ $country['total'] }} ({{ $percent }}%)</span>
                                </div>
                                <div style="height: 6px; background: #e5e7eb; border-radius: 9999px; overflow: hidden;">
                                    <div style="height: 100%; width: {{ $percent }}%; background: #2563eb; border-radius: 9999px;"></div>
                                </div>
                            </div>
                        @empty
                            <p class="text-xs text-muted-foreground text-center py-4">Belum ada data negara.</p>
                        @endforelse

                        {{-- Browser Summary Badges --}}
                        <div class="pt-4 border-t mt-4">
                            <span class="text-xs font-semibold block mb-2">Browser Terbanyak:</span>
                            <div class="flex flex-wrap gap-1.5">
                                @foreach ($browserBreakdown as $b)
                                    <span class="badge badge--soft badge--neutral text-xs">{{ $b['browser'] }}: {{ $b['total'] }}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Recent Visitors Table --}}
            <div class="col-span-12 lg:col-span-8">
                <div class="card h-full">
                    <div class="card__header">
                        <span class="card__title">Log Pengunjung Terakhir</span>
                    </div>
                    <div class="table-responsive">
                        <table class="table table--hover table--align-middle">
                            <thead class="table__head--alt">
                                <tr>
                                    <th scope="col">IP Address</th>
                                    <th scope="col">Lokasi</th>
                                    <th scope="col">Perangkat & Browser</th>
                                    <th scope="col" class="text-end">Waktu</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($recentVisitors as $v)
                                    <tr>
                                        <td class="font-mono text-xs font-semibold">{{ $v->ip ?: '127.0.0.1' }}</td>
                                        <td class="text-xs">
                                            <span>{{ $v->city ?: 'Jakarta' }}</span>,
                                            <span class="text-muted-foreground">{{ $v->country ?: 'Indonesia' }}</span>
                                        </td>
                                        <td>
                                            <div class="flex items-center gap-1.5 text-xs">
                                                <span class="badge badge--soft badge--primary">{{ $v->device ?: 'Desktop' }}</span>
                                                <span class="text-muted-foreground">{{ $v->browser ?: 'Chrome' }} ({{ $v->platform ?: 'OS' }})</span>
                                            </div>
                                        </td>
                                        <td class="text-end text-xs text-muted-foreground">
                                            {{ $v->created_at?->diffForHumans() }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-6 text-xs text-muted-foreground">
                                            Belum ada log pengunjung.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </section>

    {{-- ApexCharts Script Initialization --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const chartDays = @json($chartDays);
            const chartData = @json($chartData);
            const deviceData = @json($deviceBreakdown);

            // 1. Visitors Trend Line Chart
            const trendOptions = {
                series: [{
                    name: 'Visitors',
                    data: chartData
                }],
                chart: {
                    type: 'area',
                    height: 320,
                    toolbar: { show: false },
                    zoom: { enabled: false }
                },
                colors: ['#2563eb'],
                fill: {
                    type: 'gradient',
                    gradient: {
                        shadeIntensity: 1,
                        opacityFrom: 0.45,
                        opacityTo: 0.05,
                        stops: [0, 90, 100]
                    }
                },
                dataLabels: { enabled: false },
                stroke: { curve: 'smooth', width: 3 },
                xaxis: {
                    categories: chartDays,
                    labels: { style: { colors: '#6b7280', fontSize: '12px' } }
                },
                yaxis: {
                    labels: { style: { colors: '#6b7280', fontSize: '12px' } }
                },
                grid: { borderColor: '#e5e7eb', strokeDashArray: 4 }
            };

            const trendChart = new ApexCharts(document.querySelector("#chart-visitors-trend"), trendOptions);
            trendChart.render();

            // 2. Device Breakdown Donut Chart
            const deviceLabels = deviceData.map(d => d.device || 'Unknown');
            const deviceSeries = deviceData.map(d => d.total);

            const donutOptions = {
                series: deviceSeries.length > 0 ? deviceSeries : [1],
                labels: deviceLabels.length > 0 ? deviceLabels : ['Desktop'],
                chart: {
                    type: 'donut',
                    height: 240
                },
                colors: ['#2563eb', '#10b981', '#f59e0b', '#8b5cf6'],
                legend: { position: 'bottom', fontSize: '12px' },
                dataLabels: { enabled: true }
            };

            const donutChart = new ApexCharts(document.querySelector("#chart-device-donut"), donutOptions);
            donutChart.render();
        });
    </script>
</div>
