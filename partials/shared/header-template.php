<?php
@session_start();

$dataSource = dirname(__DIR__, 2) . '/text.php';
if (file_exists($dataSource)) {
    include_once $dataSource;
}

$companyName = $Company ?? 'Paralax Studio';
$tagline = $HomeIntro['headline'] ?? 'Parallax Template Kit';
$initials = strtoupper(substr($companyName, 0, 1) . (preg_match('/\s+([A-Za-z])/', $companyName, $m) ? $m[1] : '')); 
$basePath = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
if ($basePath === '.' || $basePath === '/') {
    $basePath = '';
}

$logoFile = __DIR__ . '/../../assets/images/logo.png';
$logo = file_exists($logoFile) ? ($basePath . '/assets/images/logo.png') : '';
if (!$logo && file_exists(__DIR__ . '/../../assets/images/avatar.png')) {
    $logo = $basePath . '/assets/images/avatar.png';
}

$templateMeta = [
    'home-1' => [
        'label' => 'Home 1',
        'tagline' => 'Classic agency',
        'anchors' => [
            ['href' => '#about', 'label' => 'About'],
            ['href' => '#faq-v1', 'label' => 'FAQ'],
            ['href' => '#projects-showcase', 'label' => 'Projects'],
            ['href' => '#testimonials', 'label' => 'Testimonials'],
            ['href' => '#achievements', 'label' => 'Metrics'],
            ['href' => '#contact-v1', 'label' => 'Contact'],
        ],
    ],
    'home-2' => [
        'label' => 'Home 2',
        'tagline' => 'Performance suite',
        'anchors' => [
            ['href' => '#faq-v2', 'label' => 'FAQ'],
            ['href' => '#about', 'label' => 'About'],
            ['href' => '#services-redesign', 'label' => 'Services'],
            ['href' => '#projects-seo-grid', 'label' => 'Projects'],
            ['href' => '#contact-v2', 'label' => 'Contact'],
        ],
    ],
    'home-3' => [
        'label' => 'Home 3',
        'tagline' => 'Immersive parallax',
        'anchors' => [
            ['href' => '#faq-v3', 'label' => 'FAQ'],
            ['href' => '#about', 'label' => 'About'],
            ['href' => '#services-tilt-dark', 'label' => 'Services'],
            ['href' => '#projects-glass', 'label' => 'Projects'],
            ['href' => '#contact-v3', 'label' => 'Contact'],
        ],
    ],
    'home-4' => [
        'label' => 'Home 4',
        'tagline' => 'Growth architecture',
        'anchors' => [
            ['href' => '#home4-solutions', 'label' => 'Solutions'],
            ['href' => '#home4-process', 'label' => 'Process'],
            ['href' => '#home4-case-studies', 'label' => 'Case Studies'],
            ['href' => '#home4-cta', 'label' => 'CTA'],
        ],
    ],
    'home-5' => [
        'label' => 'Home 5',
        'tagline' => 'Campaign accelerator',
        'anchors' => [
            ['href' => '#home5-trust', 'label' => 'Proof'],
            ['href' => '#home5-services', 'label' => 'Services'],
            ['href' => '#home5-insights', 'label' => 'Insights'],
            ['href' => '#home5-contact', 'label' => 'Contact'],
        ],
    ],
];

$currentTemplate = $CurrentTemplate ?? 'home-1';
if (!array_key_exists($currentTemplate, $templateMeta)) {
    $currentTemplate = 'home-1';
}

$templateLink = static function (string $slug) use ($basePath): string {
    return ($basePath ?: '') . '/index.php?template=' . urlencode($slug);
};

$primaryNav = $templateMeta[$currentTemplate]['anchors'] ?? [];
?>

<header class="template-header" data-active-template="<?= htmlspecialchars($currentTemplate) ?>">
  <div class="template-header__inner">
    <a href="<?= $basePath ?>/index.php" class="template-header__logo">
      <span class="template-header__logo-badge" aria-hidden="true">
        <?= htmlspecialchars($initials) ?>
      </span>
      <span>
        <?= htmlspecialchars($companyName) ?>
        <span class="template-header__tagline">Template System</span>
      </span>
    </a>

    <nav class="template-header__nav" aria-label="Main navigation">
      <ul class="template-header__nav-list">
        <li class="template-header__item template-header__item--has-submenu">
          <button class="template-header__trigger" type="button" data-submenu-toggle aria-expanded="false">
            Templates <span class="template-header__chevron" aria-hidden="true">▾</span>
          </button>
          <ul class="template-header__submenu" role="menu">
            <?php foreach ($templateMeta as $slug => $meta): ?>
              <li role="none">
                <a role="menuitem" href="<?= htmlspecialchars($templateLink($slug)) ?>" <?php if ($slug === $currentTemplate): ?>aria-current="page"<?php endif; ?>>
                  <?= htmlspecialchars($meta['label']) ?>
                  <small><?= htmlspecialchars($meta['tagline']) ?></small>
                </a>
              </li>
            <?php endforeach; ?>
          </ul>
        </li>
        <?php foreach ($primaryNav as $item): ?>
          <li>
            <a class="template-header__link" href="<?= htmlspecialchars($item['href']) ?>">
              <?= htmlspecialchars($item['label']) ?>
            </a>
          </li>
        <?php endforeach; ?>
      </ul>
    </nav>

    <div class="template-header__actions">
      <?php if ($logo): ?>
        <img src="<?= htmlspecialchars($logo) ?>" alt="<?= htmlspecialchars($companyName) ?>" class="template-header__brand" loading="lazy" />
      <?php endif; ?>
      <a href="#contact" class="template-header__cta">Book a Strategy Call</a>
      <button type="button" class="template-header__menu-toggle" data-menu-toggle aria-expanded="false" aria-controls="template-mobile-nav">
        <span class="sr-only">Toggle navigation</span>
        <span class="template-header__hamburger"><span></span><span></span><span></span></span>
      </button>
    </div>
  </div>

  <div class="template-header__overlay" data-menu-overlay></div>
  <nav class="template-header__mobile" id="template-mobile-nav" aria-hidden="true">
    <div class="template-header__mobile-inner">
      <div class="template-header__mobile-top">
        <div>
          <div class="template-header__mobile-label">Templates</div>
          <strong><?= htmlspecialchars($templateMeta[$currentTemplate]['label']) ?></strong>
        </div>
        <button type="button" class="template-header__mobile-close" data-menu-close aria-label="Close menu">&times;</button>
      </div>

      <div>
        <p class="template-header__mobile-label">Pick a layout</p>
        <ul class="template-header__mobile-templates">
          <?php foreach ($templateMeta as $slug => $meta): ?>
            <li>
              <a href="<?= htmlspecialchars($templateLink($slug)) ?>" <?php if ($slug === $currentTemplate): ?>aria-current="page"<?php endif; ?>>
                <?= htmlspecialchars($meta['label']) ?> — <?= htmlspecialchars($meta['tagline']) ?>
              </a>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>

      <div>
        <p class="template-header__mobile-label">Navigate</p>
        <ul class="template-header__mobile-nav">
          <?php foreach ($primaryNav as $item): ?>
            <li>
              <a href="<?= htmlspecialchars($item['href']) ?>"><?= htmlspecialchars($item['label']) ?></a>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>

      <a class="template-header__cta" href="tel:<?= isset($Phone) ? preg_replace('/[^0-9+]/', '', $Phone) : '13055551234' ?>">
        <i class="fa-solid fa-phone"></i> <?= htmlspecialchars($Phone ?? '(305) 555-1234') ?>
      </a>
    </div>
  </nav>
</header>
