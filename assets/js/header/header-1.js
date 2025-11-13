/* =========================================================================
 * header-1.js — Configuración del header moderno usando App.Modules.Nav
 * ========================================================================= */

(function (global) {
  'use strict';

  const App = global.App || (global.App = {});
  const NavService = App.Modules && App.Modules.Nav;

  if (!NavService) {
    console.warn('[header-1] NavService no disponible. Carga modules/nav.js antes.');
    return;
  }

  const controller = NavService.register({
    id: 'header-1',
    header: '.site-header',
    menu: '#mobile-menu',
    panel: '.menu-panel',
    toggle: '#menu-toggle',
    close: ['#menu-close'],
    overlay: '.menu-overlay',
    autoCloseBreakpoints: ['lg', 'xl', '2xl'],
    onOpen: () => App.Bus?.emit?.('menu:open'),
    onClose: () => App.Bus?.emit?.('menu:close'),
  });

  if (!controller) return;

  // Hover animation for desktop links
  const desktopNav = document.querySelectorAll('nav.nav-desktop a');
  desktopNav.forEach((link) => {
    link.addEventListener('mouseenter', () => link.classList.add('hovering'));
    link.addEventListener('mouseleave', () => link.classList.remove('hovering'));
  });

  // Swipe gesture to close the panel (mobile UX)
  const panel = controller.elements.panel;
  let touchStartX = 0;
  if (panel) {
    panel.addEventListener('touchstart', (e) => { touchStartX = e.touches[0].clientX; }, { passive: true });
    panel.addEventListener('touchmove', (e) => {
      const dx = e.touches[0].clientX - touchStartX;
      if (dx > 80) controller.close();
    }, { passive: true });
  }

  // Public API (legacy compatibility)
  global.Header1 = {
    open: () => controller.open(),
    close: () => controller.close(),
    toggle: (force) => controller.toggle(force),
    isOpen: () => controller.isOpen(),
  };

  // Mantener compatibilidad con parallax refresh
  document.addEventListener('DOMContentLoaded', () => {
    try { App.ParallaxBridge?.refresh?.(); } catch (_) {}
  });
})(window);
