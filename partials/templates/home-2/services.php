<?php
@session_start();
if (!isset($SN)) {
    $dataSource = dirname(__DIR__, 3) . '/text.php';
    if (file_exists($dataSource)) {
        include_once $dataSource;
    }
}

/* ======= Textos (desde text.php o fallback) ======= */
$TitleServices = $TitleServices ?? "Committed to your health and wellbeing";
$SubServices   = $SubServices ?? "From design to implementation, we deliver digital solutions focused on performance, UX, and SEO.";

/* ======= Imagen héroe (ruta local) + dimensiones declaradas para SEO/CLS ======= */
$heroImg    = "assets/images/services/hero-1.jpg";
$heroWidth  = 1280;  // ancho lógico declarado
$heroHeight = 800;   // alto lógico declarado

/* ======= Tarjetas inferiores: toma hasta 6 servicios ======= */
$cards = [];
if (!empty($SN)) {
  $i = 0;
  foreach ($SN as $k => $name) {
    $cards[] = [
      'title' => $name,
      'desc'  => $ExSD[$k] ?? "",
    ];
    if (++$i === 6) break;
  }
}
?>

<section id="services-redesign" class="svcR" aria-labelledby="svcR-title">
  <div class="svcR__wrap">
    <!-- TOP: Headline + Image -->
    <div class="svcR__top">
      <div class="svcR__copy reveal">
        <div class="svcR__chip">
          <i class="fa-solid fa-screwdriver-wrench"></i>
          <span>About us</span>
        </div>
        <h2 id="svcR-title"><?= htmlspecialchars($TitleServices) ?></h2>
        <p class="svcR__sub"><?= htmlspecialchars($SubServices) ?></p>
        <div class="svcR__ctas">
          <a href="services.php" class="svcR__btn">
            <span>More About Us</span>
            <i class="fa-solid fa-arrow-right"></i>
          </a>
          <a href="services.php" class="svcR__btn ghost" aria-label="Go">
            <i class="fa-solid fa-arrow-up-right-from-square"></i>
          </a>
        </div>
      </div>

      <figure class="svcR__media reveal">
        <img
          src="<?= htmlspecialchars($heroImg) ?>"
          alt=""
          loading="lazy"
          decoding="async"
          width="<?= (int)$heroWidth ?>"
          height="<?= (int)$heroHeight ?>"
        >
      </figure>
    </div>

    <!-- BOTTOM: Grid de servicios -->
    <?php if (!empty($cards)): ?>
    <div class="svcR__grid">
      <?php foreach ($cards as $ix => $c): ?>
      <article class="svcR__card reveal c<?= $ix+1 ?>">
        <header>
          <h3 class="svcR__cardTitle"><?= htmlspecialchars($c['title']) ?></h3>
          <?php if (!empty($c['desc'])): ?>
          <p class="svcR__cardDesc"><?= htmlspecialchars($c['desc']) ?></p>
          <?php endif; ?>
        </header>
        <a class="svcR__view" href="services.php">
          <span>View all</span>
          <i class="fa-solid fa-arrow-up-right-from-square"></i>
        </a>
      </article>
      <?php endforeach; ?>
    </div>
    <?php endif; ?>
  </div>
</section>

<style>
/* =======================
   Services Redesign (health-style) — usa root.css
   ======================= */
.svcR{
  background:var(--color-light);
  color:var(--color-dark);
  padding:clamp(2.8rem,5vw,4rem) 0;
}
.svcR__wrap{
  width:min(1180px,92%);
  margin:0 auto;
  border:10px solid var(--color-primary);
  border-radius:22px;
  background:var(--color-ivory-soft); /* tono claro muy suave sobre var(--color-light) */
  box-shadow:0 10px 40px var(--color-dark-alpha-12);
  overflow:hidden;
}

/* ---------- TOP ---------- */
.svcR__top{
  display:grid;
  grid-template-columns:1.05fr .95fr;
  gap:1rem;
  padding:1.2rem;
}
@media (max-width: 980px){
  .svcR__top{ grid-template-columns:1fr; }
}

.svcR__copy{ padding:1rem 1.2rem 0 1.2rem; }
.svcR__chip{
  display:inline-flex; gap:.5rem; align-items:center;
  background:var(--color-dark-alpha-05);
  border:1px solid var(--color-dark-alpha-08);
  padding:.45rem .8rem; border-radius:999px;
  font-weight:700; color:var(--color-neutral);
}
.svcR__chip i{ color:var(--color-soft); }

.svcR__copy h2{
  margin:.6rem 0 .4rem;
  font-family:var(--font-heading);
  font-size:clamp(1.8rem,3.5vw,2.6rem);
  line-height:1.15; letter-spacing:.5px;
  color:var(--color-primary);
}
.svcR__sub{
  max-width:62ch;
  color:var(--color-graphite);
  margin:0 0 .9rem;
}

