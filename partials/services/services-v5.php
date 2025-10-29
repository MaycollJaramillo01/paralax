<?php
@session_start();
if (!isset($SN)) include __DIR__ . '/text.php';

$TitleServices = $TitleServices ?? "How We Help You";
$SubServices   = $SubServices ?? "Our team of experts is dedicated to helping you achieve your goals through precise, data-driven strategies.";
?>
<section id="services-v3" class="sv3" aria-labelledby="sv3-title">
  <div class="sv3__container">
    <header class="sv3__head">
      <h2 id="sv3-title"><?= htmlspecialchars($TitleServices) ?></h2>
      <p><?= htmlspecialchars($SubServices) ?></p>
    </header>

    <?php if (!empty($SN)): foreach ($SN as $i => $name):
      $idx  = $i + 1;
      $desc = $ExSD[$idx] ?? '';
      $img  = "assets/images/services/s{$idx}.jpg";
      $rev  = $idx % 2 === 0 ? 'is-rev' : '';
    ?>
    <article class="sv3__card reveal <?= $rev ?>">
      <div class="sv3__media">
        <div class="sv3__imgWrap">
          <img src="<?= htmlspecialchars($img) ?>" alt="<?= htmlspecialchars($name) ?>" loading="lazy" decoding="async">
        </div>
      </div>
      <div class="sv3__body">
        <h3><?= htmlspecialchars($name) ?></h3>
        <?php if ($desc): ?><p class="sv3__desc"><?= htmlspecialchars($desc) ?></p><?php endif; ?>
        <a class="sv3__cta" href="contact.php">Learn More <i class="fa-solid fa-arrow-right"></i></a>
      </div>
    </article>
    <?php endforeach; endif; ?>
  </div>
</section>

<style>
/* ============================================================
   SERVICES V3 — BLOQUES UNIFICADOS + HALO DE COLOR
   ============================================================ */
.sv3 {
  background: var(--color-light);
  color: var(--color-dark);
  padding: clamp(3rem, 6vw, 5.5rem) 0;
}
.sv3__container {
  width: min(1150px, 92%);
  margin: 0 auto;
}
.sv3__head {
  text-align: center;
  margin-bottom: 2.5rem;
}
.sv3__head h2 {
  font-family: var(--font-heading);
  font-size: clamp(2rem, 3vw, 2.8rem);
  color: var(--color-primary);
}
.sv3__head p {
  color: var(--color-neutral);
  max-width: 60ch;
  margin: 0.5rem auto 0;
}

/* ============================================================
   CARD CONTAINER
   ============================================================ */
.sv3__card {
  display: grid;
  grid-template-columns: 0.9fr 1.1fr;
  align-items: center;
  gap: 2rem;
  background: var(--color-light);
  border-radius: 20px;
  box-shadow: 0 8px 28px var(--color-dark-alpha-12);
  padding: 2rem 2.5rem;
  margin-bottom: 2.5rem;
  transition: var(--transition-medium);
  transform: translateY(30px);
  opacity: 0;
}
.sv3__card:hover {
  box-shadow: var(--shadow-hard);
  transform: translateY(-2px);
}
.sv3__card.is-rev {
  grid-template-columns: 1.1fr 0.9fr;
}
.sv3__card.is-rev .sv3__media {
  order: 2;
}
.sv3__card.is-rev .sv3__body {
  order: 1;
}
@media (max-width: 920px) {
  .sv3__card,
  .sv3__card.is-rev {
    grid-template-columns: 1fr;
    text-align: center;
    padding: 2rem 1.5rem;
  }
}

/* ============================================================
   IMAGEN CON HALO / GLOW
   ============================================================ */
.sv3__media {
  display: flex;
  justify-content: center;
  align-items: center;
}
.sv3__imgWrap {
  position: relative;
  width: 260px;
  height: 260px;
  border-radius: 50%;
  background: radial-gradient(circle at 30% 30%, var(--color-warm-glow-alpha-25), var(--color-dark-alpha-03));
  display: flex;
  justify-content: center;
  align-items: center;
  box-shadow: 0 0 60px var(--color-warm-glow-alpha-35);
}
.sv3__imgWrap::before {
  content: "";
  position: absolute;
  inset: -10px;
  border-radius: 50%;
  background: radial-gradient(circle, var(--color-warm-base-alpha-25), transparent 70%);
  z-index: 0;
}
.sv3__imgWrap img {
  position: relative;
  z-index: 1;
  width: 210px;
  height: 210px;
  border-radius: 50%;
  object-fit: cover;
  transition: transform 1s var(--transition-smooth);
}
.sv3__imgWrap:hover img {
  transform: scale(1.08);
}
@media (max-width: 600px) {
  .sv3__imgWrap {
    width: 200px;
    height: 200px;
  }
  .sv3__imgWrap img {
    width: 160px;
    height: 160px;
  }
}

/* ============================================================
   BODY
   ============================================================ */
.sv3__body h3 {
  font-family: var(--font-heading);
  font-size: clamp(1.3rem, 2vw, 1.8rem);
  margin: 0 0 0.6rem;
  color: var(--color-primary);
}
.sv3__desc {
  color: var(--color-neutral);
  margin: 0 0 1.2rem;
  line-height: 1.6;
}
.sv3__cta {
  display: inline-flex;
  align-items: center;
  gap: 0.5rem;
  background: var(--color-primary);
  color: var(--color-light);
  text-decoration: none;
  padding: 0.6rem 1rem;
  border-radius: 10px;
  font-weight: 700;
  transition: var(--transition-fast);
}
.sv3__cta:hover {
  background: var(--color-accent);
  transform: translateX(3px);
}

/* ============================================================
   ANIMATION (GSAP / Fallback)
   ============================================================ */
#services-v3 .reveal {
  opacity: 0;
  transform: translateY(30px);
}
#services-v3 .reveal.active {
  opacity: 1;
  transform: translateY(0);
  transition: 0.6s var(--transition-smooth);
}
</style>

<script>
(function(){
  const cards = document.querySelectorAll('#services-v3 .reveal');
  const io = new IntersectionObserver((entries)=>{
    entries.forEach(e=>{
      if(!e.isIntersecting) return;
      const el = e.target;
      if (window.gsap){
        gsap.fromTo(el,{opacity:0,y:30},{opacity:1,y:0,duration:0.8,ease:"power3.out"});
      } else {
        el.classList.add('active');
      }
      io.unobserve(el);
    });
  },{threshold:0.2, rootMargin:"0px 0px -8% 0px"});
  cards.forEach(el=>io.observe(el));
})();
</script>
