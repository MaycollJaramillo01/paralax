<?php
@session_start();
if (!isset($BaseURL))  $BaseURL  = '/';
if (!isset($Company))  $Company  = 'Aurora Creative Agency';
$logoSrc = 'assets/images/logo.png';
?>
<header class="h5" data-header="pill">
  <div class="h5__row">
    <!-- Brand -->
    <a class="h5__brand" href="<?php echo htmlspecialchars($BaseURL, ENT_QUOTES, 'UTF-8'); ?>" aria-label="<?php echo htmlspecialchars($Company, ENT_QUOTES, 'UTF-8'); ?>">
      <img class="h5__logo" src="<?php echo htmlspecialchars($logoSrc, ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($Company, ENT_QUOTES, 'UTF-8'); ?>" width="120" height="32" />
      <span class="h5__brand-text"><?php echo htmlspecialchars($Company, ENT_QUOTES, 'UTF-8'); ?></span>
    </a>

    <!-- Burger (mobile) -->
    <button class="h5__burger" id="h5-burger" aria-expanded="false" aria-controls="h5-nav" aria-label="Open menu">
      <span class="h5__burger-bar"></span><span class="h5__burger-bar"></span><span class="h5__burger-bar"></span>
    </button>

    <!-- Center pill nav -->
    <nav class="h5__nav" id="h5-nav" aria-label="Main">
      <ul class="h5__menu">
        <li class="h5__item h5__item--dd">
          <button class="h5__link" aria-expanded="false">Platform</button>
          <div class="h5__dd">
            <a href="<?php echo $BaseURL; ?>/platform/overview">Overview</a>
            <a href="<?php echo $BaseURL; ?>/platform/automation">Automation</a>
            <a href="<?php echo $BaseURL; ?>/platform/security">Security</a>
          </div>
        </li>
        <li class="h5__item h5__item--dd">
          <button class="h5__link" aria-expanded="false">Solutions</button>
          <div class="h5__dd">
            <a href="<?php echo $BaseURL; ?>/solutions/startups">Startups</a>
            <a href="<?php echo $BaseURL; ?>/solutions/enterprise">Enterprise</a>
            <a href="<?php echo $BaseURL; ?>/solutions/ecommerce">E-commerce</a>
          </div>
        </li>
        <li class="h5__item h5__item--dd">
          <button class="h5__link" aria-expanded="false">Resources</button>
          <div class="h5__dd">
            <a href="<?php echo $BaseURL; ?>/resources/blog">Blog</a>
            <a href="<?php echo $BaseURL; ?>/resources/case-studies">Case Studies</a>
            <a href="<?php echo $BaseURL; ?>/resources/docs">Docs</a>
          </div>
        </li>
        <li class="h5__item h5__item--dd">
          <button class="h5__link" aria-expanded="false">Company</button>
          <div class="h5__dd">
            <a href="<?php echo $BaseURL; ?>/about">About</a>
            <a href="<?php echo $BaseURL; ?>/careers">Careers</a>
            <a href="<?php echo $BaseURL; ?>/contact">Contact</a>
          </div>
        </li>
        <li class="h5__item">
          <a class="h5__link" href="<?php echo $BaseURL; ?>/pricing">Pricing</a>
        </li>
        <li class="h5__item h5__item--icon">
          <button class="h5__icon-btn" aria-label="Search">
            <!-- simple icon -->
            <svg viewBox="0 0 24 24" width="18" height="18" aria-hidden="true"><circle cx="11" cy="11" r="7" fill="none" stroke="currentColor" stroke-width="2"/><path d="M20 20l-3.2-3.2" stroke="currentColor" stroke-width="2" fill="none"/></svg>
          </button>
        </li>
      </ul>
    </nav>

    <!-- Right CTA -->
    <a class="h5__cta" href="<?php echo $BaseURL; ?>/reviews">Leave a review</a>
  </div>
</header>
