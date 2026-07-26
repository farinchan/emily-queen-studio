<div>
    <x-slot:description>Kelola konfigurasi umum website, identitas SEO, lokasi, dan media sosial.</x-slot:description>

    {{-- Toast Notification Container (vanilla JS) --}}
    <div id="livewire-toast"
        style="position:fixed;bottom:1.5rem;right:1.5rem;z-index:9999;min-width:320px;opacity:0;transform:translateY(8px);transition:opacity .3s ease,transform .3s ease;pointer-events:none;">
        <div class="alert alert--success">
            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" aria-hidden="true">
                <g fill="none" stroke="currentColor" stroke-width="1.5">
                    <circle cx="12" cy="12" r="10" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="m8.5 12.5l2 2l5-5" />
                </g>
            </svg>
            <span id="livewire-toast-message"></span>
        </div>
    </div>

    <form wire:submit="save">
        <div class="space-y-6">

            {{-- Card 1: Identitas & SEO Website --}}
            <div class="card">
                <div class="card__header">
                    <span class="card__title">Identitas & SEO Website</span>
                </div>
                <div class="card__body space-y-4">
                    <div class="field mb-4">
                        <label class="field__label">Nama Website (Site Name) *</label>
                        <input type="text" class="input" wire:model="site_name" placeholder="e.g. Emily Queen Studio" />
                        @error('site_name')
                            <div class="field__error mt-1" style="color: #ef4444; font-size: 13px;">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        {{-- Site Logo --}}
                        <div class="field">
                            <label class="field__label">Logo Utama Website (Site Logo)</label>
                            <div class="flex items-center gap-3">
                                @if ($site_logo && !is_string($site_logo))
                                    <img src="{{ $site_logo->temporaryUrl() }}" alt="Preview Logo"
                                        style="max-height: 48px; object-fit: contain; border-radius: 6px; border: 1px solid var(--color-border); padding: 4px;" />
                                @elseif ($existing_site_logo)
                                    <img src="{{ asset('storage/' . $existing_site_logo) }}" alt="Logo"
                                        style="max-height: 48px; object-fit: contain; border-radius: 6px; border: 1px solid var(--color-border); padding: 4px;" />
                                @else
                                    <div style="height: 48px; width: 48px; border-radius: 6px; background: #f3f4f6; display: flex; align-items: center; justify-content: center; font-size: 11px; color: #6b7280;">
                                        Logo
                                    </div>
                                @endif
                                <input type="file" class="input flex-1" wire:model="site_logo" accept="image/*" />
                            </div>
                            <div class="field__description">Maksimal 8MB. Format: PNG, SVG, JPG, WEBP.</div>
                            @error('site_logo')
                                <div class="field__error mt-1" style="color: #ef4444; font-size: 13px;">{{ $message }}</div>
                            @enderror
                            <div wire:loading wire:target="site_logo" class="text-xs text-primary mt-1">
                                Mengupload logo...
                            </div>
                        </div>

                        {{-- Site Favicon --}}
                        <div class="field">
                            <label class="field__label">Favicon Website (Site Favicon)</label>
                            <div class="flex items-center gap-3">
                                @if ($site_favicon && !is_string($site_favicon))
                                    <img src="{{ $site_favicon->temporaryUrl() }}" alt="Preview Favicon"
                                        style="width: 36px; height: 36px; object-fit: contain; border-radius: 6px; border: 1px solid var(--color-border);" />
                                @elseif ($existing_site_favicon)
                                    <img src="{{ asset('storage/' . $existing_site_favicon) }}" alt="Favicon"
                                        style="width: 36px; height: 36px; object-fit: contain; border-radius: 6px; border: 1px solid var(--color-border);" />
                                @else
                                    <div style="width: 36px; height: 36px; border-radius: 6px; background: #f3f4f6; display: flex; align-items: center; justify-content: center; font-size: 11px; color: #6b7280;">
                                        Icon
                                    </div>
                                @endif
                                <input type="file" class="input flex-1" wire:model="site_favicon" accept="image/*" />
                            </div>
                            <div class="field__description">Maksimal 2MB. Format: ICO, PNG, SVG.</div>
                            @error('site_favicon')
                                <div class="field__error mt-1" style="color: #ef4444; font-size: 13px;">{{ $message }}</div>
                            @enderror
                            <div wire:loading wire:target="site_favicon" class="text-xs text-primary mt-1">
                                Mengupload favicon...
                            </div>
                        </div>
                    </div>

                    {{-- Site Description --}}
                    <div class="field">
                        <label class="field__label">Deskripsi Website (Site Description)</label>
                        <textarea class="textarea" rows="3" wire:model="site_description" placeholder="Deskripsi singkat website untuk SEO dan meta tag..."></textarea>
                        @error('site_description')
                            <div class="field__error mt-1" style="color: #ef4444; font-size: 13px;">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Site Keyword --}}
                    <div class="field">
                        <label class="field__label">Kata Kunci SEO (Site Keywords)</label>
                        <input type="text" class="input" wire:model="site_keyword" placeholder="e.g. photography, studio, wedding, prewedding, jakarta" />
                        <div class="field__description">Pisahkan kata kunci dengan tanda koma (,).</div>
                        @error('site_keyword')
                            <div class="field__error mt-1" style="color: #ef4444; font-size: 13px;">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- Card 2: Alamat & Peta Lokasi --}}
            <div class="card mt-4">
                <div class="card__header">
                    <span class="card__title">Alamat & Peta Lokasi</span>
                </div>
                <div class="card__body space-y-4">
                    {{-- Address --}}
                    <div class="field">
                        <label class="field__label">Alamat Lengkap (Address)</label>
                        <textarea class="textarea" rows="3" wire:model="address" placeholder="e.g. Jl. Jend. Sudirman No. 123, Jakarta Selatan"></textarea>
                        @error('address')
                            <div class="field__error mt-1" style="color: #ef4444; font-size: 13px;">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Maps Embed --}}
                    <div class="field">
                        <label class="field__label">Google Maps Embed HTML / Link</label>
                        <textarea class="textarea font-mono text-xs" rows="3" wire:model="maps_embed" placeholder='<iframe src="https://www.google.com/maps/embed?pb=..." width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>'></textarea>
                        <div class="field__description">Paste kode &lt;iframe&gt; Google Maps atau URL lokasi studio.</div>
                        @error('maps_embed')
                            <div class="field__error mt-1" style="color: #ef4444; font-size: 13px;">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- Card 3: Media Sosial & WhatsApp --}}
            <div class="card mt-4">
                <div class="card__header">
                    <span class="card__title">Media Sosial & WhatsApp</span>
                </div>
                <div class="card__body space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        {{-- Instagram --}}
                        <div class="field">
                            <label class="field__label">Instagram</label>
                            <input type="text" class="input" wire:model="instagram" placeholder="e.g. https://instagram.com/emilyqueenstudio" />
                            @error('instagram')
                                <div class="field__error mt-1" style="color: #ef4444; font-size: 13px;">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Facebook --}}
                        <div class="field">
                            <label class="field__label">Facebook</label>
                            <input type="text" class="input" wire:model="facebook" placeholder="e.g. https://facebook.com/emilyqueenstudio" />
                            @error('facebook')
                                <div class="field__error mt-1" style="color: #ef4444; font-size: 13px;">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        {{-- YouTube --}}
                        <div class="field">
                            <label class="field__label">YouTube</label>
                            <input type="text" class="input" wire:model="youtube" placeholder="e.g. https://youtube.com/@emilyqueenstudio" />
                            @error('youtube')
                                <div class="field__error mt-1" style="color: #ef4444; font-size: 13px;">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- WhatsApp --}}
                        <div class="field">
                            <label class="field__label">Nomor WhatsApp</label>
                            <input type="text" class="input" wire:model="whatsapp" placeholder="e.g. 6281234567890" />
                            <div class="field__description">Gunakan format internasional tanpa tanda + (contoh: 6281234567890).</div>
                            @error('whatsapp')
                                <div class="field__error mt-1" style="color: #ef4444; font-size: 13px;">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            {{-- Submit Footer Button --}}
            <div class="flex justify-end pt-2 pb-6">
                <button type="submit" class="button button--primary" wire:target="save, site_favicon" wire:loading.attr="disabled">
                    <span wire:loading.remove wire:target="save">Simpan Pengaturan</span>
                    <span wire:loading wire:target="save">Menyimpan...</span>
                </button>
            </div>

        </div>
    </form>

    {{-- Toast Notification (vanilla JS) --}}
    @script
    <script>
        let toastTimer = null;
        $wire.on('notify', (params) => {
            const message = params.message || (Array.isArray(params) ? params[0]?.message : '');
            const toast = document.getElementById('livewire-toast');
            const msgEl = document.getElementById('livewire-toast-message');
            if (!toast || !msgEl) return;

            clearTimeout(toastTimer);
            msgEl.textContent = message;
            toast.style.opacity = '1';
            toast.style.transform = 'translateY(0)';
            toast.style.pointerEvents = 'auto';

            toastTimer = setTimeout(() => {
                toast.style.opacity = '0';
                toast.style.transform = 'translateY(8px)';
                toast.style.pointerEvents = 'none';
            }, 3000);
        });
    </script>
    @endscript
</div>
