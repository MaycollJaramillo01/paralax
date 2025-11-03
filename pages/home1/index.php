<?php
$homeSections = [
    'home-header',
    'home-slider',
    'home-about',
    'home-mission',
    'home-services',
    'home-gallery',
    'home-testimonials',
    'home-contact',
    'home-footer',
];

foreach ($homeSections as $section) {
    $path = __DIR__ . '/' . $section . '.php';
    if (file_exists($path)) {
        include $path;
    }
}
