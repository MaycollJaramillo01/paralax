/* =========================================================================
 * header-hero.js — Drawer hero integrado con App.Modules.Nav
 * ========================================================================= */

(function (global, d) {
  'use strict';

  const App = global.App || (global.App = {});
  const NavService = App.Modules && App.Modules.Nav;

  const header = d.querySelector('.header-hero.hh');
  const drawer = d.getElementById('hh-drawer');

  if (!NavService || !header || !drawer) return;

  const controller = NavService.register({
    id: 'header-hero',
    header,
    menu: drawer,
    panel: '.hh__drawer-panel',
    toggle: '#hh-burger',
    close: ['.hh__close'],
    overlay: '#hh-drawer',
    scrollThreshold: 8,
    onOpen: (ctrl) => {
      drawer.removeAttribute('hidden');
      drawer.setAttribute('open', '');
      ctrl?.elements.toggle?.setAttribute('aria-expanded', 'true');
      d.documentElement.classList.add('hero-blur-active');
      focusFirstLink(drawer);
    },
    onClose: (ctrl) => {
      drawer.removeAttribute('open');
      ctrl?.elements.toggle?.setAttribute('aria-expanded', 'false');
      d.documentElement.classList.remove('hero-blur-active');
      setTimeout(() => drawer.setAttribute('hidden', ''), 250);
    },
    onScroll: ({ controller }) => {
      controller?.elements.header?.classList.toggle('is-scrolled', (global.scrollY || 0) > 8);
    },
  });

  if (!controller) return;

  App.Bus?.on?.('menu:close', () => controller.close());
  App.Bus?.on?.('menu:open', () => controller.open());

  function focusFirstLink(container) {
    setTimeout(() => {
      const first = container.querySelector('a,button');
      first && first.focus();
    }, 50);
  }

  drawer.addEventListener('click', (e) => {
    if (e.target === drawer) controller.close();
  });

  const panel = drawer.querySelector('.hh__drawer-panel');
  if (panel) {
    panel.addEventListener('wheel', (e) => {
      const atTop = panel.scrollTop === 0 && e.deltaY < 0;
      const atBottom = Math.ceil(panel.scrollTop + panel.clientHeight) >= panel.scrollHeight && e.deltaY > 0;
      if (atTop || atBottom) e.preventDefault();
    }, { passive: false });
  }

  global.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && controller.isOpen()) controller.close();
  });

  // Refresh parallax when ready
  d.addEventListener('DOMContentLoaded', () => {
    if (global.ParallaxKit?.refresh) {
      try { global.ParallaxKit.refresh(); } catch (_) {}
    }
  });
})(window, document);
