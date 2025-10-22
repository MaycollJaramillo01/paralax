<?php
@session_start();
if (!isset($HomeIntro)) include_once __DIR__ . '/../../text.php';

/**
 * HERO-4 "Quantum Canvas" — diseño propio
 * Motor: parallaxkit.js + scroll-anim.js (si existen)
 * CLS-safe, LCP optimizado, JSON-LD + speakable
 */

$headline     = $HomeIntro['headline']     ?? 'Parallax Experiences that Convert';
$sub          = $HomeIntro['sub']          ?? 'Experiencias inmersivas rápidas, accesibles y listas para producción.';
$bullets      = $HomeIntro['bullets']      ?? ['Diseño responsive', 'SEO técnico', 'Core Web Vitals'];
$primaryCTA   = $HomeIntro['primaryCTA']   ?? 'Request a Free Consultation';
$secondaryCTA = $HomeIntro['secondaryCTA'] ?? 'See Our Work';
$company      = $Company                   ?? 'Your Company';
$baseURL      = $BaseURL                   ?? '/';
$experience   = $Experience                ?? '10 Years of Experience';

$img1 = $HeroImages[0] ?? 'assets/images/hero/hero1.jpg';
$img2 = $HeroImages[1] ?? $img1;
$img3 = $HeroImages[2] ?? $img2;

$schemaData = [
  '@context'    => 'https://schema.org',
  '@type'       => 'WebPage',
  'name'        => $SEO['home']['title'] ?? ($company.' | Parallax Web Design'),
  'description' => $SEO['home']['description'] ?? $sub,
  'publisher'   => ['@type'=>'Organization','name'=>$company,'url'=>$baseURL],
  'about'       => $headline,
  'speakable'   => ['@type'=>'SpeakableSpecification','cssSelector'=>['#hero4-title','.q-lead']],
];
?>

<section
  id="hero-quantum"
  class="q-hero"
  aria-labelledby="hero4-title"
  data-hero="quantum"
  data-parallax
  data-scrub="true"
>
  <!-- BG layers -->
  <span class="q-bg q-bg--grid" aria-hidden="true"></span>
  <span class="q-bg q-bg--spotlight" aria-hidden="true"></span>

  <div class="q-wrap">
    <!-- TEXT -->
    <header class="q-content">
      <p class="q-eyebrow" data-animate="fade-in"><?php echo htmlspecialchars($experience, ENT_QUOTES, 'UTF-8'); ?></p>

      <h1 id="hero4-title" class="q-title" data-split="words" data-animate="slide-up">
        <?php echo htmlspecialchars($headline, ENT_QUOTES, 'UTF-8'); ?>
      </h1>

      <p class="q-lead" data-animate="fade-in">
        <?php echo htmlspecialchars($sub, ENT_QUOTES, 'UTF-8'); ?>
      </p>

      <ul class="q-bullets" data-animate="fade-in" data-anim-group="q-bullets">
        <?php foreach ($bullets as $b): ?>
          <li><?php echo htmlspecialchars($b, ENT_QUOTES, 'UTF-8'); ?></li>
        <?php endforeach; ?>
      </ul>

      <div class="q-cta" data-animate="zoom-in">
        <a class="q-btn q-btn--primary" href="<?php echo htmlspecialchars($baseURL . '/contact', ENT_QUOTES, 'UTF-8'); ?>" data-hover="pulse">
          <?php echo htmlspecialchars($primaryCTA, ENT_QUOTES, 'UTF-8'); ?>
        </a>
        <a class="q-btn q-btn--ghost" href="<?php echo htmlspecialchars($baseURL . '/portfolio', ENT_QUOTES, 'UTF-8'); ?>">
          <?php echo htmlspecialchars($secondaryCTA, ENT_QUOTES, 'UTF-8'); ?>
        </a>
      </div>

      <ul class="q-trust" data-animate="fade-in" aria-label="Highlights">
        <li>⚡ 95+ Lighthouse SEO</li>
        <li>♿ Accessible-first</li>
        <li>🚀 CWV Optimized</li>
      </ul>
    </header>

    <!-- VISUAL -->
    <div class="q-visual" data-parallax-mouse data-depth="0.35">
      <div class="q-card" data-animate="zoom-in" data-parallax data-depth="0.18">
        <img
          class="q-img"
          src="<?php echo htmlspecialchars($img1, ENT_QUOTES, 'UTF-8'); ?>"
          data-src-1="<?php echo htmlspecialchars($img1, ENT_QUOTES, 'UTF-8'); ?>"
          data-src-2="<?php echo htmlspecialchars($img2, ENT_QUOTES, 'UTF-8'); ?>"
          data-src-3="<?php echo htmlspecialchars($img3, ENT_QUOTES, 'UTF-8'); ?>"
          alt="<?php echo htmlspecialchars($company, ENT_QUOTES, 'UTF-8'); ?> project showcase"
          width="1200" height="900"
          loading="eager" fetchpriority="high" decoding="async"
        />
        <span class="q-ring q-ring--outer" aria-hidden="true"></span>
        <span class="q-ring q-ring--inner" aria-hidden="true"></span>
      </div>

      <div class="q-dots" aria-label="Slides">
        <button class="is-active" aria-label="Slide 1"></button>
        <button aria-label="Slide 2"></button>
        <button aria-label="Slide 3"></button>
      </div>
    </div>
  </div>

  <script type="application/ld+json"><?php
    echo json_encode($schemaData, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
  ?></script>
</section>
