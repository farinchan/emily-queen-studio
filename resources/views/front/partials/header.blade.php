@php
    $photographyNav = \App\Models\Photography::select('id', 'title', 'slug')->get();
@endphp
<!-- Header -->
<header class="fixed inset-x-0 top-0 z-50 border-b border-white/0 text-white transition-all duration-500" id="siteHeader">
    <div class="mx-auto flex h-24 max-w-[1600px] items-center justify-between px-5 sm:px-8 lg:px-12">
        <button aria-expanded="false" aria-label="Open navigation" class="group flex items-center gap-3 lg:hidden"
            id="menuButton" type="button">
            <span class="relative block h-4 w-7">
                <span class="menu-line absolute left-0 top-0 h-px w-7 bg-current transition-all duration-300"></span>
                <span class="menu-line absolute left-0 top-2 h-px w-5 bg-current transition-all duration-300"></span>
                <span class="menu-line absolute left-0 top-4 h-px w-7 bg-current transition-all duration-300"></span>
            </span>
            <span class="hidden text-[10px] font-medium uppercase tracking-[.28em] sm:block">Menu</span>
        </button>
        <a aria-label="Go to home" class="absolute left-1/2 -translate-x-1/2 text-center" href="{{ route('home') }}">
            <span class="block text-[28px] font-semibold tracking-[.15em] sm:text-[34px]">Emily Queen</span>
            <span class="mt-1 hidden text-[7px] uppercase tracking-[.52em] sm:block">Home Photo Studio</span>
        </a>
        <nav aria-label="Primary navigation"
            class="hidden items-center gap-8 text-[10px] font-medium uppercase tracking-[.22em] lg:flex">
            <div class="group relative py-10">
                <a href="#" class="flex items-center gap-2 transition-opacity hover:opacity-60">
                    Photography
                    <svg class="h-3 w-3 transition-transform group-hover:rotate-180" fill="none"
                        stroke="currentColor" stroke-width="1.5" viewbox="0 0 24 24">
                        <path d="m6 9 6 6 6-6"></path>
                    </svg>
                </a>
                <div
                    class="pointer-events-none absolute left-0 top-[84px] w-64 translate-y-3 border border-black/5 bg-white p-7 text-[#171717] opacity-0 shadow-2xl shadow-black/10 transition-all duration-300 group-hover:pointer-events-auto group-hover:translate-y-0 group-hover:opacity-100">
                    <div class="space-y-4 text-[9px] tracking-[.18em]">
                        @foreach ($photographyNav as $photo)
                            <a class="block hover:opacity-45" href="{{ route('photography.show', $photo->slug) }}">{{ $photo->title }}</a>
                        @endforeach
                    </div>
                </div>
            </div>

            <a class="py-10 transition-opacity hover:opacity-60" href="#contact">About</a>
            <a class="py-10 transition-opacity hover:opacity-60" href="#contact">Get in Touch</a>
        </nav>
        <div class="hidden items-center gap-7 lg:flex">
            <a class="text-[9px] font-medium uppercase tracking-[.2em] transition-opacity hover:opacity-60"
                href="#contact">Padang</a>
            <span class="h-4 w-px bg-current opacity-30"></span>
            <button aria-label="Open search" class="transition-opacity hover:opacity-60" id="searchButton"
                type="button">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.4" viewbox="0 0 24 24">
                    <circle cx="11" cy="11" r="7"></circle>
                    <path d="m20 20-4-4"></path>
                </svg>
            </button>
        </div>
        <button aria-label="Open search" class="lg:hidden" id="mobileSearchButton" type="button">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.4" viewbox="0 0 24 24">
                <circle cx="11" cy="11" r="7"></circle>
                <path d="m20 20-4-4"></path>
            </svg>
        </button>
    </div>
</header>
<!-- Mobile Navigation -->
<div aria-hidden="true"
    class="fixed inset-0 z-[60] invisible bg-[#171717] text-white opacity-0 transition-all duration-500 lg:hidden"
    id="mobileMenu">
    <div class="flex h-full flex-col overflow-y-auto px-6 py-8 sm:px-10">
        <div class="flex items-center justify-between">
            <a class="text-2xl font-semibold tracking-[.3em]" href="{{ route('home') }}">AXIOO</a>
            <button aria-label="Close navigation" class="grid h-11 w-11 place-items-center border border-white/20"
                id="closeMenuButton" type="button">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.2" viewbox="0 0 24 24">
                    <path d="M5 5l14 14M19 5 5 19"></path>
                </svg>
            </button>
        </div>
        <nav aria-label="Mobile navigation" class="my-auto py-16">
            <div class="border-b border-white/15 py-5">
                <button class="mobile-accordion flex w-full items-center justify-between text-left" type="button">
                    <span class="font-display text-4xl">Photography</span>
                    <svg class="accordion-icon h-5 w-5 transition-transform" fill="none" stroke="currentColor"
                        viewbox="0 0 24 24">
                        <path d="m6 9 6 6 6-6"></path>
                    </svg>
                </button>
                <div class="accordion-content grid max-h-0 overflow-hidden transition-all duration-500">
                    <div class="space-y-4 pb-3 pt-6 text-xs uppercase tracking-[.2em] text-white/60">
                        @foreach ($photographyNav as $photo)
                            <a class="mobile-link block" href="{{ route('photography.show', $photo->slug) }}">{{ $photo->title }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
            <a class="mobile-link block border-b border-white/15 py-5 font-display text-4xl"
                href="#contact">About</a>
            <a class="mobile-link block border-b border-white/15 py-5 font-display text-4xl" href="#contact">Get
                in Touch</a>
        </nav>
        <div
            class="flex items-end justify-between border-t border-white/15 pt-6 text-[10px] uppercase tracking-[.2em] text-white/55">
            <div class="space-y-2">
                <a class="block" href="#">Instagram</a>
                <a class="block" href="#">YouTube</a>
            </div>
            <a href="#contact">Axioo Bali ↗</a>
        </div>
    </div>
</div>
