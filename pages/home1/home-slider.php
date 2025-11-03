<section id="home" class="hero" data-animate="section">
    <div class="container hero-grid">
        <div class="hero-copy">
            <p class="hero-tagline" data-animate="text"><?php echo htmlspecialchars($HeroTagline); ?></p>
            <h1 class="hero-title" data-animate="text"><?php echo htmlspecialchars($HeroTitle); ?></h1>
            <div class="hero-slider" data-slider>
                <div class="slider-track" data-slider-track>
                    <?php foreach ($Phrase as $index => $headline): ?>
                        <article class="slider-slide" data-animate="section">
                            <h2 class="slide-title" data-animate="text"><?php echo htmlspecialchars($headline); ?></h2>
                            <p class="slide-text" data-animate="text"><?php echo htmlspecialchars($Home[$index % count($Home)]); ?></p>
                        </article>
                    <?php endforeach; ?>
                </div>
                <div class="slider-controls">
                    <button type="button" class="slider-arrow" data-slider-prev aria-label="<?php echo htmlspecialchars($SliderControls['previous']); ?>">&#8592;</button>
                    <button type="button" class="slider-arrow" data-slider-next aria-label="<?php echo htmlspecialchars($SliderControls['next']); ?>">&#8594;</button>
                    <button type="button" class="slider-toggle" data-slider-toggle data-state="playing" data-play-label="<?php echo htmlspecialchars($SliderControls['play']); ?>" data-pause-label="<?php echo htmlspecialchars($SliderControls['pause']); ?>" aria-label="<?php echo htmlspecialchars($SliderControls['pause']); ?>">
                        <span class="toggle-label"><?php echo htmlspecialchars($SliderControls['pause']); ?></span>
                    </button>
                </div>
                <div class="slider-dots" data-slider-dots>
                    <?php foreach ($Phrase as $index => $headline): ?>
                        <button type="button" class="slider-dot" data-slider-dot="<?php echo $index; ?>" aria-label="<?php echo htmlspecialchars($headline); ?>"></button>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="hero-ctas" data-animate="section">
                <a href="#contact" class="btn btn-primary"><?php echo htmlspecialchars($HeroButtons['primary']); ?></a>
                <a href="#gallery" class="btn btn-outline"><?php echo htmlspecialchars($HeroButtons['secondary']); ?></a>
            </div>
            <div class="hero-highlights" data-animate="section">
                <?php foreach ($HeroHighlights as $key => $value): ?>
                    <div class="highlight-card" data-animate="card">
                        <span class="highlight-label"><?php echo htmlspecialchars($HeroHighlightLabels[$key] ?? $key); ?></span>
                        <p class="highlight-value"><?php echo htmlspecialchars($value); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="hero-media" data-animate="image">
            <div class="hero-media-inner">
                <?php foreach ($HeroBadges as $label => $text): ?>
                    <span class="hero-badge" data-animate="text"><?php echo htmlspecialchars($text); ?></span>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
