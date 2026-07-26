<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Instagram Feed — {{ config('app.name') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" />

    {{-- Frontend Asset Styles --}}
    <link rel="stylesheet" href="{{ asset('assets/css/tailwind.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
</head>
<body class="bg-gray-50 text-gray-900 font-sans antialiased">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        {{-- Header Section --}}
        <div class="text-center max-w-2xl mx-auto mb-12">
            <h1 class="text-3xl font-bold tracking-tight sm:text-4xl">Instagram Gallery</h1>
            <p class="mt-3 text-lg text-gray-600">
                Koleksi moment dan hasil karya fotografi terbaru dari akun Instagram kami.
            </p>
        </div>

        {{-- Grid Section --}}
        @if ($posts && count($posts) > 0)
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-6">
                @foreach ($posts as $post)
                    <div class="group relative bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-md transition duration-300 flex flex-col justify-between border border-gray-100">
                        <div class="relative aspect-square overflow-hidden bg-gray-100">
                            <img src="{{ $post->preview_url }}" alt="{{ Str::limit($post->caption, 50) }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition duration-500" loading="lazy" />

                            @if ($post->media_type === 'VIDEO' || $post->media_product_type === 'REELS')
                                <span class="absolute top-3 right-3 bg-black/70 text-white p-1.5 rounded-full backdrop-blur-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                                </span>
                            @elseif ($post->media_type === 'CAROUSEL_ALBUM')
                                <span class="absolute top-3 right-3 bg-black/70 text-white p-1.5 rounded-full backdrop-blur-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="2" y="2" width="16" height="16" rx="2"/><rect x="6" y="6" width="16" height="16" rx="2"/></svg>
                                </span>
                            @endif
                        </div>

                        <div class="p-4 flex-1 flex flex-col justify-between">
                            <p class="text-sm text-gray-700 line-clamp-2 leading-relaxed">
                                {{ $post->caption ?: 'Emily Queen Studio Gallery' }}
                            </p>
                            <div class="mt-4 pt-3 border-t border-gray-100 flex items-center justify-between text-xs text-gray-500">
                                <span>{{ $post->posted_at?->format('d M Y') }}</span>
                                <a href="{{ $post->permalink }}" target="_blank" rel="noopener noreferrer"
                                    class="text-indigo-600 font-medium hover:text-indigo-800 flex items-center gap-1">
                                    Instagram
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-12 flex justify-center">
                {{ $posts->links() }}
            </div>
        @else
            <div class="text-center py-16 bg-white rounded-xl shadow-sm border border-gray-100">
                <p class="text-gray-500 text-base">Belum ada postingan Instagram yang ditampilkan.</p>
            </div>
        @endif
    </div>

</body>
</html>
