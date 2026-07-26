<div style="height: 100vh; display: flex; flex-direction: column;">
    {{-- Toast Notification (vanilla JS) --}}
    <div id="livewire-toast"
        style="position:fixed;bottom:1.5rem;right:1.5rem;z-index:99999;min-width:320px;opacity:0;transform:translateY(8px);transition:opacity .3s ease,transform .3s ease;pointer-events:none;">
        <div
            style="background: #10b981; color: white; padding: 12px 18px; border-radius: 8px; font-size: 14px; font-weight: 500; display: flex; align-items: center; gap: 10px; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.3);">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="10"></circle>
                <polyline points="9 11 12 14 22 4"></polyline>
            </svg>
            <span id="livewire-toast-message"></span>
        </div>
    </div>

    {{-- Top Header Toolbar --}}
    <header
        style="height: 60px; background: #111827; border-bottom: 1px solid #374151; display: flex; align-items: center; justify-content: space-between; padding: 0 1.25rem; flex-shrink: 0;">
        <div style="display: flex; align-items: center; gap: 1rem;">
            <a href="{{ route('admin.photographies.index') }}"
                style="display: inline-flex; align-items: center; gap: 6px; color: #9ca3af; text-decoration: none; font-size: 13px; font-weight: 500; padding: 6px 12px; border-radius: 6px; background: #1f2937; transition: all .2s;"
                onmouseover="this.style.color='#fff'; this.style.background='#374151'"
                onmouseout="this.style.color='#9ca3af'; this.style.background='#1f2937'">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2">
                    <line x1="19" y1="12" x2="5" y2="12"></line>
                    <polyline points="12 19 5 12 12 5"></polyline>
                </svg>
                Kembali ke Daftar
            </a>
            <div style="height: 20px; width: 1px; background: #374151;"></div>
            <div>
                <h1 style="margin: 0; font-size: 14px; font-weight: 600; color: #f9fafb;">GrapesJS Page Builder</h1>
                <span style="font-size: 12px; color: #9ca3af;">{{ $photography->title }}</span>
            </div>
        </div>

        {{-- Device Viewports Switcher --}}
        <div
            style="display: flex; align-items: center; gap: 4px; background: #1f2937; padding: 4px; border-radius: 8px;">
            <button type="button" id="device-desktop"
                style="padding: 6px 12px; font-size: 12px; border: none; background: #374151; color: #fff; border-radius: 6px; cursor: pointer; display: flex; align-items: center; gap: 6px;"
                onclick="setDevice('Desktop')">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2">
                    <rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect>
                    <line x1="8" y1="21" x2="16" y2="21"></line>
                    <line x1="12" y1="17" x2="12" y2="21"></line>
                </svg>
                Desktop
            </button>
            <button type="button" id="device-tablet"
                style="padding: 6px 12px; font-size: 12px; border: none; background: transparent; color: #9ca3af; border-radius: 6px; cursor: pointer; display: flex; align-items: center; gap: 6px;"
                onclick="setDevice('Tablet')">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2">
                    <rect x="4" y="2" width="16" height="20" rx="2" ry="2"></rect>
                    <line x1="12" y1="18" x2="12.01" y2="18"></line>
                </svg>
                Tablet
            </button>
            <button type="button" id="device-mobile"
                style="padding: 6px 12px; font-size: 12px; border: none; background: transparent; color: #9ca3af; border-radius: 6px; cursor: pointer; display: flex; align-items: center; gap: 6px;"
                onclick="setDevice('Mobile')">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2">
                    <rect x="5" y="2" width="14" height="20" rx="2" ry="2"></rect>
                    <line x1="12" y1="18" x2="12.01" y2="18"></line>
                </svg>
                Mobile
            </button>
        </div>

        {{-- Actions --}}
        <div style="display: flex; align-items: center; gap: 10px;">
            <button type="button" id="btn-save-content"
                style="display: inline-flex; align-items: center; gap: 8px; padding: 8px 20px; font-size: 13px; font-weight: 600; background: #2563eb; color: white; border: none; border-radius: 6px; cursor: pointer; transition: background .2s;"
                onmouseover="this.style.background='#1d4ed8'" onmouseout="this.style.background='#2563eb'">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                    <polyline points="17 21 17 13 7 13 7 21"></polyline>
                    <polyline points="7 3 7 8 15 8"></polyline>
                </svg>
                Simpan Content
            </button>
        </div>
    </header>

    {{-- GrapesJS Editor Area --}}
    <div wire:ignore style="flex: 1; height: calc(100vh - 60px); width: 100%; position: relative;">
        <div id="gjs" style="height: 100%; width: 100%;"></div>
    </div>
</div>

