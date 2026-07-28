@extends('front.app')

@section('content')
    <!-- Hero -->
    <section id="home" class="relative h-screen min-h-[680px] overflow-hidden bg-black text-white">
        <div id="heroSlides" class="absolute inset-0">
            @forelse ($banners as $banner)
                <article class="hero-slide absolute inset-0 transition-opacity duration-1000 {{ $loop->first ? 'opacity-100' : 'pointer-events-none opacity-0' }}"
                    data-index="{{ $loop->index }}">
                    <img src="{{ $banner->image }}"
                        alt="{{ $banner->title }}"
                        class="h-full w-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/65 via-black/10 to-black/30"></div>
                    <div
                        class="absolute inset-x-0 bottom-20 mx-auto max-w-[1600px] px-6 sm:bottom-24 sm:px-10 lg:bottom-28 lg:px-16">
                        <div class="max-w-4xl">
                            @if ($banner->label)
                                <p class="mb-5 text-[9px] uppercase tracking-[.32em] text-white/75 sm:text-[10px]">
                                    {{ $banner->label }}
                                </p>
                            @endif
                            <{{ $loop->first ? 'h1' : 'h2' }}
                                class="font-display text-5xl leading-[.88] tracking-[-.03em] sm:text-7xl lg:text-[108px]">
                                {{ $banner->title }}
                            </{{ $loop->first ? 'h1' : 'h2' }}>
                            @if ($banner->subtitle)
                                <p
                                    class="mt-5 max-w-xl text-xs font-light uppercase leading-6 tracking-[.18em] text-white/75 sm:text-sm">
                                    {{ $banner->subtitle }}
                                </p>
                            @endif
                            @if ($banner->link)
                                <a href="{{ $banner->link }}"
                                    class="mt-8 inline-flex items-center gap-4 border-b border-white/50 pb-2 text-[9px] uppercase tracking-[.25em] transition-all hover:gap-6 hover:border-white">Explore
                                    Story <span>→</span></a>
                            @endif
                        </div>
                    </div>
                </article>
            @empty
                <div class="grid h-full place-items-center text-white">
                    <p class="text-sm uppercase tracking-[.25em] text-white/70">No banners yet</p>
                </div>
            @endforelse
        </div>

        <!-- Hero controls -->
        <div class="absolute bottom-7 right-6 z-20 flex items-center gap-5 sm:bottom-10 sm:right-10 lg:right-16">
            <button id="prevSlide" type="button"
                class="grid h-10 w-10 place-items-center border border-white/35 transition-colors hover:bg-white hover:text-black"
                aria-label="Previous slide">
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2">
                    <path d="m15 18-6-6 6-6" />
                </svg>
            </button>
            <div id="heroDots" class="flex items-center gap-3" aria-label="Hero slide navigation"></div>
            <button id="nextSlide" type="button"
                class="grid h-10 w-10 place-items-center border border-white/35 transition-colors hover:bg-white hover:text-black"
                aria-label="Next slide">
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2">
                    <path d="m9 18 6-6-6-6" />
                </svg>
            </button>
        </div>

        <div class="absolute bottom-8 left-6 z-20 hidden items-center gap-4 sm:flex sm:left-10 lg:left-16">
            <span class="h-px w-12 bg-white/60"></span>
            <span class="text-[8px] uppercase tracking-[.3em] text-white/70">Scroll to discover</span>
        </div>
    </section>


    <!-- Intro -->
    <section class="px-6 py-24 sm:px-10 sm:py-32 lg:px-16 lg:py-40">
        <div class="reveal mx-auto grid max-w-[1400px] gap-14 lg:grid-cols-[.8fr_1.2fr] lg:items-end">
            <div>
                <p class="mb-5 text-[9px] uppercase tracking-[.34em] text-[#817a72]">Photography · Cinematography
                </p>
                <h2 class="font-display text-5xl leading-[.98] sm:text-6xl lg:text-7xl">We turn fleeting moments
                    into stories that stay.</h2>
            </div>
            <div class="lg:pl-24">
                <p class="max-w-xl text-sm font-light leading-8 text-black/65 sm:text-base">A collective of
                    photographers, filmmakers, designers, editors, and stylists crafting sincere visual narratives
                    for weddings, families, and modern portraits.</p>
                <a class="mt-8 inline-flex items-center gap-4 border-b border-black/30 pb-2 text-[9px] uppercase tracking-[.24em] transition-all hover:gap-7 hover:border-black"
                    href="about.html">Meet the studio <span>→</span></a>
            </div>
        </div>
    </section>

    <!-- Featured Mosaic -->
    @if(isset($photographies) && $photographies->count() > 0)
        <section class="pb-28 sm:pb-36 lg:pb-44">
            <div class="mx-auto max-w-[1600px] px-4 sm:px-8 lg:px-12">
                <div class="grid gap-4 md:grid-cols-12 md:grid-rows-[420px_260px] lg:grid-rows-[520px_330px]">
                    @foreach($photographies->take(4) as $index => $photo)
                        @php
                            $gridClass = match($index) {
                                0 => 'md:col-span-8 md:row-span-1',
                                1 => 'md:col-span-4 md:row-span-2',
                                2 => 'md:col-span-4',
                                3 => 'md:col-span-4',
                                default => 'md:col-span-4',
                            };
                        @endphp
                        <a class="image-zoom reveal group relative overflow-hidden bg-black {{ $gridClass }}"
                            href="{{ route('photography.show', $photo->slug) }}">
                            <img alt="{{ $photo->title }}" class="h-full w-full object-cover opacity-85 transition duration-700 group-hover:opacity-100"
                                src="{{ $photo->image ?: 'https://images.unsplash.com/photo-1519225421980-715cb0215aed?auto=format&fit=crop&w=1800&q=88' }}" />
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/10 to-transparent"></div>
                            @if($index === 1)
                                <div class="absolute right-6 top-7 grid h-14 w-14 place-items-center rounded-full border border-white/55 text-white transition-transform duration-500 group-hover:scale-110">
                                    <svg class="ml-1 h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M8 5v14l11-7z"></path>
                                    </svg>
                                </div>
                            @endif
                            <div class="absolute inset-x-0 bottom-0 p-6 sm:p-9 text-white">
                                <p class="mb-2 text-[8px] sm:text-[9px] uppercase tracking-[.25em] text-white/65">
                                    {{ $photo->label ?: 'Photography' }}
                                </p>
                                <h3 class="font-display text-3xl sm:text-4xl lg:text-5xl leading-tight">
                                    {{ $photo->title }}
                                </h3>
                                @if($photo->subtitle)
                                    <p class="mt-2 text-[10px] uppercase tracking-[.2em] text-white/70">
                                        {{ $photo->subtitle }}
                                    </p>
                                @endif
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif


    <!-- Journal -->
    {{-- <section class="border-t border-black/10 px-6 py-24 sm:px-10 sm:py-32 lg:px-16 lg:py-40" id="journal">
        <div class="mx-auto max-w-[1400px]">
            <div class="reveal mb-16 flex flex-col gap-8 sm:mb-24 md:flex-row md:items-end md:justify-between">
                <div>
                    <p class="mb-5 text-[9px] uppercase tracking-[.34em] text-[#817a72]">Selected stories</p>
                    <h2 class="font-display text-6xl sm:text-7xl lg:text-8xl">Latest Journal</h2>
                </div>
                <a class="inline-flex w-fit items-center gap-4 border-b border-black/30 pb-2 text-[9px] uppercase tracking-[.24em] transition-all hover:gap-7 hover:border-black"
                    href="journal.html">View all stories <span>→</span></a>
            </div>
            <div class="divide-y divide-black/12 border-y border-black/12">
                <!-- Article 1 -->
                <article
                    class="journal-item reveal group grid gap-8 py-10 sm:py-14 lg:grid-cols-[120px_1fr_280px] lg:items-center lg:gap-14">
                    <div class="flex items-center gap-4 lg:block">
                        <span class="font-display text-5xl leading-none sm:text-6xl">12</span>
                        <div class="mt-2 text-[9px] uppercase leading-5 tracking-[.22em] text-[#817a72]">
                            <span class="block">Jun</span>
                            <span class="block">2026</span>
                        </div>
                    </div>
                    <div>
                        <p class="mb-3 text-[9px] uppercase tracking-[.24em] text-[#817a72]">Photography · Journal
                        </p>
                        <h3
                            class="font-display text-4xl transition-transform duration-500 group-hover:translate-x-2 sm:text-5xl">
                            Introducing Colin</h3>
                        <p class="mt-3 text-xs uppercase tracking-[.17em] text-black/55">A fresh modern perspective
                            joins the team</p>
                    </div>
                    <a aria-label="Open story detail"
                        class="image-zoom relative aspect-[16/10] overflow-hidden bg-[#dfd5c7]" href="story.html">
                        <img alt="Portrait of a photographer"
                            class="h-full w-full object-cover grayscale transition duration-700 group-hover:grayscale-0"
                            src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&amp;fit=crop&amp;w=900&amp;q=85" />
                    </a>
                </article>
                <!-- Article 2 -->
                <article
                    class="journal-item reveal group grid gap-8 py-10 sm:py-14 lg:grid-cols-[120px_1fr_280px] lg:items-center lg:gap-14">
                    <div class="flex items-center gap-4 lg:block">
                        <span class="font-display text-5xl leading-none sm:text-6xl">11</span>
                        <div class="mt-2 text-[9px] uppercase leading-5 tracking-[.22em] text-[#817a72]">
                            <span class="block">Jun</span>
                            <span class="block">2026</span>
                        </div>
                    </div>
                    <div>
                        <p class="mb-3 text-[9px] uppercase tracking-[.24em] text-[#817a72]">Videography · Journal
                        </p>
                        <h3
                            class="font-display text-4xl transition-transform duration-500 group-hover:translate-x-2 sm:text-5xl">
                            Introducing Gerald</h3>
                        <p class="mt-3 text-xs uppercase tracking-[.17em] text-black/55">Cinema, movement, and
                            honest emotion</p>
                    </div>
                    <a aria-label="Open story detail"
                        class="image-zoom relative aspect-[16/10] overflow-hidden bg-[#dfd5c7]" href="story.html">
                        <img alt="Portrait of a filmmaker"
                            class="h-full w-full object-cover grayscale transition duration-700 group-hover:grayscale-0"
                            src="https://images.unsplash.com/photo-1557862921-37829c790f19?auto=format&amp;fit=crop&amp;w=900&amp;q=85" />
                    </a>
                </article>
                <!-- Article 3 -->
                <article
                    class="journal-item reveal group grid gap-8 py-10 sm:py-14 lg:grid-cols-[120px_1fr_280px] lg:items-center lg:gap-14">
                    <div class="flex items-center gap-4 lg:block">
                        <span class="font-display text-5xl leading-none sm:text-6xl">06</span>
                        <div class="mt-2 text-[9px] uppercase leading-5 tracking-[.22em] text-[#817a72]">
                            <span class="block">Apr</span>
                            <span class="block">2026</span>
                        </div>
                    </div>
                    <div>
                        <p class="mb-3 text-[9px] uppercase tracking-[.24em] text-[#817a72]">Photography · She Said
                            Yes</p>
                        <h3
                            class="font-display text-4xl transition-transform duration-500 group-hover:translate-x-2 sm:text-5xl">
                            Life Could Be a Dream</h3>
                        <p class="mt-3 text-xs uppercase tracking-[.17em] text-black/55">Strip away the noise, and
                            what remains matters</p>
                    </div>
                    <a aria-label="Open story detail"
                        class="image-zoom relative aspect-[16/10] overflow-hidden bg-[#dfd5c7]" href="story.html">
                        <img alt="Wedding couple posing outdoors"
                            class="h-full w-full object-cover grayscale transition duration-700 group-hover:grayscale-0"
                            src="https://images.unsplash.com/photo-1523438885200-e635ba2c371e?auto=format&amp;fit=crop&amp;w=900&amp;q=85" />
                    </a>
                </article>
                <!-- Article 4 -->
                <article
                    class="journal-item reveal group grid gap-8 py-10 sm:py-14 lg:grid-cols-[120px_1fr_280px] lg:items-center lg:gap-14">
                    <div class="flex items-center gap-4 lg:block">
                        <span class="font-display text-5xl leading-none sm:text-6xl">17</span>
                        <div class="mt-2 text-[9px] uppercase leading-5 tracking-[.22em] text-[#817a72]">
                            <span class="block">Mar</span>
                            <span class="block">2026</span>
                        </div>
                    </div>
                    <div>
                        <p class="mb-3 text-[9px] uppercase tracking-[.24em] text-[#817a72]">Videography · Tying
                            The Knot</p>
                        <h3
                            class="font-display text-4xl transition-transform duration-500 group-hover:translate-x-2 sm:text-5xl">
                            Some Love Stories Start With “Not Yet”</h3>
                        <p class="mt-3 text-xs uppercase tracking-[.17em] text-black/55">A swipe that did not work
                            — until it did</p>
                    </div>
                    <a aria-label="Open story detail"
                        class="image-zoom relative aspect-[16/10] overflow-hidden bg-[#dfd5c7]" href="story.html">
                        <img alt="Romantic wedding reception"
                            class="h-full w-full object-cover grayscale transition duration-700 group-hover:grayscale-0"
                            src="https://images.unsplash.com/photo-1519741347686-c1e0aadf4611?auto=format&amp;fit=crop&amp;w=900&amp;q=85" />
                    </a>
                </article>
            </div>
        </div>
    </section> --}}


    <!-- Film Feature -->
    <section class="relative min-h-[760px] overflow-hidden bg-black text-white" id="films">
        <img alt="Wedding ceremony prepared for a film" class="absolute inset-0 h-full w-full object-cover opacity-55"
            src="https://images.unsplash.com/photo-1519225421980-715cb0215aed?auto=format&amp;fit=crop&amp;w=2200&amp;q=90" />
        <div class="absolute inset-0 bg-gradient-to-r from-black/80 via-black/35 to-black/25"></div>
        <div class="relative mx-auto flex min-h-[760px] max-w-[1600px] items-center px-6 py-24 sm:px-10 lg:px-16">
            <div class="reveal max-w-3xl">
                <p class="mb-6 text-[9px] uppercase tracking-[.35em] text-white/60">Featured film</p>
                <h2 class="font-display text-6xl leading-[.9] sm:text-8xl lg:text-[110px]">A Love Beyond Words</h2>
                <p class="mt-8 max-w-lg text-sm font-light leading-7 text-white/70">A cinematic celebration of the
                    small gestures, deep glances, and unscripted moments that make a wedding day unforgettable.</p>
                <a class="group mt-10 flex items-center gap-5 text-[9px] uppercase tracking-[.28em]" href="#">
                    <span
                        class="grid h-16 w-16 place-items-center rounded-full border border-white/55 transition-all duration-500 group-hover:bg-white group-hover:text-black">
                        <svg class="ml-1 h-5 w-5" fill="currentColor" viewbox="0 0 24 24">
                            <path d="M8 5v14l11-7z"></path>
                        </svg>
                    </span>
                    Watch film
                </a>
            </div>
        </div>
        <div class="absolute bottom-8 right-8 hidden text-[8px] uppercase tracking-[.25em] text-white/50 sm:block">
            Film No. 024</div>
    </section>
    <!-- Instagram Gallery -->
    <section class="bg-white py-24 sm:py-32 lg:py-40">
        <div class="mx-auto max-w-[1600px] px-4 sm:px-8 lg:px-12">
            <div class="reveal mb-14 flex flex-col gap-7 px-2 sm:mb-20 md:flex-row md:items-end md:justify-between">
                <div>
                    <p class="mb-3 sm:mb-5 text-[9px] uppercase tracking-[.34em] text-[#817a72]">From Instagram</p>
                    <h2 class="font-display text-3xl sm:text-3xl lg:text-5xl instagram-handle-heading">Follow @emilyqueen.homephotostudio</h2>
                </div>
                <div class="flex gap-5 text-[9px] uppercase tracking-[.22em]">
                    <a class="border-b border-black/25 pb-1 hover:border-black" href="#">Instagram</a>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-2 md:grid-cols-4 lg:gap-3">
                <a class="image-zoom reveal group relative aspect-square overflow-hidden bg-[#dfd5c7]" href="#">
                    <img alt="Bride and groom portrait" class="h-full w-full object-cover"
                        src="https://images.unsplash.com/photo-1532712938310-34cb3982ef74?auto=format&amp;fit=crop&amp;w=900&amp;q=84" />
                    <div
                        class="absolute inset-0 grid place-items-center bg-black/0 text-white opacity-0 transition-all duration-500 group-hover:bg-black/35 group-hover:opacity-100">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.5"
                            viewbox="0 0 24 24">
                            <rect height="18" rx="5" width="18" x="3" y="3"></rect>
                            <circle cx="12" cy="12" r="4"></circle>
                            <circle cx="17.5" cy="6.5" fill="currentColor" r="1" stroke="none">
                            </circle>
                        </svg>
                    </div>
                </a>
                <a class="image-zoom reveal group relative aspect-square overflow-hidden bg-[#dfd5c7]" href="#">
                    <img alt="Outdoor wedding" class="h-full w-full object-cover"
                        src="https://images.unsplash.com/photo-1519741497674-611481863552?auto=format&amp;fit=crop&amp;w=900&amp;q=84" />
                    <div
                        class="absolute inset-0 grid place-items-center bg-black/0 text-white opacity-0 transition-all duration-500 group-hover:bg-black/35 group-hover:opacity-100">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.5"
                            viewbox="0 0 24 24">
                            <rect height="18" rx="5" width="18" x="3" y="3"></rect>
                            <circle cx="12" cy="12" r="4"></circle>
                            <circle cx="17.5" cy="6.5" fill="currentColor" r="1" stroke="none">
                            </circle>
                        </svg>
                    </div>
                </a>
                <a class="image-zoom reveal group relative aspect-square overflow-hidden bg-[#dfd5c7]" href="#">
                    <img alt="Newlyweds laughing" class="h-full w-full object-cover"
                        src="https://images.unsplash.com/photo-1511285560929-80b456fea0bc?auto=format&amp;fit=crop&amp;w=900&amp;q=84" />
                    <div
                        class="absolute inset-0 grid place-items-center bg-black/0 text-white opacity-0 transition-all duration-500 group-hover:bg-black/35 group-hover:opacity-100">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.5"
                            viewbox="0 0 24 24">
                            <rect height="18" rx="5" width="18" x="3" y="3"></rect>
                            <circle cx="12" cy="12" r="4"></circle>
                            <circle cx="17.5" cy="6.5" fill="currentColor" r="1" stroke="none">
                            </circle>
                        </svg>
                    </div>
                </a>
                <a class="image-zoom reveal group relative aspect-square overflow-hidden bg-[#dfd5c7]" href="#">
                    <img alt="Wedding table flowers" class="h-full w-full object-cover"
                        src="https://images.unsplash.com/photo-1465495976277-4387d4b0e4a6?auto=format&amp;fit=crop&amp;w=900&amp;q=84" />
                    <div
                        class="absolute inset-0 grid place-items-center bg-black/0 text-white opacity-0 transition-all duration-500 group-hover:bg-black/35 group-hover:opacity-100">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.5"
                            viewbox="0 0 24 24">
                            <rect height="18" rx="5" width="18" x="3" y="3"></rect>
                            <circle cx="12" cy="12" r="4"></circle>
                            <circle cx="17.5" cy="6.5" fill="currentColor" r="1" stroke="none">
                            </circle>
                        </svg>
                    </div>
                </a>
                <a class="image-zoom reveal group relative aspect-square overflow-hidden bg-[#dfd5c7]" href="#">
                    <img alt="Bride and groom together" class="h-full w-full object-cover"
                        src="https://images.unsplash.com/photo-1523438885200-e635ba2c371e?auto=format&amp;fit=crop&amp;w=900&amp;q=84" />
                    <div
                        class="absolute inset-0 grid place-items-center bg-black/0 text-white opacity-0 transition-all duration-500 group-hover:bg-black/35 group-hover:opacity-100">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.5"
                            viewbox="0 0 24 24">
                            <rect height="18" rx="5" width="18" x="3" y="3"></rect>
                            <circle cx="12" cy="12" r="4"></circle>
                            <circle cx="17.5" cy="6.5" fill="currentColor" r="1" stroke="none">
                            </circle>
                        </svg>
                    </div>
                </a>
                <a class="image-zoom reveal group relative aspect-square overflow-hidden bg-[#dfd5c7]" href="#">
                    <img alt="Couple embracing" class="h-full w-full object-cover"
                        src="https://images.unsplash.com/photo-1529636798458-92182e662485?auto=format&amp;fit=crop&amp;w=900&amp;q=84" />
                    <div
                        class="absolute inset-0 grid place-items-center bg-black/0 text-white opacity-0 transition-all duration-500 group-hover:bg-black/35 group-hover:opacity-100">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.5"
                            viewbox="0 0 24 24">
                            <rect height="18" rx="5" width="18" x="3" y="3"></rect>
                            <circle cx="12" cy="12" r="4"></circle>
                            <circle cx="17.5" cy="6.5" fill="currentColor" r="1" stroke="none">
                            </circle>
                        </svg>
                    </div>
                </a>
                <a class="image-zoom reveal group relative aspect-square overflow-hidden bg-[#dfd5c7]" href="#">
                    <img alt="Bridal portrait" class="h-full w-full object-cover"
                        src="https://images.unsplash.com/photo-1507504031003-b417219a0fde?auto=format&amp;fit=crop&amp;w=900&amp;q=84" />
                    <div
                        class="absolute inset-0 grid place-items-center bg-black/0 text-white opacity-0 transition-all duration-500 group-hover:bg-black/35 group-hover:opacity-100">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.5"
                            viewbox="0 0 24 24">
                            <rect height="18" rx="5" width="18" x="3" y="3"></rect>
                            <circle cx="12" cy="12" r="4"></circle>
                            <circle cx="17.5" cy="6.5" fill="currentColor" r="1" stroke="none">
                            </circle>
                        </svg>
                    </div>
                </a>
                <a class="image-zoom reveal group relative aspect-square overflow-hidden bg-[#dfd5c7]" href="#">
                    <img alt="Romantic couple portrait" class="h-full w-full object-cover"
                        src="https://images.unsplash.com/photo-1494774157365-9e04c6720e47?auto=format&amp;fit=crop&amp;w=900&amp;q=84" />
                    <div
                        class="absolute inset-0 grid place-items-center bg-black/0 text-white opacity-0 transition-all duration-500 group-hover:bg-black/35 group-hover:opacity-100">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.5"
                            viewbox="0 0 24 24">
                            <rect height="18" rx="5" width="18" x="3" y="3"></rect>
                            <circle cx="12" cy="12" r="4"></circle>
                            <circle cx="17.5" cy="6.5" fill="currentColor" r="1" stroke="none">
                            </circle>
                        </svg>
                    </div>
                </a>
            </div>
        </div>
    </section>
    <!-- About + Contact -->
    <section class="bg-[#dfd5c7]/55 px-6 py-24 sm:px-10 sm:py-32 lg:px-16 lg:py-40" id="about">
        <div class="mx-auto grid max-w-[1400px] gap-16 lg:grid-cols-2 lg:gap-24">
            <div class="reveal">
                <p class="mb-5 text-[9px] uppercase tracking-[.34em] text-[#817a72]">About</p>
                <h2 class="font-display text-6xl leading-[.95] sm:text-7xl">A house of visual storytellers.</h2>
            </div>
            <div class="reveal lg:pt-14">
                <p class="text-base font-light leading-8 text-black/65">We are a group of passionate photographers,
                    cinematographers, designers, editors, and stylists working together to create meaningful visual
                    masterpieces.</p>
                <p class="mt-6 text-base font-light leading-8 text-black/65">Every project begins with listening.
                    We pay attention to the light, the energy, the unexpected laughter, and the quiet details that
                    reveal who you truly are.</p>
                <a class="mt-10 inline-flex items-center gap-4 border-b border-black/30 pb-2 text-[9px] uppercase tracking-[.24em] transition-all hover:gap-7 hover:border-black"
                    href="{{ route('about') }}">Read our story <span>→</span></a>
            </div>
        </div>
    </section>
@endsection
