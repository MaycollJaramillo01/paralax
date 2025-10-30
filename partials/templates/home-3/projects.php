<?php
@session_start();
if (!isset($Projects)) {
  $Projects = [
    [
      "title"=>"M.V Contractors Inc.",
      "desc"=>"Full website redesign + SEO growth +320%.",
      "img"=>"assets/images/projects/mv.jpg",
      "url"=>"portfolio.php"
    ],
    [
      "title"=>"Vallcuerba Real Estate",
      "desc"=>"Real estate automation with Betterplace API integration.",
      "img"=>"assets/images/projects/vallcuerba.jpg",
      "url"=>"portfolio.php"
    ],
    [
      "title"=>"R&J Seamless Gutters",
      "desc"=>"Local SEO & Google Business optimization for Katy, TX.",
      "img"=>"assets/images/projects/rj.jpg",
      "url"=>"portfolio.php"
    ]
  ];
}
?>

<section id="projects-glass" class="projGlass" aria-labelledby="projGlass-title">
  <header class="projGlass__head reveal">
    <h2 id="projGlass-title">Featured Projects</h2>
    <p>High-performance builds crafted with precision, SEO-first architecture, and design depth.</p>
  </header>

  <div class="projGlass__grid">
    <?php foreach ($Projects as $ix=>$p): ?>
    <article class="projGlass__card reveal" itemscope itemtype="https://schema.org/CreativeWork">
      <figure class="projGlass__media">
        <img src="<?= $p['img'] ?>" alt="<?= htmlspecialchars($p['title']) ?>" width="1280" height="720" loading="lazy" itemprop="image">
      </figure>
      <div class="projGlass__content">
        <h3 itemprop="name"><?= htmlspecialchars($p['title']) ?></h3>
        <p itemprop="description"><?= htmlspecialchars($p['desc']) ?></p>
        <a href="<?= $p['url'] ?>" class="projGlass__cta" itemprop="url">
          View Case Study <i class="fa-solid fa-arrow-up-right-from-square"></i>
        </a>
      </div>
    </article>
    <?php endforeach; ?>
  </div>
</section>

<style>
/* ============================================
   FEATURED PROJECTS — GLASSMORPHISM SHOWCASE
   ============================================ */
.projGlass{
  width:100%;
  background:linear-gradient(135deg,var(--color-light) 0%,var(--color-light-alpha-15) 100%);
  color:var(--color-dark);
  padding:clamp(3rem,5vw,5rem) 0;
  overflow:hidden;
  position:relative;
  backdrop-filter:blur(20px);
}

/* ---------- HEADER ---------- */
.projGlass__head{
  text-align:center;
  margin-bottom:3rem;
  max-width:75ch;
  margin-inline:auto;
}
.projGlass__head h2{
  font-family:var(--font-heading);
  font-size:clamp(2rem,3vw,2.6rem);
  color:var(--color-primary);
  letter-spacing:.5px;
}
.projGlass__head p{
  font-size:1.05rem;
  color:var(--color-dark-alpha-70);
}

/* ---------- GRID ---------- */
.projGlass__grid{
  display:grid;
  grid-template-columns:repeat(auto-fit,minmax(320px,1fr));
  gap:2rem;
  width:min(1400px,92%);
  margin:0 auto;
}

/* ---------- CARD ---------- */
.projGlass__card{
  position:relative;
  border-radius:22px;
  overflow:hidden;
  background:var(--color-light-alpha-10);
  backdrop-filter:blur(16px);
  border:1px solid var(--color-light-alpha-25);
  box-shadow:0 8px 32px var(--color-dark-alpha-10);
  transform:translateY(30px);
  opacity:0;
  transition:transform .6s ease, opacity .6s ease, box-shadow .5s ease, scale .5s ease;
}
.projGlass__card:hover{
  transform:translateY(-6px) scale(1.03);
  box-shadow:0 16px 45px var(--color-dark-alpha-25);
}

/* ---------- IMAGE ---------- */
.projGlass__media{
  position:relative;
  height:240px;
  overflow:hidden;
}
.projGlass__media img{
  width:100%;
  height:100%;
  object-fit:cover;
  transition:transform 1s ease, filter .5s ease;
  filter:brightness(0.9);
}
.projGlass__card:hover img{
  transform:scale(1.12);
  filter:brightness(1);
}

/* ---------- CONTENT ---------- */
.projGlass__content{
  position:relative;
  padding:1.5rem 1.6rem 2rem;
  z-index:2;
}
.projGlass__content h3{
  font-family:var(--font-heading);
  font-size:1.4rem;
  margin:0 0 .5rem;
  color:var(--color-primary);
}
.projGlass__content p{
  font-size:.95rem;
  color:var(--color-dark-alpha-80);
  margin:0 0 1.2rem;
  line-height:1.5;
}
.projGlass__cta{
  display:inline-flex;
  align-items:center;
  gap:.5rem;
  background:var(--color-light-alpha-25);
  backdrop-filter:blur(8px);
  border-radius:12px;
  padding:.6rem 1.1rem;
  color:var(--color-dark);
  font-weight:700;
  text-decoration:none;
  box-shadow:0 4px 10px var(--color-dark-alpha-15);
  transition:all .4s ease;
}
.projGlass__cta:hover{
  background:var(--color-accent);
  color:var(--color-light);
  transform:translateY(-2px);
  box-shadow:0 6px 16px var(--color-dark-alpha-25);
}

/* ---------- ANIMATION ---------- */
#projects-glass .reveal{
  opacity:0;
  transform:translateY(40px);
}
#projects-glass .reveal.active{
  opacity:1;
  transform:translateY(0);
  transition:opacity .8s cubic-bezier(.19,1,.22,1),transform .8s cubic-bezier(.19,1,.22,1);
}

/* ---------- RESPONSIVE ---------- */
@media(max-width:768px){
  .projGlass__media{height:200px;}
  .projGlass__content h3{font-size:1.2rem;}
}
@media(max-width:480px){
  .projGlass__grid{gap:1.2rem;}
  .projGlass__content{padding:1.2rem;}
}
</style>

<script>
/* Animación de aparición suave en scroll */
(function(){
  const scope=document.getElementById('projects-glass');
  if(!scope)return;
  const cards=scope.querySelectorAll('.reveal');
  const io=new IntersectionObserver(entries=>{
    entries.forEach(e=>{
      if(e.isIntersecting){
        e.target.classList.add('active');
        io.unobserve(e.target);
      }
    });
  },{threshold:.15,rootMargin:"0px 0px -10% 0px"});
  cards.forEach(c=>io.observe(c));
})();
</script>
