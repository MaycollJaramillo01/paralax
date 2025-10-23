<?php
@session_start();
include_once __DIR__ . '/../../text.php';

$CompanyName = htmlspecialchars($Company ?? 'Aquila', ENT_QUOTES, 'UTF-8');
$BaseURL     = htmlspecialchars($BaseURL ?? '', ENT_QUOTES, 'UTF-8');
$title       = htmlspecialchars($SEO['home']['title'] ?? ($CompanyName . ' | Parallax Web Design'), ENT_QUOTES, 'UTF-8');
$desc        = htmlspecialchars($SEO['home']['description'] ?? ($HomeIntro['sub'] ?? ''), ENT_QUOTES, 'UTF-8');
$canonical   = htmlspecialchars($SEO['home']['canonical'] ?? ($BaseURL . '/'), ENT_QUOTES, 'UTF-8');
$keywords    = htmlspecialchars(implode(', ', $SEO['home']['keywords'] ?? [
  'parallax websites', 'web design', 'performance optimization', 'SEO-friendly architecture', 'accessible web', '3D parallax', 'responsive design'
]), ENT_QUOTES, 'UTF-8');
$lcp0 = $HeroImages[0] ?? 'assets/images/hero/hero1.jpg';
$lcp1 = $HeroImages[1] ?? 'assets/images/hero/hero2.jpg';
$lcp2 = $HeroImages[2] ?? 'assets/images/hero/hero3.jpg';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="robots" content="index,follow" />
  <meta name="theme-color" content="#0b1d28" />

  <title><?= $title ?></title>
  <meta name="description" content="<?= $desc ?>" />
  <meta name="keywords" content="<?= $keywords ?>" />
  <link rel="canonical" href="<?= $canonical ?>" />

  <!-- OG / Twitter -->
  <meta property="og:type" content="website" />
  <meta property="og:title" content="<?= $title ?>" />
  <meta property="og:description" content="<?= $desc ?>" />
  <meta property="og:url" content="<?= $BaseURL ?>" />
  <meta property="og:image" content="<?= $BaseURL ?>/assets/images/og/home.jpg" />
  <meta name="twitter:card" content="summary_large_image" />
  <meta name="twitter:title" content="<?= $title ?>" />
  <meta name="twitter:description" content="<?= $desc ?>" />
  <meta name="twitter:image" content="<?= $BaseURL ?>/assets/images/og/home.jpg" />

  <!-- Preload LCP hero -->
  <link rel="preload" as="image"
    href="<?= htmlspecialchars($lcp0, ENT_QUOTES, 'UTF-8'); ?>"
    imagesrcset="<?= htmlspecialchars("$lcp0 1280w, $lcp1 1024w, $lcp2 640w", ENT_QUOTES, 'UTF-8'); ?>"
    imagesizes="(min-width:1024px) 1200px, (min-width:640px) 960px, 100vw" />

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600;700&family=Open+Sans:wght@400;500;600&display=swap" rel="stylesheet" />

  <!-- CSS global y dependencias respetando orden raíz -->
  <link rel="stylesheet" href="assets/css/root.css" />           <!-- VARIABLES Y ROOT -->
  <link rel="stylesheet" href="assets/css/main.css" />           <!-- BASE / UTILS -->
  <link rel="stylesheet" href="assets/css/hero-banner-canvas.css"> <!-- HERO PARALLAX -->
  <link rel="stylesheet" href="assets/css/hero-4.css">
  <link rel="stylesheet" href="assets/css/header-hero.css">
  <link rel="stylesheet" href="assets/css/header-5.css">
  <link rel="stylesheet" href="assets/css/header-4.css">
  <link rel="stylesheet" href="assets/css/header-3.css">
  <link rel="stylesheet" href="assets/css/header-2.css">
  <link rel="stylesheet" href="assets/css/header-1.css">
</head>
