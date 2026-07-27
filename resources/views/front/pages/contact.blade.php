@extends('front.app')

@section('content')
    {{-- Get in touch --}}
    <section class="contact-section-spacing px-6 pb-24 sm:px-10 sm:pb-32 lg:px-16">
        <div class="mx-auto grid max-w-[1400px] gap-16 lg:grid-cols-[.8fr_1.2fr]">
            <div>
                <p class="text-[9px] uppercase tracking-[.34em] text-[#817a72]">Get in touch</p>
                <h1 class="mt-5 font-display text-7xl leading-[.9] sm:text-8xl">Tell us what you are planning.</h1>
                @if (!empty($settings['site_description']))
                    <p class="mt-8 max-w-md text-sm font-light leading-8 text-black/65">
                        {{ $settings['site_description'] }}
                    </p>
                @endif
                <div class="mt-10 space-y-6 text-sm text-black/75">


                    @if (
                        !empty($settings['whatsapp']) ||
                            !empty($settings['instagram']) ||
                            !empty($settings['facebook']) ||
                            !empty($settings['youtube']))
                        <div>
                            <span class="block text-[9px] uppercase tracking-[.24em] text-[#817a72] mb-3">Connect &
                                Socials</span>
                            <div class="flex items-center gap-3">
                                @if (!empty($settings['whatsapp']))
                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['whatsapp']) }}"
                                        target="_blank" rel="noopener noreferrer"
                                        title="WhatsApp: {{ $settings['whatsapp'] }}"
                                        class="grid h-11 w-11 place-items-center rounded-full border border-black/20 text-[#171717] transition-all hover:bg-[#171717] hover:text-white hover:border-[#171717]">
                                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z" />
                                        </svg>
                                    </a>
                                @endif

                                @if (!empty($settings['instagram']))
                                    <a href="{{ $settings['instagram'] }}" target="_blank" rel="noopener noreferrer"
                                        title="Instagram"
                                        class="grid h-11 w-11 place-items-center rounded-full border border-black/20 text-[#171717] transition-all hover:bg-[#171717] hover:text-white hover:border-[#171717]">
                                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                                        </svg>
                                    </a>
                                @endif

                                @if (!empty($settings['facebook']))
                                    <a href="{{ $settings['facebook'] }}" target="_blank" rel="noopener noreferrer"
                                        title="Facebook"
                                        class="grid h-11 w-11 place-items-center rounded-full border border-black/20 text-[#171717] transition-all hover:bg-[#171717] hover:text-white hover:border-[#171717]">
                                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                                        </svg>
                                    </a>
                                @endif

                                @if (!empty($settings['youtube']))
                                    <a href="{{ $settings['youtube'] }}" target="_blank" rel="noopener noreferrer"
                                        title="YouTube"
                                        class="grid h-11 w-11 place-items-center rounded-full border border-black/20 text-[#171717] transition-all hover:bg-[#171717] hover:text-white hover:border-[#171717]">
                                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z" />
                                        </svg>
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <form action="{{ route('contact.store') }}" method="POST" class="grid gap-7 sm:grid-cols-2">
                @csrf
                {{-- Anti-Spam Honeypot & Timestamp --}}
                <div style="display:none !important;" aria-hidden="true">
                    <input type="text" name="website_hp" tabindex="-1" autocomplete="off">
                </div>
                <input type="hidden" name="form_time" value="{{ encrypt(time()) }}">

                @if(session('success'))
                    <div class="sm:col-span-2 p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs tracking-wider uppercase rounded-sm">
                        {{ session('success') }}
                    </div>
                @endif
                @if($errors->has('message') && !$errors->has('name'))
                    <div class="sm:col-span-2 p-4 bg-red-50 border border-red-200 text-red-800 text-xs tracking-wider uppercase rounded-sm">
                        {{ $errors->first('message') }}
                    </div>
                @endif

                <label class="block">
                    <span class="text-[9px] uppercase tracking-[.22em]">Full name *</span>
                    <input name="name" value="{{ old('name') }}" required
                        class="mt-3 w-full border-b border-black/25 bg-transparent py-3 outline-none focus:border-black transition-colors"
                        placeholder="Your name">
                    @error('name')
                        <small class="mt-2 block text-xs text-red-700">{{ $message }}</small>
                    @enderror
                </label>

                <label class="block">
                    <span class="text-[9px] uppercase tracking-[.22em]">Email *</span>
                    <input name="email" type="email" value="{{ old('email') }}" required
                        class="mt-3 w-full border-b border-black/25 bg-transparent py-3 outline-none focus:border-black transition-colors"
                        placeholder="you@example.com">
                    @error('email')
                        <small class="mt-2 block text-xs text-red-700">{{ $message }}</small>
                    @enderror
                </label>

                <label class="block">
                    <span class="text-[9px] uppercase tracking-[.22em]">Phone / WhatsApp *</span>
                    <input name="phone" value="{{ old('phone') }}" required
                        class="mt-3 w-full border-b border-black/25 bg-transparent py-3 outline-none focus:border-black transition-colors"
                        placeholder="+62 800 0000 0000">
                    @error('phone')
                        <small class="mt-2 block text-xs text-red-700">{{ $message }}</small>
                    @enderror
                </label>

                <label class="block">
                    <span class="text-[9px] uppercase tracking-[.22em]">Subject / Service *</span>
                    <select name="subject" required
                        class="mt-3 w-full border-b border-black/25 bg-transparent py-3 outline-none focus:border-black transition-colors">
                        <option value="">Select subject / service</option>
                        <option value="Wedding Photography" {{ old('subject') == 'Wedding Photography' ? 'selected' : '' }}>Wedding Photography</option>
                        <option value="Prewedding Photography" {{ old('subject') == 'Prewedding Photography' ? 'selected' : '' }}>Prewedding Photography</option>
                        <option value="Wedding Film & Videography" {{ old('subject') == 'Wedding Film & Videography' ? 'selected' : '' }}>Wedding Film & Videography</option>
                        <option value="Family Portrait" {{ old('subject') == 'Family Portrait' ? 'selected' : '' }}>Family Portrait</option>
                        <option value="Maternity & Event" {{ old('subject') == 'Maternity & Event' ? 'selected' : '' }}>Maternity & Event</option>
                        <option value="General Inquiry" {{ old('subject') == 'General Inquiry' ? 'selected' : '' }}>General Inquiry</option>
                    </select>
                    @error('subject')
                        <small class="mt-2 block text-xs text-red-700">{{ $message }}</small>
                    @enderror
                </label>

                <label class="block sm:col-span-2">
                    <span class="text-[9px] uppercase tracking-[.22em]">Tell us more *</span>
                    <textarea name="message" required rows="6"
                        class="mt-3 w-full border-b border-black/25 bg-transparent py-3 outline-none focus:border-black transition-colors"
                        placeholder="Location, event plans, and what matters most to you">{{ old('message') }}</textarea>
                    @error('message')
                        <small class="mt-2 block text-xs text-red-700">{{ $message }}</small>
                    @enderror
                </label>

                <div class="sm:col-span-2">
                    <button class="bg-[#171717] hover:bg-black px-8 py-5 text-[10px] uppercase tracking-[.24em] text-white transition-colors" type="submit">
                        Send Enquiry
                    </button>
                </div>
            </form>
        </div>
    </section>
    <section class="grid min-h-[480px] bg-[#dfd5c7] lg:grid-cols-2">
        <div class="min-h-[400px] relative">
            @if (!empty($settings['maps_embed']))
                <div
                    class="h-full min-h-[400px] w-full [&>iframe]:w-full [&>iframe]:h-full [&>iframe]:min-h-[400px] [&>iframe]:border-0 grayscale">
                    {!! $settings['maps_embed'] !!}
                </div>
            @else
                <iframe class="h-full min-h-[400px] w-full grayscale" title="Studio location" loading="lazy"
                    src="https://www.openstreetmap.org/export/embed.html?bbox=106.75%2C-6.25%2C106.9%2C-6.1&amp;layer=mapnik"></iframe>
            @endif
        </div>
        <div class="flex items-center px-8 py-20 sm:px-16">
            <div>
                <p class="text-[9px] uppercase tracking-[.3em] text-[#817a72]">Studio visits</p>
                <h2 class="mt-5 font-display text-6xl">By appointment only.</h2>
                <p class="mt-6 max-w-lg text-sm leading-8 text-black/65">
                    {{ !empty($settings['address']) ? $settings['address'] : 'Our consultation spaces are designed for private conversations, album reviews, and creative planning. Contact the team before visiting.' }}
                </p>
            </div>
        </div>
    </section>
@endsection
