<?php
@session_start();
if (!isset($HomeIntro)) include_once dirname(__DIR__, 3) . '/text.php';

$headline = $HomeIntro['headline'] ?? 'Parallax Websites that Convert';
$sub      = $HomeIntro['sub'] ?? 'Creamos experiencias web inmersivas con rendimiento, accesibilidad y SEO listos para producción.';
$cta1     = $HomeIntro['primaryCTA'] ?? 'Request a Free Consultation';
$cta2     = $HomeIntro['secondaryCTA'] ?? 'See Our Work';
$images   = $HeroImages ?? [];
$baseURL  = $BaseURL ?? '';
?>
<section class="hero4" id="hero-4">
  <div class="hero4__slides">
    <?php foreach ($images as $i => $src): ?>
      <div class="hero4__slide<?= $i === 0 ? ' active' : '' ?>">
        <img src="<?= $i === 0 ? htmlspecialchars($src) : '' ?>"
          data-src="<?= htmlspecialchars($src) ?>"
          alt="Slide <?= $i + 1 ?>" loading="<?= $i === 0 ? 'eager' : 'lazy' ?>" decoding="async">
      </div>
    <?php endforeach; ?>
  </div>

  <div class="hero4__overlay"></div>

  <div class="hero4__content container">
    <h1 class="hero4__title"><?= htmlspecialchars($headline) ?></h1>
    <p class="hero4__sub"><?= htmlspecialchars($sub) ?></p>
    <div class="hero4__cta">
      <a href="<?= htmlspecialchars($baseURL . '/contact.php') ?>" class="hero4__btn hero4__btn--primary"><?= htmlspecialchars($cta1) ?></a>
      <a href="<?= htmlspecialchars($baseURL . '/gallery.php') ?>" class="hero4__btn hero4__btn--ghost"><?= htmlspecialchars($cta2) ?></a>
    </div>
  </div>

  <div class="hero4__thumbs">
    <div class="hero4__arrows">
      <button class="hero4__arrow prev" aria-label="Previous slide">←</button>
      <button class="hero4__arrow next" aria-label="Next slide">→</button>
    </div>
    <div class="hero4__thumbs-list">
      <?php foreach ($images as $i => $src): ?>
        <button class="hero4__thumb<?= $i === 0 ? ' active' : '' ?>" data-index="<?= $i ?>">
          <img src="<?= htmlspecialchars($src) ?>" alt="Preview <?= $i + 1 ?>">
        </button>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<script src="<?= htmlspecialchars($baseURL) ?>/assets/js/hero/hero-4.js" defer></script>
