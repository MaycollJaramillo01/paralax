<?php
@session_start();
if (!isset($FAQs)) include __DIR__ . '/text.php';
?>
<section id="faq-v1" class="faq-v1-section">
  <div class="faq-v1-container">
    <h2 data-animate="slide-up">Frequently Asked Questions</h2>

    <div class="faq-v1-list">
      <?php foreach ($FAQs as $i => $f): ?>
      <div class="faq-v1-item" data-index="<?= $i ?>">
        <button class="faq-v1-question"><?= htmlspecialchars($f["q"]) ?></button>
        <div class="faq-v1-answer"><?= htmlspecialchars($f["a"]) ?></div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<style>
.faq-v1-section {
  background: var(--color-light);
  color: var(--color-dark);
  padding: clamp(3rem,5vw,5rem) 2rem;
}
.faq-v1-container {
  max-width: 900px;
  margin: 0 auto;
  text-align: left;
}
.faq-v1-container h2 {
  text-align: center;
  font-family: var(--font-heading);
  margin-bottom: 2rem;
}
.faq-v1-item {
  background: var(--color-light-alpha-80);
  border: 1px solid var(--color-neutral);
  border-radius: var(--radius-md);
  margin-bottom: 1rem;
  box-shadow: var(--shadow-soft);
  overflow: hidden;
  transform: translateY(40px);
  opacity: 0;
  transition: all 0.8s var(--transition-smooth);
}
.faq-v1-item.visible {
  transform: translateY(0);
  opacity: 1;
}
.faq-v1-question {
  width: 100%;
  background: transparent;
  border: none;
  padding: 1rem 1.2rem;
  font-weight: 700;
  cursor: pointer;
  text-align: left;
}
.faq-v1-answer {
  max-height: 0;
  overflow: hidden;
  opacity: 0;
  transition: max-height .5s ease, opacity .5s ease;
  padding: 0 1.2rem;
}
.faq-v1-item.active .faq-v1-answer {
  max-height: 200px;
  opacity: 1;
  animation: float-answer 1s ease;
}
@keyframes float-answer {
  0% {transform: translateY(10px);}
  50% {transform: translateY(-5px);}
  100% {transform: translateY(0);}
}
</style>

<script>
document.querySelectorAll('.faq-v1-question').forEach(btn=>{
  btn.addEventListener('click',()=>{
    const item = btn.parentElement;
    item.classList.toggle('active');
  });
});
const observer = new IntersectionObserver(entries=>{
  entries.forEach(e=>{
    if(e.isIntersecting){
      e.target.classList.add('visible');
      observer.unobserve(e.target);
    }
  });
},{threshold:0.2});
document.querySelectorAll('.faq-v1-item').forEach(el=>observer.observe(el));
</script>
