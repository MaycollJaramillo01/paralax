<?php
@session_start();
include_once __DIR__ . '/../text.php';

/* ==========================================
   HERO SECTION — DYNAMIC PARALLAX VERSION
   ========================================== */

$heroTitle     = $HomeIntro['headline'] ?? "We Create. You Inspire.";
$heroSub       = $HomeIntro['sub'] ?? "Next-Level Parallax & Performance.";
$primaryCTA    = $HomeIntro['primaryCTA'] ?? "Contact Us";
$secondaryCTA  = $HomeIntro['secondaryCTA'] ?? "Our Projects";
$heroImage     = $HeroImages[0] ?? 'assets/images/hero/hero1.jpg';
?>

<section class="hero-1 parallax-section" aria-label="Hero section">
  <div class="hero-bg parallax-bg layer layer-bg" data-depth="0.15"
       style="background-image:url('<?php echo $heroImage; ?>')"></div>

  <!-- Partículas -->
  <div class="hero-deco" aria-hidden="true">
    <div class="blob blob-1 layer" data-depth="0.25"></div>
    <div class="blob blob-2 layer" data-depth="0.4"></div>
    <div class="blob blob-3 layer" data-depth="0.55"></div>
  </div>

  <div class="hero-overlay"></div>

  <!-- Contenido dinámico -->
  <div class="hero-content parallax-content layer" data-depth="0.8">
    <div class="hero-inner">
      <h1 class="hero-title" data-animate="fade-in">
        <?php echo htmlspecialchars($heroTitle); ?>
      </h1>

      <p class="hero-sub" data-animate="slide-up">
        <?php echo htmlspecialchars($heroSub); ?>
      </p>

      <div class="hero-ctas" data-animate="zoom-in">
        <a href="contact.php" class="btn btn-primary" data-ripple>
          <?php echo htmlspecialchars($primaryCTA); ?>
        </a>
        <a href="projects.php" class="btn btn-ghost" data-ripple>
          <?php echo htmlspecialchars($secondaryCTA); ?>
        </a>
      </div>

      <div class="hero-metrics" data-animate="slide-up">
        <div class="metric">
          <span class="metric-num" data-counter data-to="150" data-duration="1500">0</span><span class="metric-suf">+</span>
          <span class="metric-label">Projects</span>
        </div>
        <div class="metric">
          <span class="metric-num" data-counter data-to="98" data-duration="1500">0</span><span class="metric-suf">%</span>
          <span class="metric-label">Satisfied Clients</span>
        </div>
      </div>
    </div>
  </div>

  <b