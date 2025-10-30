<?php
@session_start();
if (!isset($ServiceAreas)) {
    include_once dirname(__DIR__, 3) . '/text.php';
}

$areas = $ServiceAreas ?? [];
$areasList = array_slice($areas, 0, 5);
?>
<section id="home5-insights" class="h5-insights" aria-labelledby="home5-insights-title">
  <div class="h5-insights__inner">
    <header class="h5-insights__header">
      <span class="h5-insights__chip">Insights</span>
      <h2 id="home5-insights-title">Analytics and territories we master</h2>
      <p>From South Florida to LATAM, we deploy data-driven operations built to localize and scale.</p>
    </header>

    <div class="h5-insights__content">
      <div class="h5-insights__metrics">
        <div>
          <span class="h5-insights__metric">12</span>
          <p>Industry verticals accelerated in the last 18 months.</p>
        </div>
        <div>
          <span class="h5-insights__metric">65k</span>
          <p>Keywords monitored every week for SEO and PPC insights.</p>
        </div>
        <div>
          <span class="h5-insights__metric">28</span>
          <p>Automation workflows orchestrating lead and revenue tracking.</p>
        </div>
      </div>
      <?php if (!empty($areasList)): ?>
      <aside class="h5-insights__aside" aria-label="Service areas">
        <h3>Priority markets</h3>
        <ul>
          <?php foreach ($areasList as $area): ?>
          <li><?= htmlspecialchars($area) ?></li>
          <?php endforeach; ?>
        </ul>
      </aside>
      <?php endif; ?>
    </div>
  </div>
</section>

<style>
.h5-insights{
  background:#0a1f33;
  color:#fff;
  padding:clamp(3.4rem,7vw,5.4rem) 0;
}
.h5-insights__inner{
  width:min(1180px,90%);
  margin:0 auto;
  display:grid;
  gap:2.4rem;
}
.h5-insights__header{
  max-width:640px;
}
.h5-insights__chip{
  display:inline-flex;
  align-items:center;
  gap:.35rem;
  padding:.35rem .75rem;
  border-radius:999px;
  text-transform:uppercase;
  letter-spacing:.16em;
  font-weight:700;
  background:rgba(124,246,255,.18);
  color:#7cf6ff;
}
.h5-insights__header h2{
  margin:1rem 0 .7rem;
  font-family:var(--font-heading);
  font-size:clamp(2.1rem,4vw,2.8rem);
}
.h5-insights__header p{
  margin:0;
  color:rgba(255,255,255,.75);
}
.h5-insights__content{
  display:grid;
  gap:2rem;
  grid-template-columns:1fr;
}
.h5-insights__metrics{
  display:grid;
  gap:1.6rem;
  grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
}
.h5-insights__metrics div{
  padding:1.8rem;
  border-radius:20px;
  background:rgba(4,17,29,.72);
  border:1px solid rgba(124,246,255,.16);
  backdrop-filter:blur(6px);
  display:flex;
  flex-direction:column;
  gap:1rem;
}
.h5-insights__metric{
  font-size:2.4rem;
  font-weight:800;
  color:#7cf6ff;
}
.h5-insights__metrics p{
  margin:0;
  color:rgba(255,255,255,.72);
  line-height:1.6;
}
.h5-insights__aside{
  padding:2rem;
  border-radius:20px;
  background:rgba(7,18,30,.85);
  border:1px solid rgba(124,246,255,.16);
}
.h5-insights__aside h3{
  margin:0 0 1rem;
  font-size:1.3rem;
}
.h5-insights__aside ul{
  margin:0;
  padding:0;
  list-style:none;
  display:grid;
  gap:.65rem;
}
.h5-insights__aside li{
  position:relative;
  padding-left:1.2rem;
  color:rgba(255,255,255,.7);
}
.h5-insights__aside li::before{
  content:'•';
  position:absolute;
  left:0;
  color:#7cf6ff;
}
@media (min-width:960px){
  .h5-insights__content{
    grid-template-columns:1.4fr .8fr;
    align-items:start;
  }
}
</style>
