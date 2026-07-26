<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" type="image/svg+xml"
        href='data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><style>.t{fill:%230a0a0a}.m{stroke:%23fafafa}@media (prefers-color-scheme: dark){.t{fill:%23fafafa}.m{stroke:%230a0a0a}}</style><rect class="t" width="512" height="512" rx="112"/><path class="m" d="M 392 144 H 200 A 56 56 0 0 0 200 256 H 312 A 56 56 0 0 1 312 368 H 120" fill="none" stroke-width="76" stroke-linecap="round" stroke-linejoin="round"/></svg>' />
    <title>{{ $title ?? 'Page Builder - Emily Queen Studio' }}</title>

    <!-- Google Fonts for Front-End Preview -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;1,400&family=Montserrat:wght@300;400;500;600&display=swap"
        rel="stylesheet" />

    <link href="{{ asset('assets/css/tailwind.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/favicon.svg') }}" rel="icon" type="image/svg+xml" />

    <!-- GrapesJS Core Assets -->
    <link rel="stylesheet" href="https://unpkg.com/grapesjs/dist/css/grapes.min.css" />
    <script src="https://unpkg.com/grapesjs"></script>
    <script src="https://unpkg.com/grapesjs-preset-newsletter"></script>


    @livewireStyles
    <style>
        body,
        html {
            margin: 0;
            padding: 0;
            height: 100%;
            overflow: hidden;
            font-family: 'Montserrat', sans-serif;
            background-color: #1e1e1e;
            color: #f3f4f6;
        }
    </style>
</head>

<body>
    {{ $slot }}

    @livewireScripts
</body>

</html>
