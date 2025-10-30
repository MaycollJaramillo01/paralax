<?php
@session_start();
include_once __DIR__ . '/text.php';

$templateMap = [
    'home-1' => [
        'label' => 'Home 1 — Classic agency',
        'sections' => ['hero', 'faq', 'about', 'projects', 'testimonials', 'metrics', 'cta', 'partners', 'contact'],
    ],
    'home-2' => [
        'label' => 'Home 2 — Performance suite',
        'sections' => ['hero', 'faq', 'about', 'services', 'projects', 'testimonials', 'metrics', 'cta', 'partners', 'contact'],
    ],
    'home-3' => [
        'label' => 'Home 3 — Immersive parallax',
        'sections' => ['hero', 'hero-alt', 'hero-canvas', 'faq', 'about', 'services', 'services-alt', 'projects', 'testimonials', 'metrics', 'cta', 'cta-alt', 'partners', 'contact'],
    ],
    'home-4' => [
        'label' => 'Home 4 — Growth architecture',
        'sections' => ['hero', 'solutions', 'process', 'case-studies', 'cta'],
    ],
    'home-5' => [
        'label' => 'Home 5 — Campaign accelerator',
        'sections' => ['hero-alt', 'trust', 'services', 'insights', 'contact'],
    ],
];

$requestedTemplate = $_GET['template'] ?? 'home-1';
if (!array_key_exists($requestedTemplate, $templateMap)) {
    $requestedTemplate = 'home-1';
}

$CurrentTemplate = $requestedTemplate;
$sectionsToInclude = $templateMap[$requestedTemplate]['sections'];
?>
<?php include 'partials/shared/head.php'; ?>

<body class="bg-light text-neutral font-body overflow-x-hidden" data-template="<?= htmlspecialchars($CurrentTemplate) ?>">

  <?php include 'partials/shared/header-template.php'; ?>

  <?php
  foreach ($sectionsToInclude as $section) {
      $path = __DIR__ . '/partials/templates/' . $CurrentTemplate . '/' . $section . '.php';
      if (file_exists($path)) {
          include $path;
      }
  }
  ?>

  <footer class="bg-primary text-light text-center py-4 font-body text-sm">
    <p>&copy; <?= date('Y'); ?> Demo Parallax Template. Designed by <strong>Maycoll Jaramillo</strong>.</p>
  </footer>

  <?php include 'partials/shared/scripts.php'; ?>
  <script>
  /* Parallax + reveal simple (no dependencias) */
  (function(){
    const hero = document.querySelector('.hero-card');
    const bg = hero?.querySelector('.hero-card-bg');

    function onScroll(){
      if(!bg || !hero) return;
      const rect = hero.getBoundingClientRect();
      const winH = window.innerHeight;
      const pct = Math.max(-1, Math.min(1, (rect.top - (winH/2)) / (winH/2)));
      const translateY = pct * 20;
      bg.style.transform = `translateY(${translateY}px) scale(1.12)`;
    }
    window.addEventListener('scroll', onScroll, {passive:true});
    onScroll();

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