<script>
    let editor = null;

    document.addEventListener('DOMContentLoaded', () => {
        const initialContent = @json($content);

        editor = grapesjs.init({
            container: '#gjs',
            fromElement: false,
            height: '100%',
            width: 'auto',
            storageManager: false,
            plugins: ['grapesjs-preset-newsletter'],
            pluginsOpts: {
                'grapesjs-preset-newsletter': {
                    // options
                }
            },

            // INJECT EXACT FRONT-END CSS & FONTS INTO CANVAS IFRAME
            canvas: {
                styles: [
                    'https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;1,400&family=Montserrat:wght@300;400;500;600&display=swap',
                    '{{ asset('assets/css/tailwind.css') }}',
                    '{{ asset('assets/css/styles.css') }}'
                ]
            },

            // Built-in Theme-tailored Blocks
            blockManager: {
                blocks: [
                    {
                        id: 'section-hero-fullscreen',
                        label: '✨ Fullscreen Hero Banner',
                        category: 'Page Sections',
                        content: `
                            <section class="relative min-h-[750px] flex items-end overflow-hidden bg-black text-white py-24 px-6 sm:px-12 lg:px-16">
                                <img src="https://images.unsplash.com/photo-1519741497674-611481863552?auto=format&fit=crop&w=2000&q=88" alt="Hero Background" class="absolute inset-0 w-full h-full object-cover opacity-65" />
                                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent"></div>
                                <div class="relative z-10 max-w-5xl mx-auto text-left w-full">
                                    <span class="text-[10px] uppercase tracking-[.35em] text-white/70 block mb-4">${@json($photography->label ?: 'Editorial Collection')}</span>
                                    <h1 class="font-display text-5xl sm:text-7xl lg:text-[100px] leading-[.9] font-normal mb-6">${@json($photography->title)}</h1>
                                    <p class="max-w-xl text-sm sm:text-base text-white/80 font-light leading-relaxed uppercase tracking-[.15em] mb-8">${@json($photography->subtitle ?: 'Capture timeless vows and memorable moments forever.')}</p>
                                    <a href="#gallery" class="inline-flex items-center gap-4 border-b border-white/60 pb-2 text-[10px] uppercase tracking-[.25em] font-medium hover:gap-6 hover:border-white transition-all">Explore Story <span>→</span></a>
                                </div>
                            </section>
                        `
                    },
                    {
                        id: 'section-hero',
                        label: '✨ Hero Section',
                        category: 'Page Sections',
                        content: `
                            <section class="bg-white text-[#171717] py-20 px-6 sm:px-12 text-center border-b border-black/10">
                                <span class="text-[10px] uppercase tracking-[.3em] text-[#171717]/60 mb-4 block">${@json($photography->label ?: 'Portfolio Collection')}</span>
                                <h1 class="font-display text-5xl sm:text-7xl font-normal leading-tight mb-6">${@json($photography->title)}</h1>
                                <p class="max-w-2xl mx-auto text-sm sm:text-base text-[#171717]/70 font-light leading-relaxed mb-8">${@json($photography->subtitle ?: 'Capture timeless vows and memorable moments forever.')}</p>
                                <a href="#gallery" class="inline-flex items-center gap-3 border-b border-black/40 pb-1 text-[11px] uppercase tracking-[.24em] font-medium hover:border-black transition-all">Jelajahi Galeri <span>→</span></a>
                            </section>
                        `
                    },
                    {
                        id: 'section-editorial-story',
                        label: '📖 Editorial Story & Quote',
                        category: 'Page Sections',
                        content: `
                            <section class="bg-white text-[#171717] py-24 px-6 sm:px-12 lg:px-16 max-w-5xl mx-auto">
                                <div class="text-center max-w-2xl mx-auto mb-16">
                                    <span class="text-[9px] uppercase tracking-[.3em] text-[#817a72] block mb-3">Chapter I · Connection</span>
                                    <h2 class="font-display text-4xl sm:text-5xl leading-tight">Sebuah Kisah Tentang Cinta & Keindahan</h2>
                                </div>
                                <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                                    <div class="lg:col-span-7">
                                        <p class="text-lg leading-relaxed text-black/80 font-light mb-6">
                                            Ketika keramaian meredap, dua insan menemukan bahwa momen paling sederhana sering kali menjadi yang paling abadi. Melalui kehangatan tatapan, tawa alami, dan pendar cahaya, kami merangkai kenangan yang bertahan melintasi waktu.
                                        </p>
                                        <blockquote class="border-l-2 border-black/30 pl-6 py-2 my-8 font-display italic text-2xl text-black/90">
                                            "Foto adalah puisi visual yang menangkap keabadian dalam selintas detik."
                                        </blockquote>
                                    </div>
                                    <div class="lg:col-span-5 overflow-hidden rounded-sm bg-black/5 aspect-[4/5] shadow-sm">
                                        <img src="https://images.unsplash.com/photo-1522673607200-164d1b6ce486?auto=format&fit=crop&w=1000&q=80" alt="Story Feature" class="w-full h-full object-cover" />
                                    </div>
                                </div>
                            </section>
                        `
                    },
                    {
                        id: 'section-quote-banner',
                        label: '💬 Dark Quote Banner',
                        category: 'Page Sections',
                        content: `
                            <section class="bg-[#171717] text-white py-24 px-6 sm:px-12 text-center my-12">
                                <div class="max-w-3xl mx-auto space-y-6">
                                    <span class="text-[9px] uppercase tracking-[.4em] text-white/50 block">Studio Philosophy</span>
                                    <h3 class="font-display text-3xl sm:text-5xl italic font-normal leading-snug text-white/95">
                                        "Mencintai dan dicintai adalah merasakan pancaran sinar matahari dari dua sisi."
                                    </h3>
                                    <p class="text-xs uppercase tracking-[.25em] text-white/60 font-light pt-4">— Emily Queen Studio</p>
                                </div>
                            </section>
                        `
                    },
                    {
                        id: 'section-photographer-top',
                        label: '👤 Photographer (Foto di Atas)',
                        category: 'Page Sections',
                        content: `
                            <section class="py-16 px-6 max-w-3xl mx-auto text-center">
                                <div style="width: 72px; height: 72px;" class="mx-auto rounded-full overflow-hidden mb-5 shadow-sm bg-black/5">
                                    <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=400&q=80" alt="Photographer Avatar" class="w-full h-full object-cover" />
                                </div>
                                <span class="text-[9px] uppercase tracking-[.28em] text-[#817a72] block mb-1">Captured By</span>
                                <h3 class="font-display text-3xl text-[#171717] mb-3">Emily Queen</h3>
                                <p class="text-sm font-light text-black/70 leading-relaxed max-w-lg mx-auto">
                                    Menangkap kehangatan, emosi, dan kejujuran momen pernikahan Anda dalam karya visual yang tak lekang oleh waktu.
                                </p>
                            </section>
                        `
                    },
                    {
                        id: 'section-photographer-left',
                        label: '👤 Photographer (Foto di Kiri)',
                        category: 'Page Sections',
                        content: `
                            <section class="py-16 px-6 max-w-3xl mx-auto">
                                <div class="flex flex-col sm:flex-row items-center gap-6 p-6 sm:p-8 rounded-sm border border-black/5 bg-[#faf9f6]">
                                    <div style="width: 72px; height: 72px; flex-shrink: 0;" class="rounded-full overflow-hidden bg-black/5 shadow-sm">
                                        <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=400&q=80" alt="Photographer" class="w-full h-full object-cover" />
                                    </div>
                                    <div class="space-y-2 sm:text-left">
                                        <span class="text-[9px] uppercase tracking-[.28em] text-[#817a72] block">Captured By</span>
                                        <h3 class="font-display text-3xl text-[#171717]">Emily Queen</h3>
                                        <p class="text-sm font-light text-black/70 leading-relaxed">
                                            Menangkap kehangatan, emosi, dan kejujuran momen pernikahan Anda dalam karya visual yang tak lekang oleh waktu.
                                        </p>
                                    </div>
                                </div>
                            </section>
                        `
                    },
                    {
                        id: 'section-youtube-embed',
                        label: '▶️ YouTube Video Embed (16:9 Player)',
                        category: 'Page Sections',
                        content: `
                            <section class="py-16 px-6 sm:px-12 max-w-5xl mx-auto text-center">
                                <div class="mb-8 space-y-2">
                                    <span class="text-[9px] uppercase tracking-[.3em] text-[#817a72] block">Featured Video</span>
                                    <h3 class="font-display text-3xl sm:text-5xl font-normal text-[#171717]">Cinematic Wedding Highlights</h3>
                                    <p class="text-sm text-black/65 font-light max-w-xl mx-auto">Tonton cuplikan momen terindah dalam format video sinematik 4K.</p>
                                </div>
                                <div class="relative overflow-hidden rounded-sm aspect-[16/9] w-full min-h-[380px] bg-black shadow-lg">
<iframe width="560" height="315" src="https://www.youtube.com/embed/-oWixTYefzE?si=Ba8a3jKtANHEZ2CM" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>                                </div>
                            </section>
                        `
                    },
                    {
                        id: 'section-faq-accordion',
                        label: '❓ FAQ Client Accordion',
                        category: 'Page Sections',
                        content: `
                            <section class="py-20 px-6 sm:px-12 max-w-4xl mx-auto">
                                <div class="text-center mb-12">
                                    <span class="text-[9px] uppercase tracking-[.3em] text-[#817a72] block mb-2">Information</span>
                                    <h3 class="font-display text-4xl">Frequently Asked Questions</h3>
                                </div>
                                <div class="space-y-6">
                                    <div class="border-b border-black/10 pb-5">
                                        <h4 class="font-display text-xl mb-2 text-[#171717]">Berapa lama proses edit dan pengiriman hasil foto?</h4>
                                        <p class="text-sm text-black/70 font-light leading-relaxed">Pengiriman teaser sneak peek foto diberikan H+3 setelah acara. Album penuh dan galeri online selesai dalam waktu 3-4 minggu.</p>
                                    </div>
                                    <div class="border-b border-black/10 pb-5">
                                        <h4 class="font-display text-xl mb-2 text-[#171717]">Apakah melayani sesi pemotretan luar kota / luar negeri?</h4>
                                        <p class="text-sm text-black/70 font-light leading-relaxed">Ya, tim kami siap mendokumentasikan momen bahagia Anda di seluruh Indonesia maupun luar negeri.</p>
                                    </div>
                                </div>
                            </section>
                        `
                    },
                    {
                        id: 'section-press-awards',
                        label: '🏆 Press & Publications Strip',
                        category: 'Page Sections',
                        content: `
                            <section class="border-y border-black/10 py-12 px-6 bg-[#faf9f6]">
                                <div class="max-w-[1400px] mx-auto text-center space-y-6">
                                    <span class="text-[9px] uppercase tracking-[.35em] text-[#817a72] block">Featured In & Awards</span>
                                    <div class="flex flex-wrap items-center justify-center gap-10 md:gap-16 font-display text-xl sm:text-2xl text-black/60 tracking-wider">
                                        <span>VOGUE WEDDINGS</span>
                                        <span>·</span>
                                        <span>HARPER'S BAZAAR</span>
                                        <span>·</span>
                                        <span>BRIDES MAGAZINE</span>
                                        <span>·</span>
                                        <span>GRACE ORMONDE</span>
                                    </div>
                                </div>
                            </section>
                        `
                    },

                    {
                        id: 'section-testimonial-card',
                        label: '💌 Couple Testimonial Letter',
                        category: 'Page Sections',
                        content: `
                            <section class="py-20 px-6 sm:px-12 max-w-4xl mx-auto">
                                <div class="bg-white border border-black/10 p-8 sm:p-14 shadow-sm text-center relative overflow-hidden">
                                    <div class="absolute -top-6 -right-6 text-black/5 text-9xl font-display font-bold select-none">“</div>
                                    <span class="text-[9px] uppercase tracking-[.3em] text-[#817a72] block mb-4">Love Letter & Review</span>
                                    <h3 class="font-display text-2xl sm:text-3xl italic text-[#171717] mb-6 leading-relaxed">
                                        "Melihat kembali album foto kami membawa kami kembali ke setiap detik emosi dan kebahagiaan hari pernikahan kami. Terima kasih telah mengabadikan cerita kami secara sempurna."
                                    </h3>
                                    <div class="pt-4 border-t border-black/10 max-w-xs mx-auto">
                                        <span class="font-display text-lg block text-[#171717]">Sophia & Alexander</span>
                                        <span class="text-[10px] uppercase tracking-[.2em] text-[#817a72]">Villa Como, Italy</span>
                                    </div>
                                </div>
                            </section>
                        `
                    },
                    {
                        id: 'section-timeline-story',
                        label: '⏳ Love Story Timeline & Milestones',
                        category: 'Page Sections',
                        content: `
                            <section class="py-20 px-6 sm:px-12 max-w-[1400px] mx-auto">
                                <div class="text-center mb-16">
                                    <span class="text-[9px] uppercase tracking-[.3em] text-[#817a72] block mb-2">The Journey</span>
                                    <h3 class="font-display text-4xl sm:text-5xl">Milestones of The Day</h3>
                                </div>
                                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                                    <div class="border-t border-black/20 pt-6 space-y-2">
                                        <span class="text-[10px] uppercase tracking-[.25em] font-mono text-[#817a72]">01 · MORNING</span>
                                        <h4 class="font-display text-2xl text-[#171717]">The Preparation</h4>
                                        <p class="text-xs font-light text-black/70 leading-relaxed">Sesi dokumentasi riasan, gaun, dan momen haru bersama keluarga tercinta.</p>
                                    </div>
                                    <div class="border-t border-black/20 pt-6 space-y-2">
                                        <span class="text-[10px] uppercase tracking-[.25em] font-mono text-[#817a72]">02 · NOON</span>
                                        <h4 class="font-display text-2xl text-[#171717]">The First Look</h4>
                                        <p class="text-xs font-light text-black/70 leading-relaxed">Momen emosional tatapan pertama kedua mempelai sebelum upacara sakral.</p>
                                    </div>
                                    <div class="border-t border-black/20 pt-6 space-y-2">
                                        <span class="text-[10px] uppercase tracking-[.25em] font-mono text-[#817a72]">03 · AFTERNOON</span>
                                        <h4 class="font-display text-2xl text-[#171717]">Holy Matrimony</h4>
                                        <p class="text-xs font-light text-black/70 leading-relaxed">Janji suci pernikahan, penukaran cincin, dan ciuman pertama sebagai suami istri.</p>
                                    </div>
                                    <div class="border-t border-black/20 pt-6 space-y-2">
                                        <span class="text-[10px] uppercase tracking-[.25em] font-mono text-[#817a72]">04 · EVENING</span>
                                        <h4 class="font-display text-2xl text-[#171717]">Dinner & Party</h4>
                                        <p class="text-xs font-light text-black/70 leading-relaxed">Pesta resepsi malam yang hangat, pesta dansa, dan kembang api.</p>
                                    </div>
                                </div>
                            </section>
                        `
                    },
                    {
                        id: 'section-contact-cta',
                        label: '✉️ Booking & Inquiry CTA Card',
                        category: 'Page Sections',
                        content: `
                            <section class="bg-[#171717] text-white py-20 px-6 sm:px-12 rounded-sm max-w-[1400px] mx-auto my-16 text-center">
                                <div class="max-w-2xl mx-auto space-y-6">
                                    <span class="text-[9px] uppercase tracking-[.35em] text-white/50 block">Reservation</span>
                                    <h3 class="font-display text-4xl sm:text-5xl font-normal leading-tight">Ready to Tell Your Unique Story?</h3>
                                    <p class="text-sm text-white/70 font-light leading-relaxed">Hubungi tim kami untuk konsultasi konsep pemotretan dan tanggal ketersediaan.</p>
                                    <div class="pt-4">
                                        <a href="#contact" class="inline-block bg-white text-[#171717] px-8 py-3.5 text-[10px] uppercase tracking-[.25em] font-medium hover:bg-white/90 transition-all rounded-sm shadow-md">
                                            Book A Session Now <span>→</span>
                                        </a>
                                    </div>
                                </div>
                            </section>
                        `
                    },

                    // GALLERY GRIDS
                    {
                        id: 'grid-1-photo-standard',
                        label: '🖼️ 1 Photo (Standard Centered)',
                        category: 'Gallery Grids',
                        content: `
                            <div class="max-w-4xl mx-auto px-6 py-8">
                                <div class="overflow-hidden rounded-sm bg-black/5 aspect-[3/2] shadow-sm group">
                                    <img src="https://images.unsplash.com/photo-1519225421980-715cb0215aed?auto=format&fit=crop&w=1600&q=88" alt="Standard Featured Photo" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" />
                                </div>
                            </div>
                        `
                    },
                    {
                        id: 'grid-1-photo-wide',
                        label: '🖼️ 1 Photo Wide Container (1400px)',
                        category: 'Gallery Grids',
                        content: `
                            <div class="max-w-[1400px] mx-auto px-6 py-10">
                                <div class="overflow-hidden rounded-sm bg-black/5 aspect-[16/9] shadow-sm group">
                                    <img src="https://images.unsplash.com/photo-1519225421980-715cb0215aed?auto=format&fit=crop&w=2000&q=88" alt="Wide Featured Photo" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" />
                                </div>
                            </div>
                        `
                    },
                    {
                        id: 'grid-2-col-equal',
                        label: '🖼️ 2 Photo Side-by-Side (Equal Gap)',
                        category: 'Gallery Grids',
                        content: `
                            <div class="max-w-[1400px] mx-auto px-6 py-10">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-10">
                                    <div class="overflow-hidden rounded-sm bg-black/5 aspect-[4/5] shadow-sm group">
                                        <img src="https://images.unsplash.com/photo-1519741497674-611481863552?auto=format&fit=crop&w=1200&q=80" alt="Photo 1" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" />
                                    </div>
                                    <div class="overflow-hidden rounded-sm bg-black/5 aspect-[4/5] shadow-sm group">
                                        <img src="https://images.unsplash.com/photo-1522673607200-164d1b6ce486?auto=format&fit=crop&w=1200&q=80" alt="Photo 2" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" />
                                    </div>
                                </div>
                            </div>
                        `
                    },
                    {
                        id: 'grid-3-col-equal',
                        label: '📷 3 Photo Grid (Triple Columns)',
                        category: 'Gallery Grids',
                        content: `
                            <div class="max-w-[1500px] mx-auto px-6 py-10">
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8">
                                    <div class="overflow-hidden rounded-sm bg-black/5 aspect-[3/4] shadow-sm group">
                                        <img src="https://images.unsplash.com/photo-1544078751-58fee2d8a03b?auto=format&fit=crop&w=900&q=80" alt="Photo 1" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" />
                                    </div>
                                    <div class="overflow-hidden rounded-sm bg-black/5 aspect-[3/4] shadow-sm group">
                                        <img src="https://images.unsplash.com/photo-1523438885200-e635ba2c371e?auto=format&fit=crop&w=900&q=80" alt="Photo 2" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" />
                                    </div>
                                    <div class="overflow-hidden rounded-sm bg-black/5 aspect-[3/4] shadow-sm group">
                                        <img src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=900&q=80" alt="Photo 3" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" />
                                    </div>
                                </div>
                            </div>
                        `
                    },
                    {
                        id: 'grid-3-col-highlight',
                        label: '🌟 3 Photo Grid (Featured Center)',
                        category: 'Gallery Grids',
                        content: `
                            <div class="max-w-[1500px] mx-auto px-6 py-12">
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-center">
                                    <div class="overflow-hidden rounded-sm bg-black/5 aspect-[3/4] shadow-sm group">
                                        <img src="https://images.unsplash.com/photo-1519741497674-611481863552?auto=format&fit=crop&w=800&q=80" alt="Side 1" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" />
                                    </div>
                                    <div class="overflow-hidden rounded-sm bg-black/5 aspect-[2/3] shadow-md md:-translate-y-2 group z-10">
                                        <img src="https://images.unsplash.com/photo-1511285560929-80b456fea0bc?auto=format&fit=crop&w=1000&q=84" alt="Center Highlight" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" />
                                    </div>
                                    <div class="overflow-hidden rounded-sm bg-black/5 aspect-[3/4] shadow-sm group">
                                        <img src="https://images.unsplash.com/photo-1522673607200-164d1b6ce486?auto=format&fit=crop&w=800&q=80" alt="Side 2" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" />
                                    </div>
                                </div>
                            </div>
                        `
                    },
                    {
                        id: 'grid-4-col-quad',
                        label: '📸 4 Photo Grid (Quad Columns)',
                        category: 'Gallery Grids',
                        content: `
                            <div class="max-w-[1600px] mx-auto px-6 py-10">
                                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">
                                    <div class="overflow-hidden rounded-sm bg-black/5 aspect-[3/4] shadow-sm group">
                                        <img src="https://images.unsplash.com/photo-1519741497674-611481863552?auto=format&fit=crop&w=800&q=80" alt="Quad 1" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" />
                                    </div>
                                    <div class="overflow-hidden rounded-sm bg-black/5 aspect-[3/4] shadow-sm group">
                                        <img src="https://images.unsplash.com/photo-1522673607200-164d1b6ce486?auto=format&fit=crop&w=800&q=80" alt="Quad 2" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" />
                                    </div>
                                    <div class="overflow-hidden rounded-sm bg-black/5 aspect-[3/4] shadow-sm group">
                                        <img src="https://images.unsplash.com/photo-1544078751-58fee2d8a03b?auto=format&fit=crop&w=800&q=80" alt="Quad 3" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" />
                                    </div>
                                    <div class="overflow-hidden rounded-sm bg-black/5 aspect-[3/4] shadow-sm group">
                                        <img src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=800&q=80" alt="Quad 4" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" />
                                    </div>
                                </div>
                            </div>
                        `
                    },
                    {
                        id: 'grid-staggered-offset',
                        label: '✨ Staggered Offset 3-Grid (Floating Steps)',
                        category: 'Gallery Grids',
                        content: `
                            <div class="max-w-[1500px] mx-auto px-6 py-16">
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-start">
                                    <div class="overflow-hidden rounded-sm bg-black/5 aspect-[4/5] shadow-sm group md:translate-y-4">
                                        <img src="https://images.unsplash.com/photo-1544078751-58fee2d8a03b?auto=format&fit=crop&w=800&q=80" alt="Stagger 1" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" />
                                    </div>
                                    <div class="overflow-hidden rounded-sm bg-black/5 aspect-[4/5] shadow-md group md:-translate-y-4">
                                        <img src="https://images.unsplash.com/photo-1523438885200-e635ba2c371e?auto=format&fit=crop&w=800&q=80" alt="Stagger 2" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" />
                                    </div>
                                    <div class="overflow-hidden rounded-sm bg-black/5 aspect-[4/5] shadow-sm group md:translate-y-8">
                                        <img src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=800&q=80" alt="Stagger 3" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" />
                                    </div>
                                </div>
                            </div>
                        `
                    },
                    {
                        id: 'grid-featured-thumbnails',
                        label: '👑 Featured Main + 4 Detail Thumbnails',
                        category: 'Gallery Grids',
                        content: `
                            <div class="max-w-[1400px] mx-auto px-6 py-12 space-y-6">
                                <div class="overflow-hidden rounded-sm bg-black/5 aspect-[16/9] shadow-sm group">
                                    <img src="https://images.unsplash.com/photo-1519225421980-715cb0215aed?auto=format&fit=crop&w=1800&q=88" alt="Featured Main" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" />
                                </div>
                                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                    <div class="overflow-hidden rounded-sm bg-black/5 aspect-[4/3] shadow-sm group">
                                        <img src="https://images.unsplash.com/photo-1519741497674-611481863552?auto=format&fit=crop&w=600&q=80" alt="Detail 1" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" />
                                    </div>
                                    <div class="overflow-hidden rounded-sm bg-black/5 aspect-[4/3] shadow-sm group">
                                        <img src="https://images.unsplash.com/photo-1522673607200-164d1b6ce486?auto=format&fit=crop&w=600&q=80" alt="Detail 2" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" />
                                    </div>
                                    <div class="overflow-hidden rounded-sm bg-black/5 aspect-[4/3] shadow-sm group">
                                        <img src="https://images.unsplash.com/photo-1544078751-58fee2d8a03b?auto=format&fit=crop&w=600&q=80" alt="Detail 3" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" />
                                    </div>
                                    <div class="overflow-hidden rounded-sm bg-black/5 aspect-[4/3] shadow-sm group">
                                        <img src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=600&q=80" alt="Detail 4" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" />
                                    </div>
                                </div>
                            </div>
                        `
                    },
                    {
                        id: 'grid-film-strip',
                        label: '🎞️ 35mm Filmstrip Gallery',
                        category: 'Gallery Grids',
                        content: `
                            <div class="bg-black text-white py-12 px-6 my-10 border-y border-white/10">
                                <div class="max-w-[1500px] mx-auto">
                                    <div class="flex items-center justify-between text-[10px] uppercase tracking-[.3em] text-white/50 mb-6 font-mono">
                                        <span>35MM FILM ROLL · PORTRA 400</span>
                                        <span>KODAK EXP 2026</span>
                                    </div>
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                        <div class="border border-white/20 p-3 bg-[#111] space-y-2">
                                            <div class="overflow-hidden aspect-[3/2] bg-white/5">
                                                <img src="https://images.unsplash.com/photo-1519741497674-611481863552?auto=format&fit=crop&w=800&q=80" alt="Film 1" class="w-full h-full object-cover" />
                                            </div>
                                            <div class="flex justify-between text-[9px] font-mono text-white/40">
                                                <span>FRAME #01</span>
                                                <span>f/1.8 1/500s</span>
                                            </div>
                                        </div>
                                        <div class="border border-white/20 p-3 bg-[#111] space-y-2">
                                            <div class="overflow-hidden aspect-[3/2] bg-white/5">
                                                <img src="https://images.unsplash.com/photo-1511285560929-80b456fea0bc?auto=format&fit=crop&w=800&q=80" alt="Film 2" class="w-full h-full object-cover" />
                                            </div>
                                            <div class="flex justify-between text-[9px] font-mono text-white/40">
                                                <span>FRAME #02</span>
                                                <span>f/1.8 1/500s</span>
                                            </div>
                                        </div>
                                        <div class="border border-white/20 p-3 bg-[#111] space-y-2">
                                            <div class="overflow-hidden aspect-[3/2] bg-white/5">
                                                <img src="https://images.unsplash.com/photo-1522673607200-164d1b6ce486?auto=format&fit=crop&w=800&q=80" alt="Film 3" class="w-full h-full object-cover" />
                                            </div>
                                            <div class="flex justify-between text-[9px] font-mono text-white/40">
                                                <span>FRAME #03</span>
                                                <span>f/2.0 1/320s</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `
                    },
                    {
                        id: 'grid-polaroid-gallery',
                        label: '🏷️ Polaroid Style Card Grid',
                        category: 'Gallery Grids',
                        content: `
                            <div class="max-w-[1400px] mx-auto px-6 py-12 bg-[#f9f8f6]">
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                                    <div class="bg-white p-4 shadow-md rounded-sm transform -rotate-1 hover:rotate-0 transition-transform duration-300">
                                        <div class="overflow-hidden bg-black/5 aspect-[4/5] mb-3">
                                            <img src="https://images.unsplash.com/photo-1519741497674-611481863552?auto=format&fit=crop&w=800&q=80" alt="Polaroid 1" class="w-full h-full object-cover" />
                                        </div>
                                        <p class="font-display text-center text-sm text-black/70 italic">The First Glance · 2026</p>
                                    </div>
                                    <div class="bg-white p-4 shadow-md rounded-sm transform rotate-1 hover:rotate-0 transition-transform duration-300">
                                        <div class="overflow-hidden bg-black/5 aspect-[4/5] mb-3">
                                            <img src="https://images.unsplash.com/photo-1511285560929-80b456fea0bc?auto=format&fit=crop&w=800&q=80" alt="Polaroid 2" class="w-full h-full object-cover" />
                                        </div>
                                        <p class="font-display text-center text-sm text-black/70 italic">Eternal Vows · Cappadocia</p>
                                    </div>
                                    <div class="bg-white p-4 shadow-md rounded-sm transform -rotate-2 hover:rotate-0 transition-transform duration-300">
                                        <div class="overflow-hidden bg-black/5 aspect-[4/5] mb-3">
                                            <img src="https://images.unsplash.com/photo-1522673607200-164d1b6ce486?auto=format&fit=crop&w=800&q=80" alt="Polaroid 3" class="w-full h-full object-cover" />
                                        </div>
                                        <p class="font-display text-center text-sm text-black/70 italic">Golden Hour Magic</p>
                                    </div>
                                </div>
                            </div>
                        `
                    },

                    // BASIC ELEMENTS
                    {
                        id: 'text-block',
                        label: '✏️ Text Paragraph',
                        category: 'Basic Elements',
                        content: '<div class="max-w-4xl mx-auto px-6 py-4"><p class="text-base text-[#171717]/80 leading-relaxed font-light">Tuliskan deskripsi atau narasi tambahan di sini...</p></div>'
                    },
                    {
                        id: 'image-caption',
                        label: '📸 Single Photo with Caption',
                        category: 'Basic Elements',
                        content: `
                            <div class="max-w-4xl mx-auto px-6 py-8">
                                <div class="overflow-hidden rounded-sm bg-black/5 aspect-[3/2] shadow-sm mb-3">
                                    <img src="https://images.unsplash.com/photo-1511285560929-80b456fea0bc?auto=format&fit=crop&w=1400&q=84" alt="Photo" class="w-full h-full object-cover" />
                                </div>
                                <p class="text-xs text-center text-[#817a72] italic">Tuliskan keterangan foto / caption di sini...</p>
                            </div>
                        `
                    }
                ]
            }
        });

        // Add custom component traits for iframe / YouTube video links
        editor.Components.addType('iframe', {
            isComponent: el => el && el.tagName === 'IFRAME',
            model: {
                defaults: {
                    traits: [
                        {
                            type: 'text',
                            name: 'src',
                            label: 'Link Embed YouTube (src)',
                            changeProp: 1
                        },
                        {
                            type: 'text',
                            name: 'title',
                            label: 'Judul Video'
                        }
                    ]
                }
            }
        });

        // Load initial content if present
        if (initialContent && initialContent.trim() !== '') {
            editor.setComponents(initialContent);
        }

        // Save handler
        document.getElementById('btn-save-content').addEventListener('click', () => {
            const html = editor.getHtml();
            const css = editor.getCss();
            const fullContent = (css && css.trim() !== '') ? `<style>${css}</style>${html}` : html;

            @this.saveContent(fullContent);
        });
    });

    // Device Switcher logic
    function setDevice(device) {
        if (!editor) return;

        const btnDesktop = document.getElementById('device-desktop');
        const btnTablet = document.getElementById('device-tablet');
        const btnMobile = document.getElementById('device-mobile');

        [btnDesktop, btnTablet, btnMobile].forEach(btn => {
            btn.style.background = 'transparent';
            btn.style.color = '#9ca3af';
        });

        const iframe = document.querySelector('#gjs iframe');
        if (!iframe) return;

        if (device === 'Desktop') {
            iframe.style.width = '100%';
            btnDesktop.style.background = '#374151';
            btnDesktop.style.color = '#fff';
        } else if (device === 'Tablet') {
            iframe.style.width = '768px';
            iframe.style.margin = '0 auto';
            btnTablet.style.background = '#374151';
            btnTablet.style.color = '#fff';
        } else if (device === 'Mobile') {
            iframe.style.width = '375px';
            iframe.style.margin = '0 auto';
            btnMobile.style.background = '#374151';
            btnMobile.style.color = '#fff';
        }
    }

    // Toast Notification Listener
    let toastTimer = null;
    window.addEventListener('notify', (event) => {
        const message = event.detail.message || (Array.isArray(event.detail) ? event.detail[0]?.message : '');
        const toast = document.getElementById('livewire-toast');
        const msgEl = document.getElementById('livewire-toast-message');
        if (!toast || !msgEl) return;

        clearTimeout(toastTimer);
        msgEl.textContent = message;
        toast.style.opacity = '1';
        toast.style.transform = 'translateY(0)';

        toastTimer = setTimeout(() => {
            toast.style.opacity = '0';
            toast.style.transform = 'translateY(8px)';
        }, 3000);
    });
</script>
