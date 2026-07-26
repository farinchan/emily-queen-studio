<div style="height: 100vh; display: flex; flex-direction: column;">
    {{-- Toast Notification (vanilla JS) --}}
    <div id="livewire-toast"
        style="position:fixed;bottom:1.5rem;right:1.5rem;z-index:99999;min-width:320px;opacity:0;transform:translateY(8px);transition:opacity .3s ease,transform .3s ease;pointer-events:none;">
        <div style="background: #10b981; color: white; padding: 12px 18px; border-radius: 8px; font-size: 14px; font-weight: 500; display: flex; align-items: center; gap: 10px; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.3);">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="9 11 12 14 22 4"></polyline></svg>
            <span id="livewire-toast-message"></span>
        </div>
    </div>

    {{-- Top Header Toolbar --}}
    <header style="height: 60px; background: #111827; border-bottom: 1px solid #374151; display: flex; align-items: center; justify-content: space-between; padding: 0 1.25rem; flex-shrink: 0;">
        <div style="display: flex; align-items: center; gap: 1rem;">
            <a href="{{ route('admin.photographies.index') }}"
                style="display: inline-flex; align-items: center; gap: 6px; color: #9ca3af; text-decoration: none; font-size: 13px; font-weight: 500; padding: 6px 12px; border-radius: 6px; background: #1f2937; transition: all .2s;"
                onmouseover="this.style.color='#fff'; this.style.background='#374151'"
                onmouseout="this.style.color='#9ca3af'; this.style.background='#1f2937'">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
                Kembali ke Daftar
            </a>
            <div style="height: 20px; width: 1px; background: #374151;"></div>
            <div>
                <h1 style="margin: 0; font-size: 14px; font-weight: 600; color: #f9fafb;">GrapesJS Page Builder</h1>
                <span style="font-size: 12px; color: #9ca3af;">{{ $photography->title }}</span>
            </div>
        </div>

        {{-- Device Viewports Switcher --}}
        <div style="display: flex; align-items: center; gap: 4px; background: #1f2937; padding: 4px; border-radius: 8px;">
            <button type="button" id="device-desktop"
                style="padding: 6px 12px; font-size: 12px; border: none; background: #374151; color: #fff; border-radius: 6px; cursor: pointer; display: flex; align-items: center; gap: 6px;"
                onclick="setDevice('Desktop')">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect><line x1="8" y1="21" x2="16" y2="21"></line><line x1="12" y1="17" x2="12" y2="21"></line></svg>
                Desktop
            </button>
            <button type="button" id="device-tablet"
                style="padding: 6px 12px; font-size: 12px; border: none; background: transparent; color: #9ca3af; border-radius: 6px; cursor: pointer; display: flex; align-items: center; gap: 6px;"
                onclick="setDevice('Tablet')">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="4" y="2" width="16" height="20" rx="2" ry="2"></rect><line x1="12" y1="18" x2="12.01" y2="18"></line></svg>
                Tablet
            </button>
            <button type="button" id="device-mobile"
                style="padding: 6px 12px; font-size: 12px; border: none; background: transparent; color: #9ca3af; border-radius: 6px; cursor: pointer; display: flex; align-items: center; gap: 6px;"
                onclick="setDevice('Mobile')">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="5" y="2" width="14" height="20" rx="2" ry="2"></rect><line x1="12" y1="18" x2="12.01" y2="18"></line></svg>
                Mobile
            </button>
        </div>

        {{-- Actions --}}
        <div style="display: flex; align-items: center; gap: 10px;">
            <button type="button" id="btn-save-content"
                style="display: inline-flex; align-items: center; gap: 8px; padding: 8px 20px; font-size: 13px; font-weight: 600; background: #2563eb; color: white; border: none; border-radius: 6px; cursor: pointer; transition: background .2s;"
                onmouseover="this.style.background='#1d4ed8'"
                onmouseout="this.style.background='#2563eb'">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg>
                Simpan Content
            </button>
        </div>
    </header>

    {{-- GrapesJS Editor Area --}}
    <div style="flex: 1; height: calc(100vh - 60px); width: 100%; position: relative;">
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

            // INJECT EXACT FRONT-END CSS & FONTS INTO CANVAS IFRAME
            canvas: {
                styles: [
                    'https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;1,400&family=Montserrat:wght@300;400;500;600&display=swap',
                    '{{ asset("assets/css/tailwind.css") }}',
                    '{{ asset("assets/css/styles.css") }}'
                ]
            },

            // Built-in Theme-tailored Blocks
            blockManager: {
                blocks: [
                    {
                        id: 'section-hero',
                        label: '✨ Hero Section',
                        category: 'Page Sections',
                        content: `
                            <section class="bg-white text-[#171717] py-20 px-6 sm:px-12 text-center border-b border-black/10">
                                <span class="text-[10px] uppercase tracking-[.3em] text-[#171717]/60 mb-4 block">Portfolio Collection</span>
                                <h1 class="font-display text-5xl sm:text-7xl font-normal leading-tight mb-6">${@json($photography->title)}</h1>
                                <p class="max-w-2xl mx-auto text-sm sm:text-base text-[#171717]/70 font-light leading-relaxed mb-8">${@json($photography->subtitle ?: 'Capture timeless vows and memorable moments forever.')}</p>
                                <a href="#gallery" class="inline-flex items-center gap-3 border-b border-black/40 pb-1 text-[11px] uppercase tracking-[.24em] font-medium hover:border-black transition-all">Jelajahi Galeri <span>→</span></a>
                            </section>
                        `
                    },
                    {
                        id: 'section-text-story',
                        label: '📖 Story Narration',
                        category: 'Page Sections',
                        content: `
                            <section class="bg-white text-[#171717] py-16 px-6 max-w-4xl mx-auto">
                                <h2 class="font-display text-3xl sm:text-4xl text-center mb-6">Sebuah Kisah Tentang Cinta & Keindahan</h2>
                                <p class="text-base text-[#171717]/80 leading-relaxed mb-6 font-light">Setiap momen memiliki jiwa dan emosi tersendiri. Melalui lensa kami, kami mengabadikan detik-detik berharga ini menjadi karya seni visual yang tak lekang oleh waktu.</p>
                                <blockquote class="border-l-2 border-[#171717]/30 pl-6 py-2 my-8 font-display italic text-2xl text-[#171717]/90">"Foto adalah puisi visual yang menangkap keabadian dalam selintas detik."</blockquote>
                            </section>
                        `
                    },
                    {
                        id: 'grid-2-col-photo',
                        label: '🖼️ 2 Photo Grid',
                        category: 'Gallery Grids',
                        content: `
                            <div class="max-w-[1400px] mx-auto px-6 py-12 grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div class="overflow-hidden rounded-sm bg-black/5 aspect-[4/5]">
                                    <img src="https://images.unsplash.com/photo-1519741497674-611481863552?auto=format&fit=crop&w=1200&q=80" alt="Photo 1" class="w-full h-full object-cover hover:scale-105 transition-transform duration-700" />
                                </div>
                                <div class="overflow-hidden rounded-sm bg-black/5 aspect-[4/5]">
                                    <img src="https://images.unsplash.com/photo-1522673607200-164d1b6ce486?auto=format&fit=crop&w=1200&q=80" alt="Photo 2" class="w-full h-full object-cover hover:scale-105 transition-transform duration-700" />
                                </div>
                            </div>
                        `
                    },
                    {
                        id: 'grid-3-col-photo',
                        label: '📷 3 Photo Grid',
                        category: 'Gallery Grids',
                        content: `
                            <div class="max-w-[1600px] mx-auto px-6 py-12 grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div class="overflow-hidden rounded-sm bg-black/5 aspect-[3/4]">
                                    <img src="https://images.unsplash.com/photo-1544078751-58fee2d8a03b?auto=format&fit=crop&w=800&q=80" alt="Photo 1" class="w-full h-full object-cover" />
                                </div>
                                <div class="overflow-hidden rounded-sm bg-black/5 aspect-[3/4]">
                                    <img src="https://images.unsplash.com/photo-1523438885200-e635ba2c371e?auto=format&fit=crop&w=800&q=80" alt="Photo 2" class="w-full h-full object-cover" />
                                </div>
                                <div class="overflow-hidden rounded-sm bg-black/5 aspect-[3/4]">
                                    <img src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=800&q=80" alt="Photo 3" class="w-full h-full object-cover" />
                                </div>
                            </div>
                        `
                    },
                    {
                        id: 'text-block',
                        label: '✏️ Text Paragraph',
                        category: 'Basic Elements',
                        content: '<p class="text-base text-[#171717]/80 leading-relaxed my-4 font-light">Tuliskan deskripsi atau narasi tambahan di sini...</p>'
                    },
                    {
                        id: 'cta-banner',
                        label: '📣 Call To Action',
                        category: 'Page Sections',
                        content: `
                            <section class="bg-[#171717] text-white py-20 px-6 text-center my-12">
                                <h3 class="font-display text-4xl sm:text-5xl mb-4">Ingin Mengabadikan Momen Anda?</h3>
                                <p class="text-white/70 max-w-lg mx-auto text-sm mb-8 font-light">Hubungi tim profesional kami untuk konsultasi dan reservasi jadwal pemotretan.</p>
                                <a href="mailto:info@emilyqueenstudio.com" class="inline-block bg-white text-[#171717] px-8 py-3 text-xs uppercase tracking-[.2em] font-medium hover:bg-white/90 transition-colors">Reservasi Sekarang</a>
                            </section>
                        `
                    }
                ]
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
