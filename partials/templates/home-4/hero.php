<?php
@session_start();
if (!isset($HomeIntro)) {
    include_once dirname(__DIR__, 3) . '/text.php';
}

$headline = $HomeIntro['headline'] ?? 'Performance Marketing Experiences';
$sub      = $HomeIntro['sub'] ?? 'Immersive parallax storytelling blended with measurable growth campaigns.';
$bullets  = $HomeIntro['bullets'] ?? [];
$cta1     = $HomeIntro['primaryCTA'] ?? 'Request a Free Strategy Session';
$cta2     = $HomeIntro['secondaryCTA'] ?? 'Explore Our Case Studies';
$images   = $HeroImages ?? [];
$baseURL  = $BaseURL ?? '';
?>
<section class="hero4 hero4--agency" id="hero-4">
  <div class="hero4__slides" aria-hidden="true">
    <?php foreach ($images as $i => $src): ?>
      <div class="hero4__slide<?= $i === 0 ? ' active' : '' ?>">
        <img src="<?= $i === 0 ? htmlspecialchars($src) : '' ?>"
          data-src="<?= htmlspecialchars($src) ?>"
          alt="Hero background <?= $i + 1 ?>"
          loading="<?= $i === 0 ? 'eager' : 'lazy' ?>"
          decoding="async">
      </div>
    <?php endforeach; ?>
  </div>

  <div class="hero4__overlay"></div>

  <div class="hero4__content container">
    <div class="hero4__badge">Growth Architecture 4.0</div>
    <h1 class="hero4__title"><?= htmlspecialchars($headline) ?></h1>
    <p class="hero4__sub"><?= htmlspecialchars($sub) ?></p>

    <?php if (!empty($bullets)): ?>
    <ul class="hero4__bullets">
      <?php foreach ($bullets as $point): ?>
        <li><?= htmlspecialchars($point) ?></li>
      <?php endforeach; ?>
    </ul>
    <?php endif; ?>

    <div class="hero4__cta">
      <a href="<?= htmlspecialchars($baseURL . '/contact.php') ?>" class="hero4__btn hero4__btn--primary">
        <?= htmlspecialchars($cta1) ?>
      </a>
      <a href="<?= htmlspecialchars($baseURL . '/projects.php') ?>" class="hero4__btn hero4__btn--ghost">
        <?= htmlspecialchars($cta2) ?>
      </a>
    </div>

    <dl class="hero4__metrics">
      <div>
        <dt>+142%</dt>
        <dd>Average campaign ROI</dd>
      </div>
      <div>
        <dt>95</dt>
        <dd>Lighthouse SEO score</dd>
      </div>
      <div>
        <dt>50+</dt>
        <dd>Growth partners</dd>
      </div>
    </dl>
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
.hero4--agency .hero4__badge{
  display:inline-flex;
  align-items:center;
  gap:.4rem;
  padding:.45rem .9rem;
  border-radius:999px;
  font-size:.85rem;
  letter-spacing:.08em;
  text-transform:uppercase;
  background:rgba(255,255,255,.18);
  backdrop-filter:blur(6px);
  color:#fff;
  font-weight:700;
  margin-bottom:1.2rem;
}
.hero4--agency .hero4__bullets{
  display:grid;
  gap:.45rem;
  margin:1.5rem 0 2rem;
  padding:0;
  list-style:none;
}
.hero4--agency .hero4__bullets li{
  position:relative;
  padding-left:1.6rem;
  color:rgba(255,255,255,.92);
  font-size:1rem;
}
.hero4--agency .hero4__bullets li::before{
  content:'✔';
  position:absolute;
  left:0;
  top:.05rem;
  color:#7cf6ff;
}
.hero4__metrics{
  margin:2.2rem 0 0;
  display:grid;
  grid-template-columns:repeat(3,minmax(0,1fr));
  gap:1.2rem;
  padding:0;
}
.hero4__metrics dt{
  font-size:2rem;
  font-weight:800;
  color:#fff;
}
.hero4__metrics dd{
  margin:0;
  color:rgba(255,255,255,.7);
  font-size:.95rem;
}
@media (max-width:768px){
  .hero4__metrics{
    grid-template-columns:repeat(2,minmax(0,1fr));
  }
}
@media (max-width:540px){
  .hero4__metrics{
    grid-template-columns:1fr;
  }
}
</style>
