/* =========================================================================
 * modules/nav.js — Servicio centralizado de navegación/header
 * Consolida lógica de menús móviles, focus trap y sincronización con App.Bus
 * ========================================================================= */

(function (global) {
  'use strict';

  const App = global.App || (global.App = {});
  const Modules = App.Modules || (App.Modules = {});
  const d = global.document;

  const fallbackUtils = {
    qs(sel, ctx = d) { return ctx ? ctx.querySelector(sel) : null; },
    qsa(sel, ctx = d) { return Array.prototype.slice.call(ctx ? ctx.querySelectorAll(sel) : []); },
    on(el, evt, fn, opts) { el && el.addEventListener(evt, fn, opts); },
    off(el, evt, fn, opts) { el && el.removeEventListener(evt, fn, opts); },
    toggleClass(el, cls, force) { if (el && el.classList) el.classList.toggle(cls, force); },
  };

  Modules.Nav = (function () {
    const controllers = new Map();
    const bus = App.Bus || null;

    function emit(evt, payload) {
      try { bus && typeof bus.emit === 'function' && bus.emit(evt, payload); }
      catch (err) { console.error('[Nav] emit error', err); }
    }

    function register(config = {}) {
      if (!config.id) {
        config.id = `nav-${controllers.size + 1}`;
      }
      if (controllers.has(config.id)) return controllers.get(config.id);

      const utils = config.utils || App.Utils || fallbackUtils;
      const ctx = config.context || d;
      const header = resolveEl(config.header, ctx, utils);
      const menu = resolveEl(config.menu, ctx, utils) || header;
      if (!menu) {
        console.warn('[Nav] menú no encontrado para', config.id);
        return null;
      }

      const toggle = resolveEl(config.toggle, ctx, utils);
      const closes = ([]).concat(config.close || [])
        .map(sel => resolveEl(sel, ctx, utils))
        .filter(Boolean);
      const overlay = resolveEl(config.overlay, ctx, utils);
      const panel = resolveEl(config.panel, menu || ctx, utils) || menu;

      const state = {
        id: config.id,
        open: false,
        options: Object.assign({
          openClass: config.openClass || 'open',
          lockScroll: config.lockScroll !== false,
          trapFocus: config.trapFocus !== false,
          preventOverscroll: config.preventOverscroll !== false,
          autoCloseBreakpoints: config.autoCloseBreakpoints || [],
          overlayCloses: config.overlayCloses !== false,
          ariaHidden: config.ariaHidden !== false,
          scrollThreshold: config.scrollThreshold || 60,
          scrollClasses: Object.assign({
            scrolled: 'is-scrolled',
            down: 'scroll-down',
            up: 'scroll-up',
          }, config.scrollClasses || {}),
        }, config),
        utils,
        header,
        menu,
        toggle,
        overlay,
        panel,
        closeButtons: closes,
        removeFns: [],
        lastScroll: global.scrollY || 0,
      };
      const controller = {
        id: config.id,
        open: () => openMenu(state),
        close: () => closeMenu(state),
        toggle(force) { toggleMenu(state, force); },
        isOpen: () => state.open,
        updateScrollState: () => updateScrollState(state),
        destroy: () => destroyController(state),
        elements: { header, menu, toggle, overlay, panel },
        options: state.options,
      };

      state.controller = controller;
      bindInteractions(state);

      controllers.set(config.id, controller);
      emit('nav:registered', { id: controller.id, controller });
      return controller;
    }

    function resolveEl(selOrEl, ctx, utils) {
      if (!selOrEl) return null;
      if (typeof selOrEl === 'string') return utils.qs(selOrEl, ctx);
      if (selOrEl instanceof global.HTMLElement) return selOrEl;
      return null;
    }

    function bindInteractions(state) {
      const { utils, toggle, closeButtons, overlay, menu, options } = state;

      const closeHandler = () => closeMenu(state);

      if (toggle) {
        const toggleHandler = () => toggleMenu(state);
        utils.on(toggle, 'click', toggleHandler);
        state.removeFns.push(() => utils.off(toggle, 'click', toggleHandler));
      }

      closeButtons.forEach((btn) => {
        utils.on(btn, 'click', closeHandler);
        state.removeFns.push(() => utils.off(btn, 'click', closeHandler));
      });

      if (overlay) {
        const overlayHandler = (e) => {
          if (options.overlayCloses === 'any' || e.target === overlay) {
            closeMenu(state);
          }
        };
        utils.on(overlay, 'click', overlayHandler);
        state.removeFns.push(() => utils.off(overlay, 'click', overlayHandler));
      }

      if (options.preventOverscroll && state.panel) {
        const wheelOpts = { passive: false };
        const wheelHandler = (e) => {
          const el = state.panel;
          const atTop = el.scrollTop === 0 && e.deltaY < 0;
          const atBottom = Math.ceil(el.scrollTop + el.clientHeight) >= el.scrollHeight && e.deltaY > 0;
          if (atTop || atBottom) e.preventDefault();
        };
        utils.on(state.panel, 'wheel', wheelHandler, wheelOpts);
        state.removeFns.push(() => utils.off(state.panel, 'wheel', wheelHandler, wheelOpts));
      }

      const keyHandler = (e) => {
        if (e.key === 'Escape' && state.open) closeMenu(state);
        if (state.open && state.options.trapFocus) handleFocusTrap(e, state);
      };
      utils.on(global, 'keydown', keyHandler);
      state.removeFns.push(() => utils.off(global, 'keydown', keyHandler));

      const scrollOpts = { passive: true };
      const scrollHandler = () => updateScrollState(state);
      utils.on(global, 'scroll', scrollHandler, scrollOpts);
      state.removeFns.push(() => utils.off(global, 'scroll', scrollHandler, scrollOpts));
      scrollHandler();

      if (bus && state.options.autoCloseBreakpoints.length) {
        const off = bus.on('breakpoint:change', ({ current }) => {
          if (state.options.autoCloseBreakpoints.includes(current)) closeMenu(state);
        });
        state.removeFns.push(off);
      }
    }

    function toggleMenu(state, force) {
      const shouldOpen = typeof force === 'boolean' ? force : !state.open;
      if (shouldOpen) openMenu(state);
      else closeMenu(state);
    }

    function openMenu(state) {
      if (state.open) return;
      state.open = true;
      state.menu && state.menu.classList.add(state.options.openClass);
      if (state.options.ariaHidden && state.menu) state.menu.setAttribute('aria-hidden', 'false');
      if (state.toggle) state.toggle.setAttribute('aria-expanded', 'true');
      if (state.options.lockScroll) d.body.style.overflow = 'hidden';
      focusFirst(state);
      emit('nav:open', { id: state.id, controller: state.controller });
      state.options.onOpen && state.options.onOpen(state.controller);
    }

    function closeMenu(state) {
      if (!state.open) return;
      state.open = false;
      state.menu && state.menu.classList.remove(state.options.openClass);
      if (state.options.ariaHidden && state.menu) state.menu.setAttribute('aria-hidden', 'true');
      if (state.toggle) state.toggle.setAttribute('aria-expanded', 'false');
      if (state.options.lockScroll) d.body.style.overflow = '';
      state.toggle && setTimeout(() => state.toggle.focus(), 10);
      emit('nav:close', { id: state.id, controller: state.controller });
      state.options.onClose && state.options.onClose(state.controller);
    }

    function focusFirst(state) {
      if (!state.options.trapFocus || !state.menu) return;
      setTimeout(() => {
        const focusables = getFocusable(state.menu);
        focusables[0] && focusables[0].focus();
      }, 40);
    }

    function getFocusable(container) {
      return Array.prototype.slice.call(container.querySelectorAll(
        'a[href], button, textarea, input, select, [tabindex]:not([tabindex="-1"])'
      )).filter((el) => !el.disabled && el.offsetParent !== null);
    }

    function handleFocusTrap(e, state) {
      if (e.key !== 'Tab' || !state.menu) return;
      const focusables = getFocusable(state.menu);
      if (!focusables.length) return;
      const first = focusables[0];
      const last = focusables[focusables.length - 1];
      if (e.shiftKey && d.activeElement === first) {
        e.preventDefault();
        last.focus();
      } else if (!e.shiftKey && d.activeElement === last) {
        e.preventDefault();
        first.focus();
      }
    }

    function updateScrollState(state) {
      if (!state.header) return;
      const y = global.scrollY || global.pageYOffset || 0;
      const goingDown = y > state.lastScroll;
      const scrolled = y > state.options.scrollThreshold;
      state.header.classList.toggle(state.options.scrollClasses.scrolled, scrolled);
      state.header.classList.toggle(state.options.scrollClasses.down, goingDown);
      state.header.classList.toggle(state.options.scrollClasses.up, !goingDown);
      state.lastScroll = y;
      state.options.onScroll && state.options.onScroll({ y, goingDown, scrolled, controller: state.controller });
    }

    function destroyController(state) {
      closeMenu(state);
      state.removeFns.forEach((off) => { try { typeof off === 'function' && off(); } catch (_) {} });
      state.removeFns.length = 0;
      controllers.delete(state.id);
    }

    function get(id) {
      return controllers.get(id) || null;
    }

    function closeAll() {
      controllers.forEach((controller) => controller.close());
    }

    return {
      register,
      get,
      closeAll,
    };
  })();
})(window);
