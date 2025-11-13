<?php
@session_start();
if (!isset($Testimonials)) {
    include_once dirname(__DIR__, 3) . '/text.php';
}

$testimonials = $Testimonials ?? [];
?>
<section id="home5-trust" class="h5-trust" aria-labelledby="home5-trust-title">
  <div class="h5-trust__inner">
    <header class="h5-trust__header">
      <span class="h5-trust__chip">Proof</span>
      <h2 id="home5-trust-title">Trusted by product, service, and B2B brands</h2>
      <p>Organizations rely on our growth operators to orchestrate full-funnel campaigns.</p>
    </header>

    <?php if (!empty($testimonials)): ?>
    <div class="h5-trust__grid">
      <?php foreach ($testimonials as $item): ?>
      <blockquote class="h5-trust__card">
        <p>“<?= htmlspecialchars($item['text'] ?? '') ?>”</p>
        <footer><?= htmlspecialchars($item['name'] ?? 'Client') ?></footer>
      </blockquote>
      <?php endforeach; ?>
      <blockquote class="h5-trust__card h5-trust__card--metric">
        <strong>4.9<span>/5</span></strong>
        <p>Average satisfaction across 60+ delivered programs.</p>
      </blockquote>
    </div>
    <?php endif; ?>
  </div>
</section>

<style>
.h5-trust{
  background:#f2f5ff;
  color:#08192a;
  padding:clamp(3rem,6vw,4.8rem) 0;
}
.h5-trust__inner{
  width:min(1120px,90%);
  margin:0 auto;
  display:grid;
  gap:2.6rem;
}
.h5-trust__header{
  max-width:620px;
}
.h5-trust__chip{
  display:inline-flex;
  align-items:center;
  gap:.4rem;
  padding:.3rem .75rem;
  border-radius:999px;
  text-transform:uppercase;
  letter-spacing:.16em;
  font-weight:700;
  background:rgba(8,25,42,.08);
  color:#0d3c80;
}
.h5-trust__header h2{
  margin:1rem 0 .6rem;
  font-family:var(--font-heading);
  font-size:clamp(2rem,3.8vw,2.6rem);
  line-height:1.1;
}
.h5-trust__header p{
  margin:0;
  color:#3a4c64;
}
.h5-trust__grid{
  display:grid;
  gap:1.5rem;
  grid-template-columns:repeat(auto-fit,minmax(240px,1fr));
}
.h5-trust__card{
  padding:1.8rem;
  border-radius:20px;
  background:#fff;
  box-shadow:0 20px 45px rgba(21,45,85,.12);
  border:1px solid rgba(16,46,94,.08);
  display:flex;
  flex-direction:column;
  gap:1.1rem;
}
.h5-trust__card p{
  margin:0;
  font-size:1.05rem;
  line-height:1.6;
}
.h5-trust__card footer{
  font-weight:700;
  color:#0d3c80;
}
.h5-trust__card--metric{
  align-items:flex-start;
  justify-content:flex-start;
  gap:.6rem;
}
.h5-trust__card--metric strong{
  font-size:2.6rem;
  color:#0d3c80;
  font-weight:800;
}
.h5-trust__card--metric strong span{
  font-size:1.1rem;
  color:#6083b5;
}
</style>
