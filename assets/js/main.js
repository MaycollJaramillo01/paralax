/* =========================================================================
 *  main.js — Núcleo del sitio (runtime base, utilidades y fallbacks)
 *  Autor: Maycoll (Maven Marketing)
 *  Objetivo:
 *    - Cargar utilidades robustas para cualquier página
 *    - Cubrir fallbacks (sin IO, sin smooth-scroll nativo, navegadores viejos)
 *    - Integración segura con ParallaxKit si está presente
 *    - No rompe tu header ni tus parciales
 *  Dependencias: ninguna (opcional: ParallaxKit si existe)
 * ========================================================================= */

(function (global) {
  'use strict';

  // -----------------------------------------------------------------------
  // Namespace
  // -----------------------------------------------------------------------
  const App = (global.App = global.App || {});
  App.version = App.version || '1.0.0';

  // -----------------------------------------------------------------------
  // Feature Detection
  // -----------------------------------------------------------------------
  const Feature = {
    passiveEvents: false,
    smoothScroll: 'scrollBehavior' in document.documentElement.style,
    intersectionObserver: 'IntersectionObserver' in global,
    scrollRestoration: 'scrollRestoration' in history,
    reduceMotion: global.matchMedia && global.matchMedia('(prefers-reduced-motion: reduce)').matches,
    localStorage: (function () {
      try {
        const k = '__test__';
        localStorage.setItem(k, '1');
        localStorage.removeItem(k);
        return true;
      } catch (e) {
        return false;
      }
    })(),
  };

  // Detect passive events support
  try {
    const opts = Object.defineProperty({}, 'passive', {
      get() {
        Feature.passiveEvents = true;
        return true;
      },
    });
    global.addEventListener('test', null, opts);
  } catch (_) {}

  App.Feature = Feature;

  // -----------------------------------------------------------------------
  // Utils
  // -----------------------------------------------------------------------
  const Utils = {
    clamp(n, min, max) { return Math.min(max, Math.max(min, n)); },
    lerp(a, b, t) { return (1 - t) * a + t * b; },
    now() { return (global.performance && performance.now) ? performance.now() : Date.now(); },
    toNumber(v, def = 0) { const n = Number(v); return isNaN(n) ? def : n; },
    uid: (() => { let i = 0; return (p='id') => `${p}-${++i}-${Math.random().toString(36).slice(2,7)}`; })(),
    // DOM
    qs(sel, ctx = document) { return ctx.querySelector(sel); },
    qsa(sel, ctx = document) { return Array.prototype.slice.call(ctx.querySelectorAll(sel)); },
    on(el, evt, fn, opts) { el && el.addEventListener(evt, fn, Feature.passiveEvents ? { passive: true, ...opts } : opts); },
    off(el, evt, fn, opts) { el && el.removeEventListener(evt, fn, opts); },
    css(el, map) { if (!el) return; Object.keys(map).forEach(k => { el.style[k] = map[k]; }); },
    hasClass(el, c) { return el && el.classList && el.classList.contains(c); },
    addClass(el, c) { el && el.classList && el.classList.add(c); },
    remClass(el, c) { el && el.classList && el.classList.remove(c); },
    toggleClass(el, c, force) { el && el.classList && el.classList.toggle(c, force); },
    // Storage seguro
    storage: {
      get(k, def = null) {
        try {
          if (!Feature.localStorage) return def;
          const v = localStorage.getItem(k);
          return v === null ? def : JSON.parse(v);
        } catch (_e) { return def; }
      },
      set(k, v) {
        try {
          if (!Feature.localStorage) return false;
          localStorage.setItem(k, JSON.stringify(v));
          return true;
        } catch (_e) { return false; }
      },
      del(k) {
        try { if (Feature.localStorage) localStorage.removeItem(k); } catch(_e){}
      }
    },
    // Debounce/Throttle
    debounce(fn, wait = 150) {
      let t; return function (...args) { clearTimeout(t); t = setTimeout(() => fn.apply(this, args), wait); };
    },
    throttle(fn, limit = 100) {
      let inThrottle = false, lastArgs = null;
      return function (...args) {
        if (!inThrottle) {
          fn.apply(this, args);
          inThrottle = true;
          setTimeout(() => {
            inThrottle = false;
            if (lastArgs) { fn.apply(this, lastArgs); lastArgs = null; }
          }, limit);
        } else { lastArgs = args; }
      };
    },
    // Focus helpers
    focusSafe(el) { try { el && typeof el.focus === 'function' && el.focus({ preventScroll: true }); } catch (_e) {} },
    // Hash encode
    encodeHash(s) { return encodeURIComponent(String(s)).replace(/%20/g, '+'); },
  };

  App.Utils = Utils;

  // -----------------------------------------------------------------------
  // Event Bus (simple, sin dependencias)
  // -----------------------------------------------------------------------
  const Bus = (() => {
    const map = new Map();
    return {
      on(evt, fn) {
        if (!map.has(evt)) map.set(evt, new Set());
        map.get(evt).add(fn);
        return () => map.get(evt)?.delete(fn);
      },
      off(evt, fn) { map.get(evt)?.delete(fn); },
      emit(evt, data) { (map.get(evt) || []).forEach(fn => { try { fn(data); } catch (e) { console.error('[Bus]', e); } }); },
      clear() { map.clear(); },
    };
  })();

  App.Bus = Bus;

  // -----------------------------------------------------------------------
  // Smooth Scroll (con fallback)
  // -----------------------------------------------------------------------
  const SmoothScroll = (() => {
    const SCROLL_TIME = 380;
    function nativeTo(hash) {
      try {
        const el = document.getElementById(hash) || Utils.qs(`[name="${hash}"]`);
        if (!el) return;
        el.scrollIntoView({ behavior: 'smooth', block: 'start' });
      } catch (_e) {}
    }
    function polyfillTo(hash) {
      const target = document.getElementById(hash) || Utils.qs(`[name="${hash}"]`);
      if (!target) return;
      const start = global.pageYOffset || document.documentElement.scrollTop || 0;
      const rect = target.getBoundingClientRect();
      const to = rect.top + start - 10; // offset leve
      const startT = Utils.now();
      (function step() {
        const t = Utils.clamp((Utils.now() - startT) / SCROLL_TIME, 0, 1);
        const e = Feature.reduceMotion ? t : (t < 0.5 ? 2*t*t : -1+(4-2*t)*t); // easeInOutQuad
        const y = start + (to - start) * e;
        global.scrollTo(0, y);
        if (t < 1) requestAnimationFrame(step);
      })();
    }
    function to(hash) { (Feature.smoothScroll && !Feature.reduceMotion) ? nativeTo(hash) : polyfillTo(hash); }
    function bind() {
      Utils.qsa('a[href^="#"]').forEach(a => {
        Utils.on(a, 'click', (e) => {
          const href = a.getAttribute('href');
          const hash = href && href.slice(1);
          if (!hash) return;
          const el = document.getElementById(hash) || Utils.qs(`[name="${hash}"]`);
          if (!el) return;
          e.preventDefault();
          to(hash);
          history.pushState(null, '', `#${Utils.encodeHash(hash)}`);
          Utils.focusSafe(el);
        });
      });
    }
    return { to, bind };
  })();

  App.SmoothScroll = SmoothScroll;

  // -----------------------------------------------------------------------
  // Intersection Observer Helpers (con fallback de scroll)
  // -----------------------------------------------------------------------
  const IO = (() => {
    const supports = Feature.intersectionObserver;
    const observers = new Map(); // key -> observer
    const entriesMap = new WeakMap(); // el -> {cb, once}

    function observe(sel, cb, options = {}) {
      const once = !!options.once;
      const rootMargin = options.rootMargin || '0px 0px -10% 0px';
      const threshold = options.threshold || [0, 0.1, 0.5, 1];

      if (supports) {
        const key = `${rootMargin}|${Array.isArray(threshold)?threshold.join(','):threshold}`;
        if (!observers.has(key)) {
          observers.set(key, new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
              const meta = entriesMap.get(entry.target);
              if (!meta) return;
              if (entry.isIntersecting || entry.intersectionRatio > 0) {
                try { meta.cb(entry.target, entry); } catch(e){ console.error('[IO]', e); }
                if (meta.once) { observers.get(key).unobserve(entry.target); entriesMap.delete(entry.target); }
              }
            });
          }, { root: null, rootMargin, threshold }));
        }
        const obs = observers.get(key);
        Utils.qsa(sel).forEach(el => {
          entriesMap.set(el, { cb, once });
          obs.observe(el);
        });
        return () => {
          const obs2 = observers.get(key);
          Utils.qsa(sel).forEach(el => obs2 && obs2.unobserve(el));
        };
      }

      // Fallback sin IntersectionObserver: listener de scroll + chequeo de viewport
      const els = Utils.qsa(sel);
      const onScroll = Utils.throttle(() => {
        const vh = global.innerHeight || document.documentElement.clientHeight || 0;
        els.forEach((el) => {
          if (!el || el.__io_done__) return;
          const r = el.getBoundingClientRect();
          if (r.top < vh * 0.9 && r.bottom > 0) {
            try { cb(el, null); } catch (e){ console.error('[IO-fb]', e); }
            if (once) el.__io_done__ = true;
          }
        });
      }, 100);
      Utils.on(global, 'scroll', onScroll);
      Utils.on(global, 'resize', onScroll);
      onScroll();
      return () => {
        Utils.off(global, 'scroll', onScroll);
        Utils.off(global, 'resize', onScroll);
      };
    }

    return { observe };
  })();

  App.IO = IO;

  // -----------------------------------------------------------------------
  // Lazy Load de imágenes (data-src / data-srcset) con fallback
  // -----------------------------------------------------------------------
  const Lazy = (() => {
    function hydrate(el) {
      const src = el.getAttribute('data-src');
      const srcset = el.getAttribute('data-srcset');
      if (src) el.src = src;
      if (srcset) el.srcset = srcset;
      el.removeAttribute('data-src');
      el.removeAttribute('data-srcset');
      el.onload = () => el.classList.add('is-loaded');
      el.onerror = () => el.classList.add('is-error');
    }
    function bind() {
      IO.observe('img[data-src], source[data-srcset]', (el) => {
        if (el.tagName.toLowerCase() === 'img') hydrate(el);
        else if (el.tagName.toLowerCase() === 'source') {
          const srcset = el.getAttribute('data-srcset');
          if (srcset) { el.srcset = srcset; el.removeAttribute('data-srcset'); }
          const parentImg = el.parentElement && el.parentElement.querySelector('img');
          if (parentImg && parentImg.hasAttribute('data-src')) hydrate(parentImg);
        }
      }, { rootMargin: '20% 0px', threshold: [0, 0.01], once: true });
    }
    return { bind };
  })();

  App.Lazy = Lazy;

  // -----------------------------------------------------------------------
  // Breakpoints reactivos (emite eventos al cruzarlos)
  // -----------------------------------------------------------------------
  const Breakpoints = (() => {
    // Personaliza si quieres (siguiendo Tailwind por ejemplo)
    const points = {
      sm: 640,
      md: 768,
      lg: 1024,
      xl: 1280,
      '2xl': 1536,
    };

    let current = get();
    function get() {
      const w = global.innerWidth || document.documentElement.clientWidth || 0;
      if (w >= points['2xl']) return '2xl';
      if (w >= points.xl) return 'xl';
      if (w >= points.lg) return 'lg';
      if (w >= points.md) return 'md';
      if (w >= points.sm) return 'sm';
      return 'xs';
    }
    const onResize = Utils.throttle(() => {
      const next = get();
      if (next !== current) {
        const prev = current;
        current = next;
        Bus.emit('breakpoint:change', { prev, current, width: global.innerWidth });
      }
    }, 120);

    function init() {
      Utils.on(global, 'resize', onResize);
      Bus.emit('breakpoint:ready', { current, width: global.innerWidth });
    }

    return { init, get };
  })();

  App.Breakpoints = Breakpoints;

  // -----------------------------------------------------------------------
  // A11y / Skip-links (corrección para Safari/Chrome)
  // -----------------------------------------------------------------------
  const A11y = (() => {
    function initSkipLinks() {
      Utils.qsa('a[href^="#"]').forEach(a => {
        const id = a.getAttribute('href').slice(1);
        if (!id) return;
        const target = document.getElementById(id);
        if (!target) return;
        a.addEventListener('click', () => {
          if (!target.hasAttribute('tabindex')) target.setAttribute('tabindex', '-1');
          setTimeout(() => Utils.focusSafe(target), 0);
        });
      });
    }
    return { initSkipLinks };
  })();

  App.A11y = A11y;

  // -----------------------------------------------------------------------
  // Header helper (sticky state + clase de scroll) sin tocar tu HTML
  // -----------------------------------------------------------------------
  const HeaderHelper = (() => {
    let lastY = 0;
    const onScroll = Utils.throttle(() => {
      const y = global.scrollY || global.pageYOffset || 0;
      const scrolled = y > 10;
      const header = Utils.qs('.site-header');
      if (header) {
        Utils.toggleClass(header, 'is-scrolled', scrolled);
        // Si quieres shrink visual, tu CSS puede reaccionar a .is-scrolled
      }
      lastY = y;
    }, 80);

    function init() {
      Utils.on(global, 'scroll', onScroll);
      onScroll();
    }

    return { init };
  })();

  App.HeaderHelper = HeaderHelper;

  // -----------------------------------------------------------------------
  // Integración con ParallaxKit (si existe)
  // -----------------------------------------------------------------------
  const ParallaxBridge = (() => {
    function init() {
      if (global.ParallaxKit && typeof global.ParallaxKit.init === 'function') {
        try { global.ParallaxKit.init(); } catch (e) { console.warn('[ParallaxKit.init] error:', e); }
      }
    }
    function refresh() {
      if (global.ParallaxKit && typeof global.ParallaxKit.refresh === 'function') {
        try { global.ParallaxKit.refresh(); } catch (e) { console.warn('[ParallaxKit.refresh] error:', e); }
      }
    }
    return { init, refresh };
  })();

  App.ParallaxBridge = ParallaxBridge;

  // -----------------------------------------------------------------------
  // DOM Ready (seguro)
  // -----------------------------------------------------------------------
  function ready(fn) {
    if (document.readyState === 'complete' || document.readyState === 'interactive') {
      setTimeout(fn, 0);
    } else {
      document.addEventListener('DOMContentLoaded', fn, { once: true });
    }
  }

  // -----------------------------------------------------------------------
  // Inicialización
  // -----------------------------------------------------------------------
  ready(() => {
    // Preferencias usuario (reduced motion)
    if (Feature.reduceMotion) document.documentElement.classList.add('prefers-reduced-motion');

    // Restauración de scroll (evita comportamiento raro al navegar)
    if (Feature.scrollRestoration) { try { history.scrollRestoration = 'manual'; } catch (_e) {} }

    // Bind globales
    SmoothScroll.bind();
    Lazy.bind();
    Breakpoints.init();
    A11y.initSkipLinks();
    HeaderHelper.init();
    ParallaxBridge.init();

    // Exponer eventos listos
    Bus.emit('app:ready', { version: App.version, feature: Feature });
  });

})(window);
