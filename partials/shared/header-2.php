<?php
@session_start();

$phone = isset($Phone) && $Phone ? $Phone : '(305) 555-1024';
$phoneRef = isset($PhoneRef) && $PhoneRef ? $PhoneRef : ('tel:' . preg_replace('/\D+/', '', $phone));
$mail = isset($Mail) && $Mail ? $Mail : 'info@example.com';
$mailRef = 'mailto:' . $mail;
$base = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
$base = ($base === '') ? '' : $base;

// Logo con fallback
$logo = $base . '/assets/images/logo.png';
if (!file_exists($_SERVER['DOCUMENT_ROOT'] . $logo)) {
  $logo = $base . '/assets/images/avatar.png';
  if (!file_exists($_SERVER['DOCUMENT_ROOT'] . $logo)) {
    $logo = 'https://via.placeholder.com/160x50?text=LOGO';
  }
}
?>

<!-- ===============================
     HEADER 2 — Aurora Template (Creative)
     =============================== -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<link rel="stylesheet" href="<?php echo $base; ?>/assets/css/header-2.css">

<header class="header-creative site-header" data-aurora="header2">
  <!-- Top bar -->
  <div class="header-top">
    <div class="container flex-between">
      <div class="contact-links">
        <a href="<?php echo $phoneRef; ?>" data-track="Phone Top">
          <i class="fa-solid fa-phone"></i> <?php echo htmlspecialchars($phone); ?>
        </a>
        <a href="<?php echo $mailRef; ?>" data-track="Email Top">
          <i class="fa-solid fa-envelope"></i> <?php echo htmlspecialchars($mail); ?>
        </a>
      </div>
      <div class="social-links">
        <a href="#" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
        <a href="#" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
        <a href="#" aria-label="LinkedIn"><i class="fa-brands fa-linkedin-in"></i></a>
      </div>
    </div>
  </div>

  <!-- Main navigation -->
  <div class="header-main">
    <div class="container flex-between">
      <button id="menu-toggle" class="menu-toggle" aria-label="Open menu" data-track="Menu Toggle 2">
        <span></span><span></span><span></span>
      </button>

      <a href="<?php echo $base; ?>/index.php" class="logo-center" aria-label="Home">
        <img src="<?php echo $logo; ?>" alt="Logo" class="logo-img" loading="lazy">
      </a>

      <a href="<?php echo $phoneRef; ?>" class="btn-cta" data-track="CTA Call 2">
        <i class="fa-solid fa-phone"></i> Call Now
      </a>
    </div>

    <nav class="nav-desktop">
      <a href="<?php echo $base; ?>/index.php" class="nav-link" data-animate="slide-up">Home</a>
      <a href="<?php echo $base; ?>/about.php" class="nav-link" data-animate="slide-up">About</a>
      <a href="<?php echo $base; ?>/services.php" class="nav-link" data-animate="slide-up">Services</a>
      <a href="<?php echo $base; ?>/projects.php" class="nav-link" data-animate="slide-up">Projects</a>
      <a href="<?php echo $base; ?>/testimonials.php" class="nav-link" data-animate="slide-up">Testimonials</a>
      <a href="<?php echo $base; ?>/contact.php" class="nav-link" data-animate="slide-up">Contact</a>
    </nav>
  </div>

  <!-- Mobile panel -->
  <div class="mobile-menu" id="mobile-menu" role="dialog" aria-modal="true" aria-hidden="true">
    <div class="menu-overlay" id="menu-overlay"></div>
    <aside class="menu-panel slide-right">
      <div class="menu-header">
        <img src="<?php echo $logo; ?>" alt="Logo" class="menu-logo">
        <button id="menu-close" class="menu-close" aria-label="Close menu">×</button>
      </div>

      <nav class="menu-nav">
        <a href="<?php echo $base; ?>/index.php">Home</a>
        <a href="<?php echo $base; ?>/about.php">About</a>
        <a href="<?php echo $base; ?>/services.php">Services</a>
        <a href="<?php echo $base; ?>/projects.php">Projects</a>
        <a href="<?php echo $base; ?>/testimonials.php">Testimonials</a>
        <a href="<?php echo $base; ?>/contact.php">Contact</a>
      </nav>

      <div class="menu-footer">
        <a href="<?php echo $phoneRef; ?>" class="menu-call">
          <i class="fa-solid fa-phone"></i> <?php echo $phone; ?>
        </a>
        <div class="menu-social">
          <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
          <a href="#"><i class="fa-brands fa-instagram"></i></a>
          <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
        </div>
      </div>
    </aside>
  </div>
</header>

<!-- ===============================
     JS MODULES
     =============================== -->
<script src="<?php echo $base; ?>/assets/js/main.js"></script>
<script src="<?php echo $base; ?>/assets/js/header/header-2.js"></script>
<script src="<?php echo $base; ?>/assets/js/nav-enhance.js"></script>
<script src="<?php echo $base; ?>/assets/js/ui-kit.js"></script>
<script src="<?php echo $base; ?>/assets/js/analytics.js"></script>
