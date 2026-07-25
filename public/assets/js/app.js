document.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('[data-current-year]').forEach(el => el.textContent = new Date().getFullYear());

  const revealItems = document.querySelectorAll('.reveal');
  if ('IntersectionObserver' in window) {
    const observer = new IntersectionObserver(entries => entries.forEach(entry => {
      if (entry.isIntersecting) { entry.target.classList.add('is-visible'); observer.unobserve(entry.target); }
    }), { threshold: .1, rootMargin: '0px 0px -30px 0px' });
    revealItems.forEach(el => observer.observe(el));
  } else revealItems.forEach(el => el.classList.add('is-visible'));

  const back = document.querySelector('[data-back-to-top]');
  const updateBack = () => {
    if (!back) return;
    const visible = window.scrollY > window.innerHeight * .75;
    back.classList.toggle('opacity-0', !visible); back.classList.toggle('translate-y-5', !visible); back.classList.toggle('pointer-events-none', !visible);
  };
  updateBack(); window.addEventListener('scroll', updateBack, { passive: true });
  back?.addEventListener('click', () => window.scrollTo({top:0, behavior:'smooth'}));

  document.querySelectorAll('[data-filter]').forEach(button => button.addEventListener('click', () => {
    const value = button.dataset.filter;
    document.querySelectorAll('[data-filter]').forEach(b => b.classList.toggle('is-active', b === button));
    document.querySelectorAll('[data-gallery-item]').forEach(item => item.classList.toggle('is-hidden', value !== 'all' && item.dataset.category !== value));
  }));

  document.querySelectorAll('[data-team-filter]').forEach(button => button.addEventListener('click', () => {
    const value = button.dataset.teamFilter;
    document.querySelectorAll('[data-team-filter]').forEach(b => b.classList.toggle('is-active', b === button));
    document.querySelectorAll('[data-team-card]').forEach(item => item.classList.toggle('is-hidden', value !== 'all' && item.dataset.location !== value));
  }));

  const lightbox = document.getElementById('lightbox'); const lightboxImage = document.getElementById('lightboxImage');
  const closeLightbox = () => { if (!lightbox) return; lightbox.classList.add('invisible','opacity-0'); lightbox.setAttribute('aria-hidden','true'); document.body.classList.remove('modal-open'); };
  document.querySelectorAll('[data-lightbox]').forEach(button => button.addEventListener('click', () => { if (!lightbox || !lightboxImage) return; lightboxImage.src = button.dataset.lightbox; lightbox.classList.remove('invisible','opacity-0'); lightbox.setAttribute('aria-hidden','false'); document.body.classList.add('modal-open'); }));
  document.querySelector('[data-close-lightbox]')?.addEventListener('click', closeLightbox); lightbox?.addEventListener('click', e => { if (e.target === lightbox) closeLightbox(); });

  const videoModal = document.getElementById('videoModal'); const videoFrame = document.getElementById('videoFrame');
  const closeVideo = () => { if (!videoModal) return; videoModal.classList.add('invisible','opacity-0'); videoModal.setAttribute('aria-hidden','true'); if(videoFrame) videoFrame.src=''; document.body.classList.remove('modal-open'); };
  document.querySelectorAll('[data-video]').forEach(button => button.addEventListener('click', () => { if (!videoModal || !videoFrame) return; videoFrame.src = `${button.dataset.video}?autoplay=1`; videoModal.classList.remove('invisible','opacity-0'); videoModal.setAttribute('aria-hidden','false'); document.body.classList.add('modal-open'); }));
  document.querySelector('[data-close-video]')?.addEventListener('click', closeVideo); videoModal?.addEventListener('click', e => { if(e.target===videoModal) closeVideo(); });

  document.querySelectorAll('[data-faq-button]').forEach(button => button.addEventListener('click', () => {
    const panel = button.nextElementSibling; const icon = button.querySelector('.faq-icon'); const open = Boolean(panel.style.maxHeight);
    document.querySelectorAll('[data-faq-panel]').forEach(p => p.style.maxHeight=''); document.querySelectorAll('.faq-icon').forEach(i => i.textContent='+');
    if(!open){ panel.style.maxHeight = `${panel.scrollHeight}px`; if(icon) icon.textContent='−'; }
  }));

  const search = document.getElementById('journalSearch'); const cards = [...document.querySelectorAll('[data-journal-card]')]; const empty = document.getElementById('journalEmpty');
  if(search){ const params=new URLSearchParams(location.search); search.value=params.get('q')||''; const run=()=>{const q=search.value.trim().toLowerCase(); let count=0; cards.forEach(card=>{const show=!q||(card.dataset.searchable||'').includes(q);card.classList.toggle('is-hidden',!show);if(show)count++;});empty?.classList.toggle('hidden',count>0);}; search.addEventListener('input',run); run(); }

  const form = document.getElementById('contactForm');
  form?.addEventListener('submit', e => {
    e.preventDefault(); let valid=true;
    form.querySelectorAll('[required]').forEach(field => { const msg=field.parentElement.querySelector('.field-message'); let text=''; if(!field.value.trim()) text='This field is required.'; else if(field.type==='email' && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(field.value)) text='Enter a valid email address.'; field.classList.toggle('field-error',Boolean(text)); if(msg) msg.textContent=text; if(text) valid=false; });
    const success=document.getElementById('formSuccess'); success?.classList.toggle('hidden',!valid); if(valid){form.reset(); success?.scrollIntoView({behavior:'smooth',block:'center'});}
  });

  document.addEventListener('keydown', e => { if(e.key==='Escape'){closeLightbox();closeVideo();} });
});