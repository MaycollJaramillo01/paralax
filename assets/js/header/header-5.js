// Header-5 PillNav (accesible, responsive)
(function (w, d) {
  'use strict';
  const root   = d.querySelector('.h5[data-header="pill"]');
  if (!root) return;

  const burger = root.querySelector('#h5-burger');
  const nav    = root.querySelector('#h5-nav');
  const ddBtns = root.querySelectorAll('.h5__item--dd > .h5__link');

  // Toggle mobile panel
  const togglePanel = (open) => {
    const state = open ?? root.getAttribute('data-open') !== 'true';
    root.setAttribute('data-open', state);
    burger.setAttribute('aria-expanded', state);
    if (!state) closeAllDropdowns();
  };

  burger.addEventListener('click', () => togglePanel());

  // Dropdowns
  const closeAllDropdowns = () => ddBtns.forEach(b => b.setAttribute('aria-expanded', 'false'));
  ddBtns.forEach(btn => {
    btn.setAttribute('aria-expanded', 'false');
    btn.addEventListener('click', (e) => {
      // en mobile abrimos sin overlay adicional
      const isOpen = btn.getAttribute('aria-expanded') === 'true';
      closeAllDropdowns();
      btn.setAttribute('aria-expanded', String(!isOpen));
      e.stopPropagation();
    });
  });

  // Cerrar al hacer click fuera
  d.addEventListener('click', (e) => {
    if (!root.contains(e.target)) {
      closeAllDropdowns();
      togglePanel(false);
    }
  });

  // Escape
  d.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
      closeAllDropdowns();
      togglePanel(false);
      burger.focus();
    }
  });

  // Mejoras al hacer scroll (sombra sutil)
  const onScroll = () => {
    const sc = w.scrollY || d.documentElement.scrollTop;
    root.classList.toggle('is-scrolled', sc > 8);
  };
  w.addEventListener('scroll', onScroll, { passive: true });
  onScroll();
})(window, document);
