<?php
@session_start();
if (!isset($Projects)) {
  $Projects = [
    ["title"=>"M.V Contractors Inc.","desc"=>"Full website redesign + SEO growth +320%.","img"=>"assets/images/projects/mv.jpg","url"=>"portfolio.php"],
    ["title"=>"Vallcuerba Real Estate","desc"=>"Real estate automation with Betterplace API integration.","img"=>"assets/images/projects/vallcuerba.jpg","url"=>"portfolio.php"],
    ["title"=>"R&J Seamless Gutters","desc"=>"Local SEO & Google Business optimization for Katy, TX.","img"=>"assets/images/projects/rj.jpg","url"=>"portfolio.php"]
  ];
}
?>

<section id="projects-seo-grid" class="pSEO" aria-labelledby="pSEO-title">
  <header class="pSEO__head reveal">
    <h2 id="pSEO-title">Featured Projects</h2>
    <p>Each case study highlights measurable impact through UX, SEO, and performance-first web development.</p>
  </header>

  <div class="pSEO__grid">
    <?php foreach ($Projects as $ix=>$p): ?>
    <article class="pSEO__card reveal" itemscope itemtype="https://schema.org/CreativeWork">
      <figure class="pSEO__img">
        <img src="<?= $p['img'] ?>" alt="<?= $p['title'] ?>" width="640" height="420" loading="lazy" itemprop="image">
      </figure>
      <div class="pSEO__info">
        <h3 itemprop="name"><?= htmlspecialchars($p['title']) ?></h3>
        <p itemprop="description"><?= htmlspecialchars($p['desc']) ?></p>
        <a href="<?= $p['url'] ?>" class="pSEO__link" itemprop="url">
          <span>View Case Study</span>
          <i class="fa-solid fa-arrow-up-right-from-square"></i>
        </a>
      </div>
    </article>
    <?php endforeach; ?>
  </div>
</section>

<style>
/* ============= SEO FOCUSED GRID ============= */
.pSEO{
  background:#fff;
  color:#111;
  padding:clamp(3rem,5vw,5rem) 2rem;
}
.pSEO__head{text-align:center;max-width:70ch;margin:0 auto 2.5rem;}
.pSEO__head h2{
  font-family:var(--font-heading);
  font-size:clamp(2rem,3vw,2.6rem);
  color:var(--color-primary);
}
.pSEO__head p{color:#333;}

.pSEO__grid{
  display:grid;
  grid-template-columns:repeat(auto-fit,minmax(320px,1fr));
  gap:1.6rem;
  max-width:1380px;
  margin:0 auto;
}
.pSEO__card{
  background:#fff;
  border-radius:16px;
  overflow:hidden;
  box-shadow:0 8px 26px rgba(0,0,0,.08);
  transition:transform .4s ease, box-shadow .4s ease;
}
.pSEO__card:hover{
  transform:translateY(-4px);
  box-shadow:0 16px 40px rgba(0,0,0,.15);
}
.pSEO__img img{
  width:100%;height:auto;display:block;
  object-fit:cover;
}
.pSEO__info{
  padding:1.2rem 1.4rem 1.6rem;
}
.pSEO__info h3{
  font-family:var(--font-heading);
  font-size:1.3rem;
  margin:.2rem 0 .4rem;
}
.pSEO__info p{font-size:.95rem;opacity:.9;margin:0 0 1rem;}
.pSEO__link{
  display:inline-flex;align-items:center;gap:.4rem;
  color:var(--color-primary);
  font-weight:700;
  text-decoration:none;
  border-bottom:2px solid transparent;
  transition:border .3s ease;
}
.pSEO__link:hover{border-bottom:2px solid var(--color-primary);}
</style>

<script>
(function(){
  const scope=document.getElementById('projects-seo-grid');
  const els=scope?.querySelectorAll('.reveal')||[];
  const io=new IntersectionObserver(e=>{
    e.forEach(i=>{
      if(i.isIntersecting){
        i.target.classList.add('active');
        io.unobserve(i.target);
      }
    });
  },{threshold:.2});
  els.forEach(n=>io.observe(n));
})();
</script>
