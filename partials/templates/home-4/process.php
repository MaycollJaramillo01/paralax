<?php
@session_start();
if (!isset($Mission)) {
    include_once dirname(__DIR__, 3) . '/text.php';
}

$mission = $Mission ?? 'We craft measurable growth systems.';
$vision  = $Vision ?? 'We lead high-performing brands in LATAM and the US.';
$experience = $Experience ?? '15+ Years of Digital Expertise';
$process = [
    [
        'label' => '01',
        'title' => 'Diagnose & discover',
        'desc'  => 'We audit analytics, competitors, and customer journeys to map the quick wins.',
    ],
    [
        'label' => '02',
        'title' => 'Build & launch',
        'desc'  => 'Multidisciplinary squads design, prototype, and deploy high-performing funnels.',
    ],
    [
        'label' => '03',
        'title' => 'Scale & optimize',
        'desc'  => 'Continuous CRO, automation, and predictive dashboards to grow profitably.',
    ],
];
?>
<section id="home4-process" class="h4-process" aria-labelledby="home4-process-title">
  <div class="h4-process__inner">
    <header class="h4-process__header">
      <span class="h4-process__eyebrow">Process</span>
      <h2 id="home4-process-title">Strategic framework to unlock growth</h2>
      <p><?= htmlspecialchars($mission) ?></p>
    </header>

    <div class="h4-process__timeline">
      <?php foreach ($process as $step): ?>
      <article class="h4-process__step">
        <span class="h4-process__step-index"><?= htmlspecialchars($step['label']) ?></span>
        <h3><?= htmlspecialchars($step['title']) ?></h3>
        <p><?= htmlspecialchars($step['desc']) ?></p>
      </article>
      <?php endforeach; ?>
    </div>

    <aside class="h4-process__aside">
      <div>
        <h3><?= htmlspecialchars($experience) ?></h3>
        <p><?= htmlspecialchars($vision) ?></p>
      </div>
      <a class="h4-process__cta" href="about.php">Meet the team</a>
    </aside>
  </div>
</section>

<style>
.h4-process{
  background:var(--color-ivory-soft,#f5f7fb);
  color:var(--color-dark,#06131d);
  padding:clamp(3rem,7vw,5rem) 0;
}
.h4-process__inner{
  width:min(1140px,90%);
  margin:0 auto;
  display:grid;
  gap:2.5rem;
}
.h4-process__header{
  max-width:640px;
}
.h4-process__eyebrow{
  display:inline-flex;
  align-items:center;
  gap:.35rem;
  padding:.35rem .8rem;
  border-radius:999px;
  text-transform:uppercase;
  letter-spacing:.14em;
  font-weight:700;
  background:rgba(9,46,79,.08);
  color:var(--color-primary,#0aa5ff);
}
.h4-process__header h2{
  margin:1rem 0 .6rem;
  font-family:var(--font-heading);
  font-size:clamp(2rem,3.8vw,2.6rem);
  line-height:1.1;
}
.h4-process__header p{
  margin:0;
  color:var(--color-graphite,#3d4d5f);
  font-size:1.05rem;
}
.h4-process__timeline{
  display:grid;
  gap:1.5rem;
  grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
}
.h4-process__step{
  border-radius:18px;
  padding:1.8rem 1.6rem;
  background:#fff;
  box-shadow:0 25px 60px rgba(15,44,65,.08);
  border:1px solid rgba(9,64,112,.08);
  position:relative;
}
.h4-process__step-index{
  display:inline-block;
  font-size:.85rem;
  letter-spacing:.24em;
  font-weight:800;
  text-transform:uppercase;
  color:var(--color-primary,#0aa5ff);
  margin-bottom:1rem;
}
.h4-process__step h3{
  margin:.3rem 0 .7rem;
  font-size:1.25rem;
  color:#07243b;
}
.h4-process__step p{
  margin:0;
  color:#42505f;
  line-height:1.55;
}
.h4-process__aside{
  border-radius:18px;
  padding:2rem;
  display:flex;
  flex-direction:column;
  gap:1.2rem;
  background:linear-gradient(135deg,#0c1f33,#123f65);
  color:#fff;
  box-shadow:0 30px 70px rgba(8,24,39,.35);
}
.h4-process__aside h3{
  margin:0 0 .4rem;
  font-size:1.6rem;
  font-weight:800;
}
.h4-process__aside p{
  margin:0;
  color:rgba(255,255,255,.75);
  line-height:1.6;
}
.h4-process__cta{
  align-self:flex-start;
  padding:.75rem 1.6rem;
  border-radius:12px;
  background:#7cf6ff;
  color:#06131d;
  font-weight:700;
  text-decoration:none;
}
.h4-process__cta:hover{
  background:#fff;
}
</style>
