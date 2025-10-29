
<section class="hero-card parallax-section" aria-label="<?php echo htmlspecialchars($HomeIntro['headline']); ?>">
  <!-- Parallax background: usa la primera imagen del array $HeroImages -->
  <div class="hero-card-bg parallax-bg"
       style="background-image: url('<?php echo htmlspecialchars($BaseURL . '/' . ltrim($HeroImages[0], '/')); ?>');"
       aria-hidden="true"></div>

  <!-- Overlay oscuro + gradiente lateral para el "bloom" -->
  <div class="hero-card-overlay" aria-hidden="true"></div>

  <div class="container parallax-content">
    <div class="hero-card-inner" data-animate="zoom-in">
      <div class="hero-eyebrow text-accent"><?php echo htmlspecialchars($Phrase[0] ?? ''); ?></div>

      <h1 class="hero-title"><?php echo htmlspecialchars($HomeIntro['headline']); ?></h1>
      <p class="hero-lead"><?php echo htmlspecialchars($HomeIntro['sub']); ?></p>

      <div class="hero-ctas">
        <a class="btn btn-primary" href="/contact.php" rel="noopener">
          <?php echo htmlspecialchars($HomeIntro['primaryCTA']); ?>
        </a>
        <a class="btn btn-outline" href="<?php echo htmlspecialchars($InternalLinks[0]['href'] ?? '/casestudies.php'); ?>" rel="noopener">
          <?php echo htmlspecialchars($HomeIntro['secondaryCTA']); ?>
        </a>
      </div>
    </div>
  </div>

  <!-- Pulso lateral (animado) -->
  <div class="hero-pulse" aria-hidden="true"></div>
</section>
<style>
  /* HERO CARD - agregar al final de root.css */
/* Usa variables definidas en :root */

.hero-card {
 max-width: 92%;
 margin: 3.5rem auto;
 border-radius: var(--radius-lg);
 overflow: hidden;
 position: relative;
 min-height: clamp(320px, 35vh, 420px);
 box-shadow: var(--shadow-hard);
 background-color: var(--color-primary); /* fallback */
 color: var(--color-light);
}

/* Background image (parallax layer) */
.hero-card .hero-card-bg {
 position: absolute;
 inset: 0;
 background-size: cover;
 background-position: center right;
 transform: translateZ(-1px) scale(1.12);
 z-index: var(--z-bg);
 filter: brightness(0.8) contrast(1.05);
 transition: transform 0.6s var(--transition-smooth);
 will-change: transform;
}

/* Overlay to darken and to create the right-side bloom */
.hero-card .hero-card-overlay {
 position: absolute;
 inset: 0;
 z-index: calc(var(--z-bg) + 1);
 /* MODIFICACIÓN CLAVE: Ajuste para más visibilidad del 'bloom' y el contenido */
 background: linear-gradient(90deg, 
        rgba(10,12,15,0.75) 0%, /* Más oscuro a la izquierda */
        rgba(10,12,15,0.40) 50%, /* Menos oscuro en el centro */
        rgba(255,255,255,0.05) 100%); /* Casi transparente/ligeramente blanco a la derecha */
 mix-blend-mode: normal;
 pointer-events: none;
 opacity: 1;
}

/* Content */
.hero-card .hero-card-inner {
 position: relative;
 z-index: var(--z-content);
 display: flex;
 flex-direction: column;
 align-items: center;
 text-align: center;
 padding: clamp(2rem, 6vw, 4.5rem);
 gap: 1rem;
 max-width: 900px;
 margin: 0 auto;
}

/* Eyebrow / small label */
.hero-eyebrow {
 font-size: 0.78rem;
 letter-spacing: .18em;
 text-transform: uppercase;
 opacity: 0.9;
 margin-bottom: 0.25rem;
 /* Usar --color-accent (Cian Vibrante) */
 color: var(--color-accent);
}

/* Title & lead */
.hero-title {
 font-family: var(--font-heading);
 font-size: clamp(1.6rem, 4vw, 2.6rem);
 line-height: 1.02;
 margin: 0;
 color: var(--color-light);
 text-shadow: 0 6px 20px rgba(0,0,0,0.45);
 font-weight: 700;
}

.hero-lead {
 max-width: 820px;
 margin: 0.5rem 0 1.25rem;
 color: rgba(235,235,235,0.92);
 font-size: clamp(0.95rem, 1.6vw, 1.05rem);
}

/* CTA buttons (usando variables) */
.btn {
 display: inline-flex;
 align-items: center;
 justify-content: center;
 gap: .6rem;
 padding: .7rem 1.1rem;
 border-radius: 999px;
 font-weight: 600;
 text-decoration: none;
 transition: var(--transition-fast);
 box-shadow: var(--shadow-soft);
 border: none;
 cursor: pointer;
}
.btn-primary {
 /* MODIFICACIÓN: Usar --color-accent para el fondo y --color-dark para el texto */
 background: var(--color-accent);
 color: var(--color-dark); 
}
.btn-primary:hover { 
 /* Usar sombra con acento y elevación */
 transform: translateY(-3px); 
 box-shadow: var(--shadow-soft), 0 10px 30px rgba(0,0,0,0.2); 
}

/* CTA container spacing */
.hero-ctas {
 display: flex;
 gap: 0.9rem;
 justify-content: center;
 flex-wrap: wrap;
 margin-top: .4rem;
}

/* Pulso lateral (origina desde la derecha, colores desde root) */
.hero-pulse {
 position: absolute;
 right: -8%;
 top: 10%;
 width: 36%;
 height: 80%;
 border-radius: 50%;
 z-index: calc(var(--z-content) - 1);
 pointer-events: none;
 /* MODIFICACIÓN: El pulso usa --color-soft para el 'bloom' */
 background: radial-gradient(circle at 30% 30%, 
        var(--color-soft) 0%, 
        rgba(51, 224, 255, 0.85) 6%, 
        rgba(51, 224, 255, 0.18) 20%, 
        rgba(0,188,212,0.06) 45%, 
        transparent 65%);
 filter: blur(32px) saturate(1.1);
 opacity: 0.95;
 transform: translateX(0) scale(1);
 animation: heroPulse 3.8s ease-in-out infinite;
 mix-blend-mode: screen;
}

/* Slight smaller pulse overlay for depth */
.hero-pulse::after {
 content: "";
 position: absolute;
 inset: 18% 10% auto auto;
 width: 55%;
 height: 55%;
 border-radius: 50%;
 /* MODIFICACIÓN: Usar --color-accent en el pulso interno */
 background: radial-gradient(circle, rgba(0,188,212,0.22), transparent 60%);
 filter: blur(18px);
 opacity: .9;
 animation: heroPulseSlow 5.6s ease-in-out infinite;
}

/* Animations */
@keyframes heroPulse {
 0%  { transform: translateX(0) scale(0.96); opacity: .9; }
 50% { transform: translateX(-6%) scale(1.03); opacity: 1; }
 100% { transform: translateX(0) scale(0.96); opacity: .9; }
}
@keyframes heroPulseSlow {
 0%  { transform: scale(0.95); opacity: .85; }
 50% { transform: scale(1.06); opacity: 1; }
 100% { transform: scale(0.95); opacity: .85; }
}

/* Responsive tweaks */
@media (max-width: 900px) {
 .hero-card { margin: 2rem 1rem; min-height: 300px; }
 .hero-card .hero-card-bg { background-position: center; transform: translateZ(-1px) scale(1.22); }
 .hero-pulse { display: none; } /* evitar recorte en pantallas pequeñas */
}
</style>