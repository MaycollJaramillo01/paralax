<?php
@session_start();
if (!isset($SN)) {
    include_once dirname(__DIR__, 3) . '/text.php';
}

$services = [];
if (!empty($SN)) {
    $limit = 4;
    $i = 0;
    foreach ($SN as $key => $title) {
        $services[] = [
            'title' => $title,
            'desc'  => $ExSD[$key] ?? '',
        ];
        if (++$i === $limit) {
            break;
        }
    }
}
$subhead = $HomeIntro['sub'] ?? 'We build marketing ecosystems ready to scale.';
?>
<section id="home4-solutions" class="h4-solutions" aria-labelledby="home4-solutions-title">
  <div class="h4-solutions__inner">
    <header class="h4-solutions__header">
      <span class="h4-solutions__chip">Solutions</span>
      <h2 id="home4-solutions-title">Full-funnel digital acceleration</h2>
      <p><?= htmlspecialchars($subhead) ?></p>
    </header>

    <?php if (!empty($services)): ?>
    <div class="h4-solutions__grid">
      <?php foreach ($services as $index => $service): ?>
      <article class="h4-solutions__card">
        <span class="h4-solutions__index">0<?= $index + 1 ?></span>
        <h3><?= htmlspecialchars($service['title']) ?></h3>
        <?php if (!empty($service['desc'])): ?>
        <p><?= htmlspecialchars($service['desc']) ?></p>
        <?php endif; ?>
        <a href="services.php" class="h4-solutions__link">
          <span>See methodology</span>
          <i class="fa-solid fa-arrow-up-right-from-square" aria-hidden="true"></i>
        </a>
      </article>
      <?php endforeach; ?>
    </div>
    <?php endif; ?>
  </div>
</section>

<style>
.h4-solutions{
  background:var(--color-deep-navy,#041826);
  color:var(--color-light,#f6faff);
  padding:clamp(3rem,6vw,4.5rem) 0;
}
.h4-solutions__inner{
  width:min(1160px,90%);
  margin:0 auto;
  display:grid;
  gap:2.8rem;
}
.h4-solutions__header{
  max-width:640px;
}
.h4-solutions__chip{
  display:inline-flex;
  align-items:center;
  gap:.45rem;
  padding:.35rem .85rem;
  font-size:.8rem;
  font-weight:700;
  letter-spacing:.15em;
  text-transform:uppercase;
  border-radius:999px;
  background:rgba(124,246,255,.15);
  color:#7cf6ff;
}
.h4-solutions__header h2{
  margin:1.1rem 0 .8rem;
  font-family:var(--font-heading);
  font-size:clamp(2rem,4vw,2.7rem);
  line-height:1.1;
}
.h4-solutions__header p{
  margin:0;
  color:rgba(255,255,255,.75);
  font-size:1.05rem;
}
.h4-solutions__grid{
  display:grid;
  grid-template-columns:repeat(auto-fit,minmax(240px,1fr));
  gap:1.6rem;
}
.h4-solutions__card{
  position:relative;
  padding:2.6rem 1.6rem 2rem;
  border-radius:20px;
  background:rgba(6,27,44,.75);
  border:1px solid rgba(124,246,255,.18);
  backdrop-filter:blur(10px);
  box-shadow:0 25px 50px rgba(0,0,0,.35);
  display:flex;
  flex-direction:column;
  gap:1rem;
}
.h4-solutions__index{
  font-size:.9rem;
  font-weight:800;
  color:#7cf6ff;
  letter-spacing:.2em;
  text-transform:uppercase;
}
.h4-solutions__card h3{
  font-size:1.3rem;
  font-weight:700;
  margin:0;
  color:#fff;
}
.h4-solutions__card p{
  margin:0;
  color:rgba(255,255,255,.68);
  line-height:1.5;
}
.h4-solutions__link{
  margin-top:auto;
  display:inline-flex;
  gap:.5rem;
  align-items:center;
  color:#7cf6ff;
  text-decoration:none;
  font-weight:700;
  font-size:.95rem;
}
.h4-solutions__link:hover{
  color:#fff;
}
</style>
