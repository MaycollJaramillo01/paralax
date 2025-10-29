<?php
@session_start();
if (!isset($SN)) include_once __DIR__ . '/text.php';

/* ===========================
   TESTIMONIALS DATA FALLBACK
   =========================== */
if (!isset($Testimonials) || !is_array($Testimonials)) {
  $Testimonials = [
    [
      "name" => "Alejandro Pérez",
      "role" => "Marketing Manager – Nexa Studio",
      "text" => "Doble el ROI de mis campañas en 3 meses. Estrategia y ejecución impecable."
    ],
    [
      "name" => "Laura Gómez",
      "role" => "CEO – Luma Digital",
      "text" => "Un equipo profesional que entiende rendimiento y diseño. Mi web ahora posiciona."
    ],
    [
      "name" => "Carlos Méndez",
      "role" => "Founder – CM Solutions",
      "text" => "El mejor soporte post-lanzamiento que hemos tenido. Rápidos y transparentes."
    ],
    [
      "name" => "Sofía Torres",
      "role" => "Project Lead – Arkon Labs",
      "text" => "Excelente trabajo de optimización técnica. Nuestro sitio carga 2 × más rápido."
    ],
    [
      "name" => "Javier Rivas",
      "role" => "Director – Rivas Group",
      "text" => "Diseño funcional y moderno. Entregas puntuales y comunicación clara."
    ]
  ];
}
?>

<section id="testimonials" class="testi-section gradient-primary" aria-labelledby="testi-title">
  <div class="testi-header" data-animate="fade-in">
    <h2 id="testi-title">What Our Clients Say</h2>
    <p>Authentic feedback from long-term collaborations built on results and trust.</p>
  </div>

  <div class="testi-grid">
    <?php foreach ($Testimonials as $t): ?>
    <article class="testi-card reveal" itemscope itemtype="https://schema.org/Review">
      <meta itemprop="itemReviewed" content="<?= htmlspecialchars($Company ?? 'Go Maven Hub'); ?>">
      <figure class="testi-avatar">
        <i class="fa-solid fa-user"></i>
      </figure>
      <blockquote itemprop="reviewBody">“<?= htmlspecialchars($t['text'] ?? '') ?>”</blockquote>
      <h3 itemprop="author"><?= htmlspecialchars($t['name'] ?? '') ?></h3>
      <?php if (!empty($t['role'])): ?>
      <p class="role"><?= htmlspecialchars($t['role']) ?></p>
      <?php endif; ?>
    </article>
    <?php endforeach; ?>
  </div>
</section>

<style>
/* =======================
   TESTIMONIALS – Glassmorphism
   ======================= */
.testi-section{
  padding:clamp(3rem,5vw,6rem) 2rem;
  color:var(--color-light);
  text-align:center;
  position:relative;
  overflow:hidden;
}
.testi-header h2{
  font-family:var(--font-heading);
  color:var(--color-light);
  font-size:clamp(1.8rem,3vw,2.6rem);
  margin-bottom:.5rem;
}
.testi-header p{
  opacity:.85;
  margin-bottom:3rem;
}

.testi-grid{
  display:grid;
  grid-template-columns:repeat(auto-fit,minmax(280px,1fr));
  gap:2rem;
  width:min(1300px,95%);
  margin:0 auto;
}

.testi-card{
  background:rgba(255,255,255,0.08);
  border:1px solid rgba(255,255,255,0.15);
  backdrop-filter:blur(16px);
  border-radius:var(--radius-lg);
  padding:2rem 1.5rem 2.5rem;
  box-shadow:var(--shadow-soft);
  transform:translateY(30px);
  opacity:0;
  transition:var(--transition-smooth);
}
.testi-card:hover{
  transform:translateY(-6px) scale(1.03);
  box-shadow:var(--shadow-hard);
}

.testi-avatar{
  display:flex;
  align-items:center;
  justify-content:center;
  width:90px;height:90px;
  margin:0 auto 1rem;
  border-radius:50%;
  border:2px solid var(--color-soft);
  color:var(--color-soft);
  background:rgba(255,255,255,0.05);
  font-size:2.4rem;
  box-shadow:0 0 10px rgba(0,0,0,0.3);
}
.testi-avatar i{
  animation: float 4s ease-in-out infinite;
}

.testi-card blockquote{
  font-style:italic;
  color:var(--color-light);
  line-height:1.6;
  margin:0 auto 1rem;
  max-width:38ch;
}
.testi-card h3{
  font-family:var(--font-heading);
  color:var(--color-soft);
  margin-bottom:.3rem;
}
.testi-card .role{
  font-size:.9rem;
  color:rgba(255,255,255,0.8);
}

/* Scroll-reveal animation */
.reveal.active{
  opacity:1;
  transform:translateY(0);
  transition:opacity .8s var(--transition-smooth),transform .8s var(--transition-smooth);
}

/* Responsive */
@media(max-width:768px){
  .testi-grid{gap:1.5rem;}
  .testi-card{padding:1.5rem;}
}
</style>

<script>
/* Intersection Observer – reveal on scroll */
(() => {
  const cards = document.querySelectorAll('#testimonials .reveal');
  const io = new IntersectionObserver(entries=>{
    entries.forEach(e=>{
      if(e.isIntersecting){
        e.target.classList.add('active');
        io.unobserve(e.target);
      }
    });
  },{threshold:0.15});
  cards.forEach(c=>io.observe(c));
})();
</script>
