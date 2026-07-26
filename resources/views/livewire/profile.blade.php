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

    {{-- Top Profile Header Banner Card --}}
    <section class="page__section">
        <div class="card">
            <img class="card__image aspect-[4/1] object-cover"
                src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=1600&h=400&q=80"
                alt="Cover Header" loading="lazy" />
            <div class="card__body">
                <div class="flex flex-wrap items-end gap-3 -mt-14">
                    <span class="avatar avatar--circle" data-stisla-avatar
                        style="--avatar-size: 6rem; box-shadow: 0 0 0 4px var(--color-surface)">
                        @if ($existingImage)
                            <img class="avatar__image" src="{{ asset('storage/' . $existingImage) }}" alt="{{ $name }}" />
                        @endif
                        <span class="avatar__fallback">{{ strtoupper(substr($name ?: 'AD', 0, 2)) }}</span>
                    </span>
                    <div class="flex-auto min-w-0">
                        <h1 class="text-xl font-bold">{{ $name }}</h1>
                        <div class="text-muted-foreground">{{ $position ?: 'Administrator' }} · Emily Queen Studio</div>
                    </div>
                    <div class="flex gap-2">
                        <button type="button" class="button button--outline button--neutral" data-stisla-drawer-trigger="drawerPassword">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" aria-hidden="true">
                                <g fill="none" stroke="currentColor" stroke-width="1.5">
                                    <path d="M2 16c0-2.828 0-4.243.879-5.121C3.757 10 5.172 10 8 10h8c2.828 0 4.243 0 5.121.879C22 11.757 22 13.172 22 16s0 4.243-.879 5.121C20.243 22 18.828 22 16 22H8c-2.828 0-4.243 0-5.121-.879C2 20.243 2 18.828 2 16Z" />
                                    <circle cx="12" cy="16" r="2" />
                                    <path stroke-linecap="round" d="M6 10V8a6 6 0 1 1 12 0v2" />
                                </g>
                            </svg>
                            Ubah password
                        </button>
                        <button type="button" class="button button--neutral" data-stisla-drawer-trigger="drawerProfile">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"
                                aria-hidden="true">
                                <path fill="none" stroke="currentColor" stroke-width="1.5"
                                    d="m14.36 4.079l.927-.927a3.932 3.932 0 0 1 5.561 5.561l-.927.927m-5.56-5.561s.115 1.97 1.853 3.707C17.952 9.524 19.92 9.64 19.92 9.64m-5.56-5.561l-8.522 8.52c-.577.578-.866.867-1.114 1.185a6.6 6.6 0 0 0-.749 1.211c-.173.364-.302.752-.56 1.526l-1.094 3.281m17.6-10.162L11.4 18.16c-.577.577-.866.866-1.184 1.114a6.6 6.6 0 0 1-1.211.749c-.364.173-.751.302-1.526.56l-3.281 1.094m0 0l-.802.268a1.06 1.06 0 0 1-1.342-1.342l.268-.802m1.876 1.876l-1.876-1.876" />
                            </svg>
                            Edit profile
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Main Grid Section --}}
    <section class="page__section">
        <div class="grid grid-cols-12 gap-4">

            {{-- Left Column --}}
            <div class="col-span-12 lg:col-span-4">
                <div class="flex flex-col gap-3">
                    {{-- About Card --}}
                    <div class="card">
                        <div class="card__header"><span class="card__title">About</span></div>
                        <div class="card__body">
                            <p class="text-sm text-muted-foreground leading-relaxed">
                                {{ $about ?: 'Belum ada informasi bio / tentang pengguna.' }}
                            </p>
                        </div>
                    </div>

                    {{-- Details Card --}}
                    <div class="card">
                        <div class="card__header"><span class="card__title">Details</span></div>
                        <ul class="list-group">
                            <li class="list-group__item">
                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"
                                    aria-hidden="true">
                                    <g fill="none" stroke="currentColor" stroke-width="1.5">
                                        <path
                                            d="M2 12c0-3.771 0-5.657 1.172-6.828S6.229 4 10 4h4c3.771 0 5.657 0 6.828 1.172S22 8.229 22 12s0 5.657-1.172 6.828S17.771 20 14 20h-4c-3.771 0-5.657 0-6.828-1.172S2 15.771 2 12Z" />
                                        <path stroke-linecap="round"
                                            d="m6 8l2.159 1.8c1.837 1.53 2.755 2.295 3.841 2.295s2.005-.765 3.841-2.296L18 8" />
                                    </g>
                                </svg>
                                <span>Email</span>
                                <span class="ms-auto text-muted-foreground">{{ $email }}</span>
                            </li>
                            <li class="list-group__item">
                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"
                                    aria-hidden="true">
                                    <g fill="none" stroke="currentColor" stroke-width="1.5">
                                        <circle cx="12" cy="6" r="4" />
                                        <path d="M20 17.5c0 2.485 0 4.5-8 4.5s-8-2.015-8-4.5S7.582 13 12 13s8 2.015 8 4.5Z" />
                                    </g>
                                </svg>
                                <span>Posisi</span>
                                <span class="ms-auto text-muted-foreground">{{ $position ?: '—' }}</span>
                            </li>
                            @if ($instagram)
                                <li class="list-group__item">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"
                                        aria-hidden="true">
                                        <g fill="none" stroke="currentColor" stroke-width="1.5">
                                            <rect x="2" y="2" width="20" height="20" rx="5" ry="5" />
                                            <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z" />
                                        </g>
                                    </svg>
                                    <span>Instagram</span>
                                    <span class="ms-auto text-muted-foreground">{{ '@' . ltrim($instagram, '@') }}</span>
                                </li>
                            @endif
                            <li class="list-group__item">
                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"
                                    aria-hidden="true">
                                    <g fill="none">
                                        <path stroke="currentColor" stroke-width="1.5"
                                            d="M2 12c0-3.771 0-5.657 1.172-6.828S6.229 4 10 4h4c3.771 0 5.657 0 6.828 1.172S22 8.229 22 12v2c0 3.771 0 5.657-1.172 6.828S17.771 22 14 22h-4c-3.771 0-5.657 0-6.828-1.172S2 17.771 2 14z" />
                                        <path stroke="currentColor" stroke-linecap="round" stroke-width="1.5"
                                            d="M7 4V2.5M17 4V2.5M2.5 9h19" />
                                    </g>
                                </svg>
                                <span>Terdaftar</span>
                                <span class="ms-auto text-muted-foreground">{{ auth()->user()->created_at?->format('M Y') ?? 'Jan 2026' }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            {{-- Right Column --}}
            <div class="col-span-12 lg:col-span-8 space-y-4">

                {{-- Active Login Sessions Card --}}
                <div class="card h-full">
                    <div class="card__header flex items-center justify-between">
                        <div>
                            <span class="card__title">Sesi Login Perangkat (Active Login Sessions)</span>
                            <div class="text-xs text-muted-foreground mt-0.5">Daftar perangkat yang terhubung ke akun Anda.</div>
                        </div>
                        @if (count($sessions) > 1)
                            <button type="button" wire:click="confirmLogout" class="button button--outline button--danger button--sm">
                                Keluar dari Sesi Lain
                            </button>
                        @endif
                    </div>
                    <div class="card__body p-0">
                        @if (count($sessions) > 0)
                            <div class="divide-y divide-border">
                                @foreach ($sessions as $session)
                                    <div class="p-4 flex items-center justify-between gap-4">
                                        <div class="flex items-center gap-3">
                                            <div class="p-2 rounded-lg bg-muted text-foreground">
                                                @if ($session->is_desktop)
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect><line x1="8" y1="21" x2="16" y2="21"></line><line x1="12" y1="17" x2="12" y2="21"></line></svg>
                                                @else
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="5" y="2" width="14" height="20" rx="2" ry="2"></rect><line x1="12" y1="18" x2="12.01" y2="18"></line></svg>
                                                @endif
                                            </div>
                                            <div>
                                                <div class="flex items-center gap-2 font-medium text-sm">
                                                    <span>{{ $session->platform }} — {{ $session->browser }}</span>
                                                    @if ($session->is_current_device)
                                                        <span class="badge badge--soft badge--success text-xs">Perangkat Ini</span>
                                                    @endif
                                                </div>
                                                <div class="text-xs text-muted-foreground mt-0.5">
                                                    <span>IP: {{ $session->ip_address }}</span>
                                                    <span class="mx-1">•</span>
                                                    <span>Terakhir aktif {{ $session->last_active }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <button type="button" wire:click="logoutSession('{{ $session->id }}')"
                                                wire:confirm="Apakah Anda yakin ingin mengeluarkan sesi login ini?"
                                                class="button button--ghost button--danger button--sm">
                                                Keluar
                                            </button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="p-6 text-center text-muted-foreground text-sm">
                                Tidak ada data sesi login perangkat.
                            </div>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- Drawer Edit Profile --}}
    <div class="drawer drawer--floating" id="drawerProfile" data-stisla-drawer aria-labelledby="drawerProfileLabel" wire:ignore.self>
        <div class="drawer__backdrop" data-stisla-drawer-dismiss></div>
        <form action="" wire:submit="updateProfile">
            <div class="drawer__content">
                <div class="drawer__header">
                    <h2 class="drawer__title" id="drawerProfileLabel">
                        Edit Profile
                    </h2>
                    <button type="button" class="drawer__close" data-stisla-drawer-dismiss aria-label="Close"><i data-lucide="x"></i></button>
                </div>
                <div class="drawer__body">
                    {{-- Photo Preview --}}
                    <div class="field mb-4">
                        <label class="field__label">Foto Profil</label>
                        @if ($image && !is_string($image))
                            <div class="mb-2">
                                <img src="{{ $image->temporaryUrl() }}" alt="Preview"
                                    style="width: 80px; height: 80px; object-fit: cover; border-radius: 50%;" />
                                <p class="text-xs text-muted-foreground mt-1">Preview foto baru</p>
                            </div>
                        @elseif ($existingImage)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $existingImage) }}" alt="{{ $name }}"
                                    style="width: 80px; height: 80px; object-fit: cover; border-radius: 50%;" />
                                <p class="text-xs text-muted-foreground mt-1">Foto saat ini</p>
                            </div>
                        @endif
                        <input type="file" class="input" wire:model="image" accept="image/*" />
                        <div class="field__description">Maks 8MB. Format: JPG, PNG, GIF, WEBP.</div>
                        @error('image')
                            <div class="field__error mt-1" style="color: #ef4444; font-size: 13px;">{{ $message }}</div>
                        @enderror
                        <div wire:loading wire:target="image" class="text-xs text-primary mt-1">
                            Mengupload foto...
                        </div>
                    </div>

                    <div class="field mb-4">
                        <label class="field__label">Nama Lengkap *</label>
                        <input type="text" class="input" wire:model="name" placeholder="Nama Anda" />
                        @error('name')
                            <div class="field__error mt-1" style="color: #ef4444; font-size: 13px;">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="field mb-4">
                        <label class="field__label">Alamat Email *</label>
                        <input type="email" class="input" wire:model="email" placeholder="email@domain.com" />
                        @error('email')
                            <div class="field__error mt-1" style="color: #ef4444; font-size: 13px;">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="field mb-4">
                        <label class="field__label">Posisi / Jabatan</label>
                        <input type="text" class="input" wire:model="position" placeholder="e.g. Store Owner" />
                        @error('position')
                            <div class="field__error mt-1" style="color: #ef4444; font-size: 13px;">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="field mb-4">
                        <label class="field__label">Instagram</label>
                        <input type="text" class="input" wire:model="instagram" placeholder="e.g. username" />
                        @error('instagram')
                            <div class="field__error mt-1" style="color: #ef4444; font-size: 13px;">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="field mb-4">
                        <label class="field__label">Bio / About</label>
                        <textarea class="textarea" rows="4" wire:model="about" placeholder="Ceritakan sedikit tentang Anda..."></textarea>
                        @error('about')
                            <div class="field__error mt-1" style="color: #ef4444; font-size: 13px;">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="drawer__footer">
                    <button type="button" class="button button--ghost button--neutral" data-stisla-drawer-dismiss>Cancel</button>
                    <button type="submit" class="button button--primary" wire:target="updateProfile, image" wire:loading.attr="disabled">
                        <span wire:loading.remove wire:target="updateProfile">Simpan Perubahan</span>
                        <span wire:loading wire:target="updateProfile">Menyimpan...</span>
                    </button>
                </div>
            </div>
        </form>
    </div>

    {{-- Drawer Ubah Password --}}
    <div class="drawer drawer--floating" id="drawerPassword" data-stisla-drawer aria-labelledby="drawerPasswordLabel" wire:ignore.self>
        <div class="drawer__backdrop" data-stisla-drawer-dismiss></div>
        <form action="" wire:submit="updatePassword">
            <div class="drawer__content">
                <div class="drawer__header">
                    <h2 class="drawer__title" id="drawerPasswordLabel">
                        Ubah Password
                    </h2>
                    <button type="button" class="drawer__close" data-stisla-drawer-dismiss aria-label="Close"><i data-lucide="x"></i></button>
                </div>
                <div class="drawer__body">
                    <div class="field mb-4">
                        <label class="field__label">Password Saat Ini *</label>
                        <input type="password" class="input" wire:model="current_password" placeholder="••••••••" />
                        @error('current_password')
                            <div class="field__error mt-1" style="color: #ef4444; font-size: 13px;">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="field mb-4">
                        <label class="field__label">Password Baru *</label>
                        <input type="password" class="input" wire:model="new_password" placeholder="••••••••" />
                        <div class="field__description">Minimal 8 karakter.</div>
                        @error('new_password')
                            <div class="field__error mt-1" style="color: #ef4444; font-size: 13px;">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="field mb-4">
                        <label class="field__label">Konfirmasi Password Baru *</label>
                        <input type="password" class="input" wire:model="new_password_confirmation" placeholder="••••••••" />
                    </div>
                </div>
                <div class="drawer__footer">
                    <button type="button" class="button button--ghost button--neutral" data-stisla-drawer-dismiss>Cancel</button>
                    <button type="submit" class="button button--primary" wire:target="updatePassword" wire:loading.attr="disabled">
                        <span wire:loading.remove wire:target="updatePassword">Ubah Password</span>
                        <span wire:loading wire:target="updatePassword">Proses...</span>
                    </button>
                </div>
            </div>
        </form>
    </div>

    {{-- Confirm Logout Other Devices Modal --}}
    @if ($confirmingLogout)
        <div style="position: fixed; inset: 0; z-index: 9999; background: rgba(0,0,0,0.5); display: flex; align-items: center; justify-content: center; padding: 1rem;">
            <div class="card max-w-md w-full p-6 shadow-xl" style="background: var(--card-bg, #ffffff);">
                <h3 class="text-lg font-semibold mb-2">Keluar dari Sesi Perangkat Lain</h3>
                <p class="text-xs text-muted-foreground mb-4">
                    Masukkan password Anda untuk mengonfirmasi bahwa Anda ingin mengeluarkan akun Anda dari semua sesi perangkat lain.
                </p>
                <form wire:submit="logoutOtherSessions">
                    <div class="field mb-4">
                        <label class="field__label">Password Anda</label>
                        <input type="password" class="input" wire:model="logout_password" placeholder="••••••••" autofocus />
                        @error('logout_password')
                            <div class="field__error mt-1" style="color: #ef4444; font-size: 13px;">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="flex justify-end gap-2">
                        <button type="button" wire:click="cancelLogout" class="button button--ghost button--neutral">
                            Batal
                        </button>
                        <button type="submit" class="button button--danger" wire:loading.attr="disabled">
                            <span wire:loading.remove wire:target="logoutOtherSessions">Konfirmasi Keluar Sesi Lain</span>
                            <span wire:loading wire:target="logoutOtherSessions">Memproses...</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    {{-- Scripts: drawer close + toast notification (vanilla JS) --}}
    @script
    <script>
        // Auto-close profile drawer after save
        $wire.on('close-drawer', () => {
            const backdrop = document.querySelector('#drawerProfile [data-stisla-drawer-dismiss]');
            if (backdrop) backdrop.click();
        });

        // Auto-close password drawer after save
        $wire.on('close-password-drawer', () => {
            const backdrop = document.querySelector('#drawerPassword [data-stisla-drawer-dismiss]');
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
