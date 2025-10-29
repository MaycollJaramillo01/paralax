/* =========================================================================
 * ui-kit.js — Componentes UI reutilizables: modales, tabs, tooltips, acordeones
 * Autor: Maycoll (Maven Marketing)
 * ========================================================================= */

(function (global) {
  "use strict";
  if (!global.App) return console.warn("[ui-kit.js] main.js requerido");

  const { Utils, Bus } = global.App;

  const UI = {
    init() {
      App.Modules?.Modal?.init({ utils: Utils, bus: Bus });
      this.tabs();
      this.tooltips();
      this.accordions();
      Bus.emit("ui:init");
    },

    tabs() {
      Utils.qsa(".tabs").forEach(tabset => {
        const buttons = Utils.qsa("[data-tab]", tabset);
        const panels = Utils.qsa(".tab-panel", tabset);
        buttons.forEach(btn => {
          Utils.on(btn, "click", () => {
            const target = btn.dataset.tab;
            buttons.forEach(b => b.classList.remove("active"));
            panels.forEach(p => p.classList.remove("active"));
            btn.classList.add("active");
            const panel = tabset.querySelector(`#${target}`);
            if (panel) panel.classList.add("active");
            Bus.emit("ui:tab:change", target);
          });
        });
      });
    },

    tooltips() {
      Utils.qsa("[data-tooltip]").forEach(el => {
        const tip = document.createElement("div");
        tip.className = "tooltip";
        tip.textContent = el.dataset.tooltip;
        document.body.appendChild(tip);
        Utils.on(el, "mouseenter", e => {
          tip.style.display = "block";
          const r = e.target.getBoundingClientRect();
          tip.style.left = `${r.left + r.width / 2}px`;
          tip.style.top = `${r.top - 30}px`;
        });
        Utils.on(el, "mouseleave", () => (tip.style.display = "none"));
      });
    },

    accordions() {
      Utils.qsa(".accordion").forEach(acc => {
        Utils.qsa(".accordion-header", acc).forEach(head => {
          Utils.on(head, "click", () => {
            const item = head.parentElement;
            const open = item.classList.contains("open");
            Utils.qsa(".accordion-item", acc).forEach(i => i.classList.remove("open"));
            if (!open) item.classList.add("open");
            Bus.emit("ui:accordion:toggle", item);
          });
        });
      });
    }
  };

  global.App.UI = UI;
  document.addEventListener("DOMContentLoaded", () => UI.init());
})(window);
