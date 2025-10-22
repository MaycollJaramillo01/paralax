/*!
 * focus-trap.js — Accessible Focus Lock Utility
 * Author: Maycoll Jaramillo
 * Vanilla JS, no dependencies
 *
 * API:
 *   const trap = FocusTrap.create(container, { onEscape, autoFocus, returnFocus });
 *   trap.activate();
 *   trap.deactivate();
 *
 *   FocusTrap.trapAll();   // re-activa traps registrados
 *   FocusTrap.releaseAll();
 */

(function (global, d) {
  "use strict";

  const traps = new Set();
  const focusableSelectors = [
    'a[href]:not([tabindex="-1"])',
    'button:not([disabled]):not([tabindex="-1"])',
    'input:not([disabled]):not([type="hidden"]):not([tabindex="-1"])',
    'select:not([disabled]):not([tabindex="-1"])',
    'textarea:not([disabled]):not([tabindex="-1"])',
    '[tabindex]:not([tabindex="-1"])',
    '[contenteditable="true"]'
  ];

  function getFocusable(container) {
    return Array.from(container.querySelectorAll(focusableSelectors.join(','))).filter(el => !!(el.offsetWidth || el.offsetHeight || el.getClientRects().length));
  }

  class FocusTrap {
    constructor(container, opts = {}) {
      this.container = container;
      this.opts = Object.assign({
        onEscape: null,
        autoFocus: true,
        returnFocus: true
      }, opts);
      this.active = false;
      this.prevFocus = null;
      this.boundHandler = (e) => this.handleKey(e);
    }

    activate() {
      if (this.active) return;
      this.active = true;
      traps.add(this);

      this.prevFocus = d.activeElement;
      if (this.opts.autoFocus) {
        const focusables = getFocusable(this.container);
        if (focusables.length) focusables[0].focus();
      }
      d.addEventListener("keydown", this.boundHandler, true);
    }

    deactivate() {
      if (!this.active) return;
      this.active = false;
      traps.delete(this);
      d.removeEventListener("keydown", this.boundHandler, true);
      if (this.opts.returnFocus && this.prevFocus && typeof this.prevFocus.focus === "function") {
        try { this.prevFocus.focus(); } catch (_) {}
      }
    }

    handleKey(e) {
      if (!this.active) return;
      if (e.key === "Escape" || e.key === "Esc") {
        if (typeof this.opts.onEscape === "function") this.opts.onEscape(e);
        return;
      }

      if (e.key !== "Tab") return;
      const focusables = getFocusable(this.container);
      if (!focusables.length) return;

      const first = focusables[0];
      const last = focusables[focusables.length - 1];
      const current = d.activeElement;

      if (e.shiftKey) {
        if (current === first || !this.container.contains(current)) {
          e.preventDefault();
          last.focus();
        }
      } else {
        if (current === last || !this.container.contains(current)) {
          e.preventDefault();
          first.focus();
        }
      }
    }

    static trapAll() {
      traps.forEach(t => t.activate());
    }

    static releaseAll() {
      traps.forEach(t => t.deactivate());
    }
  }

  // Expose
  global.FocusTrap = {
    create: (container, opts) => new FocusTrap(container, opts),
    trapAll: FocusTrap.trapAll,
    releaseAll: FocusTrap.releaseAll
  };

})(window, document);
