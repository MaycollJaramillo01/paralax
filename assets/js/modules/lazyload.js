/*!
 * lazyload.js — Universal Lazy Loader (images, bg, video, iframe)
 * Author: Maycoll Jaramillo (Maven Marketing)
 * Vanilla JS, zero dependencies. Production-ready.
 *
 * Atributos soportados por elemento:
 *  <img
 *    data-src="img.webp"
 *    data-src-fallback="img.jpg"
 *    data-srcset="img-480.webp 480w, img-960.webp 960w"
 *    data-sizes="(max-width:768px) 100vw, 960px"
 *    data-decoding="async" data-fetchpriority="low"
 *    data-lqip="img-blur.jpg" data-blur-up="true"
 *    data-retry="2" data-timeout="12000"
 *    alt="..." loading="lazy"
 *  />
 *
 *  <div data-bg="hero.webp" data-bg-fallback="hero.jpg"
 *       data-bgset="hero-640.webp 640w, hero-1280.webp 1280w"
 *       data-bgpos="center/cover" data-blur-up="true"></div>
 *
 *  <video data-src="clip.mp4" data-poster="poster.jpg" muted playsinline></video>
 *
 *  <iframe data-src="https://maps.google.com/..." data-title="Map"></iframe>
 *
 *  <a data-prefetch href="/services.php">Services</a>
 *
 * API:
 *   LazyLoad.init(options?)
 *   LazyLoad.observe(node)
 *   LazyLoad.unobserve(node)
 *   LazyLoad.refresh()
 */


