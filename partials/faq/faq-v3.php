<section id="faq-v3" class="faq-v3">
  <div class="faq-v3-wrap">
    <h2>Need More Clarity?</h2>
    <?php foreach ($FAQs as $i => $faq): ?>
    <div class="faq-v3-item" style="--delay:<?= $i*0.2 ?>s">
      <h3><?= htmlspecialchars($faq["q"]) ?></h3>
      <p><?= htmlspecialchars($faq["a"]) ?></p>
    </div>
    <?php endforeach; ?>
  </div>
</section>

<style>
.faq-v3 {
  background: linear-gradient(145deg,var(--color-primary),var(--color-secondary));
  color: var(--color-light);
  padding: clamp(3rem,5vw,6rem) 2rem;
  text-align: center;
  overflow: hidden;
}
.faq-v3-wrap {
  max-width: 1000px;
  margin: 0 auto;
}
.faq-v3 h2 {
  font-family: var(--font-heading);
  margin-bottom: 2.5rem;
}
.faq-v3-item {
  background: rgba(255,255,255,0.08);
  border: 1px solid rgba(255,255,255,0.15);
  border-radius: var(--radius-md);
  margin: 1rem 0;
  padding: 1.5rem 2rem;
  transform: translateY(50px);
  opacity: 0;
  animation: floatFadeIn 1.2s var(--transition-smooth) forwards;
  animation-delay: var(--delay);
}
@keyframes floatFadeIn {
  0% { transform: translateY(40px); opacity: 0; }
  50% { transform: translateY(-10px); opacity: .8; }
  100% { transform: translateY(0); opacity: 1; }
}
</style>
