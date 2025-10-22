// Aquila Hero: integra ScrollAnim + ParallaxKit si existen, con fallback ligero
(function (w, d) {
  'use strict';
  const root = d.querySelector('#hero-aquila');
  if (!root) return;

  // Inicializa motores si están disponibles
  if (w.ParallaxKit && typeof w.ParallaxKit.init === 'function') {
    w.ParallaxKit.init(); // usa data-parallax, data-depth, data-parallax-mouse, data-scrub
  }

  if (w.ScrollAnim && typeof w.ScrollAnim.init === 'function') {
    w.ScrollAnim.init(); // aplica .in-view a [data-animate]
  } else {
    // Fallback mínimo para [data-animate]
    const obs = new IntersectionObserver((entries) => {
      entries.forEach(e => { if (e.isIntersecting) e.target.classList.add('in-view'); });
    }, { threshold: 0.3 });
    root.querySelectorAll('[data-animate]').forEach(el => obs.observe(el));
  }

  // Micro-interacción: ripple del botón primary al enfocar/click
  const primary = root.querySelector('.aquila__btn--primary');
  if (primary) {
    primary.addEventListener('pointerdown', () => {
      primary.style.transform = 'translateY(-1px) scale(0.995)';
      setTimeout(() => (primary.style.transform = ''), 120);
    });
  }
})(window, document);
