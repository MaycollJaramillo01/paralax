<?php
@session_start();

$phone = isset($Phone) && $Phone ? $Phone : '(305) 555-1024';
$phoneRef = isset($PhoneRef) && $PhoneRef ? $PhoneRef : ('tel:' . preg_replace('/\D+/', '', $phone));
$base = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
$base = ($base === '') ? '' : $base;

// Logo dinámico con fallback
$logo = $base . '/assets/images/logo.png';
if (!file_exists($_SERVER['DOCUMENT_ROOT'] . $logo)) {
  $logo = $base . '/assets/images/avatar.png';
  if (!file_exists($_SERVER['DOCUMENT_ROOT'] . $logo)) {
    $logo = 'https://via.placeholder.com/160x50?text=LOGO';
  }
}
?>

<!-- ===============================
     HEADER 1 — Aurora Template
     =============================== -->
<link rel="stylesheet" href="<?php echo $base; ?>/assets/css/header-1.css">

<header class="site-header" data-aurora="header">
  <div class="header-container">
    <a href="<?php echo $base; ?>/index.php" class="logo" aria-label="Home">
      <img src="<?php echo $logo; ?>" alt="Logo" class="logo-img" loading="lazy">
    </a>

    <nav class="nav-desktop" aria-label="Main navigation">
      <a href="<?php echo $base; ?>/index.php">Home</a>
      <a href="<?php echo $base; ?>/about.php">About</a>
      <a href="<?php echo $base; ?>/services.php">Services</a>
      <a href="<?php echo $base; ?>/projects.php">Projects</a>
      <a href="<?php echo $base; ?>/testimonials.php">Testimonials</a>
      <a href="<?php echo $base; ?>/contact.php">Contact</a>
    </nav>

    <div class="header-actions">
      <a href="<?php echo $phoneRef; ?>" class="btn-call" data-track="Phone Click">
        <span><?php echo htmlspecialchars($phone, ENT_QUOTES); ?></span>
      </a>
      <button id="menu-toggle" class="menu-toggle" aria-label="Open menu" data-track="Menu Toggle">
        <span></span><span></span><span></span>
      </button>
    </div>
  </div>

  <!-- ===============================
       MOBILE MENU
       =============================== -->
  <div class="mobile-menu" id="mobile-menu" role="dialog" aria-modal="true" aria-hidden="true">
    <div class="menu-overlay" id="menu-overlay"></div>
    <div class="menu-panel">
      <div class="menu-header">
        <img src="<?php echo $logo; ?>" alt="Logo" class="menu-logo">
        <button id="menu-close" class="menu-close" aria-label="Close menu">&times;</button>
      </div>

      <nav class="menu-nav" aria-label="Mobile navigation">
        <a href="<?php echo $base; ?>/index.php">Home</a>
        <a href="<?php echo $base; ?>/about.php">About</a>
        <a href="<?php echo $base; ?>/services.php">Services</a>
        <a href="<?php echo $base; ?>/projects.php">Projects</a>
        <a href="<?php echo $base; ?>/testimonials.php">Testimonials</a>
        <a href="<?php echo $base; ?>/contact.php">Contact</a>
      </nav>

      <a href="<?php echo $phoneRef; ?>" class="menu-call" data-track="Call From Menu">
        Call <?php echo htmlspecialchars($phone, ENT_QUOTES); ?>
      </a>
    </div>
  </div>
</header>

<!-- ===============================
     JS MODULES — Auroral Stack
     =============================== -->
<script src="<?php echo $base; ?>/assets/js/main.js"></script>
<script src="<?php echo $base; ?>/assets/js/header/header-1.js"></script>
<script src="<?php echo $base; ?>/assets/js/nav-enhance.js"></script>
<script src="<?php echo $base; ?>/assets/js/ui-kit.js"></script>
<script src="<?php echo $base; ?>/assets/js/analytics.js"></script>

<script>
/* Integración segura con App.Header1 */
document.addEventListener("DOMContentLoaded", () => {
  if (window.App && App.Header1 && typeof App.Header1.init === "function") {
    App.Header1.init();
  }

  // Suscribirse a eventos globales (solo para debug inicial)
  if (App && App.Bus) {
    App.Bus.on("menu:open", () => console.log("[Header] menu abierto"));
    App.Bus.on("menu:close", () => console.log("[Header] menu cerrado"));
  }
});
</script>
