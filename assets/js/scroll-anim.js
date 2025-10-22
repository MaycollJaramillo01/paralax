/*!
 * ParallaxKit — Scroll & Parallax Engine (Vanilla JS)
 * Author: Maycoll Jaramillo (setup-ready)
 * Usage: include after DOM and call ParallaxKit.init()
 * Dependencies: none. Works with Tailwind/root.css variables.
 */

(function (global) {
  "use strict";

  // =========================
  // Feature detection / config
  // =========================
  const cfg = {
    rootMargin: "0px 0px -10% 0px",
    threshold: [0, 0.1, 0.25, 0.5, 0.75, 1],
    smoothFactor: 0.12, // for lerp smoothing in RAF loop
    maxRAFPerSecond: 60,
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
    reducedMotion: window.matchMedia("(prefers-reduced-motion: reduce)").matches,
    height: window.innerHeight,
    width: window.innerWidth,
    y: window.scrollY || window.pageYOffset,
    lastY: 0,
    smoothY: 0,
    rafId: null,
    rafNow: 0,
    rafMinDelta: 1000 / cfg.maxRAFPerSecond,
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

  // ============
  // Util helpers
  // ============
  const clamp = (v, min, max) => Math.min(max, Math.max(min, v));
  const lerp = (a, b, n) => (1 - n) * a + n * b;
  const mapRange = (v, inMin, inMax, outMin, outMax) => outMin + ((clamp(v, inMin, inMax) - inMin) * (outMax - outMin)) / (inMax - inMin || 1);
  const ease = {
    linear: t => t,
    inOutCubic: t => (t < 0.5 ? 4 * t * t * t : 1 - Math.pow(-2 * t + 2, 3) / 2),
    outExpo: t => (t === 1 ? 1 : 1 - Math.pow(2, -10 * t)),
    outQuad: t => 1 - (1 - t) * (1 - t),
  };
  const toNum = (v, def = 0) => (v === undefined || v === null || v === "" ? def : Number(v));
  const getCSSVar = (el, name) => getComputedStyle(el).getPropertyValue(name).trim();
  const setCSSVar = (el, name, val) => el.style.setProperty(name, val);
  const now = () => (performance && performance.now ? performance.now() : Date.now());

  const isInView = (el, offset = 0) => {
    const r = el.getBoundingClientRect();
    return r.bottom > offset && r.top < state.height - offset;
  };

  // ===========================
  // Intersection Observers
  // ===========================
  function buildObservers() {
    if (state.io) state.io.disconnect();
    if (state.ioNear) state.ioNear.disconnect();

    state.io = new IntersectionObserver(onIO, {
      root: null,
      rootMargin: cfg.rootMargin,
      threshold: cfg.threshold
    });

    // "Near" observer (for preloading backgrounds a bit earlier)
    state.ioNear = new IntersectionObserver(onIONear, {
      root: null,
      rootMargin: "25% 0px 25% 0px",
      threshold: [0, 0.01]
    });
  }

  function onIO(entries) {
    entries.forEach(entry => {
      const el = entry.target;

      // Generic appear
      if (el.matches(cfg.selector.animate)) {
        if (entry.isIntersecting) {
          el.classList.add("visible", "active");
          // stagger handling
          const stagger = toNum(el.dataset.stagger, 0);
          if (stagger && el.children && el.children.length) {
            [...el.children].forEach((c, i) => {
              c.style.transitionDelay = `${i * stagger}ms`;
              c.classList.add("visible");
            });
          }
        } else if (el.dataset.once !== "true") {
          el.classList.remove("visible", "active");
        }
      }

      // Counters
      if (el.matches(cfg.selector.counter)) {
        if (entry.isIntersecting) startCounter(el);
      }

      // Split text
      if (el.matches(cfg.selector.split)) {
        if (entry.isIntersecting) animateSplit(el);
      }

      // SVG draw
      if (el.matches(cfg.selector.draw)) {
        if (entry.isIntersecting) drawPath(el);
      }

      // Progress elements update on intersect as well
      if (el.matches(cfg.selector.progress)) {
        if (entry.isIntersecting) updateProgress(el);
      }
    });
  }

  function onIONear(entries) {
    entries.forEach(entry => {
      const el = entry.target;
      if (!entry.isIntersecting) return;
      // Lazy BG
      if (el.matches(cfg.selector.lazyBg)) {
        const url = el.dataset.bg;
        if (url) {
          const img = new Image();
          img.onload = () => {
            el.style.backgroundImage = `url("${url}")`;
            el.removeAttribute("data-bg");
            state.ioNear.unobserve(el);
          };
          img.src = url;
        }
      }
    });
  }

  // ===========================
  // Registry / scanning
  // ===========================
  function scan() {
    Object.keys(state.elements).forEach(k => (state.elements[k] = []));

    document.querySelectorAll(cfg.selector.animate).forEach(el => {
      state.elements.animate.push(el);
      state.io.observe(el);
    });

    document.querySelectorAll(cfg.selector.parallax).forEach(el => {
      state.elements.parallax.push(registerParallax(el));
    });

    document.querySelectorAll(cfg.selector.parallaxMouse).forEach(el => {
      state.elements.parallaxMouse.push(registerMouseParallax(el));
    });

    document.querySelectorAll(cfg.selector.pin).forEach(el => {
      state.elements.pin.push(registerPin(el));
    });

    document.querySelectorAll(cfg.selector.scrub).forEach(el => {
      state.elements.scrub.push(registerScrub(el));
    });

    document.querySelectorAll(cfg.selector.counter).forEach(el => {
      state.elements.counter.push(el);
      state.io.observe(el);
    });

    document.querySelectorAll(cfg.selector.split).forEach(el => {
      state.elements.split.push(el);
      state.io.observe(el);
    });

    document.querySelectorAll(cfg.selector.draw).forEach(el => {
      state.elements.draw.push(el);
      state.io.observe(el);
    });

    document.querySelectorAll(cfg.selector.lazyBg).forEach(el => {
      state.elements.lazyBg.push(el);
      state.ioNear.observe(el);
    });

    document.querySelectorAll(cfg.selector.progress).forEach(el => {
      state.elements.progress.push(el);
      state.io.observe(el);
    });
  }

  // ======================================
  // Parallax registry (scroll-based layers)
  // ======================================
  function registerParallax(el) {
    // data-speed: -1.0 .. 1.0 (positive = move faster when scrolling down)
    // data-axis: y|x
    // data-rotate, data-scale, data-opacity (from..to) optional
    // data-start, data-end: offsets in px or % of viewport
    const sp = parseFloat(el.dataset.speed || "0.2");
    const axis = (el.dataset.axis || "y").toLowerCase();
    const start = parseOffset(el.dataset.start || "0%");
    const end = parseOffset(el.dataset.end || "100%");
    const easeName = el.dataset.ease || "outQuad";
    const rotate = el.dataset.rotate ? parseRange(el.dataset.rotate) : null; // "from,to"
    const scale = el.dataset.scale ? parseRange(el.dataset.scale) : null;
    const opacity = el.dataset.opacity ? parseRange(el.dataset.opacity) : null;
    const clampTo = el.dataset.clamp ? parseRange(el.dataset.clamp) : null;
    const ctxEl = el.dataset.context ? el.closest(el.dataset.context) : null;

    return { el, sp, axis, start, end, easeName, rotate, scale, opacity, clampTo, ctxEl };
  }

  function parseOffset(v) {
    if (typeof v !== "string") return { type: "px", value: 0 };
    if (v.endsWith("%")) return { type: "percent", value: parseFloat(v) };
    return { type: "px", value: parseFloat(v) || 0 };
  }

  function parseRange(v) {
    const [a, b] = String(v).split(",").map(parseFloat);
    return { from: isNaN(a) ? 0 : a, to: isNaN(b) ? 1 : b };
  }

  function getProgress(el, start, end, ctxEl) {
    const rect = (ctxEl || el).getBoundingClientRect();
    const startPx = start.type === "percent" ? (start.value / 100) * state.height : start.value;
    const endPx = end.type === "percent" ? (end.value / 100) * state.height : end.value;
    const p = mapRange(rect.top, state.height - startPx, -endPx, 0, 1);
    return clamp(p, 0, 1);
  }

  // ======================================
  // Mouse parallax (container + children)
  // ======================================
  function registerMouseParallax(container) {
    const layers = [...container.querySelectorAll("[data-depth],[data-mouse-speed]")].map(el => ({
      el,
      depth: parseFloat(el.dataset.depth || "0.5"),
      speed: parseFloat(el.dataset.mouseSpeed || "0.08"), // easing to target
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

    function step() {
      layers.forEach(l => {
        l.x = lerp(l.x, l.tx, l.speed);
        l.y = lerp(l.y, l.ty, l.speed);
        l.el.style.transform = `translate3d(${l.x}px, ${l.y}px, 0)`;
      });
    }

    container.addEventListener("mousemove", onMove, cfg.passive);
    return { container, layers, step };
  }

  // =============================
  // Pinning (sticky-like control)
  // =============================
  function registerPin(el) {
    // data-pin-height: px or % of viewport (default: 120vh)
    // data-pin-progress-var: CSS var name for progress (default: --pin-progress)
    const ph = el.dataset.pinHeight || "120vh";
    const cssVar = el.dataset.pinProgressVar || "--pin-progress";
    el.style.minHeight = ph;
    return { el, cssVar };
  }

  // ======================
  // Scrub (keyframe-like)
  // ======================
  function registerScrub(el) {
    // data-scrub="translateY:-40,40; opacity:0,1; rotate:0,15; scale:0.9,1"
    // data-ease="inOutCubic" data-start="0%" data-end="100%"
    const map = parseScrub(el.dataset.scrub || "");
    const easeName = el.dataset.ease || "inOutCubic";
    const start = parseOffset(el.dataset.start || "0%");
    const end = parseOffset(el.dataset.end || "100%");
    const ctxEl = el.dataset.context ? el.closest(el.dataset.context) : null;
    return { el, map, easeName, start, end, ctxEl };
  }

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
        case "clipY":
          el.style.clipPath = `inset(${100 - v}% 0 0 0)`;
          break;
        default:
          break;
      }
    });
    if (tf.length) el.style.transform = tf.join(" ");
  }

  // ===================
  // Counters / Odometer
  // ===================
  function startCounter(el) {
    const to = parseFloat(el.dataset.to || "100");
    const from = parseFloat(el.dataset.from || "0");
    const dur = toNum(el.dataset.duration, 1200);
    const dec = toNum(el.dataset.decimals, 0);
    const easeName = el.dataset.ease || "outQuad";
    const formatter = el.dataset.format === "locale";

    let startT = null;
    function tick(ts) {
      if (!startT) startT = ts;
      const t = clamp((ts - startT) / dur, 0, 1);
      const e = (ease[easeName] || ease.outQuad)(t);
      const val = from + (to - from) * e;
      el.textContent = formatter ? Number(val).toLocaleString(undefined, { minimumFractionDigits: dec, maximumFractionDigits: dec }) : val.toFixed(dec);
      if (t < 1) requestAnimationFrame(tick);
    }
    requestAnimationFrame(tick);
  }

  // ======================
  // Split text animations
  // ======================
  function animateSplit(el) {
    // data-split="chars|words|lines"
    // splits once; adds spans and animates staggered
    if (el.__splitDone) return;
    const mode = (el.dataset.split || "chars").toLowerCase();
    const text = el.textContent;
    el.innerHTML = "";
    let parts = [];
    if (mode === "words") {
      parts = text.split(/(\s+)/);
    } else if (mode === "lines") {
      // naive line split: wrap words and rely on CSS to break
      parts = text.split(/(\s+)/);
    } else {
      parts = [...text];
    }
    const frag = document.createDocumentFragment();
    parts.forEach((p) => {
      const span = document.createElement("span");
      span.className = "split-part";
      span.textContent = p;
      span.style.display = "inline-block";
      span.style.transform = "translateY(1em)";
      span.style.opacity = "0";
      frag.appendChild(span);
    });
    el.appendChild(frag);
    // stagger reveal
    const delay = toNum(el.dataset.stagger, 18);
    [...el.querySelectorAll(".split-part")].forEach((s, i) => {
      setTimeout(() => {
        s.style.transition = "transform .6s cubic-bezier(0.19,1,0.22,1), opacity .6s ease";
        s.style.transform = "translateY(0)";
        s.style.opacity = "1";
      }, i * delay);
    });
    el.__splitDone = true;
  }

  // ======================
  // SVG path draw on view
  // ======================
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

  // ======================
  // Progress bar elements
  // ======================
  function updateProgress(el) {
    const total = document.documentElement.scrollHeight - state.height;
    const p = total > 0 ? clamp(state.y / total, 0, 1) : 0;
    setCSSVar(el, "--scroll-progress", p);
    if (el.matches("[data-progress='width']")) {
      el.style.width = `${p * 100}%`;
    }
  }

  // ================
  // RAF main loop
  // ================
  function onScroll() {
    state.y = window.scrollY || window.pageYOffset;
  }

  function onResize() {
    state.height = window.innerHeight;
    state.width = window.innerWidth;
  }

  function rafLoop(ts) {
    if (state.rafNow && ts - state.rafNow < state.rafMinDelta) {
      state.rafId = requestAnimationFrame(rafLoop);
      return;
    }
    state.rafNow = ts;

    // smooth scroll value
    state.smoothY = lerp(state.smoothY, state.y, cfg.smoothFactor);

    // Parallax scroll layers
    if (!state.reducedMotion) {
      for (let i = 0; i < state.elements.parallax.length; i++) {
        const it = state.elements.parallax[i];
        const { el, sp, axis, start, end, easeName, rotate, scale, opacity, clampTo, ctxEl } = it;
        if (!isInView(ctxEl || el, 200)) continue;

        const p = getProgress(el, start, end, ctxEl);
        const e = (ease[easeName] || ease.outQuad)(p);

        // base translate from scroll
        const delta = (state.y - state.lastY) * sp;
        const prevT = el.__px || 0;
        const nextT = prevT + delta;

        // optional clamp
        const clampedT = clampTo ? clamp(nextT, clampTo.from, clampTo.to) : nextT;
        el.__px = clampedT;

        const tx = axis === "x" ? clampedT : 0;
        const ty = axis === "y" ? clampedT : 0;

        const tf = [];
        tf.push(`translate3d(${tx}px, ${ty}px, 0)`);
        if (rotate) tf.push(`rotate(${rotate.from + (rotate.to - rotate.from) * e}deg)`);
        if (scale) tf.push(`scale(${scale.from + (scale.to - scale.from) * e})`);
        el.style.transform = tf.join(" ");

        if (opacity) el.style.opacity = String(opacity.from + (opacity.to - opacity.from) * e);
      }

      // Mouse parallax step
      for (let i = 0; i < state.elements.parallaxMouse.length; i++) {
        state.elements.parallaxMouse[i].step();
      }

      // Scrub animations
      for (let i = 0; i < state.elements.scrub.length; i++) {
        const it = state.elements.scrub[i];
        const p = getProgress(it.el, it.start, it.end, it.ctxEl);
        const e = (ease[it.easeName] || ease.inOutCubic)(p);
        applyScrub(it.el, it.map, e);
      }

      // Pin progress update
      for (let i = 0; i < state.elements.pin.length; i++) {
        const it = state.elements.pin[i];
        const r = it.el.getBoundingClientRect();
        const total = r.height - state.height;
        const p = total > 0 ? clamp((0 - r.top) / total, 0, 1) : 0;
        setCSSVar(it.el, it.cssVar, p);
      }

      // Progress indicators
      for (let i = 0; i < state.elements.progress.length; i++) {
        updateProgress(state.elements.progress[i]);
      }
    }

    state.lastY = state.y;
    state.rafId = requestAnimationFrame(rafLoop);
  }

  // ============================
  // Public API
  // ============================
  const API = {
    init(options = {}) {
      Object.assign(cfg, options);
      buildObservers();
      scan();

      // events
      window.addEventListener("scroll", onScroll, cfg.passive);
      window.addEventListener("resize", onResize, cfg.passive);

      // start loop
      cancelAnimationFrame(state.rafId);
      state.rafId = requestAnimationFrame(rafLoop);
      return API;
    },
    refresh() {
      buildObservers();
      scan();
    },
    setConfig(next) {
      Object.assign(cfg, next || {});
    },
    get state() {
      return state;
    },
    // programmatic utilities
    registerParallax,
    registerScrub,
    startCounter,
    animateSplit,
    drawPath
  };

  // Expose globally
  global.ParallaxKit = API;

})(window);

