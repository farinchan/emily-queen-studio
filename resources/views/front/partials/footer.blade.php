@php
    $photographyNav = \App\Models\Photography::select('id', 'title', 'slug')->take(5)->get();
    $whatsapp = \App\Models\Setting::get('whatsapp');
    $address = \App\Models\Setting::get('address');
    $instagram = \App\Models\Setting::get('instagram');
    $facebook = \App\Models\Setting::get('facebook');
    $youtube = \App\Models\Setting::get('youtube');
    $siteName = \App\Models\Setting::get('site_name', 'Emily Queen Studio');
@endphp
<!-- Footer -->
<footer class="bg-[#171717] text-white" id="contact">
    <div class="mx-auto max-w-[1600px] px-6 py-20 sm:px-10 sm:py-28 lg:px-16 lg:py-32">
        <div
            class="grid gap-16 border-b border-white/15 pb-20 md:grid-cols-2 lg:grid-cols-[1.25fr_.75fr_.75fr] lg:gap-20">
            <div class="reveal">
                <p class="mb-6 text-[9px] uppercase tracking-[.34em] text-white/45">Get in touch</p>
                <h2 class="font-display text-6xl leading-[.95] sm:text-7xl lg:text-8xl">Let us tell your story.
                </h2>
                <a class="mt-10 inline-flex items-center gap-4 border-b border-white/35 pb-2 text-[10px] uppercase tracking-[.24em] transition-all hover:gap-7 hover:border-white"
                    href="{{ route('contact') }}">
                    Send Enquiry <span>→</span>
                </a>
            </div>

            <div class="reveal">
                <p class="mb-7 text-[9px] uppercase tracking-[.3em] text-white/45">Studio Location</p>
                <div class="space-y-4 text-sm font-light leading-7 text-white/70">
                    @if ($address)
                        <p class="max-w-xs">{{ $address }}</p>
                    @else
                        <p>Padang, Sumatera Barat, Indonesia</p>
                    @endif

                    @if ($whatsapp)
                        <div class="pt-1">
                            <p class="text-[9px] uppercase tracking-[.24em] text-white/45 mb-1">WhatsApp</p>
                            <a class="text-white hover:underline transition-all font-normal"
                                href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $whatsapp) }}" target="_blank"
                                rel="noopener noreferrer">
                                {{ $whatsapp }}
                            </a>
                        </div>
                    @endif

                    <p class="text-xs uppercase tracking-[.2em] text-white/40 pt-2">By appointment only</p>
                </div>
            </div>

            <div class="reveal">
                <p class="mb-7 text-[9px] uppercase tracking-[.3em] text-white/45">Navigation</p>
                <div class="grid gap-3 text-[10px] uppercase tracking-[.2em] text-white/70">
                    <a class="hover:text-white transition-colors" href="{{ route('home') }}">Home</a>
                    <a class="hover:text-white transition-colors" href="{{ route('about') }}">About Us</a>
                    @foreach ($photographyNav as $photo)
                        <a class="hover:text-white transition-colors"
                            href="{{ route('photography.show', $photo->slug) }}">{{ $photo->title }}</a>
                    @endforeach
                    <a class="hover:text-white transition-colors" href="{{ route('contact') }}">Contact</a>
                    @if ($instagram)
                        <a class="hover:text-white transition-colors" href="{{ $instagram }}" target="_blank"
                            rel="noopener noreferrer">Instagram ↗</a>
                    @endif
                    @if ($facebook)
                        <a class="hover:text-white transition-colors" href="{{ $facebook }}" target="_blank"
                            rel="noopener noreferrer">Facebook ↗</a>
                    @endif
                    @if ($youtube)
                        <a class="hover:text-white transition-colors" href="{{ $youtube }}" target="_blank"
                            rel="noopener noreferrer">YouTube ↗</a>
                    @endif
                </div>
            </div>
        </div>

        <div class="flex flex-col gap-10 pt-10 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <span class="block text-3xl font-semibold tracking-[.36em]">EMILY QUEEN</span>
                <span class="mt-2 block text-[7px] uppercase tracking-[.5em] text-white/45">Home Photo Studio</span>
            </div>
            <div class="flex flex-col gap-2 text-[8px] uppercase tracking-[.2em] text-white/40 sm:text-right">
                <p>© {{ date('Y') }} {{ $siteName }}. All rights reserved.</p>
                <p>Padang, West Sumatra, Indonesia</p>
            </div>
        </div>
    </div>
</footer>
