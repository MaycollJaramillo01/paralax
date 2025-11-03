<?php /** @var array $NavigationLinks */ ?>
<header class="site-header" data-animate="section">
    <div class="container header-container">
        <a class="brand" href="<?php echo $BaseURL; ?>">
            <img src="<?php echo $Logo; ?>" alt="<?php echo htmlspecialchars($Company . ' logo'); ?>" class="brand-logo" data-animate="image">
        </a>
        <button class="nav-toggle" data-nav-toggle aria-expanded="false" aria-controls="primary-navigation">
            <span class="toggle-text" data-open-text="<?php echo htmlspecialchars($MenuToggleLabel); ?>" data-close-text="<?php echo htmlspecialchars($MenuCloseLabel); ?>"><?php echo htmlspecialchars($MenuToggleLabel); ?></span>
        </button>
        <nav id="primary-navigation" class="primary-navigation" data-animate="section">
            <ul class="nav-list">
                <?php foreach ($NavigationLinks as $item): ?>
                    <li class="nav-item">
                        <a href="<?php echo strpos($item['href'], '#') === 0 ? $item['href'] : $BaseURL . ltrim($item['href'], '/'); ?>" class="nav-link" data-animate="text"><?php echo htmlspecialchars($item['label']); ?></a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </nav>
        <a href="#contact" class="btn btn-primary header-cta" data-animate="text"><?php echo htmlspecialchars($HeaderCTA); ?></a>
    </div>
</header>
