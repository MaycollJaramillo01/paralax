<footer class="site-footer" data-animate="section">
    <div class="container footer-grid">
        <div class="footer-brand" data-animate="section">
            <a href="<?php echo $BaseURL; ?>" class="brand" data-animate="image">
                <img src="<?php echo $Logo; ?>" alt="<?php echo htmlspecialchars($Company . ' logo'); ?>" class="brand-logo">
            </a>
            <p class="footer-credit" data-animate="text"><?php echo htmlspecialchars($FooterNotes['credit']); ?></p>
        </div>
        <div class="footer-contact" data-animate="section">
            <h3 class="footer-title" data-animate="text"><?php echo htmlspecialchars($FooterContactTitle); ?></h3>
            <ul class="footer-list">
                <?php foreach ($ContactInformation as $contact): ?>
                    <li class="footer-item" data-animate="text">
                        <?php if (!empty($contact['href'])): ?>
                            <a href="<?php echo $contact['href']; ?>" class="footer-link"><span class="footer-label"><?php echo htmlspecialchars($contact['label']); ?></span><span class="footer-value"><?php echo htmlspecialchars($contact['value']); ?></span></a>
                        <?php else: ?>
                            <span class="footer-text"><span class="footer-label"><?php echo htmlspecialchars($contact['label']); ?></span><span class="footer-value"><?php echo htmlspecialchars($contact['value']); ?></span></span>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
                <?php foreach ($FooterExtras as $extra): ?>
                    <li class="footer-item" data-animate="text"><?php echo htmlspecialchars($extra); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="footer-social" data-animate="section">
            <h3 class="footer-title" data-animate="text"><?php echo htmlspecialchars($FooterSocialTitle); ?></h3>
            <ul class="footer-list">
                <?php foreach ($SocialProfiles as $profile): ?>
                    <?php if (!empty($profile['url'])): ?>
                        <li class="footer-item" data-animate="text"><a href="<?php echo $profile['url']; ?>" target="_blank" rel="noopener"><?php echo htmlspecialchars($profile['label']); ?></a></li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
    <div class="container footer-bottom" data-animate="section">
        <p class="footer-copy" data-animate="text">&copy; <?php echo date('Y'); ?> <?php echo htmlspecialchars($Company); ?> — <?php echo htmlspecialchars($FooterNotes['rights']); ?></p>
    </div>
</footer>
