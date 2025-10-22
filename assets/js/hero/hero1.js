/* =========================================================================
 * HERO-1.JS — Parallax + Animaciones de entrada (versión Maycoll)
 * ========================================================================= */
(function (global) {
  'use strict';
  const d = document;
  const $ = (sel, ctx = d) => ctx.querySelector(sel);
  const $$ = (sel, ctx = d) => Array.from(ctx.querySelectorAll(sel));

  /* ===============================
   * 1. Mouse Parallax Blobs
   * =============================== */
  function initMouseParallax() {
    const hero = $('.hero-1');
    const blobs = $$('.hero-deco .blob');
    if (!hero || !blobs.length) return;

    let mx = 0, my = 0, tx = 0, ty = 0;
    const damp = 0.07;

    hero.addEventListener('mousemove', (e) => {
      const rect = hero.getBoundingClientRect();
      const relX = (e.clientX - rect.left) / rect.width - 0.5;
      const relY = (e.clientY - rect.top) / rect.height - 0.5;
      mx = relX * 2;
      my = relY * 2;
    });

    function animate() {
      tx += (mx - tx) * damp;
      ty += (my - ty) * damp;
      blobs.forEach((blob, i) => {
        const depth = parseFloat(blob.dataset.depth) || (0.15 + i * 0.08);
        blob.style.transform = `translate(${tx * depth * 40}px, ${ty * depth * 40}px) scale(1.05)`;
      });
      requestAnimationFrame(animate);
    }
    animate();
  }

  /* ===============================
   * 2. Animaciones de entrada (textos / botones)
   * =============================== */
  function initScrollAnimations() {
    const items = $$('[data-animate]');
    if (!items.length) return;

    const observer = new IntersectionObserver((entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add('visible');
          observer.unobserve(entry.target);
        }
      });
    }, { threshold: 0.2 });

    items.forEach((el, i) => {
      el.style.transitionDelay = `${i * 0.1}s`; // escalonado
      observer.observe(el);
    });
  }

  /* ===============================
   * 3. Contadores automáticos
   * =============================== */
  function initCounters() {
    const counters = $$('[data-counter]');
    if (!counters.length) return;

    const obs = new IntersectionObserver((entries) => {
      entries.forEach((entry) => {
        if (!entry.isIntersecting) return;
        const el = entry.target;
        const target = parseInt(el.dataset.to || '0', 10);
        const duration = parseInt(el.dataset.duration || '1500', 10);
        let start = null;
        function step(ts) {
          if (!start) start = ts;
          const progress = Math.min((ts - start) / duration, 1);
          el.textContent = Math.floor(target * progress);
          if (progress < 1) requestAnimationFrame(step);
        }
        requestAnimationFrame(step);
        obs.unobserve(el);
      });
    }, { threshold: 0.6 });

    counters.forEach((el) => obs.observe(el));
  }

  /* ===============================
   * 4. Efecto Ripple para botones
   * =============================== */
  function rippleEffect() {
    $$('[data-ripple]').forEach((btn) => {
      btn.addEventListener('pointerdown', (e) => {
        const rect = btn.getBoundingClientRect();
        const ripple = d.createElement('span');
        const size = Math.max(rect.width, rect.height);
        ripple.className = 'ripple';
        ripple.style.width = ripple.style.height = `${size}px`;
        ripple.style.left = `${e.clientX - rect.left - size / 2}px`;
        ripple.style.top = `${e.clientY - rect.top - size / 2}px`;
        btn.appendChild(ripple);
        setTimeout(() => ripple.remove(), 600);
      });
    });
  }

  function injectRippleCSS() {
    if (d.getElementById('ripple-style')) return;
    const style = d.createElement('style');
    style.id = 'ripple-style';
    style.textContent = `
      .btn[data-ripple]{position:relative;overflow:hidden;}
      .btn .ripple{
        position:absolute;
        border-radius:50%;
        background:rgba(255,255,255,0.6);
        transform:scale(0);
        animation:ripple .6s linear forwards;
        pointer-events:none;
      }
      @keyframes ripple{to{transform:scale(1.4);opacity:0;}}
    `;
    d.head.appendChild(style);
  }

  /* ===============================
   * INIT
   * =============================== */
  function ready(fn) {
    if (d.readyState !== 'loading') fn();
    else d.addEventListener('DOMContentLoaded', fn, { once: true });
  }

  ready(() => {
    injectRippleCSS();
    initMouseParallax();
    initScrollAnimations();
    initCounters();
    rippleEffect();
  });

})(window);
