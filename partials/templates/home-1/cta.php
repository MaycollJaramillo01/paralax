<?php
// ...
// Estas líneas definen las variables:
$cta_headline = $HomeIntro['headline']; // Línea que falla si no está presente
$cta_sub = $HomeIntro['sub'];
$cta_primary_text = $HomeIntro['primaryCTA']; 
// ...
?>

<style>
    /* Sección de estilos para el componente. 
    Se recomienda mover estos estilos a un archivo CSS general para un mejor rendimiento.
    Asume que las variables de root.css están cargadas.
    */
    .cta-glass-section {
        /* Fondo oscuro necesario para que el glassmorphism resalte */
        background-color: var(--color-primary); 
        padding: 60px 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        overflow: hidden; /* Importante para el efecto de fondo */
    }

    /* Elementos de fondo para el efecto de desenfoque */
    .cta-glass-section::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 5%;
        width: 40vw; 
        height: 40vw; 
        max-width: 400px;
        max-height: 400px;
        background: var(--color-soft, var(--color-soft)); /* Azul Celeste */
        border-radius: 50%;
        filter: blur(180px);
        opacity: 0.2;
        transform: translate(-50%, -50%);
    }

    .cta-glass-card {
        max-width: 900px;
        width: 100%;
        padding: 50px;
        text-align: center;
        border-radius: var(--radius-lg, 1rem);
        z-index: var(--z-content, 10);
        
        /* GLASSMORHPISM */
        background: rgba(var(--color-secondary-rgb), 0.4); /* --color-secondary con transparencia */
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border: 1px solid var(--color-light-alpha-15);
        box-shadow: 0 10px 40px var(--color-dark-alpha-50);
        transition: var(--transition-medium, all 0.5s ease-in-out);
    }

    .cta-glass-card:hover {
        transform: scale(1.01);
        box-shadow: 0 15px 50px var(--color-accent-alpha-15); /* Sombra con acento */
    }

    .cta-glass-card h2 {
        font-family: var(--font-heading, 'Montserrat');
        color: var(--color-silver-soft); 
        font-size: 2.8rem;
        margin-bottom: 0.8rem;
        line-height: 1.2;
    }
    
    .cta-glass-card p {
        font-family: var(--font-body, 'Open Sans');
        color: var(--color-silver-soft);
        font-size: 1.15rem;
        margin-bottom: 2.5rem;
        opacity: 0.8;
    }

    .cta-button {
        display: inline-block;
        padding: 16px 40px;
        border-radius: var(--radius-md, 0.5rem);
        font-family: var(--font-heading, 'Montserrat');
        font-weight: 700;
        text-transform: uppercase;
        text-decoration: none;
        transition: var(--transition-fast, all 0.25s ease-in-out);
        
        /* Colores */
        background: var(--color-accent, var(--color-accent)); 
        color: var(--color-primary); 
        border: none;
        letter-spacing: 1px;
        box-shadow: 0 4px 15px var(--color-accent-alpha-40);
    }

    .cta-button:hover {
        background: var(--color-soft, var(--color-soft)); 
        transform: translateY(-3px);
        box-shadow: 0 8px 25px var(--color-soft-alpha-60); 
    }

    @media (max-width: 900px) {
        .cta-glass-card h2 { font-size: 2rem; }
        .cta-glass-card p { font-size: 1rem; }
        .cta-glass-card { padding: 30px 20px; }
        .cta-button { padding: 14px 30px; }
    }
</style>

<section class="cta-glass-section">
    <div class="cta-glass-card" data-animate="slide-up">
        
        <h2><?php echo $cta_headline; ?></h2>
        
        <p><?php echo $cta_sub; ?></p>
        
        <a href="<?php echo $cta_link; ?>" class="cta-button">
            <?php echo $cta_primary_text; ?>
        </a>
    </div>
</section>