/* =========================================================================
 *  scroll-anim.js — Legacy shim hacia App.Modules.Scroll
 * ========================================================================= */

(function (global) {
  'use strict';

  const App = global.App || (global.App = {});
  const Modules = App.Modules || (App.Modules = {});

  if (!Modules.Scroll) {
    console.warn('[scroll-anim.js] Requiere modules/scroll.js');
    return;
  }

  if (document.readyState !== 'loading') Modules.Scroll.refresh?.();
  else document.addEventListener('DOMContentLoaded', () => Modules.Scroll.refresh?.());
})(window);
