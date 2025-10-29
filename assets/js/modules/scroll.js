/*!
 * scroll.js — Motor centralizado de Parallax/Scroll v4.0
 * Autor original: Maycoll (Maven Marketing)
 * Adaptado para App.Modules.Scroll — GPU-friendly con API pública estable.
 *
 * Cobertura:
 *  - [data-animate]: fade|up|down|left|right|zoom|rotate (+ data-stagger, data-once)
 *  - [data-parallax]: scroll parallax con speed/axis/start/end/rotate/scale/opacity/clamp/context
 *  - [data-parallax-mouse]: parallax por ratón (layers con [data-depth])
 *  - [data-scrub]: mapea props -> from,to (translateX/Y, rotate, scale, opacity, blur, grayscale, hue, clipY)
 *  - [data-pin]: secciones fijadas con var de progreso CSS (--pin-progress)
 *  - [data-counter]: contadores con ease/duration/decimals/locale
 *  - [data-split]: chars|words|lines con stagger
 *  - [data-draw]: dibujado de path SVG on-view
 *  - [data-bg]: precarga near-viewport y setea background-image
 *  - [data-progress]: "width" ó cualquier elemento (setea --scroll-progress)
 *
 *  API Pública: Scroll.init(opts), .refresh(), .setConfig(next), .on(evt, cb), .off(evt, cb), .state
 *  Eventos: parallax:init, parallax:tick, parallax:enter/leave, parallax:reveal, parallax:lazybg
 */

