(function (w, d) {
  'use strict';

  const header = d.querySelector('.header-hero.hh');
  const burger = d.getElementById('hh-burger');
  const drawer = d.getElementById('hh-drawer');
  const closeBtn = drawer ? drawer.querySelector('.hh__close') : null;

  // sticky scroll state for stronger glass
  let lastY = 0;
  function onScroll() {
    const y = w.scrollY || w.pageYOffset || 0;
    header && header.classList.toggle('is-scrolled', y > 8);
    lastY = y;
  }
  w.addEventListener('scroll', onScroll, { passive: true });
  onScroll();

  // Drawer open/close
  function openDrawer() {
    if (!drawer) return;
    drawer.removeAttribute('hidden');
    drawer.setAttribute('open', '');
    burger.setAttribute('aria-expanded', 'true');
    d.documentElement.classList.add('hero-blur-active'); // optional blur style from hero
    // focus first link
    const first = drawer.querySelector('a,button');
    first && setTimeout(()=> first.focus(), 50);
    // prevent body scroll
    d.body.style.overflow = 'hidden';
  }
  function closeDrawer() {
    if (!drawer) return;
    drawer.removeAttribute('open');
    burger.setAttribute('aria-expanded', 'false');
    d.documentElement.classList.remove('hero-blur-active');
    d.body.style.overflow = '';
    setTimeout(()=> drawer.setAttribute('hidden',''), 250);
    burger.focus();
  }

  burger && burger.addEventListener('click', openDrawer);
  closeBtn && closeBtn.addEventListener('click', closeDrawer);
  drawer && drawer.addEventListener('click', (e)=>{
    if (e.target === drawer) closeDrawer();
  });
  w.addEventListener('keydown', (e)=>{
    if (e.key === 'Escape' && drawer && drawer.hasAttribute('open')) closeDrawer();
  });

  // Prevent scroll bounce at panel edges
  if (drawer) {
    const panel = drawer.querySelector('.hh__drawer-panel');
    panel.addEventListener('wheel', (e)=>{
      const atTop = panel.scrollTop === 0 && e.deltaY < 0;
      const atBottom = Math.ceil(panel.scrollTop + panel.clientHeight) >= panel.scrollHeight && e.deltaY > 0;
      if (atTop || atBottom) e.preventDefault();
    }, { passive: false });
  }

  // Sync with site bus if available
  if (w.App && App.Bus) {
    App.Bus.on('menu:close', closeDrawer);
    App.Bus.on('menu:open', openDrawer);
  }

  // When hero / parallax refreshes layout
  d.addEventListener('DOMContentLoaded', ()=>{
    if (w.ParallaxKit && typeof ParallaxKit.refresh === 'function') {
      try { ParallaxKit.refresh(); } catch(_) {}
    }
  });

})(window, document);
