<?php @session_start();
include_once __DIR__ . '/text.php'; // SEO/vars disponibles en <head>
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- ===== SEO BÁSICO ===== -->
    <title>
        <?php
        echo htmlspecialchars(
            $SEO['home']['title'] ?? (($Company ?? 'Aquila') . ' | Parallax Web Design'),
            ENT_QUOTES,
            'UTF-8'
        );
        ?>
    </title>
    <meta name="description" content="<?php
                                        echo htmlspecialchars($SEO['home']['description'] ?? ($HomeIntro['sub'] ?? ''), ENT_QUOTES, 'UTF-8');
                                        ?>" />
    <meta name="keywords" content="<?php
                                    $kw = $SEO['home']['keywords'] ?? ['parallax websites', 'web design miami', 'performance optimization', 'accessible web', 'seo-friendly architecture', '3D parallax', 'core web vitals', 'responsive design'];
                                    echo htmlspecialchars(implode(', ', $kw), ENT_QUOTES, 'UTF-8');
                                    ?>" />
    <link rel="canonical" href="<?php
                                echo htmlspecialchars($SEO['home']['canonical'] ?? (($BaseURL ?? '') . '/'), ENT_QUOTES, 'UTF-8');
                                ?>" />
    <meta name="robots" content="index,follow" />
    <meta name="theme-color" content="#0b1d28" />

    <!-- ===== Open Graph / Twitter ===== -->
    <meta property="og:type" content="website" />
    <meta property="og:title" content="<?php
                                        echo htmlspecialchars($SEO['home']['og']['title'] ?? (($Company ?? 'Aquila') . ' | Parallax Web Design that Converts'), ENT_QUOTES, 'UTF-8');
                                        ?>" />
    <meta property="og:description" content="<?php
                                                echo htmlspecialchars($SEO['home']['og']['description'] ?? ($HomeIntro['sub'] ?? ''), ENT_QUOTES, 'UTF-8');
                                                ?>" />
    <meta property="og:url" content="<?php
                                        echo htmlspecialchars($SEO['home']['og']['url'] ?? (($BaseURL ?? '') . '/'), ENT_QUOTES, 'UTF-8');
                                        ?>" />
    <meta property="og:image" content="<?php
                                        echo htmlspecialchars($SEO['home']['og']['image'] ?? (($BaseURL ?? '') . '/assets/images/og/home.jpg'), ENT_QUOTES, 'UTF-8');
                                        ?>" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="<?php
                                        echo htmlspecialchars($SEO['home']['twitter']['title'] ?? ('Parallax Web Design | ' . ($Company ?? 'Aquila')), ENT_QUOTES, 'UTF-8');
                                        ?>" />
    <meta name="twitter:description" content="<?php
                                                echo htmlspecialchars($SEO['home']['twitter']['description'] ?? 'Rendimiento, accesibilidad y SEO.', ENT_QUOTES, 'UTF-8');
                                                ?>" />
    <meta name="twitter:image" content="<?php
                                        echo htmlspecialchars($SEO['home']['twitter']['image'] ?? (($BaseURL ?? '') . '/assets/images/og/home.jpg'), ENT_QUOTES, 'UTF-8');
                                        ?>" />

    <!-- ===== Preload del LCP del Hero ===== -->
    <?php
    $lcp0 = $HeroImages[0] ?? 'assets/images/hero/hero1.jpg';
    $lcp1 = $HeroImages[1] ?? 'assets/images/hero/hero2.jpg';
    $lcp2 = $HeroImages[2] ?? 'assets/images/hero/hero3.jpg';
    ?>
    <link rel="preload" as="image"
        href="<?php echo htmlspecialchars($lcp0, ENT_QUOTES, 'UTF-8'); ?>"
        imagesrcset="<?php echo htmlspecialchars("$lcp0 1280w, $lcp1 1024w, $lcp2 640w", ENT_QUOTES, 'UTF-8'); ?>"
        imagesizes="(min-width:1024px) 1200px, (min-width:640px) 960px, 100vw" />

    <!-- ===== Fuentes + CSS ===== -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600;700&family=Open+Sans:wght@400;500;600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="assets/css/root.css" />
    <link rel="stylesheet" href="assets/css/main.css" /> <!-- Tailwind generado -->
    <link rel="stylesheet" href="assets/css/hero-3.css" /> <!-- CSS del nuevo hero -->
    <link rel="stylesheet" href="assets/css/hero-4.css">
    <link rel="stylesheet" href="assets/css/hero-banner-canvas.css">

</head>

<body class="bg-light text-neutral font-body overflow-x-hidden">

    <!-- HEADER -->
    <?php include 'partials/shared/header-1.php'; ?>

    <!-- HERO (Aquila, diseño propio) -->
    <?php include 'partials/hero/hero-banner-canvas.php'; ?>



    <!-- FOOTER -->
    <footer class="bg-primary text-light text-center py-4 font-body text-sm">
        <p>&copy; <?php echo date('Y'); ?> Demo Parallax Template. Designed by <strong>Maycoll Jaramillo</strong>.</p>
    </footer>

    <!-- ===== JS (orden correcto, sin duplicados) ===== -->
    <script src="assets/js/parallaxkit.js" defer></script>
    <script src="assets/js/scroll-anim.js" defer></script>
    <script src="assets/js/nav-enhance.js" defer></script>
    <script src="assets/js/main.js" defer></script>
    <script src="assets/js/analytics.js" defer></script>
    <script src="assets/js/animations.js" defer></script>

    <!-- Hero específico -->
    <script src="assets/js/hero/hero-3.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js" defer></script>
    <script src="assets/js/hero/hero-banner-canvas.js" defer></script>

    <!-- (Opcional) Si usas tus utilidades, inicialízalas aquí -->
    <script src="assets/js/scroll-anim.js" defer></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            if (window.ScrollAnim?.init) ScrollAnim.init();
        });
    </script>

    <!-- Init seguro -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (window.ParallaxKit && typeof ParallaxKit.init === 'function') ParallaxKit.init();
            if (window.ScrollAnim && typeof ScrollAnim.init === 'function') ScrollAnim.init();
        });
    </script>
</body>

</html>