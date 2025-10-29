/* =========================================================================
 *  lazyload.js — Punto de entrada legacy que delega en App.Modules.Lazy
 * ========================================================================= */

(function (global) {
  'use strict';

  const App = global.App || (global.App = {});
  const Modules = App.Modules || (App.Modules = {});

  if (!Modules.Lazy) {
    console.warn('[lazyload.js] App.Modules.Lazy no está disponible.');
    return;
  }

  if (document.readyState !== 'loading') Modules.Lazy.init();
  else document.addEventListener('DOMContentLoaded', () => Modules.Lazy.init());
})(window);
