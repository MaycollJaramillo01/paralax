<?php
@session_start();
include_once __DIR__ . '/../../text.php';
/**
 * Hero Design 1 — "The Conversational Opener"
 * Data source: text.php
 */
$heroHeadline = $HomeIntro['headline'];
$heroSub      = $HomeIntro['sub'];
$heroBullets  = $HomeIntro['bullets'];
$primaryCTA   = $HomeIntro['primaryCTA'];
$secondaryCTA = $HomeIntro['secondaryCTA'];
$heroImageLg  = $HeroImages[0] ?? '';
$heroImageMd  = $HeroImages[1] ?? $heroImageLg;
$heroImageSm  = $HeroImages[2] ?? $heroImageMd;
$schemaData = [
    '@context'    => 'https://schema.org',
    '@type'       => 'WebPage',
    'name'        => $SEO['home']['title'],
    'description' => $SEO['home']['description'],
    'publisher'   => [
        '@type' => 'Organization',
        'name'  => $Company,
        'url'   => $BaseURL,
        'logo'  => [
            '@type' => 'ImageObject',
            'url'   => $BaseURL . '/assets/images/logo.svg',
        ],
    ],
    'about'     => $heroHeadline,
    'speakable' => [
        '@type'       => 'SpeakableSpecification',
        'cssSelector' => ['#hero1-title', '.hero-conversational__lead'],
    ],
];
?>

<head>
    <link rel="stylesheet" href="assets/css/root.css">
    <link rel="stylesheet" href="assets/css/hero-1.css">

</head>
<section
    class="hero-conversational"
    id="hero-conversational"
    aria-labelledby="hero1-title"
    data-hero="conversational">
    <div class="hero-conversational__media" data-anim="zoomIn">
        <picture>
            <source
                srcset="<?php echo htmlspecialchars($heroImageLg, ENT_QUOTES, 'UTF-8'); ?>"
                media="(min-width: 1024px)" />
            <source
                srcset="<?php echo htmlspecialchars($heroImageMd, ENT_QUOTES, 'UTF-8'); ?>"
                media="(min-width: 640px)" />
            <img
                src="<?php echo htmlspecialchars($heroImageSm, ENT_QUOTES, 'UTF-8'); ?>"
                alt="<?php echo htmlspecialchars($Company, ENT_QUOTES, 'UTF-8'); ?> project showcase"
                width="1280"
                height="720"
                loading="eager"
                fetchpriority="high"
                decoding="async" />
        </picture>
    </div>
    <header class="hero-conversational__content">
        <p class="hero-conversational__eyebrow" data-anim="fade">
            <?php echo htmlspecialchars($Experience, ENT_QUOTES, 'UTF-8'); ?> <!-- from text.php: $Experience -->
        </p>
        <h1
            id="hero1-title"
            class="hero-conversational__title"
            data-hero-typing="<?php echo htmlspecialchars($heroHeadline, ENT_QUOTES, 'UTF-8'); ?>">
            <span class="hero-conversational__typing" data-hero-typing-target></span>
        </h1>

        <span class="hero-conversational__typing" data-hero-typing-target aria-hidden="true"></span>
        <span class="sr-only"><?php echo htmlspecialchars($heroHeadline, ENT_QUOTES, 'UTF-8'); ?> <!-- from text.php: $HomeIntro['headline'] --></span>
        </h1>
        <p class="hero-conversational__lead" data-anim="slideUp">
            <?php echo htmlspecialchars($heroSub, ENT_QUOTES, 'UTF-8'); ?> <!-- from text.php: $HomeIntro['sub'] -->
        </p>
        <ul class="hero-conversational__bullets" data-anim="slideUp" data-anim-group="hero1-bullets">
            <?php foreach ($heroBullets as $bullet): ?>
                <li><?php echo htmlspecialchars($bullet, ENT_QUOTES, 'UTF-8'); ?> <!-- from text.php: $HomeIntro['bullets'][] --></li>
            <?php endforeach; ?>
        </ul>
        <div class="hero-conversational__cta" data-anim="fade">
            <a
                class="hero-conversational__btn hero-conversational__btn--primary"
                href="<?php echo htmlspecialchars($BaseURL . '/contact', ENT_QUOTES, 'UTF-8'); ?>"
                data-hover="pulse">
                <?php echo htmlspecialchars($primaryCTA, ENT_QUOTES, 'UTF-8'); ?> <!-- from text.php: $HomeIntro['primaryCTA'] -->
            </a>
            <a
                class="hero-conversational__btn hero-conversational__btn--ghost"
                href="<?php echo htmlspecialchars($BaseURL . '/portfolio', ENT_QUOTES, 'UTF-8'); ?>"
                data-hover="pulse">
                <?php echo htmlspecialchars($secondaryCTA, ENT_QUOTES, 'UTF-8'); ?> <!-- from text.php: $HomeIntro['secondaryCTA'] -->
            </a>
        </div>
    </header>
    <script type="application/ld+json" class="hero-schema">
        <?php echo json_encode($schemaData, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE); ?>
    </script>
</section>