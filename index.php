<?php
include_once __DIR__ . '/text.php';

$design = isset($_GET['home']) ? preg_replace('/[^1-5]/', '', $_GET['home']) : '1';
if ($design === '') {
    $design = '1';
}
$designPath = __DIR__ . '/pages/home' . $design . '/index.php';
if (!file_exists($designPath)) {
    $design = '1';
    $designPath = __DIR__ . '/pages/home1/index.php';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($MetaTitle); ?></title>
    <meta name="description" content="<?php echo htmlspecialchars($MetaDescription); ?>">
    <meta name="keywords" content="<?php echo htmlspecialchars($MetaKeywords); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Exo:wght@400;600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo $BaseURL; ?>assets/css/global.css">
</head>
<body class="site" data-design="home<?php echo htmlspecialchars($design); ?>">
    <?php include $designPath; ?>
    <script src="<?php echo $BaseURL; ?>assets/js/animations.js" defer></script>
    <script src="<?php echo $BaseURL; ?>assets/js/home-slider.js" defer></script>
</body>
</html>
