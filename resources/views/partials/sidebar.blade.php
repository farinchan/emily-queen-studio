<aside class="sidebar sidebar--lg sidebar--app" data-stisla-sidebar>
    <header class="sidebar__header">
        <a class="sidebar__brand" href="/meridian/">
            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" fill="currentColor"
                aria-hidden="true">
                <path d="M12 1.5l3.4 7.1 7.1 3.4-7.1 3.4-3.4 7.1-3.4-7.1L1.5 12l7.1-3.4z" opacity=".45" />
                <path d="M12 1.5l3.4 7.1L12 12 8.6 8.6z" />
            </svg>
            <span>Emily Queen</span>
        </a>
    </header>

    <div class="sidebar__search">
        <div class="input-group input-group--search">
            <span class="input-group__text"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                    viewBox="0 0 24 24" aria-hidden="true">
                    <g fill="none" stroke="currentColor" stroke-width="1.5">
                        <circle cx="11.5" cy="11.5" r="9.5" />
                        <path stroke-linecap="round" d="M18.5 18.5L22 22" />
                    </g>
                </svg></span>
            <input type="search" class="input" placeholder="Search orders, products, customers…"
                aria-label="Search" />
        </div>
    </div>

    <div class="sidebar__content">
        <nav class="sidebar__menu">
            <div class="sidebar__group">
                <span class="sidebar__group-title">Store</span>
                <ul class="sidebar__list">
                    <li class="sidebar__item">
                        <a class="sidebar__button" href="{{ route('admin.dashboard') }}"
                            @if (Route::is('admin.dashboard')) aria-current="page" @endif>
                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"
                                aria-hidden="true">
                                <path fill="currentColor"
                                    d="M2 6.5c0-2.121 0-3.182.659-3.841S4.379 2 6.5 2s3.182 0 3.841.659S11 4.379 11 6.5s0 3.182-.659 3.841S8.621 11 6.5 11s-3.182 0-3.841-.659S2 8.621 2 6.5m11 11c0-2.121 0-3.182.659-3.841S15.379 13 17.5 13s3.182 0 3.841.659S22 15.379 22 17.5s0 3.182-.659 3.841S19.621 22 17.5 22s-3.182 0-3.841-.659S13 19.621 13 17.5"
                                    opacity=".5" />
                                <path fill="currentColor"
                                    d="M2 17.5c0-2.121 0-3.182.659-3.841S4.379 13 6.5 13s3.182 0 3.841.659S11 15.379 11 17.5s0 3.182-.659 3.841S8.621 22 6.5 22s-3.182 0-3.841-.659S2 19.621 2 17.5m11-11c0-2.121 0-3.182.659-3.841S15.379 2 17.5 2s3.182 0 3.841.659S22 4.379 22 6.5s0 3.182-.659 3.841S19.621 11 17.5 11s-3.182 0-3.841-.659S13 8.621 13 6.5" />
                            </svg><span>Dashboard</span>
                        </a>
                    </li>

                    <li class="sidebar__item">
                        <a class="sidebar__button" href="{{ route('admin.banners.index') }}"
                            @if (Route::is('admin.banners.index')) aria-current="page" @endif>
                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"
                                aria-hidden="true">
                                <g fill="none" stroke="currentColor" stroke-width="1.5">
                                    <rect width="18" height="14" x="3" y="5" rx="2" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m3 16l5-5c.928-.893 2.072-.893 3 0l5 5m-2-2l1-1c.928-.893 2.072-.893 3 0l2 2" />
                                    <circle cx="8.5" cy="9.5" r="1.5" fill="currentColor" />
                                </g>
                            </svg><span>Banner</span>
                        </a>
                    </li>
                    <li class="sidebar__item">
                        <a class="sidebar__button" href="{{ route('admin.photographies.index') }}"
                            @if (Route::is('admin.photographies.index')) aria-current="page" @endif>
                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"
                                aria-hidden="true">
                                <g fill="none" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M6.827 6.175A2.31 2.31 0 0 1 5.186 5.5A2.25 2.25 0 0 0 3 7.75v10.5A2.25 2.25 0 0 0 5.25 20.5h13.5A2.25 2.25 0 0 0 21 18.25V7.75A2.25 2.25 0 0 0 18.75 5.5a2.31 2.31 0 0 1-1.641.675l-.545 1.09a2.25 2.25 0 0 1-2.012 1.235h-5.104a2.25 2.25 0 0 1-2.012-1.235z" />
                                    <circle cx="12" cy="14" r="3" />
                                </g>
                            </svg><span>Photography</span>
                        </a>
                    <li class="sidebar__item">
                        <a class="sidebar__button" href="{{ route('admin.instagram.index') }}"
                            @if (Route::is('admin.instagram.*')) aria-current="page" @endif>
                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" aria-hidden="true">
                                <g fill="none" stroke="currentColor" stroke-width="1.5">
                                    <rect x="2" y="2" width="20" height="20" rx="5" ry="5" />
                                    <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z" />
                                    <circle cx="17.5" cy="6.5" r="1" fill="currentColor" />
                                </g>
                            </svg><span>Instagram Feed</span>
                        </a>
                    </li>
                </ul>
            </div>


            <div class="sidebar__group">
                <span class="sidebar__group-title">Administrator</span>
                <ul class="sidebar__list">




                    <li class="sidebar__item">
                        <a class="sidebar__button" href="{{ route('admin.users.index') }}"
                            @if (Route::is('admin.users.index')) aria-current="page" @endif>
                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"
                                aria-hidden="true">
                                <circle cx="15" cy="6" r="3" fill="currentColor" opacity=".4" />
                                <ellipse cx="16" cy="17" fill="currentColor" opacity=".4" rx="5"
                                    ry="3" />
                                <circle cx="9.001" cy="6" r="4" fill="currentColor" />
                                <ellipse cx="9.001" cy="17.001" fill="currentColor" rx="7"
                                    ry="4" />
                            </svg><span>Pengguna</span>
                        </a>
                    </li>

                    <li class="sidebar__item">
                        <a class="sidebar__button" href="{{ route('admin.settings.index') }}"
                            @if (Route::is('admin.settings.index')) aria-current="page" @endif>
                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"
                                aria-hidden="true">
                                <g fill="none" stroke="currentColor" stroke-width="1.5">
                                    <path d="M12 15a3 3 0 1 0 0-6a3 3 0 0 0 0 6Z" />
                                    <path stroke-linecap="round" d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83a2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33a1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2a2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0a2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82a1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2a2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83a2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2a2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51a1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0a2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2a2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1Z" />
                                </g>
                            </svg><span>Pengaturan</span>
                        </a>
                    </li>

                </ul>
            </div>
        </nav>
    </div>

    <footer class="sidebar__footer">
        <ul class="sidebar__list">
            <li class="sidebar__item">
                <a class="sidebar__button" href="{{ route('admin.profile') }}" @if(Route::is('admin.profile')) aria-current="page" @endif>
                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"
                        aria-hidden="true">
                        <path fill="currentColor"
                            d="M22 12c0 5.523-4.477 10-10 10S2 17.523 2 12S6.477 2 12 2s10 4.477 10 10"
                            opacity=".5" />
                        <path fill="currentColor"
                            d="M16.807 19.011A8.46 8.46 0 0 1 12 20.5a8.46 8.46 0 0 1-4.807-1.489c-.604-.415-.862-1.205-.51-1.848C7.41 15.83 8.91 15 12 15s4.59.83 5.318 2.163c.35.643.093 1.433-.511 1.848M12 12a3 3 0 1 0 0-6a3 3 0 0 0 0 6" />
                    </svg>
                    <span>Profile</span>
                </a>
            </li>
            <li class="sidebar__item">
                <form action="{{ route('logout') }}" method="POST" id="sidebar-logout-form" class="hidden">
                    @csrf
                </form>
                <a class="sidebar__button" href="#" onclick="event.preventDefault(); document.getElementById('sidebar-logout-form').submit();">
                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"
                        aria-hidden="true">
                        <path fill="currentColor"
                            d="M16 2h-1c-2.829 0-4.242 0-5.121.879S9 5.172 9 8v8c0 2.829 0 4.243.879 5.122c.878.878 2.292.878 5.119.878H16c2.828 0 4.242 0 5.121-.879C22 20.243 22 18.828 22 16V8c0-2.828 0-4.243-.879-5.121S18.828 2 16 2"
                            opacity=".5" />
                        <path fill="currentColor" fill-rule="evenodd"
                            d="M15.75 12a.75.75 0 0 0-.75-.75H4.027l1.961-1.68a.75.75 0 1 0-.976-1.14l-3.5 3a.75.75 0 0 0 0 1.14l3.5 3a.75.75 0 1 0 .976-1.14l-1.96-1.68H15a.75.75 0 0 0 .75-.75"
                            clip-rule="evenodd" />
                    </svg><span>Log out</span>
                </a>
            </li>
        </ul>
        <div class="copyright">
            <hr class="separator my-3" style="--separator-color: var(--sidebar-submenu-border-color)" />
            <p class="text-xs text-muted-foreground" style="--link-color: var(--color-foreground)">
                Dev by <a href="https://fajri.gariskode.com" class="link" target="_blank">Fajri Rinaldi Chan</a>
            </p>
        </div>
    </footer>
</aside>
