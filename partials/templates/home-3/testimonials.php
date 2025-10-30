<?php
@session_start();
if (!isset($Testimonials)) {
 // Fallback: solo texto (EN)
 $Testimonials = [
  ["name"=>"William Ashford","role"=>"Co-Founder, Asterisk Inc","text"=>"I can’t recommend them enough! Their solutions made it easier to manage customer applications and approvals, resulting in faster turnaround times and happier clients."],
  ["name"=>"Sarah Mitchel","role"=>"Marketing Director — Google","text"=>"From branding to website delivery, every detail was meticulously handled. Their expertise helped us launch faster and the results have been phenomenal."],
  ["name"=>"David Callahan","role"=>"Marketing Director — Spotify","text"=>"We needed a modern, high-converting website, and the team delivered beyond expectations. Their SEO work helped us grow conversions by 800% in just two weeks."],
  ["name"=>"Danielle Reyes","role"=>"Founder — Ember & Co","text"=>"A flawless delivery from start to finish. The redesign improved our UX and boosted conversions by 400% in a week."],
 ];
}
?>
<section id="testimonials-text-slider" class="tsay-section" aria-labelledby="tsay-title">
 <div class="tsay-wrap">
    <div class="tsay-left">
   <p class="tsay-kicker" aria-hidden="true">TESTIMONIALS</p>
   <h2 id="tsay-title" class="tsay-title">What Our Clients Are Saying</h2>
   <p class="tsay-sub">We take pride in delivering exceptional solutions that drive measurable results. But don’t just take our word for it.</p>
   <a class="tsay-cta" href="reviews.php" aria-label="View all testimonials">
    <span>View all testimonials</span>
    <svg width="16" height="16" viewBox="0 0 24 24" aria-hidden="true"><path d="M7 12h10m0 0-4-4m4 4-4 4" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
   </a>
  </div>

    <div class="tsay-right">
   <div class="tsay-card" role="group" aria-roledescription="carousel" aria-label="Client quotes">
    <?php foreach ($Testimonials as $i => $t): ?>
     <?php
      $name = htmlspecialchars($t['name'] ?? 'Client');
      $role = htmlspecialchars($t['role'] ?? '');
      $text = htmlspecialchars($t['text'] ?? '');
     ?>
     <figure class="tsay-slide<?= $i === 0 ? ' is-active' : '' ?>" 
         role="group" aria-roledescription="slide" 
         aria-label="Slide <?= ($i+1) ?> of <?= count($Testimonials) ?>">
      <blockquote class="tsay-quote">“<?= $text ?>”</blockquote>
      <figcaption class="tsay-meta">
       <span class="tsay-name"><?= $name ?></span>
       <?php if ($role): ?><span class="tsay-role"><?= $role ?></span><?php endif; ?>
      </figcaption>
     </figure>
    <?php endforeach; ?>

        <div class="tsay-controls">
     <button class="tsay-nav tsay-prev" type="button" aria-label="Previous">
      <svg width="18" height="18" viewBox="0 0 24 24" aria-hidden="true"><path d="M15 6 9 12l6 6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
     </button>
     <button class="tsay-nav tsay-next" type="button" aria-label="Next">
      <svg width="18" height="18" viewBox="0 0 24 24" aria-hidden="true"><path d="M9 6l6 6-6 6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
     </button>
    </div>
   </div>
  </div>
 </div>
</section>

<style>
/* =======================
 TESTIMONIALS — TEXT SLIDER (clases únicas tsay-*)
 ======================= */
.tsay-section{
 --tsay-bg:var(--color-mist-light);
 --tsay-card:var(--color-light);
 --tsay-ring:var(--color-dark-alpha-06);
 --tsay-muted: var(--color-neutral, var(--color-neutral-deep));
 --tsay-dark: var(--color-dark);
--tsay-accent:var(--color-warm-base);
--tsay-soft: var(--color-warm-glow);

 background: var(--tsay-bg);
 padding: clamp(2.5rem, 4vw, 4rem);
 border-radius: 24px;
 box-shadow: 0 10px 30px var(--color-dark-alpha-06);
}
.tsay-wrap{
 display:grid;
 grid-template-columns: 1.1fr 1.4fr;
 gap: clamp(1.5rem, 4vw, 3rem);
 align-items: center;
}
@media (max-width: 980px){
 .tsay-wrap{ grid-template-columns: 1fr; }
}

.tsay-left{ padding: clamp(0.5rem,1.5vw,1rem) clamp(0.5rem,1.5vw,1rem) 1rem; }
.tsay-kicker{
 letter-spacing:.18em;
 text-transform:uppercase;
 font-weight:800;
 color:var(--tsay-soft);
 margin:0 0 .6rem;
 font-size:.78rem;
}
.tsay-title{
 font-family: var(--font-heading, 'Montserrat', system-ui, sans-serif);
 color: var(--tsay-dark);
 font-size: clamp(1.8rem, 3.2vw, 2.8rem);
 line-height:1.15;
 margin:0 0 .6rem;
}
.tsay-sub{
 color: var(--tsay-muted);
 margin:0 0 1.4rem;
 max-width: 52ch;
}
.tsay-cta{
 display:inline-flex; gap:.5rem; align-items:center;
 padding:.8rem 1rem;
 border-radius: 12px;
 background: var(--tsay-card);
 color: var(--tsay-dark);
 text-decoration:none;
 border:1px solid var(--tsay-ring);
 box-shadow: 0 4px 14px var(--color-dark-alpha-06);
 font-weight: 700;
 transition: transform .2s ease, box-shadow .2s ease;
}
.tsay-cta:hover{ transform: translateY(-1px); box-shadow:0 8px 20px var(--color-dark-alpha-08); }
.tsay-cta svg{ transform: translateX(0); transition: transform .2s ease; }
.tsay-cta:hover svg{ transform: translateX(3px); }

