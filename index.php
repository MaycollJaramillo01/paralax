<?php
@session_start();
include_once __DIR__ . '/text.php';
?>
<?php include 'partials/shared/head.php'; ?>

<body class="bg-light text-neutral font-body overflow-x-hidden">

    <?php include 'partials/shared/header-3.php'; ?>

    <?php include 'partials/hero/hero-4.php'; ?>

    <?php include 'partials/about/about-v2.php'; ?>

    <?php include 'partials/services/services-v1.php'; ?>

    <?php include 'partials/services/services-v3.php'; ?>
    <?php include 'partials/services/services-v4.php'; ?>
    <?php include 'partials/services/services-v5.php'; ?>

    <?php include 'partials/projects/featured-projects.php'; ?>
    <?php include 'partials/projects/featured-projects-v2.php'; ?>
    <?php include 'partials/projects/featured-projects-v3.php'; ?>
    <footer class="bg-primary text-light text-center py-4 font-body text-sm">
        <p>&copy; <?= date('Y'); ?> Demo Parallax Template. Designed by <strong>Maycoll Jaramillo</strong>.</p>
    </footer>

    <?php include 'partials/shared/scripts.php'; ?>

</body>

</html>