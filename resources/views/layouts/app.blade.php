<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" type="image/svg+xml"
        href='data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><style>.t{fill:%230a0a0a}.m{stroke:%23fafafa}@media (prefers-color-scheme: dark){.t{fill:%23fafafa}.m{stroke:%230a0a0a}}</style><rect class="t" width="512" height="512" rx="112"/><path class="m" d="M 392 144 H 200 A 56 56 0 0 0 200 256 H 312 A 56 56 0 0 1 312 368 H 120" fill="none" stroke-width="76" stroke-linecap="round" stroke-linejoin="round"/></svg>' />
    <script>
        // Apply the saved theme before first paint to avoid a flash.
        (function() {
            var t = localStorage.getItem("stisla-theme");
            if (t === "dark" || t === "light") document.documentElement.dataset.theme = t;
        })();
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" />
    <link rel="stylesheet" href=" {{ asset('back-assets/css/style.css') }} " />

    <meta name="robots" content="noindex, nofollow" />
    <title>{{ isset($title) ? $title . ' — Admin Panel | ' . config('app.name', 'Emily Queen Studio') : 'Admin Panel — ' . config('app.name', 'Emily Queen Studio') }}</title>

    @livewireStyles
</head>

<body>

    <div class="app-shell" data-stisla-app-shell data-stisla-app-shell-auto-collapse="true">
        @include('partials.sidebar')

        <main class="app-shell__main">
            @include('partials.header')

            <div class="page content">
                <div class="content__container">
                    <header class="page__header">
                        <div class="page__headline">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb__item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                    @if (isset($breadcrumbs))
                                        {{ $breadcrumbs }}
                                    @elseif (isset($title) && $title !== 'Dashboard')
                                        <li class="breadcrumb__item" aria-current="page">{{ $title }}</li>
                                    @endif
                                </ol>
                            </nav>
                            <h1 class="page__title">{{ $title ?? 'Dashboard' }}</h1>
                            @if (isset($description) && $description)
                                <p class="page__description">
                                    {{ $description }}
                                </p>
                            @endif
                        </div>
                        @if (isset($action) && $action)
                            <div class="page__action">
                                {{ $action }}
                            </div>
                        @endif
                    </header>

                    <div class="page__body">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </main>
    </div>


    @livewireScripts
    <!-- Third-party (CDN in both dev and prod). Loads before main.js so charts.js sees window.ApexCharts. -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts@3"></script>

    <script type="module" src="https://cdn.jsdelivr.net/npm/@stisla/vanilla@3/dist/stisla.js"></script>
    <script src=" {{ asset('back-assets/js/app-shell.js') }} "></script>
    <script src=" {{ asset('back-assets/js/theme.js') }} "></script>
    <script src=" {{ asset('back-assets/js/charts.js') }} "></script>
    <script src=" {{ asset('back-assets/js/order-form.js') }} "></script>
    <script src=" {{ asset('back-assets/js/table-select.js') }} "></script>

</body>

</html>
