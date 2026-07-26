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
        <button type="button" class="button button--primary" data-stisla-drawer-trigger="drawerBasic">
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
                    <button type="button" class="toggle" role="radio" aria-checked="true" data-state="active">
                        All
                    </button>

                    <button type="button" class="toggle" role="radio" aria-checked="false">
                        Active
                    </button>

                    <button type="button" class="toggle" role="radio" aria-checked="false">
                        New
                    </button>

                    <button type="button" class="toggle" role="radio" aria-checked="false">
                        VIP
                    </button>

                    <button type="button" class="toggle" role="radio" aria-checked="false">
                        Churned
                    </button>
                </div>
                <form class="input-group ms-auto w-full md:w-60 mb-4 md:mb-0" role="search">
                    <span class="input-group__text"><svg xmlns="http://www.w3.org/2000/svg" width="1em"
                            height="1em" viewBox="0 0 24 24" aria-hidden="true">
                            <g fill="none" stroke="currentColor" stroke-width="1.5">
                                <circle cx="11.5" cy="11.5" r="9.5" />
                                <path stroke-linecap="round" d="M18.5 18.5L22 22" />
                            </g>
                        </svg></span>
                    <input type="search" name="q" class="input" placeholder="Search customers…"
                        aria-label="Search customers" />
                </form>
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
                                    aria-label="Select all customers on this page" />
                            </th>
                            <th scope="col"><a class="table__sort" href="#">Pengguna</a></th>
                            <th scope="col">
                                <a class="table__sort" href="#">Posisi</a>
                            </th>
                            <th scope="col" class="text-end">
                                <a class="table__sort" href="#">Order</a>
                            </th>
                            <th scope="col" class="text-end">
                                <a class="table__sort" href="#">Instagram</a>
                            </th>
                            <th scope="col"><a class="table__sort" href="#">Show</a></th>
                            <th scope="col" class="text-end"><span class="sr-only">Actions</span></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <input class="checkbox" type="checkbox" data-select-row
                                    aria-label="Select Acme Corp" />
                            </td>
                            <th scope="row">
                                <div class="flex items-center gap-3">
                                    <span class="avatar avatar--sm avatar--circle" data-stisla-avatar>
                                        <img class="avatar__image" src="https://i.pravatar.cc/64?img=12"
                                            alt="" />
                                        <span class="avatar__fallback">AC</span>
                                    </span>
                                    <div>
                                        <a href="/meridian/profile.html" class="font-medium">Acme Corp</a>
                                        <div class="text-xs text-muted-foreground">billing@acme.co</div>
                                    </div>
                                </div>
                            </th>
                            <td>San Diego, US</td>
                            <td class="text-end">14</td>
                            <td class="text-end"><span class="font-semibold">$24,910</span></td>
                            <td><span class="badge badge--soft badge--primary">VIP</span></td>
                            <td class="text-end">
                                <div class="flex justify-end gap-1">
                                    <a href="mailto:billing@acme.co"
                                        class="button button--ghost button--neutral button--icon-only button--sm"
                                        aria-label="Email Acme Corp"><svg xmlns="http://www.w3.org/2000/svg"
                                            width="1em" height="1em" viewBox="0 0 24 24" aria-hidden="true">
                                            <g fill="none" stroke="currentColor" stroke-width="1.5">
                                                <path
                                                    d="M2 12c0-3.771 0-5.657 1.172-6.828S6.229 4 10 4h4c3.771 0 5.657 0 6.828 1.172S22 8.229 22 12s0 5.657-1.172 6.828S17.771 20 14 20h-4c-3.771 0-5.657 0-6.828-1.172S2 15.771 2 12Z" />
                                                <path stroke-linecap="round"
                                                    d="m6 8l2.159 1.8c1.837 1.53 2.755 2.295 3.841 2.295s2.005-.765 3.841-2.296L18 8" />
                                            </g>
                                        </svg></a>
                                    <button type="button"
                                        class="button button--ghost button--danger button--icon-only button--sm"
                                        data-stisla-dialog-trigger="deleteCustomer" data-fill-name="Acme Corp"
                                        aria-label="Delete Acme Corp">
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

                    </tbody>
                </table>
            </div>

            <div class="card__footer">
                <span class="text-xs text-muted-foreground">Showing 1–10 of 10</span>
                <nav class="ms-auto" aria-label="Customers pages">
                    <ul class="pagination">
                        <li>
                            <span class="pagination__button" aria-disabled="true" aria-label="Previous"><svg
                                    xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                                    viewBox="0 0 24 24" aria-hidden="true">
                                    <path fill="none" stroke="currentColor" stroke-linecap="round"
                                        stroke-linejoin="round" stroke-width="1.5" d="m15 5l-6 7l6 7" />
                                </svg></span>
                        </li>
                        <li>
                            <a class="pagination__button" href="?page=1" data-state="active"
                                aria-current="page">1</a>
                        </li>
                        <li>
                            <span class="pagination__button" aria-disabled="true" aria-label="Next"><svg
                                    xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                                    viewBox="0 0 24 24" aria-hidden="true">
                                    <path fill="none" stroke="currentColor" stroke-linecap="round"
                                        stroke-linejoin="round" stroke-width="1.5" d="m9 5l6 7l-6 7" />
                                </svg></span>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </section>

    <div class="drawer drawer--floating" id="drawerBasic" data-stisla-drawer aria-labelledby="drawerBasicLabel">
        <div class="drawer__backdrop" data-stisla-drawer-dismiss></div>
        <form action="" wire:submit="saveUser">
            <div class="drawer__content">
                <div class="drawer__header">
                    <h2 class="drawer__title" id="drawerBasicLabel">New task</h2>
                    <button type="button" class="drawer__close" data-stisla-drawer-dismiss aria-label="Close"><i
                            data-lucide="x"></i></button>
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
                        <label class="field__label">Password</label>
                        <input type="password" class="input" wire:model="password" placeholder="Password" />
                        <div class="field__description">At least 8 characters, one number.</div>
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

                </div>
                <div class="drawer__footer">
                    <button type="button" class="button button--ghost button--neutral" data-stisla-drawer-dismiss
                        wire:click="closeModal">Cancel</button>
                    <button type="submit" class="button button--primary" data-stisla-drawer-dismiss
                        wire:target="saveUser" wire:loading.attr="aria-busy='true'">Simpan</button>
                </div>
            </div>
        </form>
    </div>

</div>