(function (global) {
  "use strict";

  const App = global.App || (global.App = {});
  const Modules = App.Modules || (App.Modules = {});
  const d = global.document;

  const cfg = {
    root: null,
    rootMargin: "0px 0px 200px 0px",
    threshold: [0, 0.01],
    maxRetries: 2,
    timeout: 12000,
    passive: { passive: true },
    selector: {
      candidates:
        "img[data-src],img[data-srcset],iframe[data-src],video[data-src],[data-bg],[data-bgset],[data-prefetch]",
    },
    classes: {
      init: "ll-init",
      loading: "ll-loading",
      loaded: "ll-loaded",
      error: "ll-error",
      blur: "ll-blur",
    },
  };

  const state = {
    io: null,
    ioVisible: null,
    items: new Set(),
    reduced: matchMedia("(prefers-reduced-motion: reduce)").matches,
    supportsIO: "IntersectionObserver" in global,
    supportsFetchPri: "fetchPriority" in HTMLImageElement.prototype,
    supportsDecode: "decode" in HTMLImageElement.prototype,
  };

  const on = (el, ev, fn, opt) => el.addEventListener(ev, fn, opt || false);
  const off = (el, ev, fn, opt) => el.removeEventListener(ev, fn, opt || false);
  const $all = (sel, ctx = d) => Array.from(ctx.querySelectorAll(sel));
  const setStyle = (el, cssText) => { el.style.cssText += ";" + cssText; };
  const isInDOM = (el) => !!(el && (el.isConnected || d.body.contains(el)));
  const once = (el, ev, fn, opt) => {
    const wrap = (e) => { off(el, ev, wrap, opt); fn(e); };
    on(el, ev, wrap, opt);
  };

  /* ---------------------------
   * Preload helpers
   * --------------------------*/
  function withTimeout(promise, ms, onAbort) {
    let t;
    const timeout = new Promise((_, rej) => {
      t = setTimeout(() => { rej(new Error("LL_TIMEOUT")); onAbort && onAbort(); }, ms);
    });
    return Promise.race([promise, timeout]).finally(() => clearTimeout(t));
  }

  function loadImage(src, fetchPriority) {
    return new Promise((res, rej) => {
      const img = new Image();
      if (fetchPriority && "fetchPriority" in img) img.fetchPriority = fetchPriority;
      img.onload = () => res(img);
      img.onerror = rej;
      img.src = src;
    });
  }

  function applyLQIP(el) {
    const { lqip, blurUp } = readData(el, ["lqip", "blurUp"]);
    if (!lqip) return;
    if (el.tagName === "IMG") {
      el.src = lqip;
      if (blurUp) el.classList.add(cfg.classes.blur);
    } else {
      el.style.setProperty("--ll-bg", `url("${lqip}")`);
      el.style.backgroundImage = `var(--ll-bg)`;
      if (blurUp) el.classList.add(cfg.classes.blur);
    }
  }

  function clearBlur(el) {
    el.classList.remove(cfg.classes.blur);
  }

  function readData(el, keys) {
    const out = {};
    keys.forEach((k) => {
      const attr = "data-" + k.replace(/[A-Z]/g, (m) => "-" + m.toLowerCase());
      const val = el.getAttribute(attr);
      if (val !== null) out[k] = val;
    });
    return out;
  }

  function setStatus(el, status) {
    el.classList.remove(cfg.classes.loading, cfg.classes.loaded, cfg.classes.error);
    if (status) el.classList.add(status);
  }

  /* ---------------------------
   * Image / BG / Video / Iframe loaders
   * --------------------------*/
  async function loadIMG(el) {
    setStatus(el, cfg.classes.loading);
    applyLQIP(el);

    const {
      src,
      srcFallback,
      srcset,
      sizes,
      decoding = "async",
      fetchpriority = "low",
      retry,
      timeout,
    } = readData(el, [
      "src",
      "srcFallback",
      "srcset",
      "sizes",
      "decoding",
      "fetchpriority",
      "retry",
      "timeout",
    ]);

    if (decoding && el.decoding !== undefined) {
      try { el.decoding = decoding; } catch (_) {}
    }
    if (fetchpriority && state.supportsFetchPri) {
      try { el.fetchPriority = fetchpriority; } catch (_) {}
    }

    // Asignar srcset/sizes antes de src para comportamiento responsive
    if (srcset) el.setAttribute("srcset", srcset);
    if (sizes) el.setAttribute("sizes", sizes);

    const tries = Math.max(parseInt(retry || cfg.maxRetries, 10), 0);
    const to = Math.max(parseInt(timeout || cfg.timeout, 10), 0) || cfg.timeout;

    let lastErr = null;
    const candidates = [src, srcFallback].filter(Boolean);

    for (let c = 0; c < candidates.length; c++) {
      const candidate = candidates[c];
      for (let i = 0; i <= tries; i++) {
        try {
          if (!candidate) throw new Error("LL_NO_SRC");
          // Pre-carga con timeout
          await withTimeout(loadImage(candidate, fetchpriority), to, () => {});
          // Asignar destino final
          el.src = candidate;
          if (state.supportsDecode && typeof el.decode === "function") {
            try { await withTimeout(el.decode(), to, () => {}); } catch (_) { /* ignore decode errors */ }
          }
          setStatus(el, cfg.classes.loaded);
          clearBlur(el);
          el.removeAttribute("data-src");
          el.removeAttribute("data-src-fallback");
          return true;
        } catch (err) {
          lastErr = err;
          await new Promise((r) => setTimeout(r, 150 * (i + 1))); // backoff leve
        }
      }
    }

    setStatus(el, cfg.classes.error);
    console.warn("[lazyload] IMG error:", lastErr, el);
    return false;
  }

  async function loadBG(el) {
    setStatus(el, cfg.classes.loading);
    applyLQIP(el);
    const { bg, bgFallback, bgset, bgpos = "center/cover", retry, timeout } = readData(el, [
      "bg",
      "bgFallback",
      "bgset",
      "bgpos",
      "retry",
      "timeout",
    ]);
    el.style.background = `${bgpos} no-repeat`;

    const tries = Math.max(parseInt(retry || cfg.maxRetries, 10), 0);
    const to = Math.max(parseInt(timeout || cfg.timeout, 10), 0) || cfg.timeout;

    // Si hay bgset (srcset para background) selecciona el mejor candidato por width actual
    const candidates = [];
    if (bgset) {
      try {
        // Parse: "img-640.webp 640w, img-1280.webp 1280w"
        bgset.split(",").forEach((part) => {
          const [url, w] = part.trim().split(/\s+/);
          const width = parseInt((w || "0").replace("w", ""), 10) || 0;
          candidates.push({ url, width });
        });
        candidates.sort((a, b) => a.width - b.width);
        const needed = Math.max(innerWidth, innerHeight);
        let pick = candidates.find((c) => c.width >= needed) || candidates[candidates.length - 1];
        if (pick?.url) candidates.length = 0, candidates.push({ url: pick.url });
      } catch (_) {
        // Si falla el parse, volver a bg
      }
    }
    if (!candidates.length) candidates.push({ url: bg }, { url: bgFallback });

    let lastErr = null;
    for (let c = 0; c < candidates.length; c++) {
      const candidate = candidates[c].url;
      if (!candidate) continue;
      for (let i = 0; i <= tries; i++) {
        try {
          await withTimeout(loadImage(candidate, "low"), to, () => {});
          el.style.setProperty("--ll-bg", `url("${candidate}")`);
          el.style.backgroundImage = `var(--ll-bg)`;
          setStatus(el, cfg.classes.loaded);
          clearBlur(el);
          el.removeAttribute("data-bg");
          el.removeAttribute("data-bg-fallback");
          el.removeAttribute("data-bgset");
          return true;
        } catch (err) {
          lastErr = err;
          await new Promise((r) => setTimeout(r, 150 * (i + 1)));
        }
      }
    }

    setStatus(el, cfg.classes.error);
    console.warn("[lazyload] BG error:", lastErr, el);
    return false;
  }

  async function loadIFRAME(el) {
    setStatus(el, cfg.classes.loading);
    const { src, title, retry, timeout } = readData(el, ["src", "title", "retry", "timeout"]);
    const tries = Math.max(parseInt(retry || cfg.maxRetries, 10), 0);
    const to = Math.max(parseInt(timeout || cfg.timeout, 10), 0) || cfg.timeout;

    // Pre-carga con una HEAD para comprobar disponibilidad (opcional)
    let lastErr = null;
    for (let i = 0; i <= tries; i++) {
      try {
        // no fetch externo (CORS), simplemente cargar directamente
        await withTimeout(
          new Promise((res, rej) => {
            const cleanup = () => {
              off(el, "load", onload);
              off(el, "error", onerror);
            };
            const onload = () => { cleanup(); res(true); };
            const onerror = (e) => { cleanup(); rej(e); };
            on(el, "load", onload);
            on(el, "error", onerror);
            if (title) el.title = title;
            el.src = src;
          }),
          to,
          () => {}
        );
        setStatus(el, cfg.classes.loaded);
        el.removeAttribute("data-src");
        return true;
      } catch (err) {
        lastErr = err;
        await new Promise((r) => setTimeout(r, 150 * (i + 1)));
      }
    }
    setStatus(el, cfg.classes.error);
    console.warn("[lazyload] IFRAME error:", lastErr, el);
    return false;
  }

  async function loadVIDEO(el) {
    setStatus(el, cfg.classes.loading);
    const { src, poster, retry } = readData(el, ["src", "poster", "retry"]);
    const tries = Math.max(parseInt(retry || 1, 10), 0);

    if (poster) el.poster = poster;

    let ok = false;
    for (let i = 0; i <= tries; i++) {
      try {
        const source = d.createElement("source");
        source.src = src;
        el.appendChild(source);
        await el.load();
        setStatus(el, cfg.classes.loaded);
        el.removeAttribute("data-src");
        ok = true;
        break;
      } catch (e) {
        await new Promise((r) => setTimeout(r, 150 * (i + 1)));
      }
    }
    if (!ok) setStatus(el, cfg.classes.error);

    // pausar/reanudar según visibilidad
    once(el, "canplay", () => {
      // nada, usuario decide play; en autoplay muted podría iniciarse
    });
    return ok;
  }

  /* ---------------------------
   * Observer setup
   * --------------------------*/
  function createObservers() {
    if (state.io) { state.io.disconnect(); state.io = null; }
    if (state.ioVisible) { state.ioVisible.disconnect(); state.ioVisible = null; }

    if (state.supportsIO) {
      state.io = new IntersectionObserver(onIO, {
        root: cfg.root,
        rootMargin: cfg.rootMargin,
        threshold: cfg.threshold,
      });

      // Para pausar videos si salen de viewport
      state.ioVisible = new IntersectionObserver(onVisibility, {
        root: cfg.root,
        rootMargin: "0px",
        threshold: [0, 0.2, 0.6, 1],
      });
    }
  }

  function onIO(entries) {
    entries.forEach((entry) => {
      const el = entry.target;
      if (!entry.isIntersecting) return;

      // Dejar de observar para evitar recargas
      state.io.unobserve(el);
      loadNode(el);
    });
  }

  function onVisibility(entries) {
    entries.forEach((e) => {
      const el = e.target;
      if (el.tagName !== "VIDEO") return;
      if (e.intersectionRatio < 0.2 && !el.paused) {
        el.pause();
      } else if (e.intersectionRatio >= 0.6 && el.paused && el.autoplay) {
        // solo auto-play videos con autoplay para evitar reproducir manuales
        el.play().catch(() => {});
      }
    });
  }

  /* ---------------------------
   * Core: loadNode segun tipo
   * --------------------------*/
  function loadNode(el) {
    if (!isInDOM(el)) return;

    if (el.matches("img[data-src], img[data-srcset]")) {
      return loadIMG(el);
    }
    if (el.hasAttribute("data-bg") || el.hasAttribute("data-bgset")) {
      return loadBG(el);
    }
    if (el.matches("iframe[data-src]")) {
      return loadIFRAME(el);
    }
    if (el.matches("video[data-src]")) {
      if (state.ioVisible) state.ioVisible.observe(el);
      return loadVIDEO(el);
    }
    if (el.matches("a[data-prefetch]")) {
      return setupPrefetch(el);
    }
    return false;
  }

  /* ---------------------------
   * Prefetch en hover/focus
   * --------------------------*/
  function setupPrefetch(a) {
    const href = a.getAttribute("href");
    if (!href) return;
    let done = false;

    const addLink = () => {
      if (done) return;
      done = true;
      const l = d.createElement("link");
      l.rel = "prefetch";
      l.href = href;
      l.as = "document";
      d.head.appendChild(l);
    };
    on(a, "mouseenter", addLink, cfg.passive);
    on(a, "focus", addLink, cfg.passive);
  }

  /* ---------------------------
   * Public API
   * --------------------------*/
  const LazyLoad = {
    init(options = {}) {
      Object.assign(cfg, options || {});
      createObservers();

      // Marcar candidatos y observar
      $all(cfg.selector.candidates).forEach((el) => {
        if (el.classList.contains(cfg.classes.loaded)) return;
        el.classList.add(cfg.classes.init);
        if (state.supportsIO) state.io.observe(el);
        else {
          // Fallback sin IO: cargar cuando se acerque por scroll
          // aquí disparamos inmediatamente si ya está cerca por simple bounding
          const rect = el.getBoundingClientRect();
          if (rect.top < innerHeight + 200) loadNode(el);
        }
      });

      // Fallback continuo sin IO
      if (!state.supportsIO) {
        const onScroll = () => {
          $all(cfg.selector.candidates).forEach((el) => {
            if (el.classList.contains(cfg.classes.loaded)) return;
            const r = el.getBoundingClientRect();
            if (r.top < innerHeight + 200) loadNode(el);
          });
        };
        on(window, "scroll", onScroll, cfg.passive);
        on(window, "resize", onScroll, cfg.passive);
      }

      // Auto-observar nodos añadidos dinámicamente
      const mo = new MutationObserver((muts) => {
        muts.forEach((m) => {
          m.addedNodes && m.addedNodes.forEach((n) => {
            if (!(n instanceof Element)) return;
            if (n.matches && n.matches(cfg.selector.candidates)) {
              if (state.supportsIO) state.io.observe(n);
              else loadNode(n);
            }
            // incluir descendientes
            $all(cfg.selector.candidates, n).forEach((el) => {
              if (state.supportsIO) state.io.observe(el);
              else loadNode(el);
            });
          });
        });
      });
      mo.observe(d.documentElement, { childList: true, subtree: true });

      return LazyLoad;
    },

    observe(el) {
      if (!el) return;
      if (state.supportsIO) state.io.observe(el);
      else loadNode(el);
    },

    unobserve(el) {
      try { state.io?.unobserve(el); } catch (_) {}
      try { state.ioVisible?.unobserve(el); } catch (_) {}
    },

    refresh() {
      createObservers();
      $all(cfg.selector.candidates).forEach((el) => {
        if (!el.classList.contains(cfg.classes.loaded)) {
          if (state.supportsIO) state.io.observe(el);
          else loadNode(el);
        }
      });
    }
  };

  // Exponer en App.Modules
  App.LazyLoad = LazyLoad;
  App.Lazy = LazyLoad;
  Modules.Lazy = LazyLoad;

})(window);
