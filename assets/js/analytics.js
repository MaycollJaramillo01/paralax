/* =========================================================================
 * analytics.js — Seguimiento de interacción, scroll-depth, clics y métricas
 * Autor: Maycoll (Maven Marketing)
 * ========================================================================= */

(function (global) {
  "use strict";
  if (!global.App) return console.warn("[analytics.js] main.js requerido");

  const { Utils, Bus } = global.App;

  const Analytics = {
    init() {
      this.trackScrollDepth();
      this.trackClicks();
      this.trackOutbound();
      this.performanceMetrics();
      Bus.emit("analytics:init");
    },

    trackScrollDepth() {
      const thresholds = [25, 50, 75, 100];
      const triggered = new Set();

      const onScroll = Utils.throttle(() => {
        const scrollTop = window.scrollY || document.documentElement.scrollTop;
        const docHeight = document.documentElement.scrollHeight - window.innerHeight;
        const percent = Math.round((scrollTop / docHeight) * 100);
        thresholds.forEach(t => {
          if (percent >= t && !triggered.has(t)) {
            triggered.add(t);
            Bus.emit("analytics:scroll", { percent: t });
          }
        });
      }, 300);

      Utils.on(window, "scroll", onScroll);
    },

    trackClicks() {
      Utils.on(document, "click", e => {
        const el = e.target.closest("a, button, [data-track]");
        if (!el) return;
        const label = el.dataset.track || el.textContent.trim().slice(0, 40);
        Bus.emit("analytics:click", { label, href: el.href || null });
      });
    },

    trackOutbound() {
      Utils.on(document, "click", e => {
        const a = e.target.closest("a[href]");
        if (!a) return;
        const url = new URL(a.href);
        if (url.host !== location.host) {
          Bus.emit("analytics:outbound", { href: a.href });
        }
      });
    },

    performanceMetrics() {
      if (!("performance" in window)) return;
      window.addEventListener("load", () => {
        const t = performance.timing;
        const metrics = {
          dns: t.domainLookupEnd - t.domainLookupStart,
          connect: t.connectEnd - t.connectStart,
          ttfb: t.responseStart - t.requestStart,
          render: t.domComplete - t.domLoading,
          total: t.loadEventEnd - t.navigationStart
        };
        Bus.emit("analytics:performance", metrics);
      });
    }
  };

  global.App.Analytics = Analytics;
  document.addEventListener("DOMContentLoaded", () => Analytics.init());
})(window);