.svcR__ctas{ display:flex; gap:.6rem; }
.svcR__btn{
  display:inline-flex; align-items:center; gap:.6rem;
  background:var(--color-primary); color:var(--color-light);
  padding:.7rem 1rem; border-radius:12px; text-decoration:none;
  font-weight:800; transition:var(--transition-fast);
  box-shadow:0 8px 26px var(--color-dark-alpha-18);
}
.svcR__btn:hover{
  transform:translateY(-1px);
  background:var(--color-accent); color:var(--color-light);
}
.svcR__btn.ghost{
  background:transparent; color:var(--color-primary);
  border:2px solid var(--color-primary); box-shadow:none;
}
.svcR__btn.ghost:hover{
  background:var(--color-primary); color:var(--color-light);
}

/* ---------- HERO con tamaño ESPECIFICADO ---------- */
.svcR__media{
  border-radius:16px; overflow:hidden; background:var(--color-soft-gray);
  height:420px; min-height:420px; /* altura fija desktop: estabilidad CLS */
}
.svcR__media img{
  width:100%; height:100%; object-fit:cover;
  transform:scale(1.04);
  transition:transform 1s var(--transition-smooth);
}
.svcR__media:hover img{ transform:scale(1.12); }

@media (max-width: 980px){
  .svcR__media{ height:320px; min-height:320px; }
}
@media (max-width: 560px){
  .svcR__media{ height:240px; min-height:240px; }
}

/* ---------- GRID inferior ---------- */
.svcR__grid{
  display:grid; grid-template-columns:repeat(3,1fr);
  gap:1rem; padding:0 1.2rem 1.2rem;
}
@media (max-width: 980px){
  .svcR__grid{ grid-template-columns:1fr; }
}

.svcR__card{
  position:relative; border-radius:16px;
  padding:1.1rem 1.1rem 1.1rem;
  border:3px solid var(--color-primary);
  background:var(--color-light);
  box-shadow:var(--shadow-soft);
  min-height:190px; overflow:hidden;
  transform:translateY(16px); opacity:0;
}
.svcR__cardTitle{
  font-size:clamp(1.25rem,2.2vw,1.6rem);
  line-height:1.1; letter-spacing:.5px; margin:0 0 .35rem;
  text-transform:uppercase; font-family:var(--font-heading);
  color:var(--color-primary);
}
.svcR__cardDesc{ color:var(--color-dark); margin:0 0 2.1rem; }
.svcR__view{
  position:absolute; right:12px; bottom:12px;
  display:inline-flex; gap:.5rem; align-items:center;
  background:var(--color-light); color:var(--color-primary);
  border:2px solid var(--color-primary);
  padding:.45rem .7rem; border-radius:12px;
  text-decoration:none; font-weight:800;
  transition:var(--transition-fast);
}
.svcR__view i{ font-size:.95rem; }
.svcR__card:hover .svcR__view{
  background:var(--color-primary); color:var(--color-light);
}
.svcR__card:hover{ transform:translateY(-2px); }

/* Colores por tarjeta (guiño a health UI respetando root) */
.svcR__card.c1{ background:var(--color-pastel-mint); }
.svcR__card.c2{ background:var(--color-pastel-apricot); }
.svcR__card.c3{ background:var(--color-pastel-sky); }
.svcR__card.c4{ background:var(--color-pastel-sand); }
.svcR__card.c5{ background:var(--color-pastel-lavender); }
.svcR__card.c6{ background:var(--color-pastel-coral); }

/* Reveal base (rápido y suave) */
#services-redesign .reveal{ opacity:0; transform:translateY(18px); }
#services-redesign .reveal.active{
  opacity:1; transform:translateY(0);
  transition:.55s var(--transition-smooth);
}
</style>

<script>
/* Animación de entrada con GSAP si está disponible;
   de lo contrario, usa clase .active (fallback). */
(function(){
  const scope = document.getElementById('services-redesign');
  if(!scope) return;
  const nodes = scope.querySelectorAll('.reveal');
  const io = new IntersectionObserver((entries)=>{
    entries.forEach(e=>{
      if(!e.isIntersecting) return;
      const el = e.target;
      if (window.gsap) {
        gsap.fromTo(el,{opacity:0,y:20},{opacity:1,y:0,duration:.55,ease:"power3.out"});
      } else {
        el.classList.add('active');
      }
      io.unobserve(el);
    });
  },{threshold:.18, rootMargin:"0px 0px -10% 0px"});
  nodes.forEach(n=>io.observe(n));
})();
</script>
