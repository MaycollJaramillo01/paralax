/* =========================================================================
 * header-3.js — Header flotante reutilizando App.Modules.Nav
 * ========================================================================= */

(function (global) {
  'use strict';

  const App = global.App || (global.App = {});
  const NavService = App.Modules && App.Modules.Nav;

  if (!NavService) {
    console.warn('[header-3] NavService no disponible.');
    return;
  }

  const controller = NavService.register({
    id: 'header-3',
    header: '.header-floating',
    menu: '#mobile-menu',
    panel: '.menu-panel',
    toggle: '#menu-toggle',
    close: ['#menu-close'],
    overlay: '#menu-overlay',
    scrollClasses: { scrolled: 'scrolled', down: 'scrolling-down', up: 'scrolling-up' },
    onScroll: ({ y, goingDown, controller }) => {
      const header = controller?.elements.header;
      if (!header) return;
      header.style.opacity = goingDown && y > 150 ? '0.95' : '1';
    },
  });

  if (!controller) return;

  global.Header3 = controller;
})(window);
