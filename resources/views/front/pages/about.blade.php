@extends('front.app')

@section('content')
    <section class="page-hero relative min-h-[760px] overflow-hidden bg-black text-white"><img
            src="https://warnaindonesiaphoto.com/wp-content/uploads/2022/03/Referensi-Studio-Foto-Group-Terbaik-2.jpg"
            alt="A House of Visual Storytellers" class="absolute inset-0 h-full w-full object-cover">
        <div
            class="relative z-10 mx-auto flex min-h-[760px] max-w-[1600px] items-end px-6 pb-20 pt-40 sm:px-10 sm:pb-28 lg:px-16">
            <div class="max-w-5xl">
                <p class="mb-5 text-[9px] uppercase tracking-[.34em] text-white/70">About the Studio</p>
                <h1 class="font-display text-6xl leading-[.88] sm:text-8xl lg:text-[118px]">A House of Visual Storytellers
                </h1>
                <p class="mt-7 max-w-2xl text-sm font-light uppercase leading-7 tracking-[.16em] text-white/75">
                    Photographers,
                    filmmakers, editors, designers, and stylists working as one creative team.</p>
            </div>
        </div>
    </section>
    <section class="px-6 py-24 sm:px-10 sm:py-32 lg:px-16">
        <div class="mx-auto grid max-w-[1400px] gap-16 lg:grid-cols-2">
            <h2 class="reveal font-display text-6xl leading-[.95] sm:text-7xl">We listen before we create.</h2>
            <div class="reveal space-y-6 text-base font-light leading-8 text-black/65">
                <p>Every commission begins by understanding the people at the center of it—their relationships, histories,
                    humour, and hopes for how the day should feel.</p>
                <p>Our multidisciplinary structure keeps photography, film, styling, design, and post-production connected
                    from the first conversation through final delivery.</p><a href="contact.html"
                    class="inline-flex border-b border-black/30 pb-2 text-[9px] uppercase tracking-[.24em]">Work with us
                    →</a>
            </div>
        </div>
    </section>

    {{-- Team Section --}}
    @if(isset($users) && $users->count() > 0)
        <section class="bg-white px-6 py-24 sm:px-10 sm:py-32 lg:px-16">
            <div class="mx-auto max-w-[1400px]">
                <div class="mb-14 flex flex-col gap-8 md:flex-row md:items-end md:justify-between">
                    <div>
                        <p class="text-[9px] uppercase tracking-[.34em] text-[#817a72]">The Team</p>
                        <h2 class="mt-5 font-display text-6xl sm:text-7xl">Meet the collective</h2>
                    </div>
                    <div class="flex gap-3">
                        <button data-team-filter="all"
                            class="filter-button is-active border border-black/20 px-5 py-3 text-[9px] uppercase tracking-[.2em]">All</button>
                    </div>
                </div>
                <div class="grid gap-x-6 gap-y-16 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach($users as $user)
                        <article data-team-card class="reveal group">
                            <div class="image-zoom block aspect-[4/5] overflow-hidden bg-[#dfd5c7]">
                                <img src="{{ $user->image_url }}"
                                    alt="{{ $user->name }}"
                                    class="h-full w-full object-cover grayscale transition duration-700 group-hover:grayscale-0">
                            </div>
                            <p class="mt-5 text-[9px] uppercase tracking-[.24em] text-[#817a72]">
                                {{ $user->position ?: 'Team Member' }}
                            </p>
                            <h3 class="mt-2 font-display text-4xl text-[#171717]">{{ $user->name }}</h3>
                            @if($user->instagram)
                                <a href="{{ str_starts_with($user->instagram, 'http') ? $user->instagram : 'https://instagram.com/' . ltrim($user->instagram, '@') }}"
                                   target="_blank" rel="noopener noreferrer"
                                   class="mt-1 inline-block text-xs uppercase tracking-[.18em] text-black/45 hover:text-black transition-colors">
                                    {{ $user->instagram_handle }}
                                </a>
                            @endif
                            @if($user->about)
                                <p class="mt-3 text-xs font-light text-black/65 leading-relaxed">
                                    {{ $user->about }}
                                </p>
                            @endif
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection
