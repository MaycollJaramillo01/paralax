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

  if (document.readyState !== 'loading') Modules.Scroll.init({ bus: App.Bus, utils: App.Utils, feature: App.Feature });
  else document.addEventListener('DOMContentLoaded', () => Modules.Scroll.init({ bus: App.Bus, utils: App.Utils, feature: App.Feature }));
})(window);
