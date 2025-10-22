<?php
@session_start();

$phone    = isset($Phone) && $Phone ? $Phone : '(305) 555-1024';
$phoneRef = isset($PhoneRef) && $PhoneRef ? $PhoneRef : ('tel:' . preg_replace('/\D+/', '', $phone));
$base     = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
$base     = ($base === '') ? '' : $base;

// Logo dinámico con fallback
$logo = $base . '/assets/images/logo.png';
if (!file_exists($_SERVER['DOCUMENT_ROOT'] . $logo)) {
  $logo = $base . '/assets/images/avatar.png';
  if (!file_exists($_SERVER['DOCUMENT_ROOT'] . $logo)) {
    $logo = 'https://via.placeholder.com/160x50?text=LOGO';
  }
}
?>

<link rel="stylesheet" href="<?php echo $base; ?>/assets/css/header-3.css">

<header class="header-floating site-header" data-aurora="header3">
  <div class="header-inner">
    <a href="<?php echo $base; ?>/index.php" class="logo" aria-label="Home">
      <img src="<?php echo $logo; ?>" alt="Logo" class="logo-img" loading="lazy">
    </a>

    <nav class="nav-desktop">
      <a href="<?php echo $base; ?>/index.php">Home</a>
      <a href="<?php echo $base; ?>/about.php">About</a>
      <a href="<?php echo $base; ?>/services.php">Services</a>
      <a href="<?php echo $base; ?>/projects.php">Projects</a>
      <a href="<?php echo $base; ?>/testimonials.php">Testimonials</a>
      <a href="<?php echo $base; ?>/contact.php">Contact</a>
    </nav>

    <div class="header-actions">
      <a href="<?php echo $phoneRef; ?>" class="btn-call">
        <i class="fa-solid fa-phone"></i> <?php echo htmlspecialchars($phone); ?>
      </a>
      <button id="menu-toggle" class="menu-toggle" aria-label="Open menu">
        <span></span><span></span><span></span>
      </button>
    </div>
  </div>

  <!-- Menú móvil -->
  <div class="mobile-menu" id="mobile-menu" role="dialog" aria-modal="true" aria-hidden="true">
    <div class="menu-overlay" id="menu-overlay"></div>
    <aside class="menu-panel">
      <div class="menu-header">
        <img src="<?php echo $logo; ?>" alt="Logo" class="menu-logo">
        <button id="menu-close" class="menu-close" aria-label="Close menu">&times;</button>
      </div>

      <nav class="menu-nav">
        <a href="<?php echo $base; ?>/index.php">Home</a>
        <a href="<?php echo $base; ?>/about.php">About</a>
        <a href="<?php echo $base; ?>/services.php">Services</a>
        <a href="<?php echo $base; ?>/projects.php">Projects</a>
        <a href="<?php echo $base; ?>/testimonials.php">Testimonials</a>
        <a href="<?php echo $base; ?>/contact.php">Contact</a>
      </nav>

      <a href="<?php echo $phoneRef; ?>" class="menu-call">
        <i class="fa-solid fa-phone"></i> Call <?php echo htmlspecialchars($phone); ?>
      </a>
    </aside>
  </div>
</header>

<script src="<?php echo $base; ?>/assets/js/main.js"></script>
<script src="<?php echo $base; ?>/assets/js/header/header-3.js"></script>
<script src="<?php echo $base; ?>/assets/js/nav-enhance.js"></script>
<script src="<?php echo $base; ?>/assets/js/ui-kit.js"></script>
<script src="<?php echo $base; ?>/assets/js/analytics.js"></script>
