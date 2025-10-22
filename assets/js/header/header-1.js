/* =========================================================================
 * header-1.js — Control de cabecera moderna (Aurora Template)
 *  Autor: Maycoll (Maven Marketing)
 *  Descripción:
 *   - Controla apertura/cierre del menú móvil
 *   - Bloquea scroll y mantiene foco accesible
 *   - Detecta ESC, click fuera y swipe en móviles
 *   - Sin dependencias externas (vanilla JS)
 *   - Totalmente compatible con main.js y ParallaxKit
 * ========================================================================= */

(function (global) {
  'use strict';
  const d = document;

  // Helpers reutilizables (sin colisión con main.js)
  const $ = (sel, ctx = d) => ctx.querySelector(sel);
  const $$ = (sel, ctx = d) => Array.prototype.slice.call(ctx.querySelectorAll(sel));
  const on = (el, evt, fn, opts) => el && el.addEventListener(evt, fn, opts);
  const off = (el, evt, fn, opts) => el && el.removeEventListener(evt, fn, opts);
  const lockScroll = (state) => { d.body.style.overflow = state ? 'hidden' : ''; };
  const trapFocus = (() => {
    let focusables = [], first, last;
    function update(container) {
      focusables = $$('a[href], button, textarea, input, select, [tabindex]:not([tabindex="-1"])', container)
        .filter(el => !el.disabled && el.offsetParent !== null);
      first = focusables[0];
      last = focusables[focusables.length - 1];
    }
    function handle(e) {
      if (e.key !== 'Tab' || focusables.length === 0) return;
      if (e.shiftKey && d.activeElement === first) { e.preventDefault(); last.focus(); }
      else if (!e.shiftKey && d.activeElement === last) { e.preventDefault(); first.focus(); }
    }
    return { update, handle };
  })();

  // Elementos
  const menuToggle = $('#menu-toggle');
  const mobileMenu = $('#mobile-menu');
  const menuPanel = $('.menu-panel', mobileMenu);
  const menuClose = $('#menu-close');
  const overlay = $('.menu-overlay');
  const header = $('.site-header');
  const focusTrapContainer = menuPanel;

  // Seguridad: si no existe header o menú, salir
  if (!header || !mobileMenu) return;

  let open = false;
  let touchStartX = 0;

  // Apertura
  function openMenu() {
    if (open) return;
    open = true;
    mobileMenu.classList.add('open');
    lockScroll(true);
    trapFocus.update(focusTrapContainer);
    setTimeout(() => {
      try {
        const firstLink = $('.menu-nav a', mobileMenu);
        if (firstLink) firstLink.focus();
      } catch (_) {}
    }, 250);
    if (global.App && App.Bus) App.Bus.emit('menu:open');
  }

  // Cierre
  function closeMenu() {
    if (!open) return;
    open = false;
    mobileMenu.classList.remove('open');
    lockScroll(false);
    if (menuToggle) menuToggle.focus();
    if (global.App && App.Bus) App.Bus.emit('menu:close');
  }

  // Toggle
  function toggleMenu(force) {
    (typeof force === 'boolean') ? (force ? openMenu() : closeMenu()) : (open ? closeMenu() : openMenu());
  }

  // Eventos
  on(menuToggle, 'click', () => toggleMenu(true));
  on(menuClose, 'click', () => toggleMenu(false));
  on(overlay, 'click', () => toggleMenu(false));

  // Escape key
  on(global, 'keydown', (e) => {
    if (e.key === 'Escape' && open) closeMenu();
    if (open) trapFocus.handle(e);
  });

  // Swipe lateral (cerrar)
  on(menuPanel, 'touchstart', (e) => { touchStartX = e.touches[0].clientX; });
  on(menuPanel, 'touchmove', (e) => {
    const dx = e.touches[0].clientX - touchStartX;
    if (dx > 80) closeMenu(); // deslizar hacia derecha cierra
  });

  // Prevención doble scroll
  on(mobileMenu, 'wheel', (e) => {
    const el = menuPanel;
    const atTop = el.scrollTop === 0 && e.deltaY < 0;
    const atBottom = Math.ceil(el.scrollTop + el.clientHeight) >= el.scrollHeight && e.deltaY > 0;
    if (atTop || atBottom) e.preventDefault();
  }, { passive: false });

  // Header animación sticky / scroll direction
  let lastScroll = 0;
  on(global, 'scroll', () => {
    const y = global.scrollY || global.pageYOffset || 0;
    const goingDown = y > lastScroll;
    const scrolled = y > 60;
    header.classList.toggle('is-scrolled', scrolled);
    header.classList.toggle('scroll-down', goingDown);
    header.classList.toggle('scroll-up', !goingDown);
    lastScroll = y;
  });

  // Sincronizar con App.Bus si existe
  if (global.App && App.Bus) {
    App.Bus.on('breakpoint:change', ({ current }) => {
      if (['lg', 'xl', '2xl'].includes(current)) closeMenu(); // auto-cierra en escritorio
    });
  }

  // Animación de hover para desktop links
  $$('nav.nav-desktop a').forEach((a) => {
    on(a, 'mouseenter', () => a.classList.add('hovering'));
    on(a, 'mouseleave', () => a.classList.remove('hovering'));
  });

  // Interfaz pública
  global.Header1 = {
    open: openMenu,
    close: closeMenu,
    toggle: toggleMenu,
    isOpen: () => open
  };

  // ParallaxKit sync si disponible
  on(global, 'DOMContentLoaded', () => {
    if (global.App && App.ParallaxBridge) App.ParallaxBridge.refresh();
  });

})(window);
