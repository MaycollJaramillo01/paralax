<?php
@session_start();
if (!isset($AboutUs)) include_once __DIR__ . '/../../text.php';

$title   = $AboutUs['title']  ?? 'Who We Are';
$short   = $AboutUs['short']  ?? 'Short description here.';
$detail  = $AboutUs['detail'] ?? 'Detailed description here.';
$baseURL = $BaseURL ?? '';

$chips = array_filter([
  'Experience' => $Experience ?? null,
  'Estimates'  => $Estimates ?? null,
  'Schedule'   => $Schedule ?? null,
  'License'    => $Lic ?? null,
  'Bilingual'  => $Bilingual ?? null,
]);
?>

<section class="about-v2" id="about">
  <div class="container">
    <div class="about-v2__wrapper">

      <!-- Texto -->
      <div class="about-v2__content" data-animate="slide-right">
        <h2><?= htmlspecialchars($title) ?></h2>
        <p class="short"><?= htmlspecialchars($short) ?></p>
        <p class="detail"><?= htmlspecialchars($detail) ?></p>

        <?php if (!empty($chips)): ?>
        <div class="about-v2__chips">
          <?php foreach ($chips as $key => $value): ?>
            <div class="chip">
              <span class="chip__icon"><i class="fa-solid fa-circle-info"></i></span>
              <span class="chip__text"><?= htmlspecialchars($value) ?></span>
            </div>
          <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <div class="cta">
          <a href="<?= htmlspecialchars($baseURL . '/services.php') ?>" class="btn btn-primary">Explore Services</a>
          <a href="<?= htmlspecialchars($baseURL . '/contact.php') ?>" class="btn btn-outline">Contact Us</a>
        </div>
      </div>

      <!-- Imagen -->
      <div class="about-v2__image" data-animate="fade-in">
        <img src="assets/images/about/about-main.jpg"
             alt="About <?= htmlspecialchars($Company) ?>" loading="lazy">
      </div>

    </div>
  </div>
</section>

<style>
/* ============================================================
   ABOUT V2 — Modern Chips Layout
   ============================================================ */

.about-v2 {
  position: relative;
  background: var(--color-soft-white);
  padding: 8rem 0;
  color: var(--color-dark, var(--color-primary));
}

.about-v2__wrapper {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(360px, 1fr));
  align-items: center;
  gap: 4rem;
}

/* === Texto === */
.about-v2__content h2 {
  font-family: var(--font-heading, 'Poppins', sans-serif);
  font-size: clamp(2.3rem, 4vw, 3.2rem);
  font-weight: 700;
  margin-bottom: 1.2rem;
}

.about-v2__content .short {
  font-size: 1.2rem;
  color: var(--color-secondary, var(--color-neutral-deep));
  margin-bottom: 1.4rem;
}

.about-v2__content .detail {
  color: var(--color-dark-alpha-78);
  font-size: 1.05rem;
  line-height: 1.75;
  margin-bottom: 2.2rem;
}

/* === Chips === */
.about-v2__chips {
  display: flex;
  flex-wrap: wrap;
  gap: 0.75rem;
  margin-bottom: 2.5rem;
}

.chip {
  display: inline-flex;
  align-items: center;
  gap: 0.5rem;
  background: var(--color-porcelain);
  border-radius: 50px;
  padding: 0.6rem 1.1rem;
  font-size: 0.95rem;
  font-weight: 500;
  color: var(--color-dark, var(--color-primary));
  box-shadow: 0 2px 8px var(--color-dark-alpha-05);
  transition: all 0.3s ease;
}
.chip:hover {
  background: var(--color-success);
  color: var(--color-light);
  transform: translateY(-2px);
}
.chip__icon {
  font-size: 1rem;
}

/* === Imagen === */
.about-v2__image {
  position: relative;
  border-radius: var(--radius-lg, 16px);
  overflow: hidden;
  box-shadow: 0 15px 40px var(--color-dark-alpha-10);
}
.about-v2__image img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transform: scale(1.05);
  transition: transform 1.2s cubic-bezier(.19,1,.22,1);
}
.about-v2__image:hover img {
  transform: scale(1.1);
}

/* === CTA === */
.cta {
  display: flex;
  flex-wrap: wrap;
  gap: 1rem;
}

.btn {
  padding: 1rem 2rem;
  border-radius: 50px;
  font-weight: 600;
  font-size: 1rem;
  text-decoration: none;
  transition: all 0.3s ease;
}

.btn-primary {
  background: var(--color-success);
  color: var(--color-light);
  box-shadow: 0 8px 20px var(--color-success-alpha-30);
}
.btn-primary:hover {
  background: var(--color-success-dark);
  transform: translateY(-3px);
}

/* === Responsive === */
@media (max-width: 992px) {
  .about-v2 {
    padding: 5rem 0;
  }
  .about-v2__wrapper {
    gap: 3rem;
  }
  .about-v2__image {
    order: -1; /* Imagen arriba en móviles */
  }
}
@media (max-width: 576px) {
  .btn {
    width: 100%;
    text-align: center;
  }
}

/* === Animaciones === */
[data-animate] {
  opacity: 0;
  transform: translateY(40px);
  transition: opacity 0.9s ease, transform 0.9s ease;
}
.is-visible[data-animate] {
  opacity: 1;
  transform: translateY(0);
}
</style>
