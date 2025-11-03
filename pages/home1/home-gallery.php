<section id="gallery" class="section gallery" data-animate="section">
    <div class="container gallery-header" data-animate="section">
        <h2 class="section-title" data-animate="text"><?php echo htmlspecialchars($GalleryTitle); ?></h2>
        <p class="section-subtitle" data-animate="text"><?php echo htmlspecialchars($GallerySubtitle); ?></p>
    </div>
    <div class="container gallery-grid">
        <?php foreach ($GalleryItems as $item): ?>
            <figure class="gallery-item" data-animate="image">
                <img src="<?php echo $item['src']; ?>" alt="<?php echo htmlspecialchars($item['alt']); ?>" class="gallery-image">
                <figcaption class="gallery-caption" data-animate="text"><?php echo htmlspecialchars($item['caption']); ?></figcaption>
            </figure>
        <?php endforeach; ?>
    </div>
</section>
