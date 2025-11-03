<section id="testimonials" class="section testimonials" data-animate="section">
    <div class="container testimonials-header" data-animate="section">
        <h2 class="section-title" data-animate="text"><?php echo htmlspecialchars($TestimonialsTitle); ?></h2>
        <p class="section-subtitle" data-animate="text"><?php echo htmlspecialchars($TestimonialsSubtitle); ?></p>
    </div>
    <div class="container testimonial-grid">
        <?php foreach ($Testimonials as $testimonial): ?>
            <article class="testimonial-card" data-animate="card">
                <p class="testimonial-quote" data-animate="text">“<?php echo htmlspecialchars($testimonial['quote']); ?>”</p>
                <p class="testimonial-name" data-animate="text"><?php echo htmlspecialchars($testimonial['name']); ?></p>
                <span class="testimonial-role" data-animate="text"><?php echo htmlspecialchars($testimonial['location']); ?></span>
            </article>
        <?php endforeach; ?>
    </div>
</section>
