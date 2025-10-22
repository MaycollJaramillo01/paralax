/* =========================================================================
 *  nav-enhance.js — Navegación inteligente, scrollspy y accesibilidad
 *  Autor: Maycoll (Maven Marketing)
 *  Descripción:
 *   - Destaca el enlace activo según scroll (scrollspy)
 *   - Gestiona focus y hash dinámicos
 *   - Scroll suave + restauración post-back/forward
 *   - SPA parcial (sin recarga completa)
 *   - Compatible con App.Bus, App.SmoothScroll y Header1
 * ========================================================================= */

(function (global) {
  'use strict';

  // Dependencias del núcleo
  if (!global.App) {
    console.warn('[nav-enhance] App namespace no detectado. Asegúrate de cargar main.js antes.');
    return;
  }

  const { Utils, Bus, SmoothScroll } = global.App;
  const d = document;

  // Configuración
  const cfg = {
    activeClass: 'is-active',
    scrollOffset: 120, // px para compensar el header fijo
    spyThrottle: 100,
    restoreDelay: 200,
  };

  // Estado interno
  const state = {
    links: [],
    sections: [],
    currentId: null,
    observing: false,
    initialized: false,
  };

  // ============================================================
  // Inicialización
  // ============================================================
  function init() {
    if (state.initialized) return;
    state.initialized = true;

    state.links = Utils.qsa('a[href^="#"]').filter(a => {
      const id = a.getAttribute('href').slice(1);
      return !!id && d.getElementById(id);
    });

    if (state.links.length === 0) return;

    state.sections = state.links.map(a => d.getElementById(a.getAttribute('href').slice(1))).filter(Boolean);

    // Enlaces con scroll suave (usa SmoothScroll de main.js)
    state.links.forEach(a => {
      Utils.on(a, 'click', (e) => {
        const id = a.getAttribute('href').slice(1);
        const target = d.getElementById(id);
        if (!target) return;
        e.preventDefault();

        // Cerrar menú móvil si está abierto
        if (global.Header1 && Header1.isOpen()) Header1.close();

        // Smooth scroll
        if (SmoothScroll && SmoothScroll.to) SmoothScroll.to(id);
        else target.scrollIntoView({ behavior: 'smooth', block: 'start' });

        // Actualiza hash sin recargar
        history.pushState(null, '', `#${Utils.encodeHash(id)}`);

        // Marca activo
        updateActive(id);
      });
    });

    // ScrollSpy activo
    Utils.on(global, 'scroll', Utils.throttle(onScrollSpy, cfg.spyThrottle));
    Utils.on(global, 'resize', Utils.debounce(recalculateSections, 200));

    // Restaurar sección activa al cargar con hash
    restoreOnLoad();

    // Integración con navegación SPA parcial (si hay App.Bus)
    Bus.on('nav:update', (data) => {
      if (data && data.hash) updateActive(data.hash);
    });

    state.observing = true;
  }

  // ============================================================
  // ScrollSpy — Detecta sección visible
  // ============================================================
  function onScrollSpy() {
    if (!state.sections.length) return;

    const scrollPos = global.scrollY + cfg.scrollOffset;
    let current = null;

    for (let i = 0; i < state.sections.length; i++) {
      const s = state.sections[i];
      if (!s) continue;
      const top = s.offsetTop;
      const height = s.offsetHeight;
      if (scrollPos >= top && scrollPos < top + height) {
        current = s.id;
        break;
      }
    }

    if (current !== state.currentId) {
      updateActive(current);
    }
  }

  // ============================================================
  // Marca el enlace activo
  // ============================================================
  function updateActive(id) {
    state.currentId = id;
    state.links.forEach(a => {
      const linkId = a.getAttribute('href').slice(1);
      Utils.toggleClass(a, cfg.activeClass, linkId === id);
      // Si está dentro del menú móvil, añade pequeño retraso de highlight
      if (linkId === id && a.closest('.mobile-menu')) {
        a.style.transition = 'color 0.3s ease';
      }
    });

    if (id && state.observing) Bus.emit('nav:active', { id });
  }

  // ============================================================
  // Recalcula posiciones (responsive)
  // ============================================================
  function recalculateSections() {
    state.sections = state.links.map(a => d.getElementById(a.getAttribute('href').slice(1))).filter(Boolean);
    onScrollSpy();
  }

  // ============================================================
  // Restaurar posición al volver (SPA o Back/Forward)
  // ============================================================
  function restoreOnLoad() {
    const hash = decodeURIComponent(location.hash || '').replace('#', '');
    if (!hash) return;
    const el = d.getElementById(hash);
    if (el) {
      setTimeout(() => {
        const y = el.getBoundingClientRect().top + global.scrollY - cfg.scrollOffset;
        global.scrollTo({ top: y, behavior: 'smooth' });
        updateActive(hash);
      }, cfg.restoreDelay);
    }
  }

  // ============================================================
  // API Pública
  // ============================================================
  const API = {
    init,
    updateActive,
    recalculateSections,
    restoreOnLoad,
  };

  global.App.NavEnhance = API;

  // ============================================================
  // Auto-inicialización (DOMContentLoaded)
  // ============================================================
  Utils.on(document, 'DOMContentLoaded', () => {
    try {
      init();
      Bus.emit('nav:ready');
    } catch (e) {
      console.error('[nav-enhance] error:', e);
    }
  });

})(window);
