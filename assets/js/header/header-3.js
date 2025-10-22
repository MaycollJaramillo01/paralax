/* =========================================================================
 * header-3.js — Aurora Floating Header Controller
 * ========================================================================= */
(function (global) {
  'use strict';
  const d = document;
  const header = d.querySelector('.header-floating');
  const menu = d.getElementById('mobile-menu');
  const toggle = d.getElementById('menu-toggle');
  const closeBtn = d.getElementById('menu-close');
  const overlay = d.getElementById('menu-overlay');

  if (!header) return;

  let lastY = 0;
  window.addEventListener('scroll', () => {
    const y = window.scrollY || 0;
    const down = y > lastY;
    const scrolled = y > 60;
    header.classList.toggle('scrolled', scrolled);
    header.style.opacity = down && y > 150 ? '0.95' : '1';
    lastY = y;
  });

  function toggleMenu(force) {
    const open = typeof force === 'boolean' ? force : !menu.classList.contains('open');
    menu.classList.toggle('open', open);
    d.body.style.overflow = open ? 'hidden' : '';
  }

  toggle?.addEventListener('click', () => toggleMenu(true));
  closeBtn?.addEventListener('click', () => toggleMenu(false));
  overlay?.addEventListener('click', () => toggleMenu(false));

})(window);
