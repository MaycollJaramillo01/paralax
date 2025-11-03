<section id="contact" class="section contact" data-animate="section">
    <div class="container contact-grid">
        <div class="contact-info" data-animate="section">
            <h2 class="section-title" data-animate="text"><?php echo htmlspecialchars($ContactTitle); ?></h2>
            <p class="section-subtitle" data-animate="text"><?php echo htmlspecialchars($ContactSubtitle); ?></p>
            <div class="contact-cta" data-animate="section">
                <a href="<?php echo $PhoneRef; ?>" class="btn btn-primary"><?php echo htmlspecialchars($ContactCTA['call']); ?></a>
                <a href="<?php echo $MailRef; ?>" class="btn btn-outline"><?php echo htmlspecialchars($ContactCTA['email']); ?></a>
                <?php if (!empty($WhatsApp)): ?>
                    <a href="<?php echo $WhatsApp; ?>" class="btn btn-outline" target="_blank" rel="noopener"><?php echo htmlspecialchars($ContactCTA['whatsapp']); ?></a>
                <?php endif; ?>
            </div>
            <ul class="contact-list" data-animate="section">
                <?php foreach ($ContactInformation as $item): ?>
                    <li class="contact-item" data-animate="text">
                        <?php if (!empty($item['href'] ?? '')): ?>
                            <a href="<?php echo $item['href']; ?>" class="contact-link"><span class="contact-label"><?php echo htmlspecialchars($item['label']); ?></span><span class="contact-value"><?php echo htmlspecialchars($item['value']); ?></span></a>
                        <?php else: ?>
                            <span class="contact-text"><span class="contact-label"><?php echo htmlspecialchars($item['label']); ?></span><span class="contact-value"><?php echo htmlspecialchars($item['value']); ?></span></span>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="contact-form-wrapper" data-animate="section">
            <form class="contact-form" action="<?php echo $MailRef; ?>" method="post">
                <label class="form-field" data-animate="text">
                    <span><?php echo htmlspecialchars($ContactFormText['name']); ?></span>
                    <input type="text" name="name" placeholder="<?php echo htmlspecialchars($ContactFormText['name']); ?>" required>
                </label>
                <label class="form-field" data-animate="text">
                    <span><?php echo htmlspecialchars($ContactFormText['email']); ?></span>
                    <input type="email" name="email" placeholder="<?php echo htmlspecialchars($ContactFormText['email']); ?>" required>
                </label>
                <label class="form-field" data-animate="text">
                    <span><?php echo htmlspecialchars($ContactFormText['phone']); ?></span>
                    <input type="tel" name="phone" placeholder="<?php echo htmlspecialchars($ContactFormText['phone']); ?>" required>
                </label>
                <label class="form-field" data-animate="text">
                    <span><?php echo htmlspecialchars($ContactFormText['service']); ?></span>
                    <input type="text" name="service" placeholder="<?php echo htmlspecialchars($ContactFormText['service']); ?>">
                </label>
                <label class="form-field" data-animate="text">
                    <span><?php echo htmlspecialchars($ContactFormText['message']); ?></span>
                    <textarea name="message" placeholder="<?php echo htmlspecialchars($ContactFormText['message']); ?>" rows="4"></textarea>
                </label>
                <button type="submit" class="btn btn-primary" data-animate="text"><?php echo htmlspecialchars($ContactFormText['submit']); ?></button>
            </form>
            <div class="contact-map" data-animate="image">
                <?php echo $GoogleMap; ?>
            </div>
        </div>
    </div>
</section>