/* =========================
   Quick How-To (examples)
   =========================
1) Fade/slide on appear:
   <div data-animate="fade-in"></div>
   <div data-animate="slide-up" data-stagger="60"></div>

2) Parallax layer:
   <div data-parallax data-speed="0.25" data-axis="y" data-start="10%" data-end="110%" data-ease="outQuad"></div>
   Optional transforms:
     data-rotate="0,15" data-scale="0.9,1" data-opacity="0.6,1" data-clamp="-80,80" data-context=".parallax-section"

3) Mouse parallax:
   <div data-parallax-mouse>
     <img data-depth="0.2">
     <img data-depth="0.6">
   </div>

4) Pin section with progress var:
   <section data-pin data-pin-height="160vh" data-pin-progress-var="--pin-progress"></section>
   Use CSS var --pin-progress (0..1) to drive gradients/clipping.

5) Scrub (keyframes by attributes):
   <div data-scrub="translateY:-60,60; opacity:0,1; rotate:0,10"
        data-ease="inOutCubic" data-start="0%" data-end="100%"></div>

6) Counter:
   <span data-counter data-from="0" data-to="1024" data-duration="1800" data-decimals="0" data-ease="outQuad"></span>

7) Split text:
   <h2 data-split="chars" data-stagger="15">Parallax Magic</h2>

8) SVG draw:
   <svg data-draw data-duration="2000" data-ease="outQuad"><path d="..."/></svg>

9) Lazy background (preload near viewport):
   <section data-bg="assets/images/hero.jpg" class="parallax-bg"></section>

10) Progress bar:
   <div class="fixed top-0 left-0 h-1 bg-secondary" data-progress="width" style="width:0"></div>

Initialize:
   <script>
     document.addEventListener("DOMContentLoaded", () => {
       ParallaxKit.init();
     });
   </script>
*/
