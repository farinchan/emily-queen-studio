<!doctype html>
<html lang="en" data-theme="light">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" type="image/svg+xml"
        href='data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><style>.t{fill:%230a0a0a}.m{stroke:%23fafafa}@media (prefers-color-scheme: dark){.t{fill:%23fafafa}.m{stroke:%230a0a0a}}</style><rect class="t" width="512" height="512" rx="112"/><path class="m" d="M 392 144 H 200 A 56 56 0 0 0 200 256 H 312 A 56 56 0 0 1 312 368 H 120" fill="none" stroke-width="76" stroke-linecap="round" stroke-linejoin="round"/></svg>' />
    <script>
        // Apply the saved theme before first paint to avoid a flash.
        (function() {
            var t = localStorage.getItem("stisla-theme");
            if (t === "dark" || t === "light") document.documentElement.dataset.theme = t;
        })();
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" />
    <title>{{ $title ?? 'Sign in · Emily Queen Studio' }}</title>

    <link rel="stylesheet" href="{{ asset('back-assets/css/style.css') }}" />
</head>

<body>
    <main class="auth">
        @yield('content')

        <aside class="auth__aside">
            <a href="/" class="auth__brand">
                <span class="auth__brand-mark">
                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"
                        fill="currentColor" aria-hidden="true">
                        <path d="M12 1.5l3.4 7.1 7.1 3.4-7.1 3.4-3.4 7.1-3.4-7.1L1.5 12l7.1-3.4z" opacity=".45" />
                        <path d="M12 1.5l3.4 7.1L12 12 8.6 8.6z" />
                    </svg>
                </span>
                <span class="auth__brand-text">
                    <span class="auth__brand-name">Emily Queen</span>
                </span>
            </a>
            <div class="auth__pitch">
                <h2 class="auth__pitch-title">Emily Queen <span>Studio Admin.</span></h2>
                <p class="auth__pitch-lede">
                    Kelola foto, banner, tim, dan konten studio dengan mudah dalam satu tempat.
                </p>
            </div>
        </aside>
    </main>

    <script type="module" src="https://cdn.jsdelivr.net/npm/@stisla/vanilla@3/dist/stisla.js"></script>
    <script src="{{ asset('back-assets/js/theme.js') }}"></script>

    <script>
        document.addEventListener("click", function(event) {
            var toggle = event.target.closest("[data-password-toggle]");
            if (!toggle) return;
            var input = document.getElementById(toggle.getAttribute("aria-controls"));
            if (!input) return;
            var reveal = input.type === "password";
            input.type = reveal ? "text" : "password";
            toggle.setAttribute("aria-pressed", String(reveal));
        });
    </script>
</body>

</html>
