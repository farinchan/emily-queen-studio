<div>
    <x-slot:description>Ringkasan statistik dan analitik pengunjung Emily Queen Studio.</x-slot:description>

    {{-- Top Stat Cards Section --}}
    <section class="page__section">
        <div class="grid grid-cols-12 gap-4">

            {{-- Card 1: Total Visitors --}}
            <div class="col-span-6 lg:col-span-3">
                <div class="card h-full">
                    <div class="card__body flex-col-reverse md:flex-row gap-4">
                        <div class="w-full flex flex-col gap-2">
                            <span class="text-sm text-muted-foreground">Total Visitors</span>
                            <div class="text-2xl font-bold">{{ number_format($totalVisitors) }}</div>
                            <div class="flex items-center gap-2">
                                <span class="badge badge--soft badge--success">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" aria-hidden="true">
                                        <g fill="none" stroke="currentColor" stroke-width="1.5">
                                            <path d="M2 12c0-4.714 0-7.071 1.464-8.536C4.93 2 7.286 2 12 2s7.071 0 8.535 1.464C22 4.93 22 7.286 22 12s0 7.071-1.465 8.535C19.072 22 16.714 22 12 22s-7.071 0-8.536-1.465C2 19.072 2 16.714 2 12Z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m7 14l2.293-2.293a1 1 0 0 1 1.414 0l1.586 1.586a1 1 0 0 0 1.414 0L17 10m0 0v2.5m0-2.5h-2.5" />
                                        </g>
                                    </svg>
                                    14%
                                </span>
                                <span class="text-xs text-muted-foreground">vs last period</span>
                            </div>
                        </div>
                        <span class="icon-box icon-box--primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" aria-hidden="true">
                                <g fill="none" stroke="currentColor" stroke-width="1.5">
                                    <circle cx="12" cy="12" r="10" />
                                    <path stroke-linecap="round" d="M12 17v1m0-12v1m3 2.5C15 8.12 13.657 7 12 7S9 8.12 9 9.5s1.343 2.5 3 2.5s3 1.12 3 2.5s-1.343 2.5-3 2.5s-3-1.12-3-2.5" />
                                </g>
                            </svg>
                        </span>
                    </div>
                </div>
            </div>

            {{-- Card 2: Visitors Hari Ini --}}
            <div class="col-span-6 lg:col-span-3">
                <div class="card h-full">
                    <div class="card__body flex-col-reverse md:flex-row gap-4">
                        <div class="w-full flex flex-col gap-2">
                            <span class="text-sm text-muted-foreground">Visitors Hari Ini</span>
                            <div class="text-2xl font-bold">{{ number_format($todayVisitors) }}</div>
                            <div class="flex items-center gap-2">
                                <span class="badge badge--soft badge--success">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" aria-hidden="true">
                                        <g fill="none" stroke="currentColor" stroke-width="1.5">
                                            <path d="M2 12c0-4.714 0-7.071 1.464-8.536C4.93 2 7.286 2 12 2s7.071 0 8.535 1.464C22 4.93 22 7.286 22 12s0 7.071-1.465 8.535C19.072 22 16.714 22 12 22s-7.071 0-8.536-1.465C2 19.072 2 16.714 2 12Z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m7 14l2.293-2.293a1 1 0 0 1 1.414 0l1.586 1.586a1 1 0 0 0 1.414 0L17 10m0 0v2.5m0-2.5h-2.5" />
                                        </g>
                                    </svg>
                                    8%
                                </span>
                                <span class="text-xs text-muted-foreground">vs last period</span>
                            </div>
                        </div>
                        <span class="icon-box icon-box--primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" aria-hidden="true">
                                <g fill="none" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" d="m2 3l.265.088c1.32.44 1.98.66 2.357 1.184S5 5.492 5 6.883V9.5c0 2.828 0 4.243.879 5.121c.878.879 2.293.879 5.121.879h8" />
                                    <path d="M7.5 18a1.5 1.5 0 1 1 0 3a1.5 1.5 0 0 1 0-3Zm9 0a1.5 1.5 0 1 1 0 3a1.5 1.5 0 0 1 0-3ZM5 6h11.45c2.055 0 3.083 0 3.528.674c.444.675.04 1.619-.77 3.508l-.429 1c-.378.882-.567 1.322-.942 1.57c-.376.248-.856.248-1.815.248H5" />
                                </g>
                            </svg>
                        </span>
                    </div>
                </div>
            </div>

            {{-- Card 3: Unique Visitors --}}
            <div class="col-span-6 lg:col-span-3">
                <div class="card h-full">
                    <div class="card__body flex-col-reverse md:flex-row gap-4">
                        <div class="w-full flex flex-col gap-2">
                            <span class="text-sm text-muted-foreground">Unique Visitors (IP)</span>
                            <div class="text-2xl font-bold">{{ number_format($uniqueVisitors) }}</div>
                            <div class="flex items-center gap-2">
                                <span class="badge badge--soft badge--success">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" aria-hidden="true">
                                        <g fill="none" stroke="currentColor" stroke-width="1.5">
                                            <path d="M2 12c0-4.714 0-7.071 1.464-8.536C4.93 2 7.286 2 12 2s7.071 0 8.535 1.464C22 4.93 22 7.286 22 12s0 7.071-1.465 8.535C19.072 22 16.714 22 12 22s-7.071 0-8.536-1.465C2 19.072 2 16.714 2 12Z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m7 14l2.293-2.293a1 1 0 0 1 1.414 0l1.586 1.586a1 1 0 0 0 1.414 0L17 10m0 0v2.5m0-2.5h-2.5" />
                                        </g>
                                    </svg>
                                    {{ round(($uniqueVisitors / max($totalVisitors, 1)) * 100, 1) }}%
                                </span>
                                <span class="text-xs text-muted-foreground">unique ratio</span>
                            </div>
                        </div>
                        <span class="icon-box icon-box--primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" aria-hidden="true">
                                <g fill="none" stroke="currentColor" stroke-width="1.5">
                                    <path d="M16.755 2h-9.51c-1.159 0-1.738 0-2.206.163a3.05 3.05 0 0 0-1.881 1.936C3 4.581 3 5.177 3 6.37v14.004c0 .858.985 1.314 1.608.744a.946.946 0 0 1 1.284 0l.483.442a1.657 1.657 0 0 0 2.25 0a1.657 1.657 0 0 1 2.25 0a1.657 1.657 0 0 0 2.25 0a1.657 1.657 0 0 1 2.25 0a1.657 1.657 0 0 0 2.25 0l.483-.442a.946.946 0 0 1 1.284 0c.623.57 1.608.114 1.608-.744V6.37c0-1.193 0-1.79-.158-2.27a3.05 3.05 0 0 0-1.881-1.937C18.493 2 17.914 2 16.755 2Z" />
                                    <path stroke-linecap="round" d="M10.5 11H17M7 11h.5M7 7.5h.5m-.5 7h.5m3-7H17m-6.5 7H17" />
                                </g>
                            </svg>
                        </span>
                    </div>
                </div>
            </div>

            {{-- Card 4: Top Device --}}
            <div class="col-span-6 lg:col-span-3">
                <div class="card h-full">
                    <div class="card__body flex-col-reverse md:flex-row gap-4">
                        <div class="w-full flex flex-col gap-2">
                            <span class="text-sm text-muted-foreground">Top Device</span>
                            <div class="text-2xl font-bold">{{ $topDevice }}</div>
                            <div class="flex items-center gap-2">
                                <span class="badge badge--soft badge--primary">
                                    Dominan
                                </span>
                                <span class="text-xs text-muted-foreground">most visitors</span>
                            </div>
                        </div>
                        <span class="icon-box icon-box--primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m18.364 8.05l-.707-.707a8 8 0 1 0 2.28 4.658m-1.573-3.95h-4.243m4.243 0V3.807" />
                            </svg>
                        </span>
                    </div>
                </div>
            </div>

        </div>
    </section>

    {{-- Main Charts Section --}}
    <section class="page__section mt-4">
        <div class="grid grid-cols-12 gap-4">
            {{-- Visitors Trend Chart --}}
            <div class="col-span-12 xl:col-span-8">
                <div class="card h-full">
                    <div class="card__header flex items-center justify-between">
                        <span class="card__title">Visitors over time</span>
                        <span class="badge badge--soft badge--success ms-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" aria-hidden="true">
                                <g fill="none" stroke="currentColor" stroke-width="1.5">
                                    <path d="M2 12c0-4.714 0-7.071 1.464-8.536C4.93 2 7.286 2 12 2s7.071 0 8.535 1.464C22 4.93 22 7.286 22 12s0 7.071-1.465 8.535C19.072 22 16.714 22 12 22s-7.071 0-8.536-1.465C2 19.072 2 16.714 2 12Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m7 14l2.293-2.293a1 1 0 0 1 1.414 0l1.586 1.586a1 1 0 0 0 1.414 0L17 10m0 0v2.5m0-2.5h-2.5" />
                                </g>
                            </svg>
                            14%
                        </span>
                    </div>
                    <div class="card__body">
                        <div id="visitorsTrendChart" class="chart" style="min-height: 320px;"></div>
                    </div>
                </div>
            </div>

            {{-- Device Breakdown Chart --}}
            <div class="col-span-12 xl:col-span-4">
                <div class="card h-full">
                    <div class="card__header">
                        <span class="card__title">Visitors by device</span>
                    </div>
                    <div class="card__body">
                        <div id="deviceChart" class="chart" style="min-height: 320px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Secondary Charts Section --}}
    <section class="page__section mt-4">
        <div class="grid grid-cols-12 gap-4">
            {{-- Country Breakdown Chart --}}
            <div class="col-span-12 lg:col-span-6">
                <div class="card h-full">
                    <div class="card__header">
                        <span class="card__title">Visitors by country</span>
                    </div>
                    <div class="card__body">
                        <div id="countryChart" class="chart" style="min-height: 280px;"></div>
                    </div>
                </div>
            </div>

            {{-- Browser Breakdown Chart --}}
            <div class="col-span-12 lg:col-span-6">
                <div class="card h-full">
                    <div class="card__header">
                        <span class="card__title">Visitors by browser</span>
                    </div>
                    <div class="card__body">
                        <div id="browserChart" class="chart" style="min-height: 280px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Recent Visitors Table Section --}}
    <section class="page__section mt-4">
        <div class="card">
            <div class="card__header">
                <span class="card__title">Log Pengunjung Terakhir (Recent Visitors)</span>
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
    </section>

    {{-- ApexCharts JavaScript Initialization --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const chartDays = @json($chartDays);
            const chartData = @json($chartData);
            const deviceData = @json($deviceBreakdown);
            const countryData = @json($topCountries);
            const browserData = @json($browserBreakdown);

            // 1. Visitors Trend Area Chart
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
            new ApexCharts(document.querySelector("#visitorsTrendChart"), trendOptions).render();

            // 2. Device Donut Chart
            const deviceLabels = deviceData.map(d => d.device || 'Unknown');
            const deviceSeries = deviceData.map(d => d.total);
            const donutOptions = {
                series: deviceSeries.length > 0 ? deviceSeries : [1],
                labels: deviceLabels.length > 0 ? deviceLabels : ['Desktop'],
                chart: {
                    type: 'donut',
                    height: 320
                },
                colors: ['#2563eb', '#10b981', '#f59e0b', '#8b5cf6'],
                legend: { position: 'bottom', fontSize: '12px' },
                dataLabels: { enabled: true }
            };
            new ApexCharts(document.querySelector("#deviceChart"), donutOptions).render();

            // 3. Country Horizontal Bar Chart
            const countryLabels = countryData.map(c => c.country || 'Unknown');
            const countrySeries = countryData.map(c => c.total);
            const countryOptions = {
                series: [{
                    name: 'Visitors',
                    data: countrySeries
                }],
                chart: {
                    type: 'bar',
                    height: 280,
                    toolbar: { show: false }
                },
                plotOptions: {
                    bar: {
                        borderRadius: 6,
                        horizontal: true,
                        barHeight: '50%'
                    }
                },
                colors: ['#3b82f6'],
                dataLabels: { enabled: true },
                xaxis: { categories: countryLabels },
                grid: { borderColor: '#e5e7eb', strokeDashArray: 4 }
            };
            new ApexCharts(document.querySelector("#countryChart"), countryOptions).render();

            // 4. Browser Vertical Bar Chart
            const browserLabels = browserData.map(b => b.browser || 'Unknown');
            const browserSeries = browserData.map(b => b.total);
            const browserOptions = {
                series: [{
                    name: 'Visitors',
                    data: browserSeries
                }],
                chart: {
                    type: 'bar',
                    height: 280,
                    toolbar: { show: false }
                },
                plotOptions: {
                    bar: {
                        borderRadius: 6,
                        columnWidth: '45%'
                    }
                },
                colors: ['#10b981'],
                dataLabels: { enabled: true },
                xaxis: { categories: browserLabels },
                grid: { borderColor: '#e5e7eb', strokeDashArray: 4 }
            };
            new ApexCharts(document.querySelector("#browserChart"), browserOptions).render();
        });
    </script>
</div>
