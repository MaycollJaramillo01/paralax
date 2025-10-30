<?php
/**
 * aboutv3.php
 * Sección About Us (Quiénes Somos)
 * Estructura de componentes reutilizables con animación ParallaxKit (data-animate).
 */

@session_start();
// Asegurar que el archivo de datos sea incluido si no está cargado.
// Se asume que este archivo está ubicado en la raíz o en una estructura que permite '../text.php'
// Ajusto la ruta a una versión más segura para incluir desde cualquier subdirectorio si text.php está en la raíz.
if (!isset($AboutUs)) {
    // Intentar incluir desde la raíz o un nivel superior, dependiendo de la estructura final del proyecto.
    // Usaremos la convención sugerida en el código de entrada:
    if (file_exists(__DIR__ . '/../../text.php')) {
        include_once __DIR__ . '/../../text.php';
    } else {
        // Fallback si la estructura de directorios no es la esperada.
        // Asumiendo que 'text.php' está en el mismo nivel si el script se ejecuta desde la raíz/aboutv3.php
        include_once 'text.php'; 
    }
}

// Extraer variables necesarias del archivo de datos con fallbacks seguros
$Company = $Company ?? 'The Agency';
$AboutUs = $AboutUs ?? [
    'title' => 'Quiénes Somos',
    'short' => 'Somos una agencia creativa especializada en alto rendimiento web.',
    'detail' => 'Nos enfocamos en la ingeniería de sitios web, asegurando que cada proyecto cumpla con los más altos estándares de Core Web Vitals, accesibilidad y arquitectura SEO desde el diseño inicial.'
];
$Mission = $Mission ?? 'Impulsar el éxito digital de nuestros clientes a través de experiencias web excepcionales.';
$Vision  = $Vision ?? 'Ser la agencia líder en la creación de sitios parallax que combinan estética y rendimiento técnico.';

$title   = $AboutUs['title']  ?? 'Quiénes Somos';
$short   = $AboutUs['short']  ?? 'Descripción corta de la agencia.';
$detail  = $AboutUs['detail'] ?? 'Detalle del enfoque, procesos y filosofía.';
$baseURL = $BaseURL ?? '';

// Array de "chips" con información clave de contacto/servicios
$chips = array_filter([
    'Experience' => $Experience ?? null,
    'Estimates'  => $Estimates ?? null,
    'Schedule'   => $Schedule ?? null,
    'License'    => $Lic ?? null,
    'Bilingual'  => $Bilingual ?? null,
]);
?>

<section class="section about-v3" id="about">
    <div class="container grid-layout">
        
        <div class="content-block" data-animate="slide-right">
            <h2 class="title" data-split="words" data-stagger="25"><?= htmlspecialchars($title) ?></h2>
            <br>
            <p class="subtitle"><?= htmlspecialchars($short) ?></p>
            <p class="detail"><?= htmlspecialchars($detail) ?></p>

            <?php if (!empty($chips)): ?>
            <div class="info-chips" data-animate="slide-right" data-delay="300">
                <?php foreach ($chips as $key => $value): ?>
                    <div class="chip">
                        <span class="chip__icon"><i class="fa-solid fa-check-circle"></i></span>
                        <span class="chip__text"><?= htmlspecialchars($value) ?></span>
                    </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>

            <div class="cta-buttons" data-animate="slide-up" data-delay="500">
                <a href="<?= htmlspecialchars($baseURL . '/services.php') ?>" class="btn btn-primary">Ver Servicios</a>
                <a href="<?= htmlspecialchars($baseURL . '/contact.php') ?>" class="btn btn-outline">Consultar Proyecto</a>
            </div>
        </div>

        <div class="features-block">
            
            <div class="feature-card counter-card" data-animate="zoom-in" data-delay="600">
                <h3 class="counter-val" 
                    data-counter data-from="0" data-to="<?= (int)preg_replace('/[^0-9]/', '', $Experience) ?: 10 ?>" 
                    data-duration="2000" data-decimals="0" data-ease="outExpo">0</h3>
                <p class="counter-label"><?= htmlspecialchars($Experience) ?></p>
                <p class="counter-desc">Especialistas en Sitios Parallax</p>
            </div>

            <div class="feature-card mission-card" data-animate="slide-up" data-delay="700">
                <h4 class="card-title">Nuestra Misión</h4>
                <p class="card-detail"><?= htmlspecialchars($Mission) ?></p>
            </div>

            <div class="feature-card vision-card" data-animate="slide-up" data-delay="850">
                <h4 class="card-title">Nuestra Visión</h4>
                <p class="card-detail"><?= htmlspecialchars($Vision) ?></p>
            </div>

        </div>
    </div>
</section>

<section class="section parallax-separator">
    <div class="container">
        <div class="parallax-line" 
             data-scrub="scaleX:0,1; opacity:0,1" 
             data-ease="inOutCubic" 
             data-start="0%" 
             data-end="100%"
             data-context=".parallax-separator">
        </div>
    </div>
</section>


<style>
/* ============================================================
    ABOUT V3 — Estructura en Grid con Misión/Visión/Contador
    ============================================================ */

.about-v3 {
    position: relative;
    padding: 6rem 0;
    background: var(--color-background, var(--color-soft-white));
    color: var(--color-dark, var(--color-primary));
}

.grid-layout {
    display: grid;
    grid-template-columns: 1fr 1fr; /* Dos columnas por defecto */
    gap: 4rem;
    align-items: center;
    max-width: 1300px;
    margin: 0 auto;
    padding: 0 1.5rem;
}

/* === Bloque de Contenido (Izquierda) === */
.content-block {
    padding-right: 2rem; /* Espacio visual */
}

