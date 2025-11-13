/* =========================================================================
 * header-5.js — PillNav adaptado al servicio App.Modules.Nav
 * ========================================================================= */

(function (global, d) {
  'use strict';

  const App = global.App || (global.App = {});
  const NavService = App.Modules && App.Modules.Nav;
  const root = d.querySelector('.h5[data-header="pill"]');

  if (!NavService || !root) return;

  const controller = NavService.register({
    id: 'header-5',
    header: root,
    menu: root,
    panel: '#h5-nav',
    toggle: '#h5-burger',
    lockScroll: false,
    trapFocus: false,
    preventOverscroll: false,
    overlayCloses: false,
    openClass: 'is-open',
    onOpen: (ctrl) => {
      root.setAttribute('data-open', 'true');
      ctrl?.elements.toggle?.setAttribute('aria-expanded', 'true');
    },
    onClose: (ctrl) => {
      root.setAttribute('data-open', 'false');
      ctrl?.elements.toggle?.setAttribute('aria-expanded', 'false');
      closeAllDropdowns();
    },
  });

  if (!controller) return;

  const burger = root.querySelector('#h5-burger');
  const ddBtns = root.querySelectorAll('.h5__item--dd > .h5__link');

  const closeAllDropdowns = () => ddBtns.forEach((b) => b.setAttribute('aria-expanded', 'false'));

  ddBtns.forEach((btn) => {
    btn.setAttribute('aria-expanded', 'false');
    btn.addEventListener('click', (e) => {
      const isOpen = btn.getAttribute('aria-expanded') === 'true';
      closeAllDropdowns();
      btn.setAttribute('aria-expanded', String(!isOpen));
      e.stopPropagation();
    });
  });

  d.addEventListener('click', (e) => {
    if (!root.contains(e.target)) {
      closeAllDropdowns();
      controller.close();
    }
  });

  d.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
      closeAllDropdowns();
      controller.close();
      burger?.focus();
    }
  });

  const onScroll = () => {
    const sc = global.scrollY || d.documentElement.scrollTop;
    root.classList.toggle('is-scrolled', sc > 8);
  };
  global.addEventListener('scroll', onScroll, { passive: true });
  onScroll();
})(window, document);
