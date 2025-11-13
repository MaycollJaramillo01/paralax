<section id="faq-v2" class="faq-v2-section">
  <div class="faq-v2-inner">
    <h2>Questions About Our Process?</h2>
    <div class="faq-v2-grid">
      <?php foreach ($FAQs as $faq): ?>
      <article class="faq-v2-card" data-animate="fade-in">
        <h3><?= htmlspecialchars($faq["q"]) ?></h3>
        <p><?= htmlspecialchars($faq["a"]) ?></p>
      </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<style>
.faq-v2-section {
  background: var(--color-secondary);
  color: var(--color-light);
  padding: clamp(3rem,6vw,6rem) 2rem;
}
.faq-v2-inner {
  max-width: 1100px;
  margin: 0 auto;
  text-align: center;
}
.faq-v2-inner h2 {
  font-family: var(--font-heading);
  margin-bottom: 2rem;
}
.faq-v2-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit,minmax(300px,1fr));
  gap: 1.5rem;
}
.faq-v2-card {
  background: var(--color-dark);
  border-radius: var(--radius-lg);
  box-shadow: inset 0 0 0 2px var(--color-light-alpha-10);
  padding: 1.5rem;
  position: relative;
  transition: transform .5s var(--transition-smooth), box-shadow .5s var(--transition-smooth);
}
.faq-v2-card::before {
  content: "";
  position: absolute;
  top: 0; left: 0;
  width: 6px; height: 100%;
  background: var(--color-accent);
  filter: blur(6px);
  opacity: .8;
  transition: all .6s ease;
}
.faq-v2-card:hover {
  transform: translateY(-6px);
  box-shadow: var(--shadow-hard);
}
.faq-v2-card:hover::before {
  width: 100%;
  opacity: .15;
}
</style>
