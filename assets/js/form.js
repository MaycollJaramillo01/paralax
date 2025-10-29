/* =========================================================================
 *  form.js — Punto de entrada legacy
 *  Mantiene compatibilidad llamando al módulo App.Modules.Forms
 * ========================================================================= */

(function (global) {
  'use strict';

  const App = global.App || (global.App = {});
  const Modules = App.Modules || (App.Modules = {});

  if (!Modules.Forms) {
    console.warn('[form.js] App.Modules.Forms no está disponible. Asegúrate de cargar modules/forms.js.');
    return;
  }

  if (document.readyState !== 'loading') Modules.Forms.init();
  else document.addEventListener('DOMContentLoaded', () => Modules.Forms.init());
})(window);
