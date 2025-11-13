/* =========================================================================
 *  parallaxkit.js — Punto de entrada legacy al motor App.Modules.Scroll
 * ========================================================================= */

(function (global) {
  'use strict';

  const App = global.App || (global.App = {});
  const Modules = App.Modules || (App.Modules = {});

  if (!Modules.Scroll) {
    console.warn('[parallaxkit.js] App.Modules.Scroll no está disponible.');
    return;
  }

  let bootstrapped = false;

  function bootstrapScroll() {
    if (!Modules.Scroll) return;

    const options = { bus: App.Bus, utils: App.Utils, feature: App.Feature };

    if (!bootstrapped) {
      Modules.Scroll.init(options);
      bootstrapped = true;
    } else if (typeof Modules.Scroll.refresh === 'function') {
      Modules.Scroll.refresh();
    }
  }

  if (document.readyState !== 'loading') bootstrapScroll();
  else document.addEventListener('DOMContentLoaded', bootstrapScroll);

  global.initScrollAnimations = function initScrollAnimations() {
    bootstrapScroll();
  };
})(window);
