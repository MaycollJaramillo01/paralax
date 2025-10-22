/* =========================================================================
 * header-2.js — Controlador del Header Creative (Aurora Template)
 * Autor: Maycoll Jaramillo (Maven Marketing)
 * =========================================================================
 * Funcionalidades:
 *  - Menú lateral responsive (open/close/ESC/swipe)
 *  - Sticky con animación de dirección de scroll
 *  - Foco accesible dentro del panel
 *  - Sin dependencias externas
 *  - Integración completa con App.Bus y Analytics
 * ========================================================================= */

(function (global) {
  "use strict";

  const d = document;
  const $ = (sel, ctx = d) => ctx.querySelector(sel);
  const $$ = (sel, ctx = d) => Array.from(ctx.querySelectorAll(sel));
  const on = (el, ev, fn, opt) => el && el.addEventListener(ev, fn, opt);
  const off = (el, ev, fn) => el && el.removeEventListener(ev, fn);
  const lockScroll = (lock) => d.body.style.overflow = lock ? "hidden" : "";
  const emit = (e, data) => global.App?.Bus?.emit?.(e, data);

  const Header2 = {
    el: null,
    menu: null,
    panel: null,
    overlay: null,
    btnOpen: null,
    btnClose: null,
    isOpen: false,
    lastScroll: 0,

    init() {
      this.el = $(".header-creative");
      this.menu = $("#mobile-menu");
      this.panel = $(".menu-panel", this.menu);
      this.overlay = $("#menu-overlay");
      this.btnOpen = $("#menu-toggle");
      this.btnClose = $("#menu-close");

      if (!this.el || !this.menu) return console.warn("[header-2.js] header no encontrado");

      this.bindEvents();
      this.scrollHandler();
      emit("header2:init");
    },

    bindEvents() {
      on(this.btnOpen, "click", () => this.toggle(true));
      on(this.btnClose, "click", () => this.toggle(false));
      on(this.overlay, "click", () => this.toggle(false));

      // Escape key
      on(window, "keydown", (e) => {
        if (e.key === "Escape" && this.isOpen) this.toggle(false);
      });

      // Swipe close
      let startX = 0;
      on(this.panel, "touchstart", (e) => startX = e.touches[0].clientX);
      on(this.panel, "touchmove", (e) => {
        const dx = e.touches[0].clientX - startX;
        if (dx > 80) this.toggle(false);
      });

      // Prevent overscroll bounce inside panel
      on(this.panel, "wheel", (e) => {
        const el = this.panel;
        const atTop = el.scrollTop === 0 && e.deltaY < 0;
        const atBottom = Math.ceil(el.scrollTop + el.clientHeight) >= el.scrollHeight && e.deltaY > 0;
        if (atTop || atBottom) e.preventDefault();
      }, { passive: false });
    },

    toggle(force) {
      const open = typeof force === "boolean" ? force : !this.isOpen;
      this.isOpen = open;
      this.menu.classList.toggle("open", open);
      this.menu.setAttribute("aria-hidden", open ? "false" : "true");
      lockScroll(open);

      if (open) {
        emit("menu:open", { header: 2 });
        setTimeout(() => {
          try { $(".menu-nav a", this.menu)?.focus(); } catch (_) {}
        }, 250);
      } else {
        emit("menu:close", { header: 2 });
        this.btnOpen?.focus();
      }
    },

    scrollHandler() {
      let lastY = 0;
      on(window, "scroll", () => {
        const y = window.scrollY || window.pageYOffset;
        const down = y > lastY;
        const scrolled = y > 60;
        this.el.classList.toggle("is-scrolled", scrolled);
        this.el.classList.toggle("scroll-down", down);
        this.el.classList.toggle("scroll-up", !down);
        lastY = y;
      });
    },

    refresh() {
      if (this.isOpen) this.toggle(false);
    }
  };

  // Registro en el ecosistema global
  global.App = global.App || {};
  global.App.Header2 = Header2;

  // Auto-inicialización
  if (d.readyState !== "loading") Header2.init();
  else on(d, "DOMContentLoaded", () => Header2.init());

})(window);
