<?php
@session_start();
if (!isset($SN)) include __DIR__ . '/text.php';

$TitleServices = $TitleServices ?? "Our Services";
$SubServices = $SubServices ?? "We combine design, technology and motion to build immersive, high-performance websites.";
?>
<section id="services-tilt-dark" class="svDark" aria-labelledby="svDark-title">
<div class="svDark__container">
<header class="svDark__head">
<h2 id="svDark-title"><?= htmlspecialchars($TitleServices) ?></h2>
<p><?= htmlspecialchars($SubServices) ?></p>
<a href="contact.php" class="svDark__cta">Get Started</a>
</header>

<div class="svDark__grid">
<?php if (!empty($SN)): foreach ($SN as $i => $name):
$idx = $i + 1;
$desc = $ExSD[$idx] ?? '';
$ico = ['fa-brain','fa-code','fa-cart-shopping','fa-laptop','fa-globe','fa-screwdriver-wrench'][$i % 6];
?>
<article class="svDark__card reveal <?= $i % 2 === 1 ? 'dark' : '' ?>">
<div class="svDark__icon">
<i class="fa-solid <?= htmlspecialchars($ico) ?>"></i>
</div>
<h3><?= htmlspecialchars($name) ?></h3>
<p><?= htmlspecialchars($desc ?: "Delivering measurable design, development, and marketing performance.") ?></p>
<a href="contact.php" class="svDark__link">Learn more <i class="fa-solid fa-arrow-right"></i></a>
</article>
<?php endforeach; endif; ?>
</div>
</div>
</section>

<style>
/* ============================================================
SERVICES DARK TILT — Optimized (3 per row, strong contrast)
============================================================ */
.svDark {
background: var(--color-light);
color: var(--color-dark);
padding: clamp(3rem, 6vw, 5rem) 0;
}
.svDark__container {
width: min(1180px, 92%);
margin: 0 auto;
}
.svDark__head {
text-align: center;
margin-bottom: 2.5rem;
}
.svDark__head h2 {
font-family: var(--font-heading);
font-size: clamp(2rem, 3vw, 2.6rem);
color: var(--color-dark);
font-weight: 800;
}
.svDark__head p {
color: var(--color-neutral);
max-width: 60ch;
margin: 0.5rem auto 1.5rem;
}
.svDark__cta {
background: var(--color-accent);
color: var(--color-light);
font-weight: 700;
text-decoration: none;
padding: .7rem 1.6rem;
border-radius: 999px;
transition: var(--transition-medium);
}
.svDark__cta:hover { background: var(--color-soft); }

/* ================= GRID (always 3 per row) ================= */
.svDark__grid {
display: grid;
grid-template-columns: repeat(3, 1fr);
gap: 1.4rem;
justify-items: center;
}
@media (max-width: 980px) {
.svDark__grid { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 640px) {
.svDark__grid { grid-template-columns: 1fr; }
}

/* ================= CARD (ANIMACIÓN MEJORADA) ================= */
.svDark__card {
width: 100%;
background: var(--color-light);
border-radius: var(--radius-lg);
padding: 1.8rem;
box-shadow: 0 10px 25px var(--color-dark-alpha-08);
transition:
transform 1.2s cubic-bezier(0.19,1,0.22,1), /* Duración aumentada */
box-shadow 0.9s cubic-bezier(0.19,1,0.22,1),
background 0.6s ease;
cursor: pointer;
transform-style: preserve-3d;
perspective: 1000px;
}
.svDark__card.dark {
background: var(--color-primary);
color: var(--color-light);
box-shadow: 0 10px 35px var(--color-dark-alpha-35);
}
.svDark__card.dark h3,
.svDark__card.dark p {
color: var(--color-light-alpha-92);
}
.svDark__card.dark .svDark__icon i {
color: var(--color-soft);
}
.svDark__card:hover {
/* Inclinación a la izquierda y elevación más pronunciada */
transform: rotateY(-18deg) rotateX(8deg) translateY(-10px);
box-shadow:
0 35px 70px var(--color-dark-alpha-35), /* Sombra más profunda */
0 0 40px var(--color-warm-glow-alpha-45); /* Brillo aumentado */
}

/* ICON + TEXT */
.svDark__icon {
font-size: 1.9rem;
margin-bottom: .6rem;
color: var(--color-soft);
}
.svDark__card h3 {
font-family: var(--font-heading);
font-size: 1.15rem;
font-weight: 700;
margin: .4rem 0;
}
.svDark__card p {
color: var(--color-neutral);
font-size: .95rem;
line-height: 1.55;
margin-bottom: 1.2rem;
}
.svDark__link {
display: inline-flex;
align-items: center;
gap: .35rem;
font-weight: 700;
text-decoration: none;
color: var(--color-accent);
transition: color .3s ease;
}
.svDark__card.dark .svDark__link {
color: var(--color-success-bright);
}
.svDark__link:hover { color: var(--color-soft); }

/* Reveal animation */
#services-tilt-dark .reveal {
opacity: 0;
transform: translateY(20px);
}
#services-tilt-dark .reveal.active {
opacity: 1;
transform: translateY(0);
transition: .6s var(--transition-smooth);
}

@media (max-width:600px){
.svDark__card{text-align:center}
}
</style>

<script>
(function(){
/* ----- Tilt interaction (Efecto mousemove) ----- */
const cards = document.querySelectorAll('#services-tilt-dark .svDark__card');
cards.forEach(card=>{
card.addEventListener('mousemove',e=>{
const rect = card.getBoundingClientRect();
const x = e.clientX - rect.left;
const y = e.clientY - rect.top;

// Se mantiene la inclinación más notoria a la izquierda (-20)
const rotateY = ((x / rect.width) - 0.5) * -20; 
const rotateX = ((y / rect.height) - 0.5) * 10;

card.style.transform = `rotateY(${rotateY}deg) rotateX(${rotateX}deg) translateY(-8px)`;
});
card.addEventListener('mouseleave',()=>{
// Restablece al estado inicial, permitiendo que el CSS :hover tome control.
// NOTA: Al hacer 'mouseleave', el CSS :hover se aplicará si el mouse está fuera de la tarjeta pero dentro de la sección si aplica, o volverá a la posición 0.
card.style.transform = 'rotateY(0deg) rotateX(0deg)';
});
});

/* ----- Reveal on scroll ----- */
const items = document.querySelectorAll('#services-tilt-dark .reveal');
const io = new IntersectionObserver(entries=>{
entries.forEach(e=>{
if(e.isIntersecting){
e.target.classList.add('active');
io.unobserve(e.target);
}
});
},{threshold:.15});
items.forEach(el=>io.observe(el));
})();
</script>