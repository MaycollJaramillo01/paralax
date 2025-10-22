<?php
@session_start();
include_once __DIR__ . '/../../text.php';

/**
 * Aquila Hero — Diseño propio
 * - Animaciones: usa scroll-anim.js + parallaxkit.js (si existen)
 * - SEO: speakable + JSON-LD
 * - Responsive con <picture> y tamaños fijos para evitar CLS
 */

// Fallbacks seguros si no vienen de text.php
$heroHeadline = $HomeIntro['headline']      ?? 'Parallax Experiences that Convert';
$heroSub      = $HomeIntro['sub']           ?? 'Creamos experiencias inmersivas rápidas, accesibles y listas para SEO.';
$bullets      = $HomeIntro['bullets']       ?? ['Diseño responsive', 'SEO técnico', 'Core Web Vitals'];
$primaryCTA   = $HomeIntro['primaryCTA']    ?? 'Request a Free Consultation';
$secondaryCTA = $HomeIntro['secondaryCTA']  ?? 'See Our Work';
$company      = $Company                    ?? 'Your Company';
$baseURL      = $BaseURL                    ?? '/';
$experience   = $Experience                 ?? '10 Years of Experience';
$imgLg        = $HeroImages[0]              ?? 'assets/images/hero/hero1.jpg';
$imgMd        = $HeroImages[1]              ?? $imgLg;
$imgSm        = $HeroImages[2]              ?? $imgMd;

$schemaData = [
  '@context'    => 'https://schema.org',
  '@type'       => 'WebPage',
  'name'        => $SEO['home']['title']        ?? ($company.' | Parallax Web Design'),
  'description' => $SEO['home']['description']  ?? $heroSub,
  'about'       => $heroHeadline,
  'publisher'   => [
    '@type' => 'Organization',
    'name'  => $company,
    'url'   => $baseURL,
  ],
  'speakable' => [
    '@type'       => 'SpeakableSpecification',
    'cssSelector' => ['#aquila-title', '.aquila__lead'],
  ],
];
?>

<!-- AQUILA HERO -->
<section
  id="hero-aquila"
  class="aquila"
  aria-labelledby="aquila-title"
  data-hero="aquila"
  data-parallax
  data-scrub="true"
>
  <!-- fondo decorativo -->
  <span class="aquila__bg" aria-hidden="true"></span>

  <div class="aquila__grid">
    <!-- LADO TEXTO -->
    <header class="aquila__content">
      <p class="aquila__eyebrow" data-animate="fade-in">
        <?php echo htmlspecialchars($experience, ENT_QUOTES, 'UTF-8'); ?>
      </p>

      <h1 id="aquila-title" class="aquila__title" data-animate="slide-up">
        <?php echo htmlspecialchars($heroHeadline, ENT_QUOTES, 'UTF-8'); ?>
      </h1>

      <p class="aquila__lead" data-animate="fade-in">
        <?php echo htmlspecialchars($heroSub, ENT_QUOTES, 'UTF-8'); ?>
      </p>

      <ul class="aquila__bullets" data-animate="fade-in" data-anim-group="aquila-bullets">
        <?php foreach ($bullets as $b): ?>
          <li><?php echo htmlspecialchars($b, ENT_QUOTES, 'UTF-8'); ?></li>
        <?php endforeach; ?>
      </ul>

      <div class="aquila__cta" data-animate="zoom-in">
        <a class="aquila__btn aquila__btn--primary"
           href="<?php echo htmlspecialchars($baseURL . '/contact', ENT_QUOTES, 'UTF-8'); ?>"
           data-hover="pulse">
          <?php echo htmlspecialchars($primaryCTA, ENT_QUOTES, 'UTF-8'); ?>
        </a>
        <a class="aquila__btn aquila__btn--ghost"
           href="<?php echo htmlspecialchars($baseURL . '/portfolio', ENT_QUOTES, 'UTF-8'); ?>">
          <?php echo htmlspecialchars($secondaryCTA, ENT_QUOTES, 'UTF-8'); ?>
        </a>
      </div>

      <!-- trust strip -->
      <ul class="aquila__trust" data-animate="fade-in" aria-label="Highlights">
        <li>⚡ 95+ Lighthouse SEO</li>
        <li>♿ Accessible-first</li>
        <li>🚀 CWV Optimized</li>
      </ul>
    </header>

    <!-- LADO IMAGEN -->
    <div class="aquila__visual" data-parallax-mouse data-depth="0.35">
      <div class="aquila__media" data-animate="zoom-in" data-parallax data-depth="0.15">
        <picture>
          <source srcset="<?php echo htmlspecialchars($imgLg, ENT_QUOTES, 'UTF-8'); ?>" media="(min-width: 1024px)"/>
          <source srcset="<?php echo htmlspecialchars($imgMd, ENT_QUOTES, 'UTF-8'); ?>" media="(min-width: 640px)"/>
          <img
            src="<?php echo htmlspecialchars($imgSm, ENT_QUOTES, 'UTF-8'); ?>"
            alt="<?php echo htmlspecialchars($company, ENT_QUOTES, 'UTF-8'); ?> project showcase"
            width="1200" height="900"
            loading="eager" fetchpriority="high" decoding="async"
          />
        </picture>
      </div>

      <!-- orb parallax -->
      <div class="aquila__orb" data-parallax data-depth="0.25" aria-hidden="true">
        <span class="aquila__orb-ring aquila__orb-ring--outer"></span>
        <span class="aquila__orb-ring aquila__orb-ring--inner"></span>
        <span class="aquila__orb-core"></span>
      </div>
    </div>
  </div>

  <!-- JSON-LD -->
  <script type="application/ld+json">
    <?php echo json_encode($schemaData, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE); ?>
  </script>
</section>
