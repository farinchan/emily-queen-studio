<div>
    <x-slot:description>Kelola koneksi akun Instagram Professional, sinkronisasi postingan, dan visibilitas galeri feed.</x-slot:description>

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

    {{-- Session Flash Alerts --}}
    @if (session('success'))
        <div class="alert alert--success mb-4 p-4 rounded-lg flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert--danger mb-4 p-4 rounded-lg flex items-center gap-2" style="background: #fef2f2; color: #991b1b; border: 1px solid #fecaca;">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
            <span>{{ session('error') }}</span>
        </div>
    @endif

    @if (!$account || !$account->isConnected())
        {{-- DISCONNECTED STATE --}}
        <section class="page__section">
            <div class="card p-8 text-center max-w-2xl mx-auto">
                <div class="flex justify-center mb-4 text-primary">
                    <div class="p-4 rounded-full bg-primary/10">
                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>
                    </div>
                </div>
                <h2 class="text-xl font-bold mb-2">Hubungkan Akun Instagram Professional</h2>
                <p class="text-sm text-muted-foreground mb-6 leading-relaxed">
                    Integrasikan akun Instagram Business atau Creator Anda untuk menampilkan postingan galeri foto, video, dan reels secara otomatis di website tanpa memperlambat loading halaman.
                </p>
                <div class="flex justify-center gap-3">
                    <a href="{{ route('admin.instagram.connect') }}" class="button button--primary flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M15 3h6v6"></path><path d="M10 14L21 3"></path><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path></svg>
                        Hubungkan Instagram
                    </a>
                </div>
            </div>
        </section>
    @else
        {{-- CONNECTED STATE --}}
        <section class="page__section space-y-6">
            {{-- Connected Account Overview Card --}}
            <div class="card p-6">
                <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
                    <div class="flex items-center gap-4">
                        @if ($account->profile_picture_url)
                            <img src="{{ $account->profile_picture_url }}" alt="{{ $account->username }}"
                                style="width: 72px; height: 72px; border-radius: 50%; object-fit: cover; border: 3px solid var(--color-primary, #2563eb);" />
                        @else
                            <div style="width: 72px; height: 72px; border-radius: 50%; background: #e5e7eb; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; font-weight: bold; color: #4b5563;">
                                {{ strtoupper(substr($account->username ?: 'IG', 0, 2)) }}
                            </div>
                        @endif
                        <div>
                            <div class="flex items-center gap-2">
                                <h2 class="text-xl font-bold">{{ $account->name ?: $account->username }}</h2>
                                <span class="badge badge--soft badge--primary text-xs">{{ $account->account_type ?: 'BUSINESS' }}</span>
                            </div>
                            <p class="text-sm text-primary font-medium mt-0.5">
                                <a href="https://instagram.com/{{ $account->username }}" target="_blank" class="hover:underline flex items-center gap-1">
                                    {{ '@' . $account->username }}
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path><polyline points="15 3 21 3 21 9"></polyline><line x1="10" y1="14" x2="21" y2="3"></line></svg>
                                </a>
                            </p>
                            <div class="text-xs text-muted-foreground mt-2 flex flex-wrap gap-x-4 gap-y-1">
                                <span>Terhubung: <strong>{{ $account->connected_at?->format('d M Y, H:i') ?: '—' }}</strong></span>
                                <span>Token Kadaluarsa: <strong>{{ $account->token_expires_at?->format('d M Y') ?: '—' }}</strong></span>
                            </div>
                        </div>
                    </div>

                    {{-- Actions --}}
                    <div class="flex flex-wrap items-center gap-2 w-full md:w-auto">
                        <a href="{{ route('instagram.feed') }}" target="_blank" class="button button--neutral button--sm">
                            Lihat Public Feed
                        </a>
                        
                        <form action="{{ route('admin.instagram.sync') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="button button--primary button--sm" @if($account->last_sync_status === 'running') disabled @endif>
                                @if($account->last_sync_status === 'running')
                                    Sinkronisasi...
                                @else
                                    Sinkronkan Postingan
                                @endif
                            </button>
                        </form>

                        <a href="{{ route('admin.instagram.connect') }}" class="button button--outline button--neutral button--sm">
                            Reconnect
                        </a>

                        <form action="{{ route('admin.instagram.disconnect') }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin memutuskan akun Instagram ini? Seluruh data postingan lokal akan dihapus.');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="button button--ghost button--danger button--sm">
                                Disconnect
                            </button>
                        </form>
                    </div>
                </div>

                {{-- Status Stats Bar --}}
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mt-6 pt-6 border-t border-border">
                    <div>
                        <span class="text-xs text-muted-foreground">Status Sinkronisasi</span>
                        <div class="mt-1">
                            @if ($account->last_sync_status === 'success')
                                <span class="badge badge--soft badge--success text-xs">Berhasil</span>
                            @elseif ($account->last_sync_status === 'running')
                                <span class="badge badge--soft badge--primary text-xs">Sedang Berjalan</span>
                            @elseif ($account->last_sync_status === 'failed')
                                <span class="badge badge--soft badge--danger text-xs">Gagal</span>
                            @else
                                <span class="badge badge--soft badge--neutral text-xs">Belum Pernah</span>
                            @endif
                        </div>
                    </div>
                    <div>
                        <span class="text-xs text-muted-foreground">Terakhir Disinkronkan</span>
                        <div class="text-sm font-semibold mt-1">
                            {{ $account->last_synced_at?->diffForHumans() ?: 'Belum pernah' }}
                        </div>
                    </div>
                    <div>
                        <span class="text-xs text-muted-foreground">Postingan di Instagram</span>
                        <div class="text-sm font-semibold mt-1">
                            {{ number_format($account->media_count ?: 0) }} Post
                        </div>
                    </div>
                    <div>
                        <span class="text-xs text-muted-foreground">Tersimpan di Database</span>
                        <div class="text-sm font-semibold mt-1">
                            {{ number_format($mediaItems->total() ?? count($mediaItems)) }} Post
                        </div>
                    </div>
                </div>

                @if ($account->last_sync_error)
                    <div class="mt-4 p-3 rounded bg-danger/10 text-danger text-xs">
                        <strong>Error Terakhir:</strong> {{ $account->last_sync_error }}
                    </div>
                @endif
            </div>

            {{-- Imported Media Grid & Visiblity Toggle Section --}}
            <div class="card">
                <div class="card__header flex items-center justify-between">
                    <span class="card__title">Daftar Postingan Terimpor (Instagram Media)</span>
                    <div class="w-64">
                        <input type="text" class="input input--sm" placeholder="Cari caption..." wire:model.live.debounce.300ms="search" />
                    </div>
                </div>
                <div class="card__body">
                    @if (count($mediaItems) > 0)
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                            @foreach ($mediaItems as $media)
                                <div class="card overflow-hidden border border-border flex flex-col justify-between" style="background: var(--card-bg, #fff);">
                                    <div class="relative">
                                        <img src="{{ $media->preview_url }}" alt="Media" class="w-full aspect-square object-cover" loading="lazy" />
                                        <span class="absolute top-2 right-2 badge badge--dark text-xs uppercase" style="background: rgba(0,0,0,0.7); color: #fff; padding: 2px 8px; border-radius: 4px;">
                                            {{ $media->media_type }}
                                        </span>
                                    </div>
                                    <div class="p-3 flex-1 flex flex-col justify-between space-y-2">
                                        <p class="text-xs text-foreground line-clamp-2 leading-relaxed">
                                            {{ $media->caption ?: '(Tanpa caption)' }}
                                        </p>
                                        <div class="flex items-center justify-between text-xs text-muted-foreground pt-2 border-t">
                                            <span>{{ $media->posted_at?->format('d M Y') }}</span>
                                            <a href="{{ $media->permalink }}" target="_blank" class="text-primary hover:underline flex items-center gap-1">
                                                Buka IG
                                                <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path><polyline points="15 3 21 3 21 9"></polyline><line x1="10" y1="14" x2="21" y2="3"></line></svg>
                                            </a>
                                        </div>
                                        <div class="pt-2 flex items-center justify-between">
                                            <span class="text-xs">Tampilkan:</span>
                                            <button type="button" wire:click="toggleVisibility({{ $media->id }})"
                                                class="button button--xs {{ $media->is_visible ? 'button--success' : 'button--neutral' }}">
                                                {{ $media->is_visible ? 'Tampil' : 'Sembunyi' }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-6">
                            {{ $mediaItems->links() }}
                        </div>
                    @else
                        <div class="p-8 text-center text-muted-foreground text-sm">
                            Belum ada postingan yang terimpor. Tekan tombol <strong>"Sinkronkan Postingan"</strong> untuk mengambil postingan terbaru dari Instagram.
                        </div>
                    @endif
                </div>
            </div>
        </section>
    @endif

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
