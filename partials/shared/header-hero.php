    <?php
@session_start();
if (!isset($BaseURL))  $BaseURL  = '/';
if (!isset($Company))  $Company  = 'Aurora Creative Agency';
$logoSrc = $logoSrc ?? ('assets/images/logo.png');
?>
<link rel="stylesheet" href="<?php echo htmlspecialchars($BaseURL); ?>assets/css/header-hero.css" />

<header class="hh header-hero" data-overlay="glass" aria-label="Primary">
  <div class="hh__wrap">
    <!-- Brand -->
    <a class="hh__brand" href="<?php echo htmlspecialchars($BaseURL); ?>" aria-label="<?php echo htmlspecialchars($Company); ?>">
      <img class="hh__logo" src="<?php echo htmlspecialchars($logoSrc); ?>" alt="<?php echo htmlspecialchars($Company); ?>" width="36" height="36" />
      <span class="hh__brand-text"><?php echo htmlspecialchars($Company); ?></span>
    </a>

    <!-- Center pill nav -->
    <nav class="hh__nav" id="hh-nav" aria-label="Main">
      <ul class="hh__menu">
        <li><a class="hh__link" href="<?php echo htmlspecialchars($BaseURL); ?>about.php">Home</a></li>
        <li><a class="hh__link" href="<?php echo htmlspecialchars($BaseURL); ?>about.php">About</a></li>
        <li><a class="hh__link" href="<?php echo htmlspecialchars($BaseURL); ?>services.php">Services</a></li>
        <li><a class="hh__link" href="<?php echo htmlspecialchars($BaseURL); ?>projects.php">Projects</a></li>
        <li><a class="hh__link" href="<?php echo htmlspecialchars($BaseURL); ?>testimonials.php">Testimonials</a></li>
        <li><a class="hh__link" href="<?php echo htmlspecialchars($BaseURL); ?>contact.php">Contact</a></li>
        <li class="hh__sep" aria-hidden="true"></li>
        <li class="hh__search">
          <button class="hh__icon-btn" type="button" aria-label="Search">
            <svg viewBox="0 0 24 24" width="18" height="18" aria-hidden="true">
              <circle cx="11" cy="11" r="7" fill="none" stroke="currentColor" stroke-width="2"/>
              <path d="M20 20l-3.2-3.2" stroke="currentColor" stroke-width="2" fill="none"/>
            </svg>
          </button>
        </li>
      </ul>
    </nav>

    <!-- CTA -->
    <a class="hh__cta" href="<?php echo htmlspecialchars($BaseURL); ?>reviews.php" aria-label="Leave a review">
      Leave a review
    </a>

    <!-- Burger -->
    <button class="hh__burger" id="hh-burger" aria-expanded="false" aria-controls="hh-drawer" aria-label="Open menu">
      <span></span><span></span><span></span>
    </button>
  </div>

  <!-- Drawer Mobile -->
  <div class="hh__drawer" id="hh-drawer" hidden role="dialog" aria-modal="true" aria-label="Mobile menu">
    <div class="hh__drawer-panel">
      <div class="hh__drawer-head">
        <img class="hh__logo" src="<?php echo htmlspecialchars($logoSrc); ?>" alt="" aria-hidden="true" />
        <button class="hh__close" type="button" aria-label="Close menu">&times;</button>
      </div>
      <nav class="hh__drawer-nav">
        <a href="<?php echo htmlspecialchars($BaseURL); ?>about.php">About</a>
        <a href="<?php echo htmlspecialchars($BaseURL); ?>services.php">Services</a>
        <a href="<?php echo htmlspecialchars($BaseURL); ?>projects.php">Projects</a>
        <a href="<?php echo htmlspecialchars($BaseURL); ?>testimonials.php">Testimonials</a>
        <a href="<?php echo htmlspecialchars($BaseURL); ?>contact.php">Contact</a>
      </nav>
      <a class="hh__drawer-cta" href="<?php echo htmlspecialchars($BaseURL); ?>reviews.php">Leave a review</a>
    </div>
  </div>
</header>

<script src="<?php echo htmlspecialchars($BaseURL); ?>assets/js/header/header-hero.js" defer></script>
