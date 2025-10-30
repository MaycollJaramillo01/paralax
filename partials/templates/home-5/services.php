<?php
@session_start();
if (!isset($SN)) {
    include_once dirname(__DIR__, 3) . '/text.php';
}

$services = [];
if (!empty($SN)) {
    $i = 0;
    foreach ($SN as $key => $title) {
        $services[] = [
            'title' => $title,
            'desc'  => $ExSD[$key] ?? '',
        ];
        if (++$i === 3) {
            break;
        }
    }
}
?>
<section id="home5-services" class="h5-services" aria-labelledby="home5-services-title">
  <div class="h5-services__inner">
    <header class="h5-services__header">
      <span class="h5-services__chip">What we do</span>
      <h2 id="home5-services-title">High-impact service pods</h2>
      <p>Modular squads that combine strategy, design, engineering, and analytics to deliver predictable outcomes.</p>
    </header>

    <?php if (!empty($services)): ?>
    <div class="h5-services__grid">
      <?php foreach ($services as $index => $service): ?>
      <article class="h5-services__card">
        <span class="h5-services__index">Pod <?= $index + 1 ?></span>
        <h3><?= htmlspecialchars($service['title']) ?></h3>
        <?php if (!empty($service['desc'])): ?>
        <p><?= htmlspecialchars($service['desc']) ?></p>
        <?php endif; ?>
        <ul class="h5-services__list">
          <li>Dedicated strategists & creatives</li>
          <li>Weekly growth sprints</li>
          <li>Transparent reporting</li>
        </ul>
        <a href="services.php" class="h5-services__cta">Discover scope</a>
      </article>
      <?php endforeach; ?>
    </div>
    <?php endif; ?>
  </div>
</section>

<style>
.h5-services{
  background:#071427;
  color:#fff;
  padding:clamp(3.4rem,7vw,5.4rem) 0;
}
.h5-services__inner{
  width:min(1180px,90%);
  margin:0 auto;
  display:grid;
  gap:2.6rem;
}
.h5-services__header{
  max-width:600px;
}
.h5-services__chip{
  display:inline-flex;
  align-items:center;
  gap:.4rem;
  padding:.35rem .75rem;
  border-radius:999px;
  text-transform:uppercase;
  letter-spacing:.16em;
  font-weight:700;
  background:rgba(124,246,255,.18);
  color:#7cf6ff;
}
.h5-services__header h2{
  margin:1.1rem 0 .7rem;
  font-family:var(--font-heading);
  font-size:clamp(2.1rem,4vw,2.8rem);
}
.h5-services__header p{
  margin:0;
  color:rgba(255,255,255,.75);
}
.h5-services__grid{
  display:grid;
  gap:1.6rem;
  grid-template-columns:repeat(auto-fit,minmax(260px,1fr));
}
.h5-services__card{
  border-radius:22px;
  padding:2.2rem 1.8rem;
  background:rgba(7,26,46,.72);
  border:1px solid rgba(124,246,255,.18);
  backdrop-filter:blur(8px);
  display:flex;
  flex-direction:column;
  gap:1.2rem;
}
.h5-services__index{
  font-size:.9rem;
  letter-spacing:.18em;
  font-weight:800;
  text-transform:uppercase;
  color:#7cf6ff;
}
.h5-services__card h3{
  margin:0;
  font-size:1.4rem;
}
.h5-services__card p{
  margin:0;
  color:rgba(255,255,255,.72);
  line-height:1.6;
}
.h5-services__list{
  margin:0;
  padding-left:1.2rem;
  color:rgba(255,255,255,.65);
  line-height:1.55;
}
.h5-services__cta{
  margin-top:auto;
  display:inline-flex;
  align-items:center;
  gap:.6rem;
  color:#7cf6ff;
  font-weight:700;
  text-decoration:none;
}
.h5-services__cta::after{
  content:'→';
}
.h5-services__cta:hover{
  color:#fff;
}
</style>
