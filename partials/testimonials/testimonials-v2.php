<?php
@session_start();
if (!isset($SN)) include_once __DIR__ . '/text.php';

/* Más testimonios de prueba para llenar los carruseles (6 en total) */
if (!isset($Testimonials) || !is_array($Testimonials)) {
 $Testimonials = [
  ["name"=>"Alejandro Pérez","role"=>"Marketing Manager – Nexa Studio","text"=>"Doble el ROI de mis campañas en 3 meses. Estrategia y ejecución impecable."],
  ["name"=>"Sophia Chen","role"=>"CTO – Axiom Labs","text"=>"Transición a un sitio web de alta velocidad sin perder mi posicionamiento. Altamente recomendados."],
  ["name"=>"Laura Gómez","role"=>"CEO – Luma Digital","text"=>"Un equipo profesional que entiende rendimiento y diseño. Mi web ahora posiciona."],
    ["name"=>"Marcos Ibarra","role"=>"Fundador – TechRise","text"=>"Servicio al cliente excepcional. Resolvieron un problema crítico de performance en horas."],
    ["name"=>"Elena Vidal","role"=>"Directora – Eterna Joyas","text"=>"Mi tienda online ha mejorado su tasa de conversión un 20% gracias a sus optimizaciones."],
    ["name"=>"David Soto","role"=>"Freelancer Senior","text"=>"Me ayudaron a migrar de servidor sin tiempo de inactividad. Profesionales y efectivos."],
 ];
}

/* Limpieza rápida de campos */
$T = array_map(function($t){
 return [
  'name' => htmlspecialchars($t['name'] ?? 'Cliente'),
  'role' => htmlspecialchars($t['role'] ?? 'Verified client'), // Fallback => corrige el warning
  'text' => htmlspecialchars($t['text'] ?? '')
 ];
}, $Testimonials);

// Usamos todos los testimonios en ambos tracks
$T_all = $T;

/* * CORRECCIÓN: Para asegurar que el loop es fluido y el track es más largo,
 * repetimos el array en PHP (en lugar de confiar solo en el JS o duplicar a mano).
 * Esto asegura que el contenido siempre esté listo y sea extenso.
 */
$T_full_track = array_merge($T_all, $T_all, $T_all); // Repetir 3 veces para mayor longitud inicial
?>

<section id="tmv2" class="tmv2-section" aria-labelledby="tmv2-title">
 <div class="tmv2-header">
  <div class="tmv2-badge"><i class="fa-solid fa-star"></i> Rated 4.9/5 by over 1K clients</div>
  <h2 id="tmv2-title">Words of praise from others about our presence.</h2>
 </div>

 <div class="tmv2-wrapper">
    <div class="tmv2-marquee tmv2-left">
   <div class="tmv2-track">
    <?php 
        /* * Ahora iteramos sobre $T_full_track que contiene 3 copias del array.
         * Luego el JS lo duplicará, haciendo que el track final sea de 6 copias de los testimonios originales.
         */
        foreach ($T_full_track as $t): ?>
    <article class="tmv2-card">
     <i class="fa-solid fa-quote-left tmv2-quote"></i>
     <p class="tmv2-text">“<?= $t['text'] ?>”</p>
     <div class="tmv2-meta">
      <div class="tmv2-avatar"><i class="fa-solid fa-user"></i></div>
      <div class="tmv2-meta-texts">
       <h3 class="tmv2-name"><?= $t['name'] ?></h3>
       <p class="tmv2-role"><?= $t['role'] ?></p>
      </div>
     </div>
    </article>
    <?php endforeach; ?>
   </div>
  </div>

    <div class="tmv2-marquee tmv2-right">
   <div class="tmv2-track">
    <?php foreach ($T_full_track as $t): ?>
    <article class="tmv2-card">
     <i class="fa-solid fa-quote-left tmv2-quote"></i>
     <p class="tmv2-text">“<?= $t['text'] ?>”</p>
     <div class="tmv2-meta">
      <div class="tmv2-avatar"><i class="fa-solid fa-user"></i></div>
      <div class="tmv2-meta-texts">
       <h3 class="tmv2-name"><?= $t['name'] ?></h3>
       <p class="tmv2-role"><?= $t['role'] ?></p>
      </div>
     </div>
    </article>
    <?php endforeach; ?>
   </div>
  </div>
 </div>
