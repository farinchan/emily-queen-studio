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

<body class="bg-white text-[#171717] antialiased">

    @include('front.partials.header')
    @include('front.partials.search-overlay')

    <main>

        @yield('content')

    </main>
    @include('front.partials.footer')
    @include('front.partials.back-to-top')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const body = document.body;
            const header = document.getElementById('siteHeader');
            const backToTop = document.getElementById('backToTop');

            // Header style on scroll
            const updateHeader = () => {
                const scrolled = window.scrollY > 60;
                if (header) {
                    header.classList.toggle('bg-white', scrolled);
                    header.classList.toggle('text-[#171717]', scrolled);
                    header.classList.toggle('border-black/10', scrolled);
                    header.classList.toggle('shadow-sm', scrolled);
                    header.classList.toggle('text-white', !scrolled);
                    header.classList.toggle('border-white/0', !scrolled);
                }

                if (backToTop) {
                    const showBackToTop = window.scrollY > window.innerHeight * 0.8;
                    backToTop.classList.toggle('opacity-0', !showBackToTop);
                    backToTop.classList.toggle('translate-y-5', !showBackToTop);
                    backToTop.classList.toggle('pointer-events-none', !showBackToTop);
                }
            };

            updateHeader();
            window.addEventListener('scroll', updateHeader, {
                passive: true
            });

            if (backToTop) {
                backToTop.addEventListener('click', () => window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                }));
            }

            // Hero slider (only if hero section exists on page)
            const heroSection = document.getElementById('home');
            const dotsContainer = document.getElementById('heroDots');
            const prevSlideButton = document.getElementById('prevSlide');
            const nextSlideButton = document.getElementById('nextSlide');
            const slides = [...document.querySelectorAll('.hero-slide')];

            if (heroSection && dotsContainer && slides.length > 0) {
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

                if (prevSlideButton) {
                    prevSlideButton.addEventListener('click', () => {
                        showSlide(activeSlide - 1);
                        restartHeroTimer();
                    });
                }

                if (nextSlideButton) {
                    nextSlideButton.addEventListener('click', () => {
                        showSlide(activeSlide + 1);
                        restartHeroTimer();
                    });
                }

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
            }

            // Mobile menu
            const mobileMenu = document.getElementById('mobileMenu');
            const menuButton = document.getElementById('menuButton');
            const closeMenuButton = document.getElementById('closeMenuButton');
            const mobileLinks = [...document.querySelectorAll('.mobile-link')];

            if (mobileMenu && menuButton && closeMenuButton) {
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
            }

            document.querySelectorAll('.mobile-accordion').forEach(button => {
                button.addEventListener('click', () => {
                    const content = button.nextElementSibling;
                    const icon = button.querySelector('.accordion-icon');
                    if (content) {
                        const isOpen = content.style.maxHeight;
                        content.style.maxHeight = isOpen ? null : `${content.scrollHeight}px`;
                        if (icon) icon.classList.toggle('rotate-180', !isOpen);
                    }
                });
            });

            // Search overlay
            const searchOverlay = document.getElementById('searchOverlay');
            const searchInput = document.getElementById('searchInput');
            const searchButton = document.getElementById('searchButton');
            const mobileSearchButton = document.getElementById('mobileSearchButton');
            const closeSearchButton = document.getElementById('closeSearchButton');

            if (searchOverlay && searchInput && closeSearchButton) {
                const setSearch = open => {
                    searchOverlay.classList.toggle('invisible', !open);
                    searchOverlay.classList.toggle('opacity-0', !open);
                    searchOverlay.setAttribute('aria-hidden', String(!open));
                    body.classList.toggle('overflow-hidden', open);
                    if (open) window.setTimeout(() => searchInput.focus(), 350);
                };

                [searchButton, mobileSearchButton].filter(Boolean).forEach(button => {
                    button.addEventListener('click', () => setSearch(true));
                });
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
            }

            // Escape key closes overlays
            document.addEventListener('keydown', event => {
                if (event.key === 'Escape') {
                    const mobileMenu = document.getElementById('mobileMenu');
                    const searchOverlay = document.getElementById('searchOverlay');
                    if (mobileMenu) {
                        mobileMenu.classList.add('invisible', 'opacity-0');
                        mobileMenu.setAttribute('aria-hidden', 'true');
                    }
                    if (searchOverlay) {
                        searchOverlay.classList.add('invisible', 'opacity-0');
                        searchOverlay.setAttribute('aria-hidden', 'true');
                    }
                    body.classList.remove('overflow-hidden');
                }
            });

            // Scroll reveal (runs reliably on ALL pages)
            const revealElements = document.querySelectorAll('.reveal');
            if (revealElements.length > 0) {
                const revealObserver = new IntersectionObserver(entries => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('is-visible');
                            revealObserver.unobserve(entry.target);
                        }
                    });
                }, {
                    threshold: 0.1,
                    rootMargin: '0px 0px -30px 0px'
                });

                revealElements.forEach(element => revealObserver.observe(element));
            }

            // Footer year
            const yearEl = document.getElementById('currentYear');
            if (yearEl) {
                yearEl.textContent = new Date().getFullYear();
            }
        });
    </script>
</body>

</html>
