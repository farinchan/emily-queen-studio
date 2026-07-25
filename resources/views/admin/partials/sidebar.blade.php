<aside class="sidebar sidebar--lg sidebar--app" data-stisla-sidebar>
    <header class="sidebar__header">
        <a class="sidebar__brand" href="/meridian/">
            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" fill="currentColor"
                aria-hidden="true">
                <path d="M12 1.5l3.4 7.1 7.1 3.4-7.1 3.4-3.4 7.1-3.4-7.1L1.5 12l7.1-3.4z" opacity=".45" />
                <path d="M12 1.5l3.4 7.1L12 12 8.6 8.6z" />
            </svg>
            <span>Emily Queen </span>
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
                        <a class="sidebar__button" href="{{ route('admin.dashboard') }}" @if(Route::is('admin.dashboard')) aria-current="page" @endif>
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
                        <a class="sidebar__button" href="/meridian/orders.html">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"
                                aria-hidden="true">
                                <path fill="currentColor" fill-rule="evenodd"
                                    d="M1.289 2.763a.75.75 0 0 1 .948-.475l.265.089l.04.013c.626.209 1.155.385 1.572.579c.442.206.826.46 1.117.865c.291.403.412.848.467 1.333c.052.456.052 1.014.052 1.674V9.5c0 1.435.002 2.437.103 3.192c.099.734.28 1.122.556 1.399c.277.277.666.457 1.4.556c.755.101 1.756.103 3.191.103h7a.75.75 0 1 1 0 1.5h-7.055c-1.367 0-2.47 0-3.337-.117c-.9-.12-1.658-.38-2.26-.981c-.601-.602-.86-1.36-.981-2.26c-.117-.867-.117-1.97-.117-3.337V6.883c0-.713 0-1.185-.042-1.546c-.04-.342-.107-.507-.194-.626c-.086-.12-.221-.237-.533-.382c-.33-.153-.777-.304-1.453-.53l-.265-.088a.75.75 0 0 1-.474-.948"
                                    clip-rule="evenodd" />
                                <path fill="currentColor"
                                    d="M5.745 6q.006.39.005.841V9.5c0 1.435.002 2.437.103 3.192q.023.165.05.308h10.12c.959 0 1.438 0 1.814-.248s.565-.688.942-1.57l.43-1c.809-1.89 1.213-2.833.769-3.508S18.506 6 16.45 6z"
                                    opacity=".5" />
                                <path fill="currentColor"
                                    d="M7.5 18a1.5 1.5 0 1 1 0 3a1.5 1.5 0 0 1 0-3M18 19.5a1.5 1.5 0 1 0-3 0a1.5 1.5 0 0 0 3 0" />
                            </svg><span>Orders</span>
                        </a>
                        <span class="sidebar__item-action">
                            <span class="badge badge--primary">8</span>
                        </span>
                    </li>
                    <li class="sidebar__item">
                        <a class="sidebar__button" href="/meridian/products.html">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"
                                aria-hidden="true">
                                <path fill="currentColor"
                                    d="M8.422 20.618C10.178 21.54 11.056 22 12 22V12L2.638 7.073l-.04.067C2 8.154 2 9.417 2 11.942v.117c0 2.524 0 3.787.597 4.801c.598 1.015 1.674 1.58 3.825 2.709z" />
                                <path fill="currentColor"
                                    d="m17.577 4.432l-2-1.05C13.822 2.461 12.944 2 12 2c-.945 0-1.822.46-3.578 1.382l-2 1.05C4.318 5.536 3.242 6.1 2.638 7.072L12 12l9.362-4.927c-.606-.973-1.68-1.537-3.785-2.641"
                                    opacity=".7" />
                                <path fill="currentColor"
                                    d="m21.403 7.14l-.041-.067L12 12v10c.944 0 1.822-.46 3.578-1.382l2-1.05c2.151-1.129 3.227-1.693 3.825-2.708c.597-1.014.597-2.277.597-4.8v-.117c0-2.525 0-3.788-.597-4.802"
                                    opacity=".5" />
                                <path fill="currentColor"
                                    d="m6.323 4.484l.1-.052l1.493-.784l9.1 5.005l4.025-2.011q.205.232.362.498c.15.254.262.524.346.825L17.75 9.964V13a.75.75 0 0 1-1.5 0v-2.286l-3.5 1.75v9.44A3 3 0 0 1 12 22c-.248 0-.493-.032-.75-.096v-9.44l-8.998-4.5c.084-.3.196-.57.346-.824q.156-.266.362-.498l9.04 4.52l3.387-1.693z" />
                            </svg><span>Products</span>
                        </a>
                    </li>

                </ul>
            </div>

            <div class="sidebar__group">
                <span class="sidebar__group-title">Insights</span>
                <ul class="sidebar__list">
                    <li class="sidebar__item" data-state="closed">
                        <a class="sidebar__button" href="/meridian/reports.html">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                                viewBox="0 0 24 24" aria-hidden="true">
                                <path fill="currentColor"
                                    d="M3.293 9.293C3 9.586 3 10.057 3 11v6c0 .943 0 1.414.293 1.707S4.057 19 5 19s1.414 0 1.707-.293S7 17.943 7 17v-6c0-.943 0-1.414-.293-1.707S5.943 9 5 9s-1.414 0-1.707.293" />
                                <path fill="currentColor"
                                    d="M17.293 2.293C17 2.586 17 3.057 17 4v13c0 .943 0 1.414.293 1.707S18.057 19 19 19s1.414 0 1.707-.293S21 17.943 21 17V4c0-.943 0-1.414-.293-1.707S19.943 2 19 2s-1.414 0-1.707.293"
                                    opacity=".4" />
                                <path fill="currentColor"
                                    d="M10 7c0-.943 0-1.414.293-1.707S11.057 5 12 5s1.414 0 1.707.293S14 6.057 14 7v10c0 .943 0 1.414-.293 1.707S12.943 19 12 19s-1.414 0-1.707-.293S10 17.943 10 17z"
                                    opacity=".7" />
                                <path fill="currentColor" d="M3 21.25a.75.75 0 0 0 0 1.5h18a.75.75 0 0 0 0-1.5z" />
                            </svg><span>Reports</span>
                        </a>
                        <button type="button" class="sidebar__item-action" data-stisla-sidebar-submenu-toggle
                            aria-expanded="false" aria-controls="nav-reports" aria-label="Toggle Reports submenu">
                            <span class="sidebar__caret"></span>
                        </button>
                        <div class="sidebar__submenu" id="nav-reports">
                            <ul class="sidebar__list">
                                <li class="sidebar__item">
                                    <a class="sidebar__button" href="/meridian/reports.html"><span>Sales</span></a>
                                </li>
                                <li class="sidebar__item">
                                    <a class="sidebar__button" href="/meridian/reports.html"><span>Traffic</span></a>
                                </li>
                                <li class="sidebar__item">
                                    <a class="sidebar__button"
                                        href="/meridian/reports.html"><span>Inventory</span></a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>

            <div class="sidebar__group">
                <span class="sidebar__group-title">Administrator</span>
                <ul class="sidebar__list">
                    <li class="sidebar__item" data-state="closed">
                        <a class="sidebar__button" href="/meridian/login.html">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                                viewBox="0 0 24 24" aria-hidden="true">
                                <path fill="currentColor"
                                    d="M2 16c0-2.828 0-4.243.879-5.121C3.757 10 5.172 10 8 10h8c2.828 0 4.243 0 5.121.879C22 11.757 22 13.172 22 16s0 4.243-.879 5.121C20.243 22 18.828 22 16 22H8c-2.828 0-4.243 0-5.121-.879C2 20.243 2 18.828 2 16"
                                    opacity=".5" />
                                <path fill="currentColor"
                                    d="M12 18a2 2 0 1 0 0-4a2 2 0 0 0 0 4M6.75 8a5.25 5.25 0 0 1 10.5 0v2.004c.567.005 1.064.018 1.5.05V8a6.75 6.75 0 0 0-13.5 0v2.055a24 24 0 0 1 1.5-.051z" />
                            </svg><span>Authentication</span>
                        </a>
                        <button type="button" class="sidebar__item-action" data-stisla-sidebar-submenu-toggle
                            aria-expanded="false" aria-controls="nav-auth"
                            aria-label="Toggle Authentication submenu">
                            <span class="sidebar__caret"></span>
                        </button>
                        <div class="sidebar__submenu" id="nav-auth">
                            <ul class="sidebar__list">
                                <li class="sidebar__item">
                                    <a class="sidebar__button" href="/meridian/login.html"><span>Login</span></a>
                                </li>
                                <li class="sidebar__item">
                                    <a class="sidebar__button"
                                        href="/meridian/register.html"><span>Register</span></a>
                                </li>
                                <li class="sidebar__item">
                                    <a class="sidebar__button" href="/meridian/forgot.html"><span>Forgot
                                            password</span></a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="sidebar__item" data-state="closed">
                        <a class="sidebar__button" href="/meridian/403.html">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                                viewBox="0 0 24 24" aria-hidden="true">
                                <path fill="currentColor"
                                    d="M12 3c-2.31 0-3.77 2.587-6.688 7.762l-.364.644c-2.425 4.3-3.638 6.45-2.542 8.022S6.214 21 11.636 21h.728c5.422 0 8.134 0 9.23-1.572s-.117-3.722-2.542-8.022l-.364-.645C15.77 5.587 14.311 3 12 3"
                                    opacity=".5" />
                                <path fill="currentColor"
                                    d="M12 7.25a.75.75 0 0 1 .75.75v5a.75.75 0 0 1-1.5 0V8a.75.75 0 0 1 .75-.75M12 17a1 1 0 1 0 0-2a1 1 0 0 0 0 2" />
                            </svg><span>Errors</span>
                        </a>
                        <button type="button" class="sidebar__item-action" data-stisla-sidebar-submenu-toggle
                            aria-expanded="false" aria-controls="nav-errors" aria-label="Toggle Errors submenu">
                            <span class="sidebar__caret"></span>
                        </button>
                        <div class="sidebar__submenu" id="nav-errors">
                            <ul class="sidebar__list">
                                <li class="sidebar__item">
                                    <a class="sidebar__button" href="/meridian/403.html"><span>403
                                            Forbidden</span></a>
                                </li>
                                <li class="sidebar__item">
                                    <a class="sidebar__button" href="/meridian/404.html"><span>404 Not
                                            found</span></a>
                                </li>
                                <li class="sidebar__item">
                                    <a class="sidebar__button" href="/meridian/500.html"><span>500 Server
                                            error</span></a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="sidebar__item">
                        <a class="sidebar__button" href="/meridian/profile.html">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                                viewBox="0 0 24 24" aria-hidden="true">
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
                        <a class="sidebar__button" href="{{ route('admin.users.index') }}" @if(Route::is('admin.users.index')) aria-current="page" @endif>
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
                </ul>
            </div>
        </nav>
    </div>

    <footer class="sidebar__footer">
        <ul class="sidebar__list">
            <li class="sidebar__item">
                <a class="sidebar__button" href="/meridian/settings.html">
                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"
                        aria-hidden="true">
                        <path fill="currentColor" fill-rule="evenodd"
                            d="M14.279 2.152C13.909 2 13.439 2 12.5 2s-1.408 0-1.779.152a2 2 0 0 0-1.09 1.083c-.094.223-.13.484-.145.863a1.62 1.62 0 0 1-.796 1.353a1.64 1.64 0 0 1-1.579.008c-.338-.178-.583-.276-.825-.308a2.03 2.03 0 0 0-1.49.396c-.318.242-.553.646-1.022 1.453c-.47.807-.704 1.21-.757 1.605c-.07.526.074 1.058.4 1.479c.148.192.357.353.68.555c.477.297.783.803.783 1.361s-.306 1.064-.782 1.36c-.324.203-.533.364-.682.556a2 2 0 0 0-.399 1.479c.053.394.287.798.757 1.605s.704 1.21 1.022 1.453c.424.323.96.465 1.49.396c.242-.032.487-.13.825-.308a1.64 1.64 0 0 1 1.58.008c.486.28.774.795.795 1.353c.015.38.051.64.145.863c.204.49.596.88 1.09 1.083c.37.152.84.152 1.779.152s1.409 0 1.779-.152a2 2 0 0 0 1.09-1.083c.094-.223.13-.483.145-.863c.02-.558.309-1.074.796-1.353a1.64 1.64 0 0 1 1.579-.008c.338.178.583.276.825.308c.53.07 1.066-.073 1.49-.396c.318-.242.553-.646 1.022-1.453c.47-.807.704-1.21.757-1.605a2 2 0 0 0-.4-1.479c-.148-.192-.357-.353-.68-.555c-.477-.297-.783-.803-.783-1.361s.306-1.064.782-1.36c.324-.203.533-.364.682-.556a2 2 0 0 0 .399-1.479c-.053-.394-.287-.798-.757-1.605s-.704-1.21-1.022-1.453a2.03 2.03 0 0 0-1.49-.396c-.242.032-.487.13-.825.308a1.64 1.64 0 0 1-1.58-.008a1.62 1.62 0 0 1-.795-1.353c-.015-.38-.051-.64-.145-.863a2 2 0 0 0-1.09-1.083"
                            clip-rule="evenodd" opacity=".5" />
                        <path fill="currentColor"
                            d="M15.523 12c0 1.657-1.354 3-3.023 3s-3.023-1.343-3.023-3S10.83 9 12.5 9s3.023 1.343 3.023 3" />
                    </svg><span>Settings</span>
                </a>
            </li>
            <li class="sidebar__item">
                <a class="sidebar__button" href="/meridian/login.html">
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
                Designed by <a href="https://nauv.al" class="link" target="_blank">Fajri Rinaldi Chan</a>
            </p>
        </div>
    </footer>
</aside>
