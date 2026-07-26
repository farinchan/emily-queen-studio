<!DOCTYPE html>
<html class="scroll-smooth" lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta
        content="A complete responsive wedding photography and cinematography portfolio project built with Tailwind CSS."
        name="description" />
    <title>Emily Queen Home Foto Studio</title>
    <!-- Tailwind CSS Browser CDN -->

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect" />
    <link
        href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;1,400&amp;family=Montserrat:wght@300;400;500;600&amp;display=swap"
        rel="stylesheet" />

    <link href="{{ asset('assets/css/tailwind.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/favicon.svg') }}" rel="icon" type="image/svg+xml" />
</head>

<body class="bg-[#f6f3ed] text-[#171717] antialiased">

    @include('front.partials.header')
    @include('front.partials.search-overlay')

    <main>

        @yield('content')

    </main>
    <!-- Footer -->
    <footer class="bg-[#171717] text-white" id="contact">
        <div class="mx-auto max-w-[1600px] px-6 py-20 sm:px-10 sm:py-28 lg:px-16 lg:py-32">
            <div
                class="grid gap-16 border-b border-white/15 pb-20 md:grid-cols-2 lg:grid-cols-[1.25fr_.75fr_.75fr] lg:gap-20">
                <div class="reveal">
                    <p class="mb-6 text-[9px] uppercase tracking-[.34em] text-white/45">Get in touch</p>
                    <h2 class="font-display text-6xl leading-[.95] sm:text-7xl lg:text-8xl">Let us tell your story.
                    </h2>
                    <a class="mt-10 inline-flex items-center gap-4 border-b border-white/35 pb-2 text-[10px] uppercase tracking-[.24em] transition-all hover:gap-7 hover:border-white"
                        href="mailto:hello@example.com">hello@example.com <span>→</span></a>
                </div>
                <div class="reveal">
                    <p class="mb-7 text-[9px] uppercase tracking-[.3em] text-white/45">Jakarta Studio</p>
                    <div class="space-y-3 text-sm font-light leading-7 text-white/70">
                        <p>By appointment only</p>
                        <p>Phone +62 800 0000 0000</p>
                        <p>Wedding enquiries<br />+62 800 0000 0001</p>
                        <p>Family enquiries<br />+62 800 0000 0002</p>
                    </div>
                </div>
                <div class="reveal">
                    <p class="mb-7 text-[9px] uppercase tracking-[.3em] text-white/45">Explore</p>
                    <div class="grid gap-3 text-[10px] uppercase tracking-[.2em] text-white/70">
                        <a class="hover:text-white" href="journal.html">Journal</a>
                        <a class="hover:text-white" href="videography.html">Films</a>
                        <a class="hover:text-white" href="about.html">About</a>
                        <a class="hover:text-white" href="contact.html">Contact</a>
                        <a class="hover:text-white" href="#">Instagram ↗</a>
                        <a class="hover:text-white" href="#">YouTube ↗</a>
                    </div>
                </div>
            </div>
            <div class="flex flex-col gap-10 pt-10 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <span class="block text-3xl font-semibold tracking-[.36em]">AXIOO</span>
                    <span class="mt-2 block text-[7px] uppercase tracking-[.5em] text-white/45">Tailwind Concept
                        Clone</span>
                </div>
                <div class="flex flex-col gap-3 text-[8px] uppercase tracking-[.2em] text-white/40 sm:text-right">
                    <p>© <span id="currentYear"></span> Studio Concept. All rights reserved.</p>
                    <p>Built as an educational UI recreation.</p>
                </div>
            </div>
        </div>
    </footer>
    @include('front.partials.back-to-top')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const body = document.body;
            const header = document.getElementById('siteHeader');
            const backToTop = document.getElementById('backToTop');
            const heroSection = document.getElementById('home');

            // Header style on scroll
            const updateHeader = () => {
                const scrolled = window.scrollY > 60;
                header.classList.toggle('bg-[#f6f3ed]/95', scrolled);
                header.classList.toggle('backdrop-blur-md', scrolled);
                header.classList.toggle('text-[#171717]', scrolled);
                header.classList.toggle('border-black/10', scrolled);
                header.classList.toggle('shadow-sm', scrolled);
                header.classList.toggle('text-white', !scrolled);
                header.classList.toggle('border-white/0', !scrolled);

                const showBackToTop = window.scrollY > window.innerHeight * 0.8;
                backToTop.classList.toggle('opacity-0', !showBackToTop);
                backToTop.classList.toggle('translate-y-5', !showBackToTop);
                backToTop.classList.toggle('pointer-events-none', !showBackToTop);
            };

            updateHeader();
            window.addEventListener('scroll', updateHeader, {
                passive: true
            });

            backToTop.addEventListener('click', () => window.scrollTo({
                top: 0,
                behavior: 'smooth'
            }));

            // Hero slider
            const slides = [...document.querySelectorAll('.hero-slide')];
            const dotsContainer = document.getElementById('heroDots');
            const prevSlideButton = document.getElementById('prevSlide');
            const nextSlideButton = document.getElementById('nextSlide');
            let activeSlide = 0;
            let heroTimer;

            slides.forEach((_, index) => {
                const dot = document.createElement('button');
                dot.type = 'button';
                dot.className = 'hero-dot h-1.5 w-1.5 rounded-full bg-white/40 transition-all duration-300';
                dot.setAttribute('aria-label', `Show slide ${index + 1}`);
                dot.addEventListener('click', () => {
                    showSlide(index);
                    restartHeroTimer();
                });
                dotsContainer.appendChild(dot);
            });

            const dots = [...document.querySelectorAll('.hero-dot')];

            function showSlide(index) {
                activeSlide = (index + slides.length) % slides.length;

                slides.forEach((slide, slideIndex) => {
                    const isActive = slideIndex === activeSlide;
                    slide.classList.toggle('opacity-100', isActive);
                    slide.classList.toggle('opacity-0', !isActive);
                    slide.classList.toggle('pointer-events-none', !isActive);
                    slide.setAttribute('aria-hidden', String(!isActive));
                });

                dots.forEach((dot, dotIndex) => {
                    const isActive = dotIndex === activeSlide;
                    dot.classList.toggle('w-8', isActive);
                    dot.classList.toggle('bg-white', isActive);
                    dot.classList.toggle('w-1.5', !isActive);
                    dot.classList.toggle('bg-white/40', !isActive);
                });
            }

            function startHeroTimer() {
                heroTimer = window.setInterval(() => showSlide(activeSlide + 1), 6500);
            }

            function restartHeroTimer() {
                window.clearInterval(heroTimer);
                startHeroTimer();
            }

            prevSlideButton.addEventListener('click', () => {
                showSlide(activeSlide - 1);
                restartHeroTimer();
            });

            nextSlideButton.addEventListener('click', () => {
                showSlide(activeSlide + 1);
                restartHeroTimer();
            });

            heroSection.addEventListener('mouseenter', () => window.clearInterval(heroTimer));
            heroSection.addEventListener('mouseleave', startHeroTimer);

            let touchStartX = 0;
            heroSection.addEventListener('touchstart', event => {
                touchStartX = event.changedTouches[0].screenX;
            }, {
                passive: true
            });
            heroSection.addEventListener('touchend', event => {
                const distance = event.changedTouches[0].screenX - touchStartX;
                if (Math.abs(distance) > 50) {
                    showSlide(activeSlide + (distance < 0 ? 1 : -1));
                    restartHeroTimer();
                }
            }, {
                passive: true
            });

            showSlide(0);
            startHeroTimer();

            // Mobile menu
            const mobileMenu = document.getElementById('mobileMenu');
            const menuButton = document.getElementById('menuButton');
            const closeMenuButton = document.getElementById('closeMenuButton');
            const mobileLinks = [...document.querySelectorAll('.mobile-link')];

            const setMobileMenu = open => {
                mobileMenu.classList.toggle('invisible', !open);
                mobileMenu.classList.toggle('opacity-0', !open);
                mobileMenu.setAttribute('aria-hidden', String(!open));
                menuButton.setAttribute('aria-expanded', String(open));
                body.classList.toggle('overflow-hidden', open);
            };

            menuButton.addEventListener('click', () => setMobileMenu(true));
            closeMenuButton.addEventListener('click', () => setMobileMenu(false));
            mobileLinks.forEach(link => link.addEventListener('click', () => setMobileMenu(false)));

            document.querySelectorAll('.mobile-accordion').forEach(button => {
                button.addEventListener('click', () => {
                    const content = button.nextElementSibling;
                    const icon = button.querySelector('.accordion-icon');
                    const isOpen = content.style.maxHeight;
                    content.style.maxHeight = isOpen ? null : `${content.scrollHeight}px`;
                    icon.classList.toggle('rotate-180', !isOpen);
                });
            });

            // Search overlay
            const searchOverlay = document.getElementById('searchOverlay');
            const searchInput = document.getElementById('searchInput');
            const searchButtons = [document.getElementById('searchButton'), document.getElementById(
                'mobileSearchButton')];
            const closeSearchButton = document.getElementById('closeSearchButton');

            const setSearch = open => {
                searchOverlay.classList.toggle('invisible', !open);
                searchOverlay.classList.toggle('opacity-0', !open);
                searchOverlay.setAttribute('aria-hidden', String(!open));
                body.classList.toggle('overflow-hidden', open);
                if (open) window.setTimeout(() => searchInput.focus(), 350);
            };

            searchButtons.forEach(button => button.addEventListener('click', () => setSearch(true)));
            closeSearchButton.addEventListener('click', () => setSearch(false));

            searchInput.addEventListener('keydown', event => {
                if (event.key === 'Enter' && searchInput.value.trim()) {
                    event.preventDefault();
                    window.location.href = `journal.html?q=${encodeURIComponent(searchInput.value.trim())}`;
                }
            });

            document.querySelectorAll('[data-search]').forEach(button => {
                button.addEventListener('click', () => {
                    searchInput.value = button.dataset.search;
                    searchInput.focus();
                });
            });

            // Escape key closes overlays
            document.addEventListener('keydown', event => {
                if (event.key === 'Escape') {
                    setMobileMenu(false);
                    setSearch(false);
                }
            });

            // Scroll reveal
            const revealObserver = new IntersectionObserver(entries => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                        revealObserver.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.12,
                rootMargin: '0px 0px -30px 0px'
            });

            document.querySelectorAll('.reveal').forEach(element => revealObserver.observe(element));

            // Footer year
            document.getElementById('currentYear').textContent = new Date().getFullYear();
        });
    </script>
</body>

</html>