</section>

<style>
/* ====== TESTIMONIALS V2 (aislado con prefijo tmv2-) ====== */
#tmv2{
 --tmv2-bg: var(--color-ivory);     /* usa tu root light */
 --tmv2-dark: var(--color-dark);
--tmv2-accent: var(--color-warm-base);
 --tmv2-neutral:var(--color-neutral-deep);
 --tmv2-radius: 1rem;
--tmv2-shadow: 0 8px 24px var(--color-dark-alpha-10);

 background: var(--tmv2-bg);
 padding: clamp(3rem,5vw,5rem) 0;
 text-align:center;
 overflow:hidden;
 border-radius: 1.25rem;
}

.tmv2-header{ margin-bottom:2rem; }
.tmv2-badge{
 display:inline-flex; gap:.45rem; align-items:center;
 background:var(--color-dark); color:var(--color-light); padding:.4rem 1rem;
 border-radius:999px; font-weight:700; font-size:.9rem;
 box-shadow:0 2px 8px var(--color-dark-alpha-18);
}
.tmv2-badge i{ color:var(--color-amber-bright); }
#tmv2 h2{
 margin:1rem auto 0; color:var(--tmv2-dark);
 font-family: var(--font-heading, Montserrat);
 font-size: clamp(1.8rem,3vw,2.4rem);
 max-width: 52ch;
}

.tmv2-wrapper{ display:flex; flex-direction:column; gap:1.4rem; }

.tmv2-marquee{ overflow:hidden; }
.tmv2-track{
 display:flex; gap:1rem;
 will-change: transform;
}

/* * Aumento la duración para asegurar la fluidez con el contenido extendido.
 * Izquierda: de 0 a -50% (bucle)
 */
.tmv2-left .tmv2-track{ animation: tmv2-left 40s linear infinite; } 
/* * Derecha: de -50% a 0 (bucle opuesto)
 * Se agrega el transform inicial para que inicie "fuera" por la mitad del track duplicado.
 */
.tmv2-right .tmv2-track{ 
    animation: tmv2-right 30s linear infinite;
    transform: translateX(-50%); 
}

.tmv2-card{
 flex:0 0 360px;
 background:var(--color-light); border-radius: var(--tmv2-radius);
 box-shadow: var(--tmv2-shadow);
 padding:1.6rem 1.4rem;
 text-align:left;
 transition: transform .35s ease, box-shadow .35s ease;
}
.tmv2-card:hover{ transform: translateY(-6px); box-shadow:0 12px 30px var(--color-dark-alpha-15); }

.tmv2-quote{ color:var(--tmv2-accent); font-size:1.2rem; margin-bottom:.5rem; display:block; }
.tmv2-text{ color:var(--tmv2-dark); line-height:1.55; margin:0 0 1rem; }

.tmv2-meta{ display:flex; align-items:center; gap:.8rem; }
.tmv2-avatar{
 width:44px; height:44px; border-radius:50%;
 display:flex; align-items:center; justify-content:center;
 background: var(--tmv2-accent); color:var(--color-light); font-size:1.1rem;
}
.tmv2-name{ margin:0; font-size:1rem; color:var(--tmv2-dark); }
.tmv2-role{ margin:0; font-size:.85rem; color:var(--tmv2-neutral); }

/* Loop infinito: deben ir del 0 al -50% del *contenido total* (el doble del que renderiza) */
@keyframes tmv2-left { from{transform:translateX(0)} to{transform:translateX(-50%)} }
@keyframes tmv2-right { from{transform:translateX(-50%)} to{transform:translateX(0)} }

@media (max-width:768px){
 .tmv2-card{ flex:0 0 290px; }
}
</style>

<script>
/* * Duplicar contenido para loop continuo:
 * Duplica el contenido que ya fue triplicado en PHP, resultando en 6 copias de los testimonios originales.
 * Esto asegura que el -50% del track (donde reinicia el keyframe) esté lejos de la vista.
 */
document.querySelectorAll('#tmv2 .tmv2-track').forEach(track=>{
 track.innerHTML += track.innerHTML;
});
</script>