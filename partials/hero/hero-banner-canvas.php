<?php
@session_start();
if (!isset($HomeIntro)) include_once __DIR__ . '/../../text.php';

$headline   = $HomeIntro['headline'] ?? 'Parallax Websites that Convert';
$sub        = $HomeIntro['sub'] ?? 'Creamos experiencias inmersivas rápidas, accesibles y listas para producción.';
$bullets    = $HomeIntro['bullets'] ?? ['Diseño responsive', 'SEO técnico', 'Core Web Vitals'];
$cta1       = $HomeIntro['primaryCTA'] ?? 'Request a Free Consultation';
$cta2       = $HomeIntro['secondaryCTA'] ?? 'See Our Work';
$baseURL    = $BaseURL ?? '/';
$experience = $Experience ?? '10 Years of Experience';
?>
<section class="ph4-hero" id="ph4-hero" aria-labelledby="ph4-title">
  <!-- Tu canvas (fondo animado) -->
  <canvas id="canvas" class="ph4-canvas" aria-hidden="true"></canvas>

  <!-- Scrim para contraste de texto -->
  <span class="ph4-scrim" aria-hidden="true"></span>

  <!-- Contenido centrado -->
  <div class="ph4-inner" data-animate="fade-in">
    <p class="ph4-eyebrow"><?php echo htmlspecialchars($experience, ENT_QUOTES, 'UTF-8'); ?></p>

    <h1 id="ph4-title" class="ph4-title">
      <?php echo htmlspecialchars($headline, ENT_QUOTES, 'UTF-8'); ?>
    </h1>

    <p class="ph4-sub">
      <?php echo htmlspecialchars($sub, ENT_QUOTES, 'UTF-8'); ?>
    </p>

    <ul class="ph4-bullets">
      <?php foreach ($bullets as $b): ?>
        <li><?php echo htmlspecialchars($b, ENT_QUOTES, 'UTF-8'); ?></li>
      <?php endforeach; ?>
    </ul>

    <div class="ph4-cta">
      <a class="ph4-btn ph4-btn--primary" href="<?php echo htmlspecialchars($baseURL . '/contact', ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($cta1, ENT_QUOTES, 'UTF-8'); ?></a>
      <a class="ph4-btn ph4-btn--ghost" href="<?php echo htmlspecialchars($baseURL . '/portfolio', ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($cta2, ENT_QUOTES, 'UTF-8'); ?></a>
    </div>
  </div>
</section>
