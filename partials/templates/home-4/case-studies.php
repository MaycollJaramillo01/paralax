<?php
@session_start();
if (!isset($Gallery)) {
    include_once dirname(__DIR__, 3) . '/text.php';
}

$gallery = array_values($Gallery ?? []);
$items = [];
for ($i = 0; $i < 3; $i++) {
    if (!isset($gallery[$i])) {
        break;
    }
    $items[] = [
        'title' => ['Ecommerce Scale Up', 'Demand Gen Automation', 'Luxury Hospitality Launch'][$i] ?? 'Case Study',
        'desc'  => [
            'Drove 4.6x ROAS through full-funnel media and CRO experiments.',
            'Automated MQL nurturing and improved SQL volume by 63%.',
            'Delivered multilingual launch with 98 CWV and 32% lift in direct bookings.',
        ][$i] ?? 'High-impact business transformation.',
        'image' => $gallery[$i],
    ];
}
?>
<section id="home4-case-studies" class="h4-cases" aria-labelledby="home4-case-studies-title">
  <div class="h4-cases__inner">
    <header class="h4-cases__header">
      <span class="h4-cases__chip">Work</span>
      <h2 id="home4-case-studies-title">Selected case studies</h2>
      <p>Stories of revenue growth, product launches, and long-term partnerships.</p>
    </header>

    <?php if (!empty($items)): ?>
    <div class="h4-cases__grid">
      <?php foreach ($items as $item): ?>
      <article class="h4-cases__card">
        <figure class="h4-cases__media">
          <img src="<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['title']) ?> visual" loading="lazy" decoding="async">
        </figure>
        <div class="h4-cases__content">
          <h3><?= htmlspecialchars($item['title']) ?></h3>
          <p><?= htmlspecialchars($item['desc']) ?></p>
          <a href="projects.php" class="h4-cases__cta">View deliverables</a>
        </div>
      </article>
      <?php endforeach; ?>
    </div>
    <?php endif; ?>
  </div>
</section>

<style>
.h4-cases{
  background:#071522;
  color:#fff;
  padding:clamp(3.2rem,7vw,5.2rem) 0;
}
.h4-cases__inner{
  width:min(1180px,90%);
  margin:0 auto;
  display:grid;
  gap:2.4rem;
}
.h4-cases__header{
  max-width:620px;
}
.h4-cases__chip{
  display:inline-flex;
  padding:.35rem .75rem;
  border-radius:999px;
  border:1px solid rgba(255,255,255,.25);
  text-transform:uppercase;
  font-size:.8rem;
  letter-spacing:.14em;
  font-weight:700;
  color:#9de6ff;
}
.h4-cases__header h2{
  margin:1rem 0 .6rem;
  font-family:var(--font-heading);
  font-size:clamp(2rem,4vw,2.7rem);
}
.h4-cases__header p{
  margin:0;
  color:rgba(255,255,255,.7);
}
.h4-cases__grid{
  display:grid;
  gap:1.8rem;
  grid-template-columns:repeat(auto-fit,minmax(280px,1fr));
}
.h4-cases__card{
  border-radius:22px;
  overflow:hidden;
  background:rgba(255,255,255,.05);
  border:1px solid rgba(157,230,255,.15);
  display:flex;
  flex-direction:column;
  min-height:100%;
}
.h4-cases__media img{
  width:100%;
  height:220px;
  object-fit:cover;
  display:block;
}
.h4-cases__content{
  padding:1.6rem;
  display:flex;
  flex-direction:column;
  gap:1rem;
}
.h4-cases__content h3{
  margin:0;
  font-size:1.35rem;
}
.h4-cases__content p{
  margin:0;
  color:rgba(255,255,255,.72);
  line-height:1.55;
}
.h4-cases__cta{
  margin-top:auto;
  display:inline-flex;
  align-items:center;
  gap:.6rem;
  color:#7cf6ff;
  font-weight:700;
  text-decoration:none;
}
.h4-cases__cta::after{
  content:'→';
  font-size:1.1rem;
}
.h4-cases__cta:hover{
  color:#fff;
}
</style>
