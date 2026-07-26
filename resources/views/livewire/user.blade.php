<x-slot:action>
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        <button type="button" class="button button--neutral">
            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" aria-hidden="true">
                <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                    stroke-width="1.5"
                    d="M3 15c0 2.828 0 4.243.879 5.121C4.757 21 6.172 21 9 21h6c2.828 0 4.243 0 5.121-.879C21 19.243 21 17.828 21 15M12 3v13m0 0l4-4.375M12 16l-4-4.375" />
            </svg>
            Export
        </button>
        <button type="button" class="button button--primary" data-stisla-drawer-trigger="drawerBasic"
            wire:click="openCreateModal">
            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"
                aria-hidden="true">
                <g fill="none" stroke="currentColor" stroke-width="1.5">
                    <circle cx="12" cy="12" r="10" />
                    <path stroke-linecap="round" d="M15 12h-3m0 0H9m3 0V9m0 3v3" />
                </g>
            </svg>
            Add user
        </button>
    </h2>
</x-slot:action>

<div>
    <section class="page__section">
        <div class="card" data-table-select>
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

            <div class="card__header card__header--alt flex-wrap" data-bulkbar hidden>
                <span><strong data-select-count>0</strong> selected</span>
                <div class="flex flex-wrap items-center gap-2 ms-auto">
                    <button type="button" class="button button--sm button--outline button--neutral">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"
                            aria-hidden="true">
                            <g fill="none" stroke="currentColor" stroke-width="1.5">
                                <path
                                    d="M2 12c0-3.771 0-5.657 1.172-6.828S6.229 4 10 4h4c3.771 0 5.657 0 6.828 1.172S22 8.229 22 12s0 5.657-1.172 6.828S17.771 20 14 20h-4c-3.771 0-5.657 0-6.828-1.172S2 15.771 2 12Z" />
                                <path stroke-linecap="round"
                                    d="m6 8l2.159 1.8c1.837 1.53 2.755 2.295 3.841 2.295s2.005-.765 3.841-2.296L18 8" />
                            </g>
                        </svg>
                        Email
                    </button>
                    <button type="button" class="button button--sm button--danger"
                        data-stisla-dialog-trigger="deleteConfirm">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"
                            aria-hidden="true">
                            <g fill="none" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round"
                                    d="M20.5 6h-17m15.333 2.5l-.46 6.9c-.177 2.654-.265 3.981-1.13 4.79s-2.196.81-4.856.81h-.774c-2.66 0-3.991 0-4.856-.81c-.865-.809-.954-2.136-1.13-4.79l-.46-6.9M9.5 11l.5 5m4.5-5l-.5 5" />
                                <path
                                    d="M6.5 6h.11a2 2 0 0 0 1.83-1.32l.034-.103l.097-.291c.083-.249.125-.373.18-.479a1.5 1.5 0 0 1 1.094-.788C9.962 3 10.093 3 10.355 3h3.29c.262 0 .393 0 .51.019a1.5 1.5 0 0 1 1.094.788c.055.106.097.23.18.479l.097.291A2 2 0 0 0 17.5 6" />
                            </g>
                        </svg>
                        Delete
                    </button>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table--hover table--align-middle">
                    <thead class="table__head--alt">
                        <tr>
                            <th scope="col">
                                <input class="checkbox" type="checkbox" data-select-all
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
                                    <input class="checkbox" type="checkbox" data-select-row
                                        aria-label="Select {{ $user->name }}" />
                                </td>
                                <th scope="row">
                                    <div class="flex items-center gap-3">
                                        <span class="avatar avatar--sm avatar--circle" data-stisla-avatar>
                                            @if ($user->image)
                                                @php
                                                    $img = $user->image;
                                                    $url = str_starts_with($img, 'http')
                                                        ? $img
                                                        : (str_starts_with($img, 'public/')
                                                            ? asset('storage/' . str_replace('public/', '', $img))
                                                            : asset('storage/' . $img));
                                                @endphp
                                                <img class="avatar__image" src="{{ $url }}" alt="{{ $user->name }}" />
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
                                            wire:confirm="Are you sure you want to delete {{ $user->name }}?"
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

    <div class="drawer drawer--floating" id="drawerBasic" data-stisla-drawer aria-labelledby="drawerBasicLabel">
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
                                <span class="text-xs text-muted-foreground ms-1">(leave blank to keep current)</span>
                            @endif
                        </label>
                        <input type="password" class="input" wire:model="password" placeholder="Password" />
                        @if (!$userId)
                            <div class="field__description">At least 8 characters.</div>
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
                        <label class="field__label">Foto</label>
                        <input type="file" class="input" wire:model="image" accept="image/*" />
                        @error('image')
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
                        wire:target="saveUser" wire:loading.attr="disabled">
                        <span wire:loading.remove wire:target="saveUser">
                            {{ $userId ? 'Simpan Perubahan' : 'Simpan' }}
                        </span>
                        <span wire:loading wire:target="saveUser">Menyimpan...</span>
                    </button>
                </div>
            </div>
        </form>
    </div>

</div>