.tsay-right{ width:100%; }
.tsay-card{
 position: relative;
 background: var(--tsay-card);
 border-radius: 18px;
 padding: clamp(1.2rem, 2.2vw, 2rem);
 box-shadow: 0 8px 28px var(--color-dark-alpha-08);
 min-height: 260px;
 display:flex;
 align-items:center;
 overflow:hidden;
}

/* Slides */
.tsay-slide{
 position:absolute;
 inset:0;
 padding: clamp(1rem, 2.5vw, 2rem);
 opacity:0;
 transform: translateY(10px);
 transition: opacity .45s ease, transform .45s ease;
 display:flex;
 flex-direction:column;
 justify-content:center;
}
.tsay-slide.is-active{
 opacity:1;
 transform: translateY(0);
 position:relative;
 /* **CORRECCIÓN 1: Asegura que el slide no esté demasiado alto** */
 z-index: 1; 
}
.tsay-quote{
 font-size: clamp(1.2rem, 2.6vw, 2rem);
 line-height:1.35;
 color: var(--tsay-dark);
 margin: 0 0 1.2rem;
 font-weight: 700;
}
.tsay-meta{ display:flex; flex-direction:column; gap:.15rem; }
.tsay-name{ font-weight:800; color: var(--tsay-dark); }
.tsay-role{ color: var(--tsay-muted); font-size:.95rem; }

/* Controles */
.tsay-controls{
 position:absolute; right: .8rem; bottom: .8rem;
 display:flex; gap:.5rem;
 /* **CORRECCIÓN 2: Eleva los controles por encima del slide** */
 z-index: 10;
}
.tsay-nav{
 width:40px; height:40px; border-radius:12px;
 border:1px solid var(--tsay-ring);
 background:var(--color-light); color:var(--tsay-dark);
 display:grid; place-items:center;
 box-shadow:0 6px 18px var(--color-dark-alpha-06);
 cursor:pointer;
 transition: transform .15s ease, background .15s ease;
}
.tsay-nav:hover{ transform: translateY(-1px); background:var(--color-soft-white); }
.tsay-nav:focus-visible{ outline:2px solid var(--tsay-accent); outline-offset:2px; }

@media (max-width: 560px){
 .tsay-controls{ position:static; margin-top:.8rem; }
 .tsay-card{ padding-bottom: .8rem; }
}
</style>

<script>
(() => {
  const root  = document.querySelector('#testimonials-text-slider');
  if (!root) return;

  const slides = [...root.querySelectorAll('.tsay-slide')];
  const prev  = root.querySelector('.tsay-prev');
  const next  = root.querySelector('.tsay-next');

  let index = 0;
  let timer = null;
  const delay = 6000; // autoplay (ms)

  const setActive = (i) => {
    slides.forEach((s, k) => s.classList.toggle('is-active', k === i));
    index = i;
  };

  const go = (dir = 1) => {
    const n = (index + dir + slides.length) % slides.length;
    setActive(n);
  };

  // Autoplay con respeto a prefers-reduced-motion
  const prefersReduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  const start = () => { if (!prefersReduced) { stop(); timer = setInterval(go, delay); } };
  const stop = () => { if (timer) clearInterval(timer); timer = null; };

  // Función unificada para navegar y reiniciar el autoplay
  const handleNav = (dir) => {
    go(dir);
    start();
  };

  // Eventos de Click (para escritorio)
  next?.addEventListener('click', () => handleNav(1));
  prev?.addEventListener('click', () => handleNav(-1));

  // **CORRECCIÓN 3: Eventos Táctiles (para móvil) para asegurar la activación del botón**
  next?.addEventListener('touchend', (e) => { 
    e.preventDefault(); 
    handleNav(1); 
  });
  prev?.addEventListener('touchend', (e) => { 
    e.preventDefault(); 
    handleNav(-1); 
  });
  
  // Pausar al hover/ focus
  const card = root.querySelector('.tsay-card');
  card.addEventListener('mouseenter', stop, {passive:true});
  card.addEventListener('mouseleave', start, {passive:true});
  card.addEventListener('focusin', stop);
  card.addEventListener('focusout', start);

  // Teclado
  card.addEventListener('keydown', (e) => {
    if (e.key === 'ArrowRight') { e.preventDefault(); handleNav(1); }
    if (e.key === 'ArrowLeft') { e.preventDefault(); handleNav(-1); }
  });

  // Init
  setActive(0);
  start();
})();
</script>