(function (global) {
  "use strict";

  const App = global.App || (global.App = {});
  const Modules = App.Modules || (App.Modules = {});

  // -----------------------------
  // Utils / Helpers
  // -----------------------------
  const doc = global.document;
  const root = doc.documentElement;

  const clamp = (v, min, max) => Math.min(max, Math.max(min, v));
  const lerp = (a, b, n) => (1 - n) * a + n * b;
  const mapRange = (v, inMin, inMax, outMin, outMax) =>
    outMin + ((clamp(v, inMin, inMax) - inMin) * (outMax - outMin)) / (inMax - inMin || 1);

  const on = (el, evt, fn, opt) => el && el.addEventListener(evt, fn, opt || false);
  const off = (el, evt, fn, opt) => el && el.removeEventListener(evt, fn, opt || false);
  const qs = (sel, ctx = doc) => ctx.querySelector(sel);
  const qsa = (sel, ctx = doc) => Array.from(ctx.querySelectorAll(sel));

  const setVar = (n, v, el = root) => el.style.setProperty(n, v);
  const now = () => (global.performance && performance.now ? performance.now() : Date.now());

  const throttle = (fn, wait = 100) => {
    let t = 0, pending;
    return function (...args) {
      const n = now();
      if (!t || n - t >= wait) {
        t = n;
        fn.apply(this, args);
      } else if (!pending) {
        const remain = wait - (n - t);
        pending = setTimeout(() => {
          t = now();
          pending = null;
          fn.apply(this, args);
        }, remain);
      }
    };
  };

  const toNum = (v, def = 0) => (v === undefined || v === null || v === "" ? def : Number(v));
  const px = (n) => `${n|0}px`;

  const ease = {
    linear: t => t,
    inOutCubic: t => (t < 0.5 ? 4 * t * t * t : 1 - Math.pow(-2 * t + 2, 3) / 2),
    outExpo: t => (t === 1 ? 1 : 1 - Math.pow(2, -10 * t)),
    outQuad: t => 1 - (1 - t) * (1 - t),
  };

  // -----------------------------
  // Event Bus (usa App.Bus si existe)
  // -----------------------------
  const Bus = App.Bus || (() => {
    const map = new Map();
    return {
      on(evt, fn) { if (!map.has(evt)) map.set(evt, new Set()); map.get(evt).add(fn); },
      off(evt, fn) { map.get(evt)?.delete(fn); },
      emit(evt, data) { map.get(evt)?.forEach(cb => { try { cb(data); } catch (_e) {} }); }
    };
  })();

  // -----------------------------
  // Config & State
  // -----------------------------
  const cfg = {
    rootMargin: "0px 0px -10% 0px",
    threshold: [0, 0.1, 0.25, 0.5, 0.75, 1],
    nearMargin: "25% 0px 25% 0px",
    smoothFactor: 0.12,
    maxFPS: 60,
    passive: { passive: true },
    selector: {
      animate: "[data-animate], .reveal",
      parallax: "[data-parallax]",
      parallaxMouse: "[data-parallax-mouse]",
      pin: "[data-pin]",
      scrub: "[data-scrub]",
      counter: "[data-counter]",
      split: "[data-split]",
      draw: "[data-draw]",
      lazyBg: "[data-bg]",
      progress: "[data-progress]"
    }
  };

  const state = {
    reduced: global.matchMedia && global.matchMedia("(prefers-reduced-motion: reduce)").matches,
    height: global.innerHeight,
    width: global.innerWidth,
    y: global.scrollY || 0,
    lastY: 0,
    smoothY: 0,
    rafId: null,
    rafNow: 0,
    rafMinDelta: 1000 / cfg.maxFPS,
    paused: false,
    io: null,
    ioNear: null,
    elements: {
      animate: [],
      parallax: [],
      parallaxMouse: [],
      pin: [],
      scrub: [],
      counter: [],
      split: [],
      draw: [],
      lazyBg: [],
      progress: []
    }
  };

  // -----------------------------
  // IO Setup + Fallback
  // -----------------------------
  const ioSupported = "IntersectionObserver" in global;

  function buildObservers() {
    if (!ioSupported) return;
    if (state.io) state.io.disconnect();
    if (state.ioNear) state.ioNear.disconnect();

    state.io = new IntersectionObserver(onIO, {
      root: null,
      rootMargin: cfg.rootMargin,
      threshold: cfg.threshold
    });

    state.ioNear = new IntersectionObserver(onIONear, {
      root: null,
      rootMargin: cfg.nearMargin,
      threshold: [0, 0.01]
    });
  }

  function onIO(entries) {
    entries.forEach(entry => {
      const el = entry.target;

      // Appear / Animate
      if (el.__pk_anim) {
        if (entry.isIntersecting) animEnter(el);
        else animLeave(el);
      }

      // Counter
      if (el.__pk_counter && entry.isIntersecting) startCounter(el);

      // Split
      if (el.__pk_split && entry.isIntersecting) splitAnimate(el);

      // Draw
      if (el.__pk_draw && entry.isIntersecting) drawPath(el);

      // Progress: actualizar al entrar (primer cálculo)
      if (el.__pk_progress && entry.isIntersecting) updateProgress(el);
    });
  }

  function onIONear(entries) {
    entries.forEach(entry => {
      const el = entry.target;
      if (!entry.isIntersecting) return;
      if (el.__pk_lazybg) {
        const url = el.dataset.bg;
        if (url) {
          const img = new Image();
          img.onload = () => {
            el.style.backgroundImage = `url("${url}")`;
            el.removeAttribute("data-bg");
            el.__pk_lazybg = false;
            try { state.ioNear && state.ioNear.unobserve(el); } catch (_e) {}
            Bus.emit("parallax:lazybg", el);
          };
          img.src = url;
        }
      }
    });
  }

  // -----------------------------
  // Animate [data-animate]
  // -----------------------------
  function animSetup(el) {
    const t = (el.dataset.animate || "").toLowerCase();
    el.style.opacity = "0";
    el.style.willChange = "transform, opacity";
    el.style.transform = "none";
    if (t.includes("up")) el.style.transform = "translateY(28px)";
    else if (t.includes("down")) el.style.transform = "translateY(-28px)";
    else if (t.includes("left")) el.style.transform = "translateX(32px)";
    else if (t.includes("right")) el.style.transform = "translateX(-32px)";
    else if (t.includes("zoom")) el.style.transform = "scale(0.94)";
    else if (t.includes("rotate")) el.style.transform = "rotate(-4deg)";
    el.__pk_anim = true;
  }

  function animEnter(el) {
    if (state.reduced) {
      el.style.opacity = "1";
      el.style.transform = "none";
      return;
    }
    const delay = toNum(el.dataset.delay, 0);
    const dur = toNum(el.dataset.duration, 620);
    const tf = el.dataset.timing || "cubic-bezier(0.22,1,0.36,1)";
    el.style.transition = "none";
    // reflow
    void el.offsetWidth;
    el.style.transition = `transform ${dur}ms ${tf}, opacity ${dur}ms ease`;
    if (el.dataset.stagger && el.children && el.children.length) {
      const step = toNum(el.dataset.stagger, 40);
      [...el.children].forEach((c, i) => {
        c.style.transitionDelay = `${delay + i * step}ms`;
        c.style.opacity = "1";
        c.style.transform = "none";
      });
    }
    el.style.transitionDelay = `${delay}ms`;
    el.style.opacity = "1";
    el.style.transform = "none";
    Bus.emit("parallax:enter", el);
  }

  function animLeave(el) {
    if (el.dataset.once === "true") return;
    const t = (el.dataset.animate || "").toLowerCase();
    el.style.opacity = "0";
    if (t.includes("up")) el.style.transform = "translateY(28px)";
    else if (t.includes("down")) el.style.transform = "translateY(-28px)";
    else if (t.includes("left")) el.style.transform = "translateX(32px)";
    else if (t.includes("right")) el.style.transform = "translateX(-32px)";
    else if (t.includes("zoom")) el.style.transform = "scale(0.94)";
    else if (t.includes("rotate")) el.style.transform = "rotate(-4deg)";
    Bus.emit("parallax:leave", el);
  }

  // -----------------------------
  // Parallax scroll [data-parallax]
  // -----------------------------
  function parseOffset(v) {
    if (typeof v !== "string") return { type: "px", value: 0 };
    if (v.endsWith("%")) return { type: "percent", value: parseFloat(v) };
    return { type: "px", value: parseFloat(v) || 0 };
  }
  function parseRange(v) {
    const [a, b] = String(v).split(",").map(parseFloat);
    return { from: isNaN(a) ? 0 : a, to: isNaN(b) ? 1 : b };
  }
  function getProgressByOffsets(el, start, end, ctxEl) {
    const rect = (ctxEl || el).getBoundingClientRect();
    const startPx = start.type === "percent" ? (start.value / 100) * state.height : start.value;
    const endPx = end.type === "percent" ? (end.value / 100) * state.height : end.value;
    const p = mapRange(rect.top, state.height - startPx, -endPx, 0, 1);
    return clamp(p, 0, 1);
  }

  function registerParallax(el) {
    const sp = parseFloat(el.dataset.speed || "0.2");
    const axis = (el.dataset.axis || "y").toLowerCase();
    const start = parseOffset(el.dataset.start || "0%");
    const end = parseOffset(el.dataset.end || "100%");
    const easeName = el.dataset.ease || "outQuad";
    const rotate = el.dataset.rotate ? parseRange(el.dataset.rotate) : null;
    const scale = el.dataset.scale ? parseRange(el.dataset.scale) : null;
    const opacity = el.dataset.opacity ? parseRange(el.dataset.opacity) : null;
    const clampTo = el.dataset.clamp ? parseRange(el.dataset.clamp) : null;
    const ctxEl = el.dataset.context ? el.closest(el.dataset.context) : null;
    el.__px = 0;
    return { el, sp, axis, start, end, easeName, rotate, scale, opacity, clampTo, ctxEl };
  }

  function stepParallax(item) {
    const { el, sp, axis, start, end, easeName, rotate, scale, opacity, clampTo, ctxEl } = item;
    // optimiza: solo cuando visible cerca
    const ctx = ctxEl || el;
    const r = ctx.getBoundingClientRect();
    if (r.bottom < -200 || r.top > state.height + 200) return;

    const p = getProgressByOffsets(el, start, end, ctxEl);
    const e = (ease[easeName] || ease.outQuad)(p);

    // delta por frame relativo al scroll
    const delta = (state.y - state.lastY) * sp;
    const prevT = el.__px || 0;
    let nextT = prevT + delta;

    if (clampTo) nextT = clamp(nextT, clampTo.from, clampTo.to);
    el.__px = nextT;

    const tx = axis === "x" ? nextT : 0;
    const ty = axis === "y" ? nextT : 0;

    const tf = [];
    tf.push(`translate3d(${px(tx)}, ${px(ty)}, 0)`);
    if (rotate) tf.push(`rotate(${rotate.from + (rotate.to - rotate.from) * e}deg)`);
    if (scale) tf.push(`scale(${scale.from + (scale.to - scale.from) * e})`);
    el.style.transform = tf.join(" ");
    if (opacity) el.style.opacity = String(opacity.from + (opacity.to - opacity.from) * e);
    el.style.willChange = "transform, opacity";
  }

  // -----------------------------
  // Mouse Parallax [data-parallax-mouse] con layers [data-depth]
  // -----------------------------
  function registerMouseParallax(container) {
    const layers = qsa("[data-depth],[data-mouse-speed]", container).map(el => ({
      el,
      depth: parseFloat(el.dataset.depth || "0.5"),
      speed: parseFloat(el.dataset.mouseSpeed || "0.08"),
      x: 0, y: 0, tx: 0, ty: 0
    }));

    function onMove(e) {
      const r = container.getBoundingClientRect();
      const cx = r.left + r.width / 2;
      const cy = r.top + r.height / 2;
      const mx = (e.clientX - cx) / (r.width / 2);
      const my = (e.clientY - cy) / (r.height / 2);
      layers.forEach(l => {
        l.tx = mx * -10 * l.depth;
        l.ty = my * -10 * l.depth;
      });
    }
    on(container, "mousemove", onMove, cfg.passive);

    return {
      container,
      layers,
      step() {
        layers.forEach(l => {
          l.x = lerp(l.x, l.tx, l.speed);
          l.y = lerp(l.y, l.ty, l.speed);
          l.el.style.transform = `translate3d(${l.x}px, ${l.y}px, 0)`;
          l.el.style.willChange = "transform";
        });
      }
    };
  }

  // -----------------------------
  // Pin [data-pin]
  // -----------------------------
  function registerPin(el) {
    const ph = el.dataset.pinHeight || "140vh";
    const cssVar = el.dataset.pinProgressVar || "--pin-progress";
    el.style.minHeight = ph;
    return { el, cssVar };
  }

  function stepPin(item) {
    const { el, cssVar } = item;
    const r = el.getBoundingClientRect();
    const total = r.height - state.height;
    const p = total > 0 ? clamp((0 - r.top) / total, 0, 1) : 0;
    setVar(cssVar, p, el);
  }

  // -----------------------------
  // Scrub [data-scrub]
  // -----------------------------
  function parseScrub(s) {
    const out = {};
    s.split(";").forEach(pair => {
      if (!pair.trim()) return;
      const [prop, range] = pair.split(":").map(p => p.trim());
      if (!range) return;
      const [a, b] = range.split(",").map(parseFloat);
      out[prop] = { from: a, to: b };
    });
    return out;
  }

  function registerScrub(el) {
    const map = parseScrub(el.dataset.scrub || "");
    const easeName = el.dataset.ease || "inOutCubic";
    const start = parseOffset(el.dataset.start || "0%");
    const end = parseOffset(el.dataset.end || "100%");
    const ctxEl = el.dataset.context ? el.closest(el.dataset.context) : null;
    return { el, map, easeName, start, end, ctxEl };
  }

  function applyScrub(el, map, t) {
    const tf = [];
    Object.keys(map).forEach(k => {
      const { from, to } = map[k];
      const v = from + (to - from) * t;
      switch (k) {
        case "translateY": tf.push(`translateY(${v}px)`); break;
        case "translateX": tf.push(`translateX(${v}px)`); break;
        case "rotate": tf.push(`rotate(${v}deg)`); break;
        case "scale": tf.push(`scale(${v})`); break;
        case "opacity": el.style.opacity = String(v); break;
        case "blur": el.style.filter = `blur(${v}px)`; break;
        case "grayscale": el.style.filter = `grayscale(${clamp(v,0,1)})`; break;
        case "hue": el.style.filter = `hue-rotate(${v}deg)`; break;
        case "clipY": el.style.clipPath = `inset(${100 - v}% 0 0 0)`; break;
        default: break;
      }
    });
    if (tf.length) {
      const prev = el.style.transform || "";
      el.style.transform = [prev.replace(/translate.*|rotate.*|scale.*/g, "").trim(), ...tf].join(" ").trim();
      el.style.willChange = "transform, opacity, filter, clip-path";
    }
  }

  function stepScrub(item) {
    const { el, map, easeName, start, end, ctxEl } = item;
    const p = getProgressByOffsets(el, start, end, ctxEl);
    const e = (ease[easeName] || ease.inOutCubic)(p);
    applyScrub(el, map, e);
  }

  // -----------------------------
  // Counter [data-counter]
  // -----------------------------
  function startCounter(el) {
    if (el.__pk_counter_done) return;
    el.__pk_counter_done = true;

    const to = parseFloat(el.dataset.to || "100");
    const from = parseFloat(el.dataset.from || "0");
    const dur = toNum(el.dataset.duration, 1200);
    const dec = toNum(el.dataset.decimals, 0);
    const easeName = el.dataset.ease || "outQuad";
    const formatter = el.dataset.format === "locale";

    let t0 = null;
    function step(ts) {
      if (!t0) t0 = ts;
      const t = clamp((ts - t0) / dur, 0, 1);
      const e = (ease[easeName] || ease.outQuad)(t);
      const val = from + (to - from) * e;
      el.textContent = formatter
        ? Number(val).toLocaleString(undefined, { minimumFractionDigits: dec, maximumFractionDigits: dec })
        : val.toFixed(dec);
      if (t < 1) requestAnimationFrame(step);
    }
    requestAnimationFrame(step);
  }

  // -----------------------------
  // Split [data-split="chars|words|lines"]
  // -----------------------------
  function splitAnimate(el) {
    if (el.__splitDone) return;
    const mode = (el.dataset.split || "chars").toLowerCase();
    const text = el.textContent;
    el.innerHTML = "";
    let parts = [];
    if (mode === "words" || mode === "lines") {
      parts = text.split(/(\s+)/); // lines naive; CSS control
    } else {
      parts = [...text];
    }
    const frag = doc.createDocumentFragment();
    parts.forEach((p) => {
      const span = doc.createElement("span");
      span.className = "split-part";
      span.textContent = p;
      span.style.display = "inline-block";
      span.style.transform = "translateY(1em)";
      span.style.opacity = "0";
      frag.appendChild(span);
    });
    el.appendChild(frag);
    const delay = toNum(el.dataset.stagger, 18);
    qsa(".split-part", el).forEach((s, i) => {
      setTimeout(() => {
        s.style.transition = "transform .6s cubic-bezier(0.19,1,0.22,1), opacity .6s ease";
        s.style.transform = "translateY(0)";
        s.style.opacity = "1";
      }, i * delay);
    });
    el.__splitDone = true;
  }

  // -----------------------------
  // Draw [data-draw] (SVG path)
  // -----------------------------
  function drawPath(el) {
    const path = el.tagName.toLowerCase() === "path" ? el : el.querySelector("path");
    if (!path) return;
    const len = Math.ceil(path.getTotalLength());
    path.style.strokeDasharray = `${len}`;
    path.style.strokeDashoffset = `${len}`;
    path.getBoundingClientRect(); // reflow
    const dur = toNum(el.dataset.duration, 1500);
    const easeName = el.dataset.ease || "outQuad";
    let t0 = null;
    function step(ts) {
      if (!t0) t0 = ts;
      const t = clamp((ts - t0) / dur, 0, 1);
      const e = (ease[easeName] || ease.outQuad)(t);
      path.style.strokeDashoffset = String((1 - e) * len);
      if (t < 1) requestAnimationFrame(step);
    }
    requestAnimationFrame(step);
  }

  // -----------------------------
  // Progress [data-progress]
  // -----------------------------
  function updateProgress(el) {
    const total = doc.documentElement.scrollHeight - state.height;
    const p = total > 0 ? clamp(state.y / total, 0, 1) : 0;
    setVar("--scroll-progress", p);
    if (el.getAttribute("data-progress") === "width") {
      el.style.width = `${(p * 100).toFixed(4)}%`;
    }
  }

  // -----------------------------
  // Scan DOM
  // -----------------------------
  function scan() {
    Object.keys(state.elements).forEach(k => (state.elements[k] = []));

    // animate
    qsa(cfg.selector.animate).forEach(el => {
      animSetup(el);
      state.elements.animate.push(el);
      if (ioSupported) state.io.observe(el);
    });

    // parallax
    qsa(cfg.selector.parallax).forEach(el => {
      state.elements.parallax.push(registerParallax(el));
    });

    // parallax mouse
    qsa(cfg.selector.parallaxMouse).forEach(el => {
      state.elements.parallaxMouse.push(registerMouseParallax(el));
    });

    // pin
    qsa(cfg.selector.pin).forEach(el => {
      state.elements.pin.push(registerPin(el));
    });

    // scrub
    qsa(cfg.selector.scrub).forEach(el => {
      state.elements.scrub.push(registerScrub(el));
    });

    // counter
    qsa(cfg.selector.counter).forEach(el => {
      el.__pk_counter = true;
      state.elements.counter.push(el);
      if (ioSupported) state.io.observe(el);
    });

    // split
    qsa(cfg.selector.split).forEach(el => {
      el.__pk_split = true;
      state.elements.split.push(el);
      if (ioSupported) state.io.observe(el);
    });

    // draw
    qsa(cfg.selector.draw).forEach(el => {
      el.__pk_draw = true;
      state.elements.draw.push(el);
      if (ioSupported) state.io.observe(el);
    });

    // lazy bg
    qsa(cfg.selector.lazyBg).forEach(el => {
      el.__pk_lazybg = true;
      state.elements.lazyBg.push(el);
      if (ioSupported) state.ioNear.observe(el);
    });

    // progress
    qsa(cfg.selector.progress).forEach(el => {
      el.__pk_progress = true;
      state.elements.progress.push(el);
      if (ioSupported) state.io.observe(el);
    });

    // Fallback inmediato si no hay IO
    if (!ioSupported) fallbackVisibleTick();
  }

  function fallbackVisibleTick() {
    // Appear fallback
    state.elements.animate.forEach(el => {
      const r = el.getBoundingClientRect();
      const vis = r.top < state.height - 80 && r.bottom > 80;
      vis ? animEnter(el) : animLeave(el);
    });
    // Counters/Draw/Split en fallback: disparar al entrar por primera vez
    state.elements.counter.forEach(el => {
      if (el.__pk_counter_done) return;
      const r = el.getBoundingClientRect();
      if (r.top < state.height - 80 && r.bottom > 80) startCounter(el);
    });
    state.elements.draw.forEach(el => {
      if (el.__pk_draw_done) return;
      const r = el.getBoundingClientRect();
      if (r.top < state.height - 80 && r.bottom > 80) { el.__pk_draw_done = true; drawPath(el); }
    });
    state.elements.split.forEach(el => {
      if (el.__splitDone) return;
      const r = el.getBoundingClientRect();
      if (r.top < state.height - 80 && r.bottom > 80) splitAnimate(el);
    });
    // Lazy BG
    state.elements.lazyBg.forEach(el => {
      if (!el.__pk_lazybg) return;
      const r = el.getBoundingClientRect();
      if (r.top < state.height * 1.25 && r.bottom > -state.height * 0.25) {
        const url = el.dataset.bg;
        if (url) {
          const img = new Image();
          img.onload = () => {
            el.style.backgroundImage = `url("${url}")`;
            el.removeAttribute("data-bg");
            el.__pk_lazybg = false;
            Bus.emit("parallax:lazybg", el);
          };
          img.src = url;
        }
      }
    });
  }

  // -----------------------------
  // RAF Loop
  // -----------------------------
  function onScroll() { state.y = global.scrollY || 0; }
  function onResize() { state.height = global.innerHeight; state.width = global.innerWidth; }
  function onVisibility() { state.paused = doc.hidden || false; }

  function raf(ts) {
    if (state.paused) { state.rafId = requestAnimationFrame(raf); return; }
    if (state.rafNow && ts - state.rafNow < state.rafMinDelta) {
      state.rafId = requestAnimationFrame(raf);
      return;
    }
    state.rafNow = ts;

    state.smoothY = lerp(state.smoothY, state.y, cfg.smoothFactor);
    setVar("--scrollY", state.smoothY);

    // parallax
    if (!state.reduced) {
      for (let i = 0; i < state.elements.parallax.length; i++) stepParallax(state.elements.parallax[i]);
      for (let i = 0; i < state.elements.parallaxMouse.length; i++) state.elements.parallaxMouse[i].step();
      for (let i = 0; i < state.elements.scrub.length; i++) stepScrub(state.elements.scrub[i]);
      for (let i = 0; i < state.elements.pin.length; i++) stepPin(state.elements.pin[i]);
      for (let i = 0; i < state.elements.progress.length; i++) updateProgress(state.elements.progress[i]);
    }

    if (!ioSupported) fallbackVisibleTick();

    state.lastY = state.y;
    Bus.emit("parallax:tick", state);
    state.rafId = requestAnimationFrame(raf);
  }

  // -----------------------------
  // API
  // -----------------------------
  const listeners = new Map(); // evt -> Set

  const ParallaxKit = {
    init(options = {}) {
      Object.assign(cfg, options || {});
      buildObservers();
      scan();

      on(global, "scroll", onScroll, cfg.passive);
      on(global, "resize", throttle(onResize, 120), cfg.passive);
      on(doc, "visibilitychange", onVisibility, false);

      cancelAnimationFrame(state.rafId);
      state.rafId = requestAnimationFrame(raf);

      Bus.emit("parallax:init");
      return ParallaxKit;
    },
    refresh() {
      buildObservers();
      scan();
    },
    setConfig(next = {}) { Object.assign(cfg, next); },
    get state() { return state; },

    // Event shim (si el consumidor no usa App.Bus)
    on(evt, cb) {
      if (!listeners.has(evt)) listeners.set(evt, new Set());
      listeners.get(evt).add(cb);
      // también se engancha al Bus del sitio
      Bus.on(evt, cb);
      return () => ParallaxKit.off(evt, cb);
    },
    off(evt, cb) {
      listeners.get(evt)?.delete(cb);
      Bus.off(evt, cb);
    }
  };

  // Exponer
  App.ParallaxKit = ParallaxKit;
  Modules.Scroll = ParallaxKit;

})(window);
