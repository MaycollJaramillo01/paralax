/* =========================================================================
 * modules/modal.js — Servicio de modales reutilizable (App.Modules.Modal)
 * ========================================================================= */

(function (global) {
  'use strict';

  const App = global.App || (global.App = {});
  const Modules = App.Modules || (App.Modules = {});
  const d = global.document;

  const fallbackUtils = {
    qsa(sel, ctx = d) { return Array.prototype.slice.call(ctx.querySelectorAll(sel)); },
    qs(sel, ctx = d) { return ctx.querySelector(sel); },
    on(el, evt, fn, opts) { el && el.addEventListener(evt, fn, opts); },
    off(el, evt, fn, opts) { el && el.removeEventListener(evt, fn, opts); },
  };

  Modules.Modal = (function () {
    const defaults = {
      triggerSelector: '[data-modal-target]',
      closeSelector: '.modal-close',
      overlaySelector: '.modal',
      activeClass: 'open',
      lockScroll: true,
    };

    let utils = fallbackUtils;
    let bus = App.Bus || null;
    let cfg = { ...defaults };
    const registry = new Map();

    function resolveDeps(options = {}) {
      utils = options.utils || App.Utils || fallbackUtils;
      bus = options.bus || App.Bus || null;
      cfg = { ...defaults, ...(options.config || {}) };
    }

    function emit(evt, payload) {
      try { bus && typeof bus.emit === 'function' && bus.emit(evt, payload); }
      catch (err) { console.error('[Modal] emit error', err); }
    }

    function init(options = {}) {
      resolveDeps(options);
      const context = options.context || d;
      utils.qsa(cfg.triggerSelector, context).forEach((trigger) => {
        const targetId = trigger.dataset.modalTarget;
        if (!targetId) return;
        if (trigger.__modalBound) return;
        trigger.__modalBound = true;
        utils.on(trigger, 'click', (e) => {
          e.preventDefault();
          open(targetId);
        });
      });

      utils.qsa(cfg.overlaySelector, context).forEach((modal) => registerModal(modal));
    }

    function registerModal(modal) {
      if (!modal || registry.has(modal.id)) return;
      registry.set(modal.id, { el: modal });

      utils.qsa(cfg.closeSelector, modal).forEach((btn) => {
        utils.on(btn, 'click', () => close(modal.id));
      });

      utils.on(modal, 'click', (e) => {
        if (e.target === modal) close(modal.id);
      });
    }

    function open(id) {
      const entry = registry.get(id) || registerAndGet(id);
      if (!entry) return;
      entry.el.classList.add(cfg.activeClass);
      if (cfg.lockScroll) d.body.style.overflow = 'hidden';
      emit('ui:modal:open', id);
      focusFirst(entry.el);
    }

    function close(id) {
      const entry = registry.get(id);
      if (!entry) return;
      entry.el.classList.remove(cfg.activeClass);
      if (cfg.lockScroll) d.body.style.overflow = '';
      emit('ui:modal:close', id);
    }

    function closeAll() {
      registry.forEach((_, id) => close(id));
    }

    function registerAndGet(id) {
      const el = d.getElementById(id);
      if (!el) return null;
      registerModal(el);
      return registry.get(id);
    }

    function focusFirst(modal) {
      setTimeout(() => {
        const focusable = modal.querySelector('a[href], button, textarea, input, select, [tabindex]:not([tabindex="-1"])');
        focusable && focusable.focus();
      }, 40);
    }

    return {
      init,
      register: registerModal,
      open,
      close,
      closeAll,
    };
  })();
})(window);
