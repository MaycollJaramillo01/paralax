<?php
@session_start();
include_once __DIR__ . '/text.php';
?>
<?php include 'partials/shared/head.php'; ?>

<body class="bg-light text-neutral font-body overflow-x-hidden">

  <?php include 'partials/shared/header-3.php'; ?>


  <?php include 'partials/hero/hero-4.php'; ?>


  <?php include 'partials/faq/faq-v1.php'; ?>
  <?php include 'partials/faq/faq-v2.php'; ?>
  <?php include 'partials/faq/faq-v3.php'; ?>

  <?php include 'partials/about/about-v1.php'; ?>
  <?php include 'partials/about/about-v2.php'; ?>
  <?php include 'partials/about/about-v3.php'; ?>
  <?php include 'partials/services/services-v1.php'; ?>

  <?php include 'partials/services/services-v3.php'; ?>
  <?php include 'partials/services/services-v4.php'; ?>
  <?php include 'partials/services/services-v5.php'; ?>

  <?php include 'partials/projects/featured-projects.php'; ?>
  <?php include 'partials/projects/featured-projects-v2.php'; ?>
  <?php include 'partials/projects/featured-projects-v3.php'; ?>
  <?php include 'partials/testimonials/testimonials-v1.php'; ?>
  <?php include 'partials/testimonials/testimonials-v2.php'; ?>
  <?php include 'partials/testimonials/testimonials-v3.php'; ?>

  <?php include 'partials/metrics/metrics-v1.php'; ?>
  <?php include 'partials/metrics/metrics-v2.php'; ?>
  <?php include 'partials/metrics/metrics-v3.php'; ?>


  <?php include 'partials/cta/cta-v1.php'; ?>
  <?php include 'partials/cta/cta-v2.php'; ?>
    <?php include 'partials/cta/cta-v3.php'; ?>

  <?php include 'partials/partners/partners-v2.php'; ?>
  <?php include 'partials/contact/form-v1.php'; ?>
  <?php include 'partials/contact/form-v2.php'; ?>
  <?php include 'partials/contact/form-v3.php'; ?>

  <footer class="bg-primary text-light text-center py-4 font-body text-sm">
    <p>&copy; <?= date('Y'); ?> Demo Parallax Template. Designed by <strong>Maycoll Jaramillo</strong>.</p>
  </footer>

  <?php include 'partials/shared/scripts.php'; ?>
<script>
/* Parallax + reveal simple (no dependencias) */
(function(){
  // Parallax background movement based on scroll
  const hero = document.querySelector('.hero-card');
  const bg = hero?.querySelector('.hero-card-bg');

  function onScroll(){
    if(!bg || !hero) return;
    const rect = hero.getBoundingClientRect();
    const winH = window.innerHeight;
    // factor dentro de la vista -> -50..50
    const pct = Math.max(-1, Math.min(1, (rect.top - (winH/2)) / (winH/2)));
    // mueve background ligeramente según porcentaje
    const translateY = pct * 20; // px
    bg.style.transform = `translateY(${translateY}px) scale(1.12)`;
  }
  window.addEventListener('scroll', onScroll, {passive:true});
  onScroll();

  // IntersectionObserver para animaciones data-animate
  const obs = new IntersectionObserver((entries)=>{
    entries.forEach(e=>{
      if(e.isIntersecting){
        e.target.classList.add('visible');
        e.target.classList.add('reveal');
      }
    });
  }, {threshold: 0.18});
  document.querySelectorAll('[data-animate]').forEach(el => obs.observe(el));
})();
</script>

</body>

</html>