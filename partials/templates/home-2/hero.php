<?php
@session_start();
include_once dirname(__DIR__, 3) . '/text.php';
/**
 * Hero Design 2 — "The Immersive Split Screen"
 * Data source: text.php
 */
$heroHeadline = $HomeIntro['headline'];
$heroSub      = $HomeIntro['sub'];
$primaryCTA   = $HomeIntro['primaryCTA'];
$secondaryCTA = $HomeIntro['secondaryCTA'];
$serviceHighlights = array_slice($SN, 1, 3, true);
$heroImagePrimary  = $HeroImages[1] ?? ($HeroImages[0] ?? '');
$heroImageFallback = $HeroImages[2] ?? $heroImagePrimary;
$schemaData = [
  '@context' => 'https://schema.org',
  '@type'    => 'Service',
  'serviceType' => 'Parallax Web Design',
  'provider' => [
    '@type' => 'Organization',
    'name'  => $Company,
    'url'   => $BaseURL,
    'telephone' => $Phone,
    'address' => $NAP,
  ],
  'areaServed' => $ServiceAreas,
  'description' => $heroSub,
  'offers' => [
    '@type' => 'Offer',
    'url'   => $BaseURL . '/contact',
    'price' => '0',
    'priceCurrency' => 'USD',
    'availability' => 'https://schema.org/InStock',
    'eligibleRegion' => $ServiceAreas,
  ],
];
?>
<section
  class="hero-immersive"
  id="hero-immersive"
  aria-labelledby="hero2-title"
  data-hero="immersive"
  data-parallax
  data-scrub="true"
>
  <div class="hero-immersive__split">

    <!-- BLOQUE DE TEXTO -->
    <header class="hero-immersive__content" data-animate="slide-left">
      <p class="hero-immersive__meta" data-animate="fade-in">
        <?php echo htmlspecialchars($Estimates, ENT_QUOTES, 'UTF-8'); ?>
      </p>

      <h1 id="hero2-title" class="hero-immersive__title" data-animate="slide-up">
        <?php echo htmlspecialchars($heroHeadline, ENT_QUOTES, 'UTF-8'); ?>
      </h1>

      <p class="hero-immersive__lead" data-animate="fade-in">
        <?php echo htmlspecialchars($heroSub, ENT_QUOTES, 'UTF-8'); ?>
      </p>

      <ul class="hero-immersive__services" data-animate="fade-in" data-anim-group="hero2-services">
        <?php foreach ($serviceHighlights as $service): ?>
          <li><?php echo htmlspecialchars($service, ENT_QUOTES, 'UTF-8'); ?></li>
        <?php endforeach; ?>
      </ul>

      <div class="hero-immersive__cta" data-animate="zoom-in">
        <a
          class="hero-immersive__btn hero-immersive__btn--primary"
          href="<?php echo htmlspecialchars($BaseURL . '/contact', ENT_QUOTES, 'UTF-8'); ?>"
          data-hover="pulse"
        >
          <?php echo htmlspecialchars($primaryCTA, ENT_QUOTES, 'UTF-8'); ?>
        </a>
        <a
          class="hero-immersive__btn hero-immersive__btn--link"
          href="<?php echo htmlspecialchars($BaseURL . '/portfolio', ENT_QUOTES, 'UTF-8'); ?>"
        >
          <?php echo htmlspecialchars($secondaryCTA, ENT_QUOTES, 'UTF-8'); ?>
        </a>
      </div>
    </header>

    <!-- BLOQUE VISUAL -->
    <div class="hero-immersive__visual" data-parallax-mouse data-depth="0.35" data-animate="zoom-in">
      <div class="hero-immersive__media" data-animate="fade-in" data-parallax data-depth="0.15">
        <picture>
          <source
            srcset="<?php echo htmlspecialchars($heroImagePrimary, ENT_QUOTES, 'UTF-8'); ?>"
            media="(min-width: 1024px)"
          />
          <img
            src="<?php echo htmlspecialchars($heroImageFallback, ENT_QUOTES, 'UTF-8'); ?>"
            alt="<?php echo htmlspecialchars($Company, ENT_QUOTES, 'UTF-8'); ?> immersive interface"
            width="960"
            height="1080"
            loading="lazy"
            decoding="async"
          />
        </picture>
      </div>

      <div class="hero-immersive__orb" data-parallax data-depth="0.25" aria-hidden="true">
        <span class="hero-immersive__orb-ring hero-immersive__orb-ring--outer"></span>
        <span class="hero-immersive__orb-ring hero-immersive__orb-ring--inner"></span>
        <span class="hero-immersive__orb-core"></span>
      </div>
    </div>

  </div>

  <script type="application/ld+json" class="hero-schema">
    <?php echo json_encode($schemaData, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE); ?>
  </script>
</section>
