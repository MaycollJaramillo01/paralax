<?php @session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Parallax Test</title>

  <!-- Fonts + Tailwind + Root CSS -->
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600;700&family=Open+Sans:wght@400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/main.css"> <!-- Tailwind generado -->
  <link rel="stylesheet" href="assets/css/root.css"> <!-- Variables y animaciones -->
</head>

<body class="bg-light text-neutral font-body overflow-x-hidden">

  <!-- HEADER -->
  <?php include('partials/shared/header-1.php'); ?>

  <!-- HERO DE PRUEBA -->
<?php include('partials/hero/hero-1.php'); ?>

  <!-- FOOTER BÁSICO -->
  <footer class="bg-primary text-light text-center py-4 font-body text-sm">
    <p>&copy; <?php echo date('Y'); ?> Demo Parallax Template. Designed by <strong>Maycoll Jaramillo</strong>.</p>
  </footer>

  <!-- JS PRINCIPAL -->
  <script src="assets/js/scroll-anim.js"></script>
  <script>
    document.addEventListener("DOMContentLoaded", () => {
      if (window.ParallaxKit) ParallaxKit.init();
    });
  </script>

</body>
</html>
 