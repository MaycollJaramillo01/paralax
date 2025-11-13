<?php
@session_start();
if (!isset($HomeIntro)) {
    include_once dirname(__DIR__, 3) . '/text.php';
}

$headline = $HomeIntro['headline'] ?? 'Parallax Campaign Architects';
$sub      = $HomeIntro['sub'] ?? 'Strategies engineered to ship performance, accessibility, and measurable ROI.';
$cta1     = $HomeIntro['primaryCTA'] ?? 'Request a Free Strategy Session';
$cta2     = $HomeIntro['secondaryCTA'] ?? 'Explore Our Case Studies';
$images   = $HeroImages ?? [];
$baseURL  = $BaseURL ?? '';
?>
<section class="hero4 hero4--alt" id="hero-4">
  <div class="hero4__slides" aria-hidden="true">
    <?php foreach ($images as $i => $src): ?>
      <div class="hero4__slide<?= $i === 0 ? ' active' : '' ?>">
        <img src="<?= $i === 0 ? htmlspecialchars($src) : '' ?>"
          data-src="<?= htmlspecialchars($src) ?>"
          alt="Hero showcase <?= $i + 1 ?>"
          loading="<?= $i === 0 ? 'eager' : 'lazy' ?>"
          decoding="async">
      </div>
    <?php endforeach; ?>
  </div>

  <div class="hero4__overlay"></div>

  <div class="hero4__content container">
    <div class="hero4__badge">Template 5 · Hero Alt</div>
    <h1 class="hero4__title"><?= htmlspecialchars($headline) ?></h1>
    <p class="hero4__sub"><?= htmlspecialchars($sub) ?></p>
    <div class="hero4__cta">
      <a href="<?= htmlspecialchars($baseURL . '/contact.php') ?>" class="hero4__btn hero4__btn--primary">
        <?= htmlspecialchars($cta1) ?>
      </a>
      <a href="<?= htmlspecialchars($baseURL . '/about.php') ?>" class="hero4__btn hero4__btn--ghost">
        <?= htmlspecialchars($cta2) ?>
      </a>
    </div>
    <div class="hero4__footnote">
      <span><strong>98</strong> Core Web Vitals</span>
      <span><strong>3.2x</strong> Avg. ROI</span>
      <span><strong>24/7</strong> Growth Operations</span>
    </div>
  </div>

  <div class="hero4__thumbs" aria-label="Hero slide selector">
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

<style>
.hero4--alt .hero4__badge{
  display:inline-flex;
  padding:.4rem .9rem;
  border-radius:999px;
  text-transform:uppercase;
  letter-spacing:.16em;
  font-weight:800;
  background:rgba(12,214,255,.2);
  color:#fff;
  margin-bottom:1.4rem;
}
.hero4--alt .hero4__footnote{
  margin-top:2.4rem;
  display:flex;
  flex-wrap:wrap;
  gap:1.2rem;
  font-size:.95rem;
  color:rgba(255,255,255,.75);
}
.hero4--alt .hero4__footnote strong{
  font-size:1.2rem;
  color:#7cf6ff;
}
</style>
