document.addEventListener('DOMContentLoaded', () => {
  const body = document.body;
  const header = document.getElementById('siteHeader');
  const solidHeader = header?.dataset.headerMode === 'solid';

  const updateHeader = () => {
    if (!header) return;
    const useSolid = solidHeader || window.scrollY > 60;
    header.classList.toggle('bg-[#f6f3ed]/95', useSolid);
    header.classList.toggle('backdrop-blur-md', useSolid);
    header.classList.toggle('text-[#171717]', useSolid);
    header.classList.toggle('border-black/10', useSolid);
    header.classList.toggle('shadow-sm', useSolid);
    header.classList.toggle('text-white', !useSolid);
    header.classList.toggle('border-white/0', !useSolid);
  };

  updateHeader();
  window.addEventListener('scroll', updateHeader, { passive: true });

  const mobileMenu = document.getElementById('mobileMenu');
  const menuButton = document.getElementById('menuButton');
  const closeMenuButton = document.getElementById('closeMenuButton');
  const mobileLinks = [...document.querySelectorAll('.mobile-link')];

  const setMobileMenu = (open) => {
    if (!mobileMenu) return;
    mobileMenu.classList.toggle('invisible', !open);
    mobileMenu.classList.toggle('opacity-0', !open);
    mobileMenu.setAttribute('aria-hidden', String(!open));
    menuButton?.setAttribute('aria-expanded', String(open));
    body.classList.toggle('overflow-hidden', open);
  };

  menuButton?.addEventListener('click', () => setMobileMenu(true));
  closeMenuButton?.addEventListener('click', () => setMobileMenu(false));
  mobileLinks.forEach(link => link.addEventListener('click', () => setMobileMenu(false)));

  document.querySelectorAll('.mobile-accordion').forEach(button => {
    button.addEventListener('click', () => {
      const content = button.nextElementSibling;
      const icon = button.querySelector('.accordion-icon');
      if (!content) return;
      const isOpen = Boolean(content.style.maxHeight);
      content.style.maxHeight = isOpen ? '' : `${content.scrollHeight}px`;
      icon?.classList.toggle('rotate-180', !isOpen);
    });
  });

  const searchOverlay = document.getElementById('searchOverlay');
  const searchInput = document.getElementById('searchInput');
  const searchButtons = [document.getElementById('searchButton'), document.getElementById('mobileSearchButton')].filter(Boolean);
  const closeSearchButton = document.getElementById('closeSearchButton');

  const setSearch = (open) => {
    if (!searchOverlay) return;
    searchOverlay.classList.toggle('invisible', !open);
    searchOverlay.classList.toggle('opacity-0', !open);
    searchOverlay.setAttribute('aria-hidden', String(!open));
    body.classList.toggle('overflow-hidden', open);
    if (open) window.setTimeout(() => searchInput?.focus(), 350);
  };

  searchButtons.forEach(button => button.addEventListener('click', () => setSearch(true)));
  closeSearchButton?.addEventListener('click', () => setSearch(false));

  searchInput?.addEventListener('keydown', event => {
    if (event.key === 'Enter' && searchInput.value.trim()) {
      event.preventDefault();
      window.location.href = `journal.html?q=${encodeURIComponent(searchInput.value.trim())}`;
    }
  });

  document.querySelectorAll('[data-search]').forEach(button => {
    button.addEventListener('click', () => {
      if (!searchInput) return;
      searchInput.value = button.dataset.search || '';
      searchInput.focus();
    });
  });

  document.addEventListener('keydown', event => {
    if (event.key === 'Escape') {
      setMobileMenu(false);
      setSearch(false);
    }
  });
});
