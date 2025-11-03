<section id="about" class="section about" data-animate="section">
    <div class="container about-grid">
        <div class="about-copy">
            <h2 class="section-title" data-animate="text"><?php echo htmlspecialchars($AboutTitle); ?></h2>
            <p class="section-subtitle" data-animate="text"><?php echo htmlspecialchars($AboutSubtitle); ?></p>
            <div class="about-text" data-animate="section">
                <?php foreach ($Home as $paragraph): ?>
                    <p class="body-text" data-animate="text"><?php echo htmlspecialchars($paragraph); ?></p>
                <?php endforeach; ?>
            </div>
            <ul class="about-highlights" data-animate="section">
                <?php foreach ($AboutHighlights as $key => $highlight): ?>
                    <li class="about-highlight" data-animate="card">
                        <span class="highlight-key"><?php echo htmlspecialchars($highlight); ?></span>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="about-media" data-animate="image">
            <img src="<?php echo $BaseURL; ?>assets/images/about-overview.svg" alt="<?php echo htmlspecialchars($Company . ' project showcase in ' . $City); ?>" class="about-image">
        </div>
    </div>
</section>
