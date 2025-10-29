<?php
@session_start();
if (!isset($Projects)) {
  $Projects = [
    [
      "title" => "M.V Contractors Inc.",
      "desc"  => "Full website redesign + SEO growth +320%.",
      "img"   => "assets/images/projects/mv.jpg",
      "url"   => "portfolio.php"
    ],
    [
      "title" => "Vallcuerba Real Estate",
      "desc"  => "Real estate automation with Betterplace API integration.",
      "img"   => "assets/images/projects/vallcuerba.jpg",
      "url"   => "portfolio.php"
    ],
    [
      "title" => "R&J Seamless Gutters",
      "desc"  => "Local SEO & Google Business optimization for Katy, TX.",
      "img"   => "assets/images/projects/rj.jpg",
      "url"   => "portfolio.php"
    ]
  ];
}

$TitleProjects = $TitleProjects ?? "Featured Projects";
$SubProjects   = $SubProjects   ?? "Each project combines strategy, design, and technology to deliver measurable impact.";
?>

<section id="projects-showcase" class="projFull" aria-labelledby="projFull-title">
  <div class="projFull__head reveal">
    <h2 id="projFull-title"><?= htmlspecialchars($TitleProjects) ?></h2>
    <p><?= htmlspecialchars($SubProjects) ?></p>
  </div>

  <div class="projFull__grid">
    <?php foreach ($Projects as $ix => $p): ?>
      <article class="projFull__card reveal" style="--delay:<?= $ix * 120 ?>ms">
        <figure class="projFull__media">
          <img src="<?= htmlspecialchars($p['img']) ?>" alt="<?= htmlspecialchars($p['title']) ?>" loading="lazy">
        </figure>
        <div class="projFull__overlay"></div>
        <div class="projFull__content">
          <h3><?= htmlspecialchars($p['title']) ?></h3>
          <p><?= htmlspecialchars($p['desc']) ?></p>
          <a href="<?= htmlspecialchars($p['url']) ?>" class="projFull__cta">
            <span>View Case Study</span>
            <i class="fa-solid fa-arrow-up-right-from-square"></i>
          </a>
        </div>
      </article>
    <?php endforeach; ?>
  </div>
</section>

<style>
/* ============ FEATURED PROJECTS FULL WIDTH ============ */
.projFull{
  width:100%;
  background:linear-gradient(to right, var(--color-light), var(--color-eggshell));
  color:var(--color-dark);
  padding:clamp(4rem,6vw,6rem) 0;
  overflow:hidden;
}

/* HEADER */
.projFull__head{
  text-align:center;
  margin-bottom:3rem;
}
.projFull__head h2{
  font-family:var(--font-heading);
  font-size:clamp(2rem,3.5vw,3rem);
  margin:0 0 .5rem;
  color:var(--color-primary);
}
.projFull__head p{
  color:var(--color-secondary);
  max-width:70ch;
  margin:0 auto;
  font-size:1.05rem;
}

/* GRID (full width responsive) */
.projFull__grid{
  display:grid;
  grid-template-columns:repeat(3,1fr);
  gap:1rem;
  width:100%;
  max-width:1600px;
  margin:0 auto;
  padding:0 2rem;
}
@media(max-width:980px){
  .projFull__grid{grid-template-columns:1fr 1fr;}
}
@media(max-width:680px){
  .projFull__grid{grid-template-columns:1fr;}
}

/* CARD */
.projFull__card{
  position:relative;
  height:460px;
  border-radius:20px;
  overflow:hidden;
  cursor:pointer;
  transform:translateY(40px);
  opacity:0;
  box-shadow:0 12px 35px var(--color-dark-alpha-15);
  transition:transform .5s ease, box-shadow .5s ease;
}
.projFull__card:hover{
  transform:scale(1.03) rotateX(4deg);
  box-shadow:0 20px 60px var(--color-dark-alpha-25);
}

/* IMAGE */
.projFull__media{position:absolute;inset:0;overflow:hidden;}
.projFull__media img{
  width:100%;height:100%;object-fit:cover;
  transform:scale(1.08);
  transition:transform 1.8s cubic-bezier(.25,.1,.25,1);
}
.projFull__card:hover img{transform:scale(1.2);}

/* OVERLAY */
.projFull__overlay{
  position:absolute;inset:0;
  background:linear-gradient(180deg,var(--color-dark-alpha-05) 0%,var(--color-dark-alpha-80) 100%);
  z-index:1;
  transition:background .4s ease;
}
.projFull__card:hover .projFull__overlay{
  background:linear-gradient(180deg,var(--color-dark-alpha-15) 0%,var(--color-dark-alpha-90) 100%);
}

/* CONTENT */
.projFull__content{
  position:absolute;
  bottom:0;
  z-index:2;
  padding:1.8rem;
  color:var(--color-light);
}
.projFull__content h3{
  font-family:var(--font-heading);
  font-size:clamp(1.4rem,2vw,1.7rem);
  margin:0 0 .4rem;
}
.projFull__content p{
  margin:0 0 1rem;
  font-size:1rem;
  opacity:.9;
}
.projFull__cta{
  display:inline-flex;align-items:center;gap:.5rem;
  background:var(--color-light-alpha-20);
  padding:.6rem 1rem;
  border-radius:10px;
  text-decoration:none;
  color:var(--color-light);font-weight:700;
  backdrop-filter:blur(6px);
  transition:background .3s ease;
}
.projFull__cta:hover{background:var(--color-accent);}

/* Animación Reveal */
#projects-showcase .reveal{opacity:0;transform:translateY(40px);}
#projects-showcase .reveal.active{opacity:1;transform:translateY(0);transition:.7s var(--transition-smooth);}
</style>

<script>
(function(){
  const scope=document.getElementById('projects-showcase');
  if(!scope)return;
  const nodes=scope.querySelectorAll('.reveal');
  const io=new IntersectionObserver(entries=>{
    entries.forEach(e=>{
      if(!e.isIntersecting)return;
      const el=e.target;
      if(window.gsap){
        gsap.fromTo(el,{opacity:0,y:50,delay:parseInt(el.style.getPropertyValue('--delay')||0)/1000},
          {opacity:1,y:0,duration:.8,ease:"power3.out"});
      }else el.classList.add('active');
      io.unobserve(el);
    });
  },{threshold:.2});
  nodes.forEach(n=>io.observe(n));
})();
</script>
    