(function (global) {
  'use strict';

  const App = global.App;
  if (!App || !App.Utils || !App.IO) {
    console.warn('[hero-design-2] App core utilities not available.');
    return;
  }

  const { Utils, IO } = App;

  function init() {
    const root = Utils.qs('[data-hero="immersive"]');
    if (!root) return;

    const visual = Utils.qs('[data-hero-visual]', root);
    const orb = Utils.qs('[data-hero-orb]', root);

    if (visual && orb) {
      IO.observe('[data-hero-visual]', (el) => {
        Utils.addClass(el, 'is-active');
      }, { once: true, threshold: [0.35, 0.6] });

      const updateTilt = Utils.throttle((evt) => {
        const rect = visual.getBoundingClientRect();
        const relX = rect.width ? ((evt.clientX - rect.left) / rect.width) - 0.5 : 0;
        const relY = rect.height ? ((evt.clientY - rect.top) / rect.height) - 0.5 : 0;
        visual.style.setProperty('--hero-orb-tilt-x', `${Utils.clamp(relX * -40, -28, 28)}deg`);
        visual.style.setProperty('--hero-orb-tilt-y', `${Utils.clamp(relY * 32 + 8, -12, 28)}deg`);
      }, 32);

      Utils.on(visual, 'pointermove', updateTilt);
      Utils.on(visual, 'pointerleave', () => {
        visual.style.setProperty('--hero-orb-tilt-x', '-18deg');
        visual.style.setProperty('--hero-orb-tilt-y', '12deg');
      });
    }
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init, { once: true });
  } else {
    init();
  }
})(window);