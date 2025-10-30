<script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js" defer></script>
<!-- CORE / FRAMEWORK -->
<script src="assets/js/main.js" defer></script>
<script src="assets/js/parallaxkit.js" defer></script>
<script src="assets/js/scroll-anim.js" defer></script>
<script src="assets/js/nav-enhance.js" defer></script>
<script src="assets/js/animations.js" defer></script>
<script src="assets/js/analytics.js" defer></script>

<!-- HEADER DEPENDENCIES -->
<script src="assets/js/header/header-template.js" defer></script>

<!-- HERO -->
<script src="assets/js/hero/hero-banner-canvas.js" defer></script>
<script src="assets/js/hero/hero-4.js" defer></script>

<!-- SAFE INIT -->
<script>
  document.addEventListener('DOMContentLoaded', () => {
    if (window.ParallaxKit?.init) ParallaxKit.init();
    if (window.ScrollAnim?.init) ScrollAnim.init();
  });
</script>
<script>
(() => {
  // Load Font Awesome
  const fa = document.createElement('script');
  fa.src = "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/js/all.min.js";
  fa.defer = true;
  fa.crossOrigin = "anonymous";
  fa.referrerPolicy = "no-referrer";
  document.head.appendChild(fa);

  // Initialize animations
  document.addEventListener('DOMContentLoaded', () => {
    if (typeof initScrollAnimations === 'function') initScrollAnimations();
  });
})();
</script>