.content-block .title {
    font-family: var(--font-heading, 'Poppins', sans-serif);
    font-size: clamp(2.5rem, 4.5vw, 3.8rem);
    font-weight: 800;
    margin-bottom: 1rem;
    line-height: 1.1;
    color: var(--color-brand-blue);
}

.content-block .subtitle {
    font-size: clamp(1.1rem, 2vw, 1.4rem);
    color: var(--color-secondary, var(--color-neutral-deep));
    margin-bottom: 1.8rem;
    font-weight: 500;
}

.content-block .detail {
    color: var(--color-dark-alpha-75);
    font-size: 1.05rem;
    line-height: 1.7;
    margin-bottom: 2.5rem;
}

/* --- Chips --- */
.info-chips {
    display: flex;
    flex-wrap: wrap;
    gap: 1rem;
    margin-bottom: 3rem;
}

.chip {
    display: inline-flex;
    align-items: center;
    gap: 0.6rem;
    background: var(--color-light, var(--color-soft-white));
    border: 1px solid var(--color-border, var(--color-neutral));
    border-radius: 50px;
    padding: 0.8rem 1.4rem;
    font-size: 0.95rem;
    font-weight: 600;
    color: var(--color-dark, var(--color-primary));
    box-shadow: 0 4px 15px var(--color-dark-alpha-04);
    transition: all 0.3s ease;
}
.chip:hover {
    border-color: var(--color-success);
    background: var(--color-success-contrast);
    color: var(--color-light, #F8F9FA);
    box-shadow: 0 6px 18px rgba(var(--color-success-contrast-rgb), 0.45);
    transform: translateY(-2px);
}
.chip__icon {
    font-size: 1.1rem;
    color: var(--color-success);
    transition: color 0.3s ease;
}
.chip:hover .chip__icon {
    color: var(--color-light, #F8F9FA);
}

/* --- Botones --- */
.cta-buttons {
    display: flex;
    flex-wrap: wrap;
    gap: 1.5rem;
}
/* Estilos de botón generales (asumen que ya están definidos globalmente o se pueden añadir aquí) */
.btn {
    padding: 1.1rem 2.4rem;
    border-radius: 50px;
    font-weight: 600;
    font-size: 1rem;
    text-decoration: none;
    transition: all 0.3s ease;
    white-space: nowrap;
}
.btn-primary {
    background: var(--color-brand-blue);
    color: var(--color-dark);
    box-shadow: 0 10px 30px var(--color-brand-blue-alpha-30);
}
.btn-primary:hover {
    background: var(--color-brand-blue-bright);
    color: var(--color-dark);
    transform: translateY(-3px);
}


/* === Bloque de Características (Derecha) === */
.features-block {
    display: grid;
    grid-template-columns: 1fr;
    gap: 2rem;
}

.feature-card {
    background: var(--color-soft-white);
    padding: 2.5rem;
    border-radius: var(--radius-lg, 16px);
    box-shadow: 0 10px 30px var(--color-dark-alpha-08);
}

.card-title {
    font-size: 1.5rem;
    font-weight: 700;
    margin-bottom: 0.8rem;
    color: var(--color-brand-blue);
}
.mission-card .card-title { color: var(--color-success); }
.vision-card .card-title { color: var(--color-ember); }

.card-detail {
    font-size: 1rem;
    color: var(--color-dark-alpha-70);
    line-height: 1.6;
}

/* --- Contador --- */
.counter-card {
    text-align: center;
    background: linear-gradient(135deg, var(--color-brand-blue), var(--color-brand-blue-dark));
    color: white;
    box-shadow: 0 15px 40px var(--color-brand-blue-alpha-50);
}
.counter-val {
    font-size: 5rem;
    font-weight: 900;
    line-height: 1;
    margin-bottom: 0.5rem;
}
.counter-label {
    font-size: 1.25rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.1em;
}
.counter-desc {
    font-size: 0.9rem;
    margin-top: 0.5rem;
    opacity: 0.8;
}

/* === Separador de Scrub === */
.parallax-separator {
    padding: 3rem 0;
    background: transparent;
    overflow: hidden; /* Ocultar el desbordamiento de la línea */
}
.parallax-line {
    height: 4px;
    width: 100%;
    background: var(--color-success);
    margin: 0 auto;
    /* Estilos iniciales para la animación */
    transform-origin: center;
    transform: scaleX(0); /* Estado inicial: invisible */
    opacity: 0;
}


/* === Responsive === */
@media (max-width: 992px) {
    .grid-layout {
        grid-template-columns: 1fr; /* Una columna en tablet/móvil */
        gap: 3rem;
    }
    .content-block {
        padding-right: 0;
    }
    .about-v3 {
        padding: 4rem 0;
    }
}
@media (max-width: 576px) {
    .cta-buttons {
        flex-direction: column;
        gap: 1rem;
    }
    .btn {
        width: 100%;
        text-align: center;
    }
}


/* === ParallaxKit Animations (Base) === */
/* Asegurarse de que el JS maneje estas transformaciones */
.split-text-wrapper,
[data-animate] {
    opacity: 0;
    transition: opacity 0.8s var(--easing-out, cubic-bezier(0.22,1,0.36,1)), transform 0.8s var(--easing-out, cubic-bezier(0.22,1,0.36,1));
}
/* Fallback/Estado inicial para slide-right */
[data-animate="slide-right"] {
    transform: translateX(-40px);
}
/* Fallback/Estado inicial para slide-up */
[data-animate="slide-up"] {
    transform: translateY(40px);
}
/* Fallback/Estado inicial para zoom-in */
[data-animate="zoom-in"] {
    transform: scale(0.9);
}

/* El ParallaxKit.js se encargará de añadir el 'visible' o ejecutar las transiciones */
</style>