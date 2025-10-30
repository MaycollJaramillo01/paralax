/* =========================================================================
 *  animations.js — Motor global de animaciones y microinteracciones
 *  Autor: Maycoll (Maven Marketing)
 *  Descripción:
 *   - Revela elementos al hacer scroll (fade, slide, zoom, stagger)
 *   - Microinteracciones (hover, click, parpadeos, pulsos)
 *   - Animaciones suaves controladas por prefers-reduced-motion
 *   - Sin dependencias externas (usa App.IO y App.Utils)
 *   - Totalmente sincronizado con scroll-anim.js y LazyLoad
 * ========================================================================= */

(function (global) {
  'use strict';

  if (!global.App) {
    console.warn('[animations.js] App namespace no detectado. Carga main.js antes.');
    return;
  }

  const { Utils, IO, Bus, Feature } = global.App;
  const d = document;

  // ============================================================
  // Configuración global
  // ============================================================
  const cfg = {
    revealSelector: '[data-anim], [data-animate], [data-reveal]',
    hoverSelector: '[data-hover]',
    delayStep: 0.12,   // delay incremental entre elementos de un grupo
    staggerGroupAttr: 'data-anim-group',
    activeClass: 'is-animated',
    hiddenClass: 'is-hidden',
    once: true,
  };

  const animations = {
    fade: { from: { opacity: 0 }, to: { opacity: 1 } },
    slideUp: { from: { opacity: 0, transform: 'translateY(30px)' }, to: { opacity: 1, transform: 'translateY(0)' } },
    slideDown: { from: { opacity: 0, transform: 'translateY(-30px)' }, to: { opacity: 1, transform: 'translateY(0)' } },
    slideLeft: { from: { opacity: 0, transform: 'translateX(40px)' }, to: { opacity: 1, transform: 'translateX(0)' } },
    slideRight: { from: { opacity: 0, transform: 'translateX(-40px)' }, to: { opacity: 1, transform: 'translateX(0)' } },
    zoomIn: { from: { opacity: 0, transform: 'scale(0.9)' }, to: { opacity: 1, transform: 'scale(1)' } },
  };

  const legacyAlias = {
    fade: 'fade',
    'fade-in': 'fade',
    fadein: 'fade',
    'slide-up': 'slideUp',
    slideup: 'slideUp',
    up: 'slideUp',
    'slide-down': 'slideDown',
    slidedown: 'slideDown',
    down: 'slideDown',
    'slide-left': 'slideLeft',
    slideleft: 'slideLeft',
    left: 'slideLeft',
    'slide-right': 'slideRight',
    slideright: 'slideRight',
    right: 'slideRight',
    'zoom-in': 'zoomIn',
    zoom: 'zoomIn',
    zoomin: 'zoomIn',
  };

  function resolveAnim(el) {
    if (!el) return 'fade';
    const explicit = el.dataset.anim;
    if (explicit && animations[explicit]) return explicit;

    const legacy = (el.dataset.animate || el.dataset.reveal || '').trim();
    if (legacy) {
      const key = legacyAlias[legacy] || legacyAlias[legacy.toLowerCase()] || legacyAlias[legacy.replace(/\s+/g, '-').toLowerCase()];
      if (key && animations[key]) {
        el.dataset.anim = key;
        return key;
      }
    }

    el.dataset.anim = 'fade';
    return 'fade';
  }

  // ============================================================
  // Inicialización
  // ============================================================
  function init() {
    prepareElements();
    observeReveals();
    bindHoverEffects();

    Bus.emit('animations:ready');
  }

  // ============================================================
  // Preparar elementos ocultos inicialmente
  // ============================================================
  function prepareElements() {
    Utils.qsa(cfg.revealSelector).forEach(el => {
      Utils.addClass(el, cfg.hiddenClass);
      resolveAnim(el);
    });
  }

  // ============================================================
  // Observación con IntersectionObserver (reveal on scroll)
  // ============================================================
  function observeReveals() {
    IO.observe(cfg.revealSelector, (el) => {
      revealElement(el);
    }, { rootMargin: '0px 0px -10% 0px', threshold: [0.1], once: cfg.once });
  }

  // ============================================================
  // Revelar elemento con animación
  // ============================================================
  function revealElement(el) {
    if (Feature.reduceMotion) {
      Utils.remClass(el, cfg.hiddenClass);
      Utils.addClass(el, cfg.activeClass);
      return;
    }

    const type = resolveAnim(el);
    const group = el.getAttribute(cfg.staggerGroupAttr);
    const anim = animations[type] || animations.fade;
    const durationRaw = Number(el.dataset.duration);
    const duration = !Number.isNaN(durationRaw) && durationRaw > 0 ? durationRaw / 1000 : 0.8;
    const timing = el.dataset.timing || 'cubic-bezier(0.22, 1, 0.36, 1)';
    const delayRaw = Number(el.dataset.delay);
    const hasDelay = !Number.isNaN(delayRaw) && delayRaw >= 0;
    const baseDelay = hasDelay ? delayRaw / 1000 : 0;

    Object.assign(el.style, anim.from, { transition: 'none', willChange: 'transform, opacity' });
    // Forzar reflow para asegurar animación
    void el.offsetWidth;
    Object.assign(el.style, {
      transition: `all ${duration}s ${timing}`,
      ...anim.to,
    });
    Utils.remClass(el, cfg.hiddenClass);
    Utils.addClass(el, cfg.activeClass);

    // Efecto stagger si pertenece a grupo
    if (group) {
      const groupEls = Utils.qsa(`[${cfg.staggerGroupAttr}="${group}"]`);
      groupEls.forEach((item, i) => {
        const totalDelay = baseDelay + i * cfg.delayStep;
        item.style.transitionDelay = `${totalDelay}s`;
      });
    } else if (hasDelay) {
      el.style.transitionDelay = `${baseDelay}s`;
    }

    Bus.emit('animations:reveal', { el, type });
  }

  // ============================================================
  // Microinteracciones de hover / click
  // ============================================================
  function bindHoverEffects() {
    Utils.qsa(cfg.hoverSelector).forEach(el => {
      const effect = el.dataset.hover || 'pulse';
      if (effect === 'pulse') setupPulse(el);
      else if (effect === 'shake') setupShake(el);
      else if (effect === 'blink') setupBlink(el);
    });
  }

  function setupPulse(el) {
    Utils.on(el, 'mouseenter', () => animateCSS(el, 'scale(1.08)', 200));
    Utils.on(el, 'mouseleave', () => animateCSS(el, 'scale(1)', 200));
  }

  function setupShake(el) {
    Utils.on(el, 'mouseenter', () => animateCSS(el, 'translateX(4px)', 80, 3));
    Utils.on(el, 'mouseleave', () => el.style.transform = '');
  }

  function setupBlink(el) {
    Utils.on(el, 'mouseenter', () => animateOpacity(el, 0.4, 150, 2));
    Utils.on(el, 'mouseleave', () => el.style.opacity = 1);
  }

  // ============================================================
  // Funciones de animación genéricas
  // ============================================================
  function animateCSS(el, transformValue, duration = 250, repeats = 1) {
    if (!el) return;
    let count = 0;
    const anim = () => {
      el.style.transition = `transform ${duration}ms ease`;
      el.style.transform = transformValue;
      setTimeout(() => {
        el.style.transform = '';
        count++;
        if (count < repeats) setTimeout(anim, duration);
      }, duration);
    };
    anim();
  }

  function animateOpacity(el, targetOpacity, duration = 250, repeats = 1) {
    if (!el) return;
    let count = 0;
    const anim = () => {
      el.style.transition = `opacity ${duration}ms ease`;
      el.style.opacity = targetOpacity;
      setTimeout(() => {
        el.style.opacity = 1;
        count++;
        if (count < repeats) setTimeout(anim, duration);
      }, duration);
    };
    anim();
  }

  // ============================================================
  // API pública
  // ============================================================
  global.App.Animations = {
    init,
    reveal: revealElement,
    pulse: setupPulse,
    shake: setupShake,
    blink: setupBlink,
  };

  // ============================================================
  // Inicialización automática
  // ============================================================
  Utils.on(document, 'DOMContentLoaded', () => {
    try {
      init();
    } catch (e) {
      console.error('[animations] Error al inicializar:', e);
    }
  });

})(window);
