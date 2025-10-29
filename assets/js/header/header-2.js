/* =========================================================================
 * header-2.js — Header creativo potenciado por App.Modules.Nav
 * ========================================================================= */

(function (global) {
  'use strict';

  const App = global.App || (global.App = {});
  const NavService = App.Modules && App.Modules.Nav;

  if (!NavService) {
    console.warn('[header-2] NavService no disponible.');
    return;
  }

  const controller = NavService.register({
    id: 'header-2',
    header: '.header-creative',
    menu: '#mobile-menu',
    panel: '.menu-panel',
    toggle: '#menu-toggle',
    close: ['#menu-close'],
    overlay: '#menu-overlay',
    autoCloseBreakpoints: ['lg', 'xl', '2xl'],
    onOpen: () => App.Bus?.emit?.('menu:open', { header: 2 }),
    onClose: () => App.Bus?.emit?.('menu:close', { header: 2 }),
    onScroll: ({ y, controller }) => {
      if (!controller?.elements.header) return;
      controller.elements.header.classList.toggle('scroll-shadow', y > 120);
    },
  });

  if (!controller) return;

  App.Bus?.emit?.('header2:init');

  // Swipe close support
  const panel = controller.elements.panel;
  if (panel) {
    let startX = 0;
    panel.addEventListener('touchstart', (e) => { startX = e.touches[0].clientX; }, { passive: true });
    panel.addEventListener('touchmove', (e) => {
      const dx = e.touches[0].clientX - startX;
      if (dx > 80) controller.close();
    }, { passive: true });
  }

  global.App.Header2 = controller;
})(window);
