<x-slot:description>Kelola gambar slider dan banner promosi pada halaman utama.</x-slot:description>

<x-slot:action>
    <div class="flex items-center gap-2">
        <button type="button" class="button button--primary" data-stisla-drawer-trigger="drawerBasic"
            wire:click="openCreateModal">
            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"
                aria-hidden="true">
                <g fill="none" stroke="currentColor" stroke-width="1.5">
                    <circle cx="12" cy="12" r="10" />
                    <path stroke-linecap="round" d="M15 12h-3m0 0H9m3 0V9m0 3v3" />
                </g>
            </svg>
            Tambah Banner
        </button>
    </div>
</x-slot:action>

<div>
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

    <section class="page__section">
        <div class="card">
            {{-- Search Header --}}
            <div class="card__header flex-wrap">
                <div class="input-group ms-auto w-full md:w-60 mb-4 md:mb-0" role="search">
                    <span class="input-group__text"><svg xmlns="http://www.w3.org/2000/svg" width="1em"
                            height="1em" viewBox="0 0 24 24" aria-hidden="true">
                            <g fill="none" stroke="currentColor" stroke-width="1.5">
                                <circle cx="11.5" cy="11.5" r="9.5" />
                                <path stroke-linecap="round" d="M18.5 18.5L22 22" />
                            </g>
                        </svg></span>
                    <input type="search" wire:model.live.debounce.300ms="search" class="input"
                        placeholder="Search title, label, subtitle…"
                        aria-label="Search banners" />
                </div>
            </div>

            {{-- Bulk Action Bar --}}
            @if (count($selectedBanners) > 0)
                <div class="card__header card__header--alt flex-wrap">
                    <span><strong>{{ count($selectedBanners) }}</strong> selected</span>
                    <div class="flex flex-wrap items-center gap-2 ms-auto">
                        <button type="button" class="button button--sm button--outline button--neutral"
                            wire:click="$set('selectedBanners', []); $set('selectAll', false)">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"
                                aria-hidden="true">
                                <path fill="none" stroke="currentColor" stroke-linecap="round"
                                    stroke-linejoin="round" stroke-width="1.5"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            Batal
                        </button>
                        <button type="button" class="button button--sm button--danger"
                            wire:click="deleteSelected"
                            wire:confirm="Apakah Anda yakin ingin menghapus {{ count($selectedBanners) }} banner yang dipilih?">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"
                                aria-hidden="true">
                                <g fill="none" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round"
                                        d="M20.5 6h-17m15.333 2.5l-.46 6.9c-.177 2.654-.265 3.981-1.13 4.79s-2.196.81-4.856.81h-.774c-2.66 0-3.991 0-4.856-.81c-.865-.809-.954-2.136-1.13-4.79l-.46-6.9M9.5 11l.5 5m4.5-5l-.5 5" />
                                    <path
                                        d="M6.5 6h.11a2 2 0 0 0 1.83-1.32l.034-.103l.097-.291c.083-.249.125-.373.18-.479a1.5 1.5 0 0 1 1.094-.788C9.962 3 10.093 3 10.355 3h3.29c.262 0 .393 0 .51.019a1.5 1.5 0 0 1 1.094.788c.055.106.097.23.18.479l.097.291A2 2 0 0 0 17.5 6" />
                                </g>
                            </svg>
                            Hapus ({{ count($selectedBanners) }})
                        </button>
                    </div>
                </div>
            @endif

            {{-- Table --}}
            <div class="table-responsive">
                <table class="table table--hover table--align-middle">
                    <thead class="table__head--alt">
                        <tr>
                            <th scope="col">
                                <input class="checkbox" type="checkbox"
                                    wire:model.live="selectAll"
                                    aria-label="Select all banners on this page" />
                            </th>
                            <th scope="col">Banner</th>
                            <th scope="col">Label</th>
                            <th scope="col">Subtitle</th>
                            <th scope="col">Link</th>
                            <th scope="col" class="text-end"><span class="sr-only">Actions</span></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($banners as $banner)
                            <tr wire:key="banner-{{ $banner->id }}">
                                <td>
                                    <input class="checkbox" type="checkbox"
                                        wire:model.live="selectedBanners"
                                        value="{{ $banner->id }}"
                                        aria-label="Select {{ $banner->title }}" />
                                </td>
                                <th scope="row">
                                    <div class="flex items-center gap-3">
                                        <div style="width: 72px; height: 48px; flex-shrink: 0; border-radius: 6px; overflow: hidden; background: #f3f4f6;">
                                            @if ($banner->image)
                                                <img src="{{ $banner->image }}" alt="{{ $banner->title }}" style="width: 100%; height: 100%; object-fit: cover;" />
                                            @endif
                                        </div>
                                        <div>
                                            <span class="font-medium">{{ $banner->title }}</span>
                                        </div>
                                    </div>
                                </th>
                                <td>{{ $banner->label ?? '—' }}</td>
                                <td>{{ $banner->subtitle ?? '—' }}</td>
                                <td>
                                    @if ($banner->link)
                                        <a href="{{ $banner->link }}" target="_blank" class="text-sm text-primary">
                                            {{ $banner->link }}
                                        </a>
                                    @else
                                        <span class="text-muted-foreground">—</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <div class="flex justify-end gap-1">
                                        <button type="button" wire:click="openEditModal({{ $banner->id }})"
                                            data-stisla-drawer-trigger="drawerBasic"
                                            class="button button--ghost button--neutral button--icon-only button--sm"
                                            aria-label="Edit {{ $banner->title }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                                                viewBox="0 0 24 24" aria-hidden="true">
                                                <g fill="none" stroke="currentColor" stroke-width="1.5">
                                                    <path stroke-linecap="round"
                                                        d="M15.214 5.667l3.04-3.04a1 1 0 0 1 1.414 0l1.706 1.706a1 1 0 0 1 0 1.414l-3.04 3.04M15.214 5.667L5.667 15.214m0 0L4 19l3.786-1.667m0 0a1 1 0 0 0 1.213-.213l11.428-11.428a1 1 0 0 0 0-1.414l-2.025-2.025a1 1 0 0 0-1.414 0L6.36 14.782a1 1 0 0 0-.213 1.213z" />
                                                </g>
                                            </svg>
                                        </button>
                                        <button type="button" wire:click="deleteBanner({{ $banner->id }})"
                                            wire:confirm="Apakah Anda yakin ingin menghapus banner {{ $banner->title }}?"
                                            class="button button--ghost button--danger button--icon-only button--sm"
                                            aria-label="Delete {{ $banner->title }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                                                viewBox="0 0 24 24" aria-hidden="true">
                                                <g fill="none" stroke="currentColor" stroke-width="1.5">
                                                    <path stroke-linecap="round"
                                                        d="M20.5 6h-17m15.333 2.5l-.46 6.9c-.177 2.654-.265 3.981-1.13 4.79s-2.196.81-4.856.81h-.774c-2.66 0-3.991 0-4.856-.81c-.865-.809-.954-2.136-1.13-4.79l-.46-6.9M9.5 11l.5 5m4.5-5l-.5 5" />
                                                    <path
                                                        d="M6.5 6h.11a2 2 0 0 0 1.83-1.32l.034-.103l.097-.291c.083-.249.125-.373.18-.479a1.5 1.5 0 0 1 1.094-.788C9.962 3 10.093 3 10.355 3h3.29c.262 0 .393 0 .51.019a1.5 1.5 0 0 1 1.094.788c.055.106.097.23.18.479l.097.291A2 2 0 0 0 17.5 6" />
                                                </g>
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-12">
                                    <div class="text-muted-foreground">
                                        <h3 class="font-semibold text-base mb-1">No banners found</h3>
                                        <p class="text-sm">Try adjusting your search or add a new banner to get started.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Footer / Pagination --}}
            <div class="card__footer">
                <span class="text-xs text-muted-foreground">
                    @if ($banners->total() > 0)
                        Showing {{ $banners->firstItem() }}–{{ $banners->lastItem() }} of {{ $banners->total() }}
                        @if ($search)
                            <span class="ms-1">(filtered)</span>
                        @endif
                    @else
                        Showing 0 banners
                    @endif
                </span>
                @if ($banners->hasPages())
                    <nav class="ms-auto" aria-label="Banners pages">
                        {{ $banners->links() }}
                    </nav>
                @endif
            </div>
        </div>
    </section>

    {{-- Drawer Form (Create / Edit) --}}
    <div class="drawer drawer--floating" id="drawerBasic" data-stisla-drawer aria-labelledby="drawerBasicLabel" wire:ignore.self>
        <div class="drawer__backdrop" data-stisla-drawer-dismiss></div>
        <form action="" wire:submit="saveBanner">
            <div class="drawer__content">
                <div class="drawer__header">
                    <h2 class="drawer__title" id="drawerBasicLabel">
                        {{ $bannerId ? 'Edit Banner' : 'New Banner' }}
                    </h2>
                    <button type="button" class="drawer__close" data-stisla-drawer-dismiss aria-label="Close"
                        wire:click="closeModal"><i data-lucide="x"></i></button>
                </div>
                <div class="drawer__body">
                    {{-- Image Preview --}}
                    <div class="field mb-4">
                        <label class="field__label">Gambar Banner {{ $bannerId ? '' : '*' }}</label>
                        @if ($image && !is_string($image))
                            <div class="mb-2">
                                <img src="{{ $image->temporaryUrl() }}"
                                    alt="Preview"
                                    style="width: 100%; max-height: 160px; object-fit: cover; border-radius: 8px;" />
                                <p class="text-xs text-muted-foreground mt-1">Preview gambar baru</p>
                            </div>
                        @elseif ($existingImage)
                            <div class="mb-2">
                                @php
                                    $previewUrl = (str_starts_with($existingImage, 'http://') || str_starts_with($existingImage, 'https://'))
                                        ? $existingImage
                                        : asset('storage/' . $existingImage);
                                @endphp
                                <img src="{{ $previewUrl }}"
                                    alt="Current banner"
                                    style="width: 100%; max-height: 160px; object-fit: cover; border-radius: 8px;" />
                                <p class="text-xs text-muted-foreground mt-1">Gambar saat ini</p>
                            </div>
                        @endif
                        <input type="file" class="input" wire:model="image" accept="image/*" />
                        <div class="field__description">Maks 8MB. Format: JPG, PNG, GIF, WEBP.</div>
                        @error('image')
                            <div class="field__error">{{ $message }}</div>
                        @enderror
                        {{-- Upload progress --}}
                        <div wire:loading wire:target="image" class="text-xs text-primary mt-1">
                            Mengupload gambar...
                        </div>
                    </div>

                    <div class="field mb-4">
                        <label class="field__label">Judul (Title) *</label>
                        <input type="text" class="input" wire:model="title" placeholder="e.g. Side by Side" />
                        @error('title')
                            <div class="field__error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="field mb-4">
                        <label class="field__label">Label</label>
                        <input type="text" class="input" wire:model="label" placeholder="e.g. Prewedding · Cappadocia" />
                        @error('label')
                            <div class="field__error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="field mb-4">
                        <label class="field__label">Subtitle</label>
                        <input type="text" class="input" wire:model="subtitle" placeholder="e.g. Sebastian & Linda · A celebration filled with grace" />
                        @error('subtitle')
                            <div class="field__error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="field mb-4">
                        <label class="field__label">Link</label>
                        <input type="text" class="input" wire:model="link" placeholder="e.g. /collections/summer-sale" />
                        @error('link')
                            <div class="field__error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="drawer__footer">
                    <button type="button" class="button button--ghost button--neutral" data-stisla-drawer-dismiss
                        wire:click="closeModal">Cancel</button>
                    <button type="submit" class="button button--primary"
                        wire:target="saveBanner, image" wire:loading.attr="disabled">
                        <span wire:loading.remove wire:target="saveBanner">
                            {{ $bannerId ? 'Simpan Perubahan' : 'Simpan' }}
                        </span>
                        <span wire:loading wire:target="saveBanner">Menyimpan...</span>
                    </button>
                </div>
            </div>
        </form>
    </div>

    {{-- Scripts: drawer close + toast notification (vanilla JS) --}}
    @script
    <script>
        // Auto-close drawer after save
        $wire.on('close-drawer', () => {
            const backdrop = document.querySelector('#drawerBasic [data-stisla-drawer-dismiss]');
            if (backdrop) backdrop.click();
        });

        // Toast notification
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
