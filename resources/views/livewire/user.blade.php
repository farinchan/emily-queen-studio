<x-slot:description>Kelola akun pengguna, peran, dan hak akses sistem.</x-slot:description>

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
            Tambah User
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
            {{-- Filter & Search Header --}}
            <div class="card__header flex-wrap">
                <div class="toggle-group mt-4 md:mt-0" data-stisla-toggle-group role="radiogroup"
                    aria-label="Filter by status">
                    <button type="button" wire:click="$set('filterStatus', 'all')" class="toggle" role="radio"
                        aria-checked="{{ $filterStatus === 'all' ? 'true' : 'false' }}"
                        data-state="{{ $filterStatus === 'all' ? 'active' : '' }}">
                        All
                    </button>

                    <button type="button" wire:click="$set('filterStatus', 'active')" class="toggle" role="radio"
                        aria-checked="{{ $filterStatus === 'active' ? 'true' : 'false' }}"
                        data-state="{{ $filterStatus === 'active' ? 'active' : '' }}">
                        Active
                    </button>

                    <button type="button" wire:click="$set('filterStatus', 'inactive')" class="toggle" role="radio"
                        aria-checked="{{ $filterStatus === 'inactive' ? 'true' : 'false' }}"
                        data-state="{{ $filterStatus === 'inactive' ? 'active' : '' }}">
                        Inactive
                    </button>
                </div>
                <div class="input-group ms-auto w-full md:w-60 mb-4 md:mb-0" role="search">
                    <span class="input-group__text"><svg xmlns="http://www.w3.org/2000/svg" width="1em"
                            height="1em" viewBox="0 0 24 24" aria-hidden="true">
                            <g fill="none" stroke="currentColor" stroke-width="1.5">
                                <circle cx="11.5" cy="11.5" r="9.5" />
                                <path stroke-linecap="round" d="M18.5 18.5L22 22" />
                            </g>
                        </svg></span>
                    <input type="search" wire:model.live.debounce.300ms="search" class="input"
                        placeholder="Search by name, email, or position…"
                        aria-label="Search users" />
                </div>
            </div>

            {{-- Bulk Action Bar --}}
            @if (count($selectedUsers) > 0)
                <div class="card__header card__header--alt flex-wrap">
                    <span><strong>{{ count($selectedUsers) }}</strong> selected</span>
                    <div class="flex flex-wrap items-center gap-2 ms-auto">
                        <button type="button" class="button button--sm button--outline button--neutral"
                            wire:click="$set('selectedUsers', []); $set('selectAll', false)">
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
                            wire:confirm="Apakah Anda yakin ingin menghapus {{ count($selectedUsers) }} user yang dipilih?">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"
                                aria-hidden="true">
                                <g fill="none" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round"
                                        d="M20.5 6h-17m15.333 2.5l-.46 6.9c-.177 2.654-.265 3.981-1.13 4.79s-2.196.81-4.856.81h-.774c-2.66 0-3.991 0-4.856-.81c-.865-.809-.954-2.136-1.13-4.79l-.46-6.9M9.5 11l.5 5m4.5-5l-.5 5" />
                                    <path
                                        d="M6.5 6h.11a2 2 0 0 0 1.83-1.32l.034-.103l.097-.291c.083-.249.125-.373.18-.479a1.5 1.5 0 0 1 1.094-.788C9.962 3 10.093 3 10.355 3h3.29c.262 0 .393 0 .51.019a1.5 1.5 0 0 1 1.094.788c.055.106.097.23.18.479l.097.291A2 2 0 0 0 17.5 6" />
                                </g>
                            </svg>
                            Hapus ({{ count($selectedUsers) }})
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
                                    aria-label="Select all users on this page" />
                            </th>
                            <th scope="col">Pengguna</th>
                            <th scope="col">Posisi</th>
                            <th scope="col" class="text-end">Order</th>
                            <th scope="col">Instagram</th>
                            <th scope="col">Show</th>
                            <th scope="col" class="text-end"><span class="sr-only">Actions</span></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr wire:key="user-{{ $user->id }}">
                                <td>
                                    <input class="checkbox" type="checkbox"
                                        wire:model.live="selectedUsers"
                                        value="{{ $user->id }}"
                                        aria-label="Select {{ $user->name }}" />
                                </td>
                                <th scope="row">
                                    <div class="flex items-center gap-3">
                                        <span class="avatar avatar--sm avatar--circle" data-stisla-avatar>
                                            @if ($user->image)
                                                <img class="avatar__image" src="{{ asset('storage/' . $user->image) }}" alt="{{ $user->name }}" />
                                            @endif
                                            <span
                                                class="avatar__fallback">{{ strtoupper(substr($user->name, 0, 2)) }}</span>
                                        </span>
                                        <div>
                                            <span class="font-medium">{{ $user->name }}</span>
                                            <div class="text-xs text-muted-foreground">{{ $user->email }}</div>
                                        </div>
                                    </div>
                                </th>
                                <td>{{ $user->position ?? '—' }}</td>
                                <td class="text-end">{{ $user->order ?? '—' }}</td>
                                <td>
                                    @if ($user->instagram)
                                        <a href="https://instagram.com/{{ ltrim($user->instagram, '@') }}"
                                            target="_blank" class="text-sm text-primary">
                                            {{ '@' . ltrim($user->instagram, '@') }}
                                        </a>
                                    @else
                                        <span class="text-muted-foreground">—</span>
                                    @endif
                                </td>
                                <td>
                                    <button type="button" wire:click="toggleShow({{ $user->id }})"
                                        class="badge {{ $user->is_show ? 'badge--soft badge--success' : 'badge--soft badge--neutral' }}"
                                        aria-label="Toggle visibility">
                                        {{ $user->is_show ? 'Active' : 'Inactive' }}
                                    </button>
                                </td>
                                <td class="text-end">
                                    <div class="flex justify-end gap-1">
                                        <button type="button" wire:click="openEditModal({{ $user->id }})"
                                            data-stisla-drawer-trigger="drawerBasic"
                                            class="button button--ghost button--neutral button--icon-only button--sm"
                                            aria-label="Edit {{ $user->name }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                                                viewBox="0 0 24 24" aria-hidden="true">
                                                <g fill="none" stroke="currentColor" stroke-width="1.5">
                                                    <path stroke-linecap="round"
                                                        d="M15.214 5.667l3.04-3.04a1 1 0 0 1 1.414 0l1.706 1.706a1 1 0 0 1 0 1.414l-3.04 3.04M15.214 5.667L5.667 15.214m0 0L4 19l3.786-1.667m0 0a1 1 0 0 0 1.213-.213l11.428-11.428a1 1 0 0 0 0-1.414l-2.025-2.025a1 1 0 0 0-1.414 0L6.36 14.782a1 1 0 0 0-.213 1.213z" />
                                                </g>
                                            </svg>
                                        </button>
                                        <button type="button" wire:click="deleteUser({{ $user->id }})"
                                            wire:confirm="Apakah Anda yakin ingin menghapus {{ $user->name }}?"
                                            class="button button--ghost button--danger button--icon-only button--sm"
                                            aria-label="Delete {{ $user->name }}">
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
                                <td colspan="7" class="text-center py-12">
                                    <div class="text-muted-foreground">

                                        <h3 class="font-semibold text-base mb-1">No users found</h3>
                                        <p class="text-sm">Try adjusting your search or filters, or add a new user to get started.</p>
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
                    @if ($users->total() > 0)
                        Showing {{ $users->firstItem() }}–{{ $users->lastItem() }} of {{ $users->total() }}
                        @if ($search || $filterStatus !== 'all')
                            <span class="ms-1">(filtered)</span>
                        @endif
                    @else
                        Showing 0 users
                    @endif
                </span>
                @if ($users->hasPages())
                    <nav class="ms-auto" aria-label="Users pages">
                        {{ $users->links() }}
                    </nav>
                @endif
            </div>
        </div>
    </section>

    {{-- Drawer Form (Create / Edit) --}}
    <div class="drawer drawer--floating" id="drawerBasic" data-stisla-drawer aria-labelledby="drawerBasicLabel" wire:ignore.self>
        <div class="drawer__backdrop" data-stisla-drawer-dismiss></div>
        <form action="" wire:submit="saveUser">
            <div class="drawer__content">
                <div class="drawer__header">
                    <h2 class="drawer__title" id="drawerBasicLabel">
                        {{ $userId ? 'Edit User' : 'New User' }}
                    </h2>
                    <button type="button" class="drawer__close" data-stisla-drawer-dismiss aria-label="Close"
                        wire:click="closeModal"><i data-lucide="x"></i></button>
                </div>
                <div class="drawer__body">
                    {{-- Image Preview --}}
                    <div class="field mb-4">
                        <label class="field__label">Foto</label>
                        @if ($image && !is_string($image))
                            <div class="mb-2">
                                <img src="{{ $image->temporaryUrl() }}"
                                    alt="Preview"
                                    style="width: 80px; height: 80px; object-fit: cover; border-radius: 50%;" />
                                <p class="text-xs text-muted-foreground mt-1">Preview foto baru</p>
                            </div>
                        @elseif ($existingImage)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $existingImage) }}"
                                    alt="Current image"
                                    style="width: 80px; height: 80px; object-fit: cover; border-radius: 50%;" />
                                <p class="text-xs text-muted-foreground mt-1">Foto saat ini</p>
                            </div>
                        @endif
                        <input type="file" class="input" wire:model="image" accept="image/*" />
                        <div class="field__description">Maks 8MB. Format: JPG, PNG, GIF, WEBP.</div>
                        @error('image')
                            <div class="field__error">{{ $message }}</div>
                        @enderror
                        {{-- Upload progress --}}
                        <div wire:loading wire:target="image" class="text-xs text-primary mt-1">
                            Mengupload foto...
                        </div>
                    </div>
                    <div class="field mb-4">
                        <label class="field__label">Nama</label>
                        <input type="text" class="input" wire:model="name" placeholder="Nama Pengguna" />
                        @error('name')
                            <div class="field__error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="field mb-4">
                        <label class="field__label">Email</label>
                        <input type="email" class="input" wire:model="email" placeholder="Email Pengguna" />
                        @error('email')
                            <div class="field__error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="field mb-4">
                        <label class="field__label">Password
                            @if ($userId)
                                <span class="text-xs text-muted-foreground ms-1">(kosongkan jika tidak ingin mengubah)</span>
                            @endif
                        </label>
                        <input type="password" class="input" wire:model="password" placeholder="Password" />
                        @if (!$userId)
                            <div class="field__description">Minimal 8 karakter.</div>
                        @endif
                        @error('password')
                            <div class="field__error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="field mb-4">
                        <label class="field__label">Posisi</label>
                        <input type="text" class="input" wire:model="position" placeholder="Posisi Pengguna" />
                        @error('position')
                            <div class="field__error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="field mb-4">
                        <label class="field__label">Order</label>
                        <input type="number" class="input" wire:model="order" placeholder="Urutan tampil (0, 1, 2, ...)" min="0" />
                        <div class="field__description">Nomor urut untuk posisi tampil di halaman publik.</div>
                        @error('order')
                            <div class="field__error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="field mb-4">
                        <label class="field__label">Instagram</label>
                        <div class="input-group max-w-sm">
                            <span class="input-group__text"><i data-lucide="at-sign"></i></span>
                            <input type="text" class="input" wire:model="instagram"
                                placeholder="Instagram Pengguna" />
                        </div>
                        @error('instagram')
                            <div class="field__error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="field mb-4">
                        <label class="field__label">Tentang</label>
                        <textarea class="textarea" id="taskDesc" rows="4" wire:model="about"
                            placeholder="Ceritakan tentang pengguna..."></textarea>
                        @error('about')
                            <div class="field__error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="field mb-4">
                        <label class="flex items-center gap-2">
                            <input type="checkbox" wire:model="is_show" class="checkbox" />
                            <span>Tampilkan di public site</span>
                        </label>
                    </div>
                </div>
                <div class="drawer__footer">
                    <button type="button" class="button button--ghost button--neutral" data-stisla-drawer-dismiss
                        wire:click="closeModal">Cancel</button>
                    <button type="submit" class="button button--primary"
                        wire:target="saveUser, image" wire:loading.attr="disabled">
                        <span wire:loading.remove wire:target="saveUser">
                            {{ $userId ? 'Simpan Perubahan' : 'Simpan' }}
                        </span>
                        <span wire:loading wire:target="saveUser">Menyimpan...</span>
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
