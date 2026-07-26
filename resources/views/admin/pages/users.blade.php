@extends('admin.app')

@section('page-action')
    <button type="button" class="button button--neutral">
        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" aria-hidden="true">
            <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                d="M3 15c0 2.828 0 4.243.879 5.121C4.757 21 6.172 21 9 21h6c2.828 0 4.243 0 5.121-.879C21 19.243 21 17.828 21 15M12 3v13m0 0l4-4.375M12 16l-4-4.375" />
        </svg>
        Export
    </button>
    <button type="button" class="button button--primary" data-stisla-drawer-trigger="addUser">
        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" aria-hidden="true">
            <g fill="none" stroke="currentColor" stroke-width="1.5">
                <circle cx="12" cy="12" r="10" />
                <path stroke-linecap="round" d="M15 12h-3m0 0H9m3 0V9m0 3v3" />
            </g>
        </svg>
        Add user
    </button>
@endsection

@section('content')

    <section class="page__section">
        <div class="card" data-table-select>
            <div class="card__header flex-wrap">
                <div class="toggle-group mt-4 md:mt-0" data-stisla-toggle-group role="radiogroup"
                    aria-label="Filter by show status">
                    <a href="{{ route('admin.users.index', array_merge(request()->except('status'), ['status' => 'all', 'page' => 1])) }}"
                        class="toggle" role="radio"
                        aria-checked="{{ ($filters['status'] ?? 'all') === 'all' ? 'true' : 'false' }}"
                        data-state="{{ ($filters['status'] ?? 'all') === 'all' ? 'active' : '' }}">
                        All
                    </a>
                    <a href="{{ route('admin.users.index', array_merge(request()->except('status'), ['status' => 'show', 'page' => 1])) }}"
                        class="toggle" role="radio"
                        aria-checked="{{ ($filters['status'] ?? '') === 'show' ? 'true' : 'false' }}"
                        data-state="{{ ($filters['status'] ?? '') === 'show' ? 'active' : '' }}">
                        Show
                    </a>
                    <a href="{{ route('admin.users.index', array_merge(request()->except('status'), ['status' => 'hide', 'page' => 1])) }}"
                        class="toggle" role="radio"
                        aria-checked="{{ ($filters['status'] ?? '') === 'hide' ? 'true' : 'false' }}"
                        data-state="{{ ($filters['status'] ?? '') === 'hide' ? 'active' : '' }}">
                        Hide
                    </a>
                </div>
                <form class="input-group ms-auto w-full md:w-60 mb-4 md:mb-0" role="search" method="GET"
                    action="{{ route('admin.users.index') }}">
                    @foreach (request()->except(['q', 'page']) as $key => $value)
                        <input type="hidden" name="{{ $key }}" value="{{ $value }}" />
                    @endforeach
                    <span class="input-group__text"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                            viewBox="0 0 24 24" aria-hidden="true">
                            <g fill="none" stroke="currentColor" stroke-width="1.5">
                                <circle cx="11.5" cy="11.5" r="9.5" />
                                <path stroke-linecap="round" d="M18.5 18.5L22 22" />
                            </g>
                        </svg></span>
                    <input type="search" name="q" class="input" placeholder="Search users…"
                        aria-label="Search users" value="{{ $filters['q'] ?? '' }}" />
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
                                    aria-label="Select all users on this page" />
                            </th>
                            <th scope="col">
                                @php $nextDir = ($filters['sort'] ?? '') === 'name' && ($filters['direction'] ?? '') === 'asc' ? 'desc' : 'asc'; @endphp
                                <a class="table__sort"
                                    href="{{ route('admin.users.index', array_merge(request()->except(['sort', 'direction', 'page']), ['sort' => 'name', 'direction' => $nextDir])) }}">
                                    User
                                </a>
                            </th>
                            <th scope="col">
                                @php $nextDir = ($filters['sort'] ?? '') === 'position' && ($filters['direction'] ?? '') === 'asc' ? 'desc' : 'asc'; @endphp
                                <a class="table__sort"
                                    href="{{ route('admin.users.index', array_merge(request()->except(['sort', 'direction', 'page']), ['sort' => 'position', 'direction' => $nextDir])) }}">
                                    Position
                                </a>
                            </th>
                            <th scope="col"><span class="text-muted-foreground">Roles</span></th>
                            <th scope="col"><span class="text-muted-foreground">Status</span></th>
                            <th scope="col" class="text-end"><span class="sr-only">Actions</span></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            @php
                                $initials = strtoupper(
                                    collect(explode(' ', trim($user->name)))
                                        ->map(fn($p) => mb_substr($p, 0, 1))
                                        ->take(2)
                                        ->implode(''),
                                );
                                $avatarUrl = $user->image ? asset('storage/' . $user->image) : null;
                            @endphp
                            <tr>
                                <td>
                                    <input class="checkbox" type="checkbox" data-select-row value="{{ $user->id }}"
                                        aria-label="Select {{ $user->name }}" />
                                </td>
                                <th scope="row">
                                    <div class="flex items-center gap-3">
                                        <span class="avatar avatar--sm avatar--circle" data-stisla-avatar>
                                            @if ($avatarUrl)
                                                <img class="avatar__image" src="{{ $avatarUrl }}" alt="" />
                                            @endif
                                            <span class="avatar__fallback">{{ $initials ?: '?' }}</span>
                                        </span>
                                        <div>
                                            <a href="#" class="font-medium">{{ $user->name }}</a>
                                            <div class="text-xs text-muted-foreground">{{ $user->email }}</div>
                                        </div>
                                    </div>
                                </th>
                                <td>
                                    <span class="text-sm">{{ $user->position ?? '—' }}</span>
                                </td>
                                <td>
                                    @php $userRoles = $user->roles; @endphp
                                    @if ($userRoles->isNotEmpty())
                                        <div class="flex flex-wrap gap-1">
                                            @foreach ($userRoles as $role)
                                                <span class="badge badge--soft badge--primary">{{ $role->name }}</span>
                                            @endforeach
                                        </div>
                                    @else
                                        <span class="text-xs text-muted-foreground">—</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($user->is_show)
                                        <span class="badge badge--soft badge--success">Show</span>
                                    @else
                                        <span class="badge badge--soft">Hide</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <div class="flex justify-end gap-1">
                                        <button type="button"
                                            class="button button--ghost button--neutral button--icon-only button--sm"
                                            data-stisla-drawer-trigger="editUser" data-user-id="{{ $user->id }}"
                                            data-user-name="{{ $user->name }}" data-user-email="{{ $user->email }}"
                                            data-user-position="{{ $user->position ?? '' }}"
                                            data-user-status="{{ $user->is_show ? '1' : '0' }}"
                                            data-user-roles='{{ $userRoles->pluck('name')->toJson() }}'
                                            data-user-order="{{ $user->order ?? '' }}"
                                            data-user-instagram="{{ $user->instagram ?? '' }}"
                                            data-user-about="{{ $user->about ?? '' }}"
                                            aria-label="Edit {{ $user->name }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                                                viewBox="0 0 24 24" aria-hidden="true">
                                                <path fill="none" stroke="currentColor" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15.25 11.75L16.5 10.5a2.28 2.28 0 0 0 0-3.236l-.514-.515a2.28 2.28 0 0 0-3.232 0L11.5 7.75m3.75 7.75l-1.25 1.25c-.88.88-2.684.93-3.806.204l-2.62-1.78a1.87 1.87 0 0 1-.707-1.507V11.5h2m-1.25 2.5h.01M2.75 18.5l.656-.515A1.5 1.5 0 0 1 4.552 18H19a1.5 1.5 0 0 0 1.448-1.108l.515-1.649A1.5 1.5 0 0 0 19.5 13.75H5.376a1.5 1.5 0 0 1-1.284-.72l-.515-.86a1.5 1.5 0 0 1 .234-1.758L12.04 4.708a5.04 5.04 0 0 1 5.942-.692l.046.026a5.04 5.04 0 0 1 2.572 3.52V9a1 1 0 0 1-1 1h-1.5" />
                                            </svg>
                                        </button>
                                        <a href="mailto:{{ $user->email }}"
                                            class="button button--ghost button--neutral button--icon-only button--sm"
                                            aria-label="Email {{ $user->name }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                                                viewBox="0 0 24 24" aria-hidden="true">
                                                <g fill="none" stroke="currentColor" stroke-width="1.5">
                                                    <path
                                                        d="M2 12c0-3.771 0-5.657 1.172-6.828S6.229 4 10 4h4c3.771 0 5.657 0 6.828 1.172S22 8.229 22 12s0 5.657-1.172 6.828S17.771 20 14 20h-4c-3.771 0-5.657 0-6.828-1.172S2 15.771 2 12Z" />
                                                    <path stroke-linecap="round"
                                                        d="m6 8l2.159 1.8c1.837 1.53 2.755 2.295 3.841 2.295s2.005-.765 3.841-2.296L18 8" />
                                                </g>
                                            </svg>
                                        </a>
                                        <button type="button"
                                            class="button button--ghost button--danger button--icon-only button--sm"
                                            data-stisla-dialog-trigger="deleteCustomer"
                                            data-fill-name="{{ $user->name }}" data-user-id="{{ $user->id }}"
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
                                <td colspan="6">
                                    <div class="empty-state py-8">
                                        <span class="empty-state__media"><svg xmlns="http://www.w3.org/2000/svg"
                                                width="1em" height="1em" viewBox="0 0 24 24" aria-hidden="true">
                                                <g fill="none" stroke="currentColor" stroke-width="1.5">
                                                    <circle cx="9.001" cy="6" r="4" />
                                                    <ellipse cx="9.001" cy="17.001" rx="7"
                                                        ry="4" />
                                                </g>
                                            </svg></span>
                                        <h3 class="empty-state__title">No users found</h3>
                                        <p class="empty-state__text">
                                            @if (!empty($filters['q']))
                                                No users match "{{ $filters['q'] }}". Try a different search.
                                            @else
                                                Add your first user to get started.
                                            @endif
                                        </p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($users->total() > 0)
                <div class="card__footer">
                    <span class="text-xs text-muted-foreground">
                        Showing {{ $users->firstItem() }}–{{ $users->lastItem() }} of {{ $users->total() }}
                    </span>
                    <nav class="ms-auto" aria-label="Users pages">
                        <ul class="pagination">
                            <li>
                                @if ($users->onFirstPage())
                                    <span class="pagination__button" aria-disabled="true" aria-label="Previous"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                                            viewBox="0 0 24 24" aria-hidden="true">
                                            <path fill="none" stroke="currentColor" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="1.5" d="m15 5l-6 7l6 7" />
                                        </svg></span>
                                @else
                                    <a class="pagination__button" href="{{ $users->previousPageUrl() }}"
                                        aria-label="Previous"><svg xmlns="http://www.w3.org/2000/svg" width="1em"
                                            height="1em" viewBox="0 0 24 24" aria-hidden="true">
                                            <path fill="none" stroke="currentColor" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="1.5" d="m15 5l-6 7l6 7" />
                                        </svg></a>
                                @endif
                            </li>
                            @foreach ($users->getUrlRange(1, $users->lastPage()) as $page => $url)
                                <li>
                                    <a class="pagination__button" href="{{ $url }}"
                                        data-state="{{ $page === $users->currentPage() ? 'active' : '' }}"
                                        aria-current="{{ $page === $users->currentPage() ? 'page' : '' }}">
                                        {{ $page }}
                                    </a>
                                </li>
                            @endforeach
                            <li>
                                @if ($users->hasMorePages())
                                    <a class="pagination__button" href="{{ $users->nextPageUrl() }}"
                                        aria-label="Next"><svg xmlns="http://www.w3.org/2000/svg" width="1em"
                                            height="1em" viewBox="0 0 24 24" aria-hidden="true">
                                            <path fill="none" stroke="currentColor" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="1.5" d="m9 5l6 7l-6 7" />
                                        </svg></a>
                                @else
                                    <span class="pagination__button" aria-disabled="true" aria-label="Next"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                                            viewBox="0 0 24 24" aria-hidden="true">
                                            <path fill="none" stroke="currentColor" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="1.5" d="m9 5l6 7l-6 7" />
                                        </svg></span>
                                @endif
                            </li>
                        </ul>
                    </nav>
                </div>
            @endif
        </div>
    </section>

    <div class="drawer" id="addUser" data-stisla-drawer aria-labelledby="addUserLabel">
        <form method="POST" action="{{ route('admin.users.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="drawer__backdrop" data-stisla-drawer-dismiss></div>
            <div class="drawer__content">
                <div class="drawer__header">
                    <h2 class="drawer__title" id="addUserLabel">Add user</h2>
                    <button type="button" class="drawer__close" data-stisla-drawer-dismiss aria-label="Close"><i
                            data-lucide="x"></i></button>
                </div>

                <div class="drawer__body">
                    <div class="field mb-4">
                        <label for="addImage" class="field__label">Image</label>
                        <input type="file" class="input" id="addImage" name="image" accept="image/*" value="{{ old('image') }}" />

                        @error('image')
                            <div class="field__error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="field mb-4">
                        <label for="addName" class="field__label">Name</label>
                        <input type="text" class="input" id="addName" name="name" placeholder="Full name"
                            required value="{{ old('name') }}" />
                        @error('name')
                            <div class="field__error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="field mb-4">
                        <label for="addEmail" class="field__label">Email</label>
                        <input type="email" class="input" id="addEmail" name="email"
                            placeholder="user@example.com" required value="{{ old('email') }}" />
                        @error('email')
                            <div class="field__error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="field mb-4">
                        <label for="addPassword" class="field__label">Password</label>
                        <input type="password" class="input" id="addPassword" name="password"
                            placeholder="Min. 8 characters" required />
                        @error('password')
                            <div class="field__error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="field mb-4">
                        <label for="addPasswordConfirmation" class="field__label">Confirm Password</label>
                        <input type="password" class="input" id="addPasswordConfirmation" name="password_confirmation"
                            placeholder="Repeat password" required />
                    </div>
                    <div class="field mb-4">
                        <label for="addPosition" class="field__label">Position</label>
                        <input type="text" class="input" id="addPosition" name="position"
                            placeholder="e.g. Manager" value="{{ old('position') }}" />
                    </div>
                    <div class="field mb-4">
                        <label for="addOrder" class="field__label">Order</label>
                        <input type="number" class="input" id="addOrder" name="order" placeholder="Sort order"
                            value="{{ old('order') }}" />
                    </div>
                    <div class="field mb-4">
                        <label for="addRole" class="field__label">Role</label>
                        <select class="input" id="addRole" name="roles[]" required>
                            <option value="">Select role</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->name }}"
                                    {{ in_array($role->name, (array) old('roles')) ? 'selected' : '' }}>
                                    {{ $role->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('roles')
                            <div class="field__error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="field mb-4">
                        <label for="addInstagram" class="field__label">Instagram</label>
                        <div class="input-group max-w-sm">
                            <span class="input-group__text"><i data-lucide="at-sign"></i></span>
                            <input type="text" class="input" id="addInstagram" name="instagram"
                                placeholder="fajri_chan" value="{{ old('instagram') }}" />
                        </div>
                    </div>
                    <div class="field mb-4">
                        <label for="addAbout" class="field__label">About</label>
                        <textarea class="textarea" id="addAbout" rows="3" name="about" placeholder="Brief description">{{ old('about') }}</textarea>
                    </div>
                    <div class="field mb-4">
                        <div class="field__item">
                            <input class="checkbox" type="checkbox" id="addIsShow" name="is_show" value="1"
                                {{ old('is_show', true) ? 'checked' : '' }} />
                            <label class="field__label" for="addIsShow">Show on website?</label>
                        </div>
                    </div>
                </div>
                <div class="drawer__footer">
                    <button type="button" class="button button--ghost button--neutral"
                        data-stisla-drawer-dismiss>Cancel</button>
                    <button type="submit" class="button button--primary">Create user</button>
                </div>

            </div>
        </form>
    </div>

    {{-- Edit User Drawer --}}
    <div class="drawer" id="editUser" data-stisla-drawer aria-labelledby="editUserLabel">
        <form method="POST" id="editForm" action="" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="drawer__backdrop" data-stisla-drawer-dismiss></div>
            <div class="drawer__content">
                <div class="drawer__header">
                    <h2 class="drawer__title" id="editUserLabel">Edit user</h2>
                    <button type="button" class="drawer__close" data-stisla-drawer-dismiss aria-label="Close"><i
                            data-lucide="x"></i></button>
                </div>
                <div class="drawer__body">
                    <div class="field mb-4">
                        <label for="editImage" class="field__label">Image</label>
                        <input type="file" class="input" id="editImage" name="image" accept="image/*" />
                    </div>
                    <div class="field mb-4">
                        <label for="editName" class="field__label">Name</label>
                        <input type="text" class="input" id="editName" name="name" required />
                    </div>
                    <div class="field mb-4">
                        <label for="editEmail" class="field__label">Email</label>
                        <input type="email" class="input" id="editEmail" name="email" required />
                    </div>
                    <div class="field mb-4">
                        <label for="editPassword" class="field__label">New Password <span
                                class="text-xs text-muted-foreground">(leave blank to keep current)</span></label>
                        <input type="password" class="input" id="editPassword" name="password"
                            placeholder="Min. 8 characters" />
                    </div>
                    <div class="field mb-4">
                        <label for="editPasswordConfirmation" class="field__label">Confirm New Password</label>
                        <input type="password" class="input" id="editPasswordConfirmation" name="password_confirmation"
                            placeholder="Repeat password" />
                    </div>
                    <div class="field mb-4">
                        <label for="editPosition" class="field__label">Position</label>
                        <input type="text" class="input" id="editPosition" name="position" />
                    </div>
                    <div class="field mb-4">
                        <label for="editOrder" class="field__label">Order</label>
                        <input type="number" class="input" id="editOrder" name="order" />
                    </div>
                    <div class="field mb-4">
                        <label for="editRole" class="field__label">Roles <span
                                class="text-xs text-muted-foreground">(hold Ctrl/Cmd to select multiple)</span></label>
                        <select class="input" id="editRole" name="roles[]" multiple>
                            @foreach ($roles as $role)
                                <option value="{{ $role->name }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="field mb-4">
                        <label for="editInstagram" class="field__label">Instagram</label>
                        <div class="input-group max-w-sm">
                            <span class="input-group__text"><i data-lucide="at-sign"></i></span>
                            <input type="text" class="input" id="editInstagram" name="instagram"
                                placeholder="fajri_chan" />
                        </div>
                    </div>
                    <div class="field mb-4">
                        <label for="editAbout" class="field__label">About</label>
                        <textarea class="textarea" id="editAbout" rows="3" name="about"></textarea>
                    </div>
                    <div class="field mb-4">
                        <div class="field__item">
                            <input class="checkbox" type="checkbox" id="editIsShow" name="is_show" value="1" />
                            <label class="field__label" for="editIsShow">Show on website?</label>
                        </div>
                    </div>
                </div>
                <div class="drawer__footer">
                    <button type="button" class="button button--ghost button--neutral"
                        data-stisla-drawer-dismiss>Cancel</button>
                    <button type="submit" class="button button--primary">Save changes</button>
                </div>
            </div>
        </form>
    </div>



    {{-- Delete Single User Dialog --}}
    <div class="dialog dialog--sm" id="deleteCustomer" data-stisla-dialog data-state="closed" role="alertdialog"
        aria-modal="true" aria-labelledby="deleteCustomerLabel" aria-describedby="deleteCustomerDesc" aria-hidden="true"
        tabindex="-1">
        <div class="dialog__backdrop" data-stisla-dialog-dismiss></div>
        <div class="dialog__panel">
            <div class="dialog__content">
                <button type="button" class="dialog__close" data-stisla-dialog-dismiss aria-label="Close">
                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                        aria-hidden="true">
                        <path d="M6 6l12 12M18 6L6 18" />
                    </svg>
                </button>
                <div class="dialog__body text-center pt-6">
                    <span class="icon-box icon-box--danger icon-box--circle icon-box--lg mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"
                            aria-hidden="true">
                            <g fill="none" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round"
                                    d="M20.5 6h-17m15.333 2.5l-.46 6.9c-.177 2.654-.265 3.981-1.13 4.79s-2.196.81-4.856.81h-.774c-2.66 0-3.991 0-4.856-.81c-.865-.809-.954-2.136-1.13-4.79l-.46-6.9M9.5 11l.5 5m4.5-5l-.5 5" />
                                <path
                                    d="M6.5 6h.11a2 2 0 0 0 1.83-1.32l.034-.103l.097-.291c.083-.249.125-.373.18-.479a1.5 1.5 0 0 1 1.094-.788C9.962 3 10.093 3 10.355 3h3.29c.262 0 .393 0 .51.019a1.5 1.5 0 0 1 1.094.788c.055.106.097.23.18.479l.097.291A2 2 0 0 0 17.5 6" />
                            </g>
                        </svg>
                    </span>
                    <h3 class="dialog__title mb-1" id="deleteCustomerLabel">
                        Delete <span data-slot="name"></span>?
                    </h3>
                    <p class="text-muted-foreground" id="deleteCustomerDesc">
                        This removes the user permanently. This can't be undone.
                    </p>
                </div>
                <div class="dialog__footer justify-center">
                    <button type="button" class="button button--ghost button--neutral"
                        data-stisla-dialog-dismiss>Cancel</button>
                    <form id="deleteForm" method="POST" action="" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="button button--danger">Delete user</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Bulk Delete Dialog --}}
    <div class="dialog dialog--sm" id="deleteConfirm" data-stisla-dialog data-state="closed" role="alertdialog"
        aria-modal="true" aria-labelledby="delCustLabel" aria-describedby="delCustDesc" aria-hidden="true"
        tabindex="-1">
        <div class="dialog__backdrop" data-stisla-dialog-dismiss></div>
        <div class="dialog__panel">
            <div class="dialog__content">
                <button type="button" class="dialog__close" data-stisla-dialog-dismiss aria-label="Close">
                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                        aria-hidden="true">
                        <path d="M6 6l12 12M18 6L6 18" />
                    </svg>
                </button>
                <div class="dialog__body text-center pt-6">
                    <span class="icon-box icon-box--danger icon-box--circle icon-box--lg mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"
                            aria-hidden="true">
                            <g fill="none" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round"
                                    d="M20.5 6h-17m15.333 2.5l-.46 6.9c-.177 2.654-.265 3.981-1.13 4.79s-2.196.81-4.856.81h-.774c-2.66 0-3.991 0-4.856-.81c-.865-.809-.954-2.136-1.13-4.79l-.46-6.9M9.5 11l.5 5m4.5-5l-.5 5" />
                                <path
                                    d="M6.5 6h.11a2 2 0 0 0 1.83-1.32l.034-.103l.097-.291c.083-.249.125-.373.18-.479a1.5 1.5 0 0 1 1.094-.788C9.962 3 10.093 3 10.355 3h3.29c.262 0 .393 0 .51.019a1.5 1.5 0 0 1 1.094.788c.055.106.097.23.18.479l.097.291A2 2 0 0 0 17.5 6" />
                            </g>
                        </svg>
                    </span>
                    <h3 class="dialog__title mb-1" id="delCustLabel">
                        Delete <span id="bulkDeleteCount">0</span> users?
                    </h3>
                    <p class="text-muted-foreground" id="delCustDesc">
                        The selected users are permanently removed. This can't be undone.
                    </p>
                </div>
                <div class="dialog__footer justify-center">
                    <button type="button" class="button button--ghost button--neutral"
                        data-stisla-dialog-dismiss>Cancel</button>
                    <form id="bulkDeleteForm" method="POST" action="{{ route('admin.users.bulkDestroy') }}"
                        style="display:inline;">
                        @csrf
                        <input type="hidden" name="ids" id="bulkIdsInput" value="" />
                        <button type="submit" class="button button--danger">Delete users</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Edit user — fill edit drawer and set form action
        document.querySelectorAll('[data-stisla-drawer-trigger="editUser"]').forEach(function(btn) {
            btn.addEventListener('click', function() {
                var userId = this.getAttribute('data-user-id');
                document.getElementById('editForm').action = '/admin/users/' + userId;
                document.getElementById('editName').value = this.getAttribute('data-user-name');
                document.getElementById('editEmail').value = this.getAttribute('data-user-email');
                document.getElementById('editPosition').value = this.getAttribute('data-user-position') ||
                    '';
                document.getElementById('editOrder').value = this.getAttribute('data-user-order') || '';
                document.getElementById('editInstagram').value = this.getAttribute('data-user-instagram') ||
                    '';
                document.getElementById('editAbout').value = this.getAttribute('data-user-about') || '';
                document.getElementById('editIsShow').checked = this.getAttribute('data-user-status') ===
                    '1';

                var selectedRoles = JSON.parse(this.getAttribute('data-user-roles') || '[]');
                var roleSelect = document.getElementById('editRole');
                for (var i = 0; i < roleSelect.options.length; i++) {
                    roleSelect.options[i].selected = selectedRoles.includes(roleSelect.options[i].value);
                }
            });
        });

        // Delete single user — set form action and fill name via data-slot
        document.querySelectorAll('[data-stisla-dialog-trigger="deleteCustomer"]').forEach(function(btn) {
            btn.addEventListener('click', function() {
                var userId = this.getAttribute('data-user-id');
                document.getElementById('deleteForm').action = '/admin/users/' + userId;
            });
        });

        // Bulk select / bulk bar logic
        var bulkBar = document.querySelector('[data-bulkbar]');
        var selectAll = document.querySelector('[data-select-all]');
        var selectRows = document.querySelectorAll('[data-select-row]');
        var selectCount = document.querySelector('[data-select-count]');
        var bulkIdsInput = document.getElementById('bulkIdsInput');

        function updateBulkBar() {
            var checked = document.querySelectorAll('[data-select-row]:checked');
            var count = checked.length;
            selectCount.textContent = count;
            if (count > 0) {
                bulkBar.hidden = false;
            } else {
                bulkBar.hidden = true;
            }
        }

        function updateSelectedIds() {
            var ids = [];
            document.querySelectorAll('[data-select-row]:checked').forEach(function(cb) {
                ids.push(cb.value);
            });
            if (bulkIdsInput) {
                bulkIdsInput.value = ids.join(',');
            }
        }

        if (selectAll) {
            selectAll.addEventListener('change', function() {
                var checked = this.checked;
                selectRows.forEach(function(cb) { cb.checked = checked; });
                updateBulkBar();
            });
        }
        selectRows.forEach(function(cb) {
            cb.addEventListener('change', function() {
                updateBulkBar();
            });
        });

        // Bulk delete — populate IDs before submit and update count on dialog open
        document.querySelectorAll('[data-stisla-dialog-trigger="deleteConfirm"]').forEach(function(btn) {
            btn.addEventListener('click', function() {
                var checked = document.querySelectorAll('[data-select-row]:checked');
                var el = document.getElementById('bulkDeleteCount');
                if (el) el.textContent = checked.length;
                updateSelectedIds();
            });
        });

        var bulkDeleteForm = document.getElementById('bulkDeleteForm');
        if (bulkDeleteForm) {
            bulkDeleteForm.addEventListener('submit', function(e) {
                updateSelectedIds();
                var ids = bulkIdsInput.value;
                if (!ids) {
                    e.preventDefault();
                    return;
                }
            });
        }
    </script>

@endsection
