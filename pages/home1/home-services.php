<section id="services" class="section services" data-animate="section">
    <div class="container services-header" data-animate="section">
        <h2 class="section-title" data-animate="text"><?php echo htmlspecialchars($Services); ?></h2>
        <p class="section-subtitle" data-animate="text"><?php echo htmlspecialchars($ServiceIntro); ?></p>
    </div>
    <div class="container service-grid">
        <?php foreach ($SN as $index => $name): ?>
            <article class="service-card" data-animate="card">
                <span class="service-number" data-animate="text"><?php echo str_pad((string)$index, 2, '0', STR_PAD_LEFT); ?></span>
                <h3 class="service-name" data-animate="text"><?php echo htmlspecialchars($name); ?></h3>
                <p class="service-description" data-animate="text"><?php echo htmlspecialchars($SD[$index]); ?></p>
                <a href="#contact" class="service-link" data-animate="text"><?php echo htmlspecialchars($ServiceButton); ?></a>
            </article>
        <?php endforeach; ?>
    </div>
</section>
