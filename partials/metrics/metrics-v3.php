<?php
if (!isset($BlogIdeas)) {
  $BlogIdeas = [
    "Performance marketing strategies for 2025",
    "How Core Web Vitals impact conversions",
    "UX & SEO synergy in modern landing pages",
    "Optimizing PPC for measurable ROI"
  ];
}
?>

<section id="insights" class="insights">
  <div class="insights-container">
    <h2>Featured Insights</h2>
    <p class="insights-sub">Learn from our experience — growth-driven digital knowledge.</p>

    <div class="insights-grid">
      <?php foreach ($BlogIdeas as $i => $idea): ?>
      <article class="insight reveal">
        <span class="insight-tag">Article <?= $i+1 ?></span>
        <h3><?= htmlspecialchars($idea) ?></h3>
        <p>Explore actionable takeaways for marketers and developers aiming to optimize performance and engagement.</p>
        <a href="blog.php" class="read-more">Read More <i class="fa-solid fa-arrow-right"></i></a>
      </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<style>
.insights {
  background: linear-gradient(135deg, var(--color-accent) 0%, var(--color-soft) 100%);
  color: var(--color-light);
  padding: clamp(3rem,5vw,5rem) 1rem;
  position: relative;
  overflow: hidden;
}
.insights-container { width: min(1150px,92%); margin: 0 auto; text-align: center; }
.insights h2 {
  font-family: var(--font-heading);
  font-size: clamp(1.8rem,3vw,2.5rem);
  font-weight: 800;
}
.insights-sub { opacity:.9; margin-bottom: 2rem; }
.insights-grid {
  display:grid;
  grid-template-columns:repeat(auto-fit,minmax(260px,1fr));
  gap:1.8rem;
}
.insight {
  background: var(--color-light-alpha-10);
  padding:2rem 1.5rem;
  border-radius:var(--radius-lg);
  backdrop-filter:blur(10px);
  transition: transform .4s var(--transition-smooth);
  text-align:left;
}
.insight:hover { transform:translateY(-5px); background: var(--color-light-alpha-15); }
.insight-tag {
  font-size:.8rem;
  text-transform:uppercase;
  letter-spacing:1px;
  display:block;
  margin-bottom:.8rem;
  opacity:.85;
}
.insight h3 {
  color:var(--color-light);
  font-family:var(--font-heading);
  margin-bottom:.6rem;
  font-size:1.15rem;
}
.insight p { font-size:.9rem; opacity:.9; margin-bottom:1rem; }
.read-more {
  color:var(--color-light);
  font-weight:600;
  text-decoration:none;
  border-bottom:2px solid var(--color-light-alpha-40);
  transition:all .3s ease;
}
.read-more:hover { border-color:var(--color-light); }
</style>
