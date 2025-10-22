/* =========================================================================
 * gallery.js — Sistema de galería avanzada con filtros, lightbox y lazyload
 * Autor: Maycoll (Maven Marketing)
 * Dependencias: App.Utils, App.IO, App.Lazy (opcional)
 * ========================================================================= */

(function (global) {
  "use strict";
  if (!global.App) return console.warn("[gallery.js] main.js requerido");

  const { Utils, IO, Bus } = global.App;

  const Gallery = {
    galleries: [],

    init() {
      Utils.qsa(".gallery").forEach(container => this.setup(container));
      Bus.emit("gallery:init");
    },

    setup(container) {
      const grid = container.querySelector(".gallery-grid");
      const filters = Utils.qsa("[data-filter]", container);
      const items = Utils.qsa(".gallery-item", grid);
      const lightbox = this.createLightbox();

      filters.forEach(btn => {
        Utils.on(btn, "click", () => {
          const cat = btn.dataset.filter;
          filters.forEach(b => b.classList.remove("active"));
          btn.classList.add("active");
          this.filter(items, cat);
        });
      });

      items.forEach(item => {
        Utils.on(item, "click", () => {
          const img = item.querySelector("img");
          const src = img.dataset.src || img.src;
          const alt = img.alt || "";
          this.openLightbox(lightbox, src, alt);
        });
      });

      IO.observe(".gallery img[data-src]", el => {
        const src = el.getAttribute("data-src");
        if (src) {
          el.src = src;
          el.removeAttribute("data-src");
        }
      }, { rootMargin: "20% 0px", once: true });

      this.galleries.push({ container, grid, items });
    },

    filter(items, cat) {
      items.forEach(el => {
        const show = cat === "all" || el.dataset.category === cat;
        el.style.display = show ? "block" : "none";
        el.style.opacity = show ? "1" : "0";
      });
      Bus.emit("gallery:filter", cat);
    },

    createLightbox() {
      if (document.querySelector("#lightbox")) return document.querySelector("#lightbox");
      const overlay = document.createElement("div");
      overlay.id = "lightbox";
      overlay.innerHTML = `
        <div class="lightbox-content">
          <img id="lightbox-img" alt="">
          <button id="lightbox-close" aria-label="Close">×</button>
        </div>`;
      document.body.appendChild(overlay);
      Utils.on(overlay, "click", e => {
        if (e.target.id === "lightbox" || e.target.id === "lightbox-close") overlay.classList.remove("open");
      });
      return overlay;
    },

    openLightbox(overlay, src, alt) {
      const img = overlay.querySelector("img");
      img.src = src;
      img.alt = alt;
      overlay.classList.add("open");
      Bus.emit("gallery:open", { src, alt });
    }
  };

  global.App.Gallery = Gallery;
  document.addEventListener("DOMContentLoaded", () => Gallery.init());
})(window);
