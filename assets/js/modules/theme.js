/* =========================================================================
 * modules/theme.js — Gestor de temas (light/dark) para App.Modules.Theme
 * ========================================================================= */

(function (global) {
  'use strict';

  const App = global.App || (global.App = {});
  const Modules = App.Modules || (App.Modules = {});
  const d = global.document;

  Modules.Theme = (function () {
    const defaults = {
      attribute: 'data-theme',
      storageKey: 'app:theme',
      toggleSelector: '[data-theme-toggle]',
      defaultTheme: 'system',
    };

    let cfg = { ...defaults };
    let utils = App.Utils || null;
    let bus = App.Bus || null;
    let mediaQuery = null;

    function init(options = {}) {
      cfg = { ...defaults, ...(options.config || {}) };
      utils = options.utils || App.Utils || null;
      bus = options.bus || App.Bus || null;

      mediaQuery = global.matchMedia('(prefers-color-scheme: dark)');
      if (mediaQuery) {
        mediaQuery.addEventListener?.('change', applySystemPreference);
        mediaQuery.addListener?.(applySystemPreference);
      }

      const saved = readStoredTheme();
      if (saved) applyTheme(saved);
      else if (cfg.defaultTheme === 'system') applyTheme(mediaQuery.matches ? 'dark' : 'light', false);
      else applyTheme(cfg.defaultTheme, false);

      bindToggles();
      emit('theme:ready', currentTheme());
    }

    function bindToggles() {
      const toggles = (utils?.qsa ? utils.qsa(cfg.toggleSelector) : Array.prototype.slice.call(d.querySelectorAll(cfg.toggleSelector)));
      toggles.forEach((btn) => {
        btn.addEventListener('click', (e) => {
          e.preventDefault();
          toggle();
        });
      });
    }

    function currentTheme() {
      return d.documentElement.getAttribute(cfg.attribute) || null;
    }

    function readStoredTheme() {
      try {
        if (utils?.storage) return utils.storage.get(cfg.storageKey, null);
        return JSON.parse(localStorage.getItem(cfg.storageKey));
      } catch (_) {
        return null;
      }
    }

    function persistTheme(theme) {
      try {
        if (utils?.storage) utils.storage.set(cfg.storageKey, theme);
        else localStorage.setItem(cfg.storageKey, JSON.stringify(theme));
      } catch (_) {}
    }

    function applyTheme(theme, persist = true) {
      if (!theme) return;
      d.documentElement.setAttribute(cfg.attribute, theme);
      persist && persistTheme(theme);
      emit('theme:change', theme);
    }

    function toggle() {
      const theme = currentTheme();
      const next = theme === 'dark' ? 'light' : 'dark';
      applyTheme(next);
    }

    function applySystemPreference() {
      if (readStoredTheme()) return; // respeta la preferencia guardada
      const prefersDark = mediaQuery ? mediaQuery.matches : false;
      applyTheme(prefersDark ? 'dark' : 'light', false);
    }

    function emit(evt, payload) {
      try { bus && typeof bus.emit === 'function' && bus.emit(evt, payload); }
      catch (err) { console.error('[Theme] emit error', err); }
    }

    return {
      init,
      apply: applyTheme,
      toggle,
      current: currentTheme,
    };
  })();
})(window);
