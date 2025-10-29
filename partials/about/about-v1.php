<?php
@session_start();
if (!isset($AboutUs)) include_once __DIR__ . '/../../text.php';

$title   = $AboutUs['title']  ?? 'Who We Are';
$short   = $AboutUs['short']  ?? 'Short description here.';
$detail  = $AboutUs['detail'] ?? 'Detailed description here.';
$whyUs   = $AboutUs['whyUs']  ?? [];
$baseURL = $BaseURL ?? '';
?>

<section class="about-v1" id="about">
  <div class="container">
    <div class="about-v1__wrapper">

      <!-- Imagen -->
      <div class="about-v1__image" data-animate="fade-in">
        <img src="assets/images/about/about-main.jpg"
             alt="About <?= htmlspecialchars($Company) ?>" loading="lazy">
      </div>

      <!-- Texto -->
      <div class="about-v1__content" data-animate="slide-up">
        <h2><?= htmlspecialchars($title) ?></h2>
        <p class="short"><?= htmlspecialchars($short) ?></p>
        <p class="detail"><?= htmlspecialchars($detail) ?></p>

        <?php if (!empty($whyUs)): ?>
        <ul class="reasons">
          <?php foreach ($whyUs as $item): ?>
            <li><i class="fa-solid fa-check"></i> <?= htmlspecialchars($item) ?></li>
          <?php endforeach; ?>
        </ul>
        <?php endif; ?>

        <div class="cta">
          <a href="<?= htmlspecialchars($baseURL . '/services.php') ?>" class="btn btn-primary">Explore Services</a>
          <a href="<?= htmlspecialchars($baseURL . '/contact.php') ?>" class="btn btn-outline">Contact Us</a>
        </div>
      </div>

    </div>
  </div>
</section>

<style>
/* ============================================================
   ABOUT V1 — Refined & Clean Layout
   ============================================================ */

.about-v1 {
  position: relative;
  background: linear-gradient(180deg, var(--color-light) 0%, var(--color-frost) 100%);
  padding: 7rem 0;
  overflow: hidden;
}

.about-v1__wrapper {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
  align-items: center;
  gap: 4rem;
}

/* === Imagen === */
.about-v1__image {
  position: relative;
  border-radius: var(--radius-lg, 16px);
  overflow: hidden;
  box-shadow: 0 15px 40px var(--color-dark-alpha-15);
  transition: transform 0.6s ease;
}
.about-v1__image img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  display: block;
  transform: scale(1.05);
  transition: transform 1.2s cubic-bezier(.19,1,.22,1);
}
.about-v1__image:hover img {
  transform: scale(1.1);
}

/* === Contenido === */
.about-v1__content {
  color: var(--color-dark);
  padding-right: 1rem;
}

.about-v1__content h2 {
  font-family: var(--font-heading, 'Poppins', sans-serif);
  font-size: clamp(2.2rem, 4vw, 3rem);
  font-weight: 700;
  margin-bottom: 1.2rem;
  color: var(--color-dark);
}

.about-v1__content .short {
  font-size: 1.15rem;
  font-weight: 500;
  color: var(--color-secondary, var(--color-neutral-deep));
  margin-bottom: 1.2rem;
}

.about-v1__content .detail {
  font-size: 1.05rem;
  line-height: 1.8;
  color: var(--color-dark-alpha-75);
  margin-bottom: 2rem;
}

/* === Lista === */
.reasons {
  list-style: none;
  margin: 0 0 2rem 0;
  padding: 0;
}
.reasons li {
  font-size: 1rem;
  display: flex;
  align-items: center;
  gap: 0.6rem;
  color: var(--color-dark);
  padding: 0.3rem 0;
  transition: transform 0.3s ease;
}
.reasons li i {
  color: var(--color-success);
}
.reasons li:hover {
  transform: translateX(4px);
}

/* === Botones === */
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
  color: var(--color-dark);
  box-shadow: 0 8px 20px var(--color-success-alpha-30);
}
.btn-primary:hover {
  background: var(--color-success-dark);
  color: var(--color-dark);
  transform: translateY(-3px);
}


/* === Responsive === */
@media (max-width: 992px) {
  .about-v1 {
    padding: 5rem 0;
  }
  .about-v1__wrapper {
    gap: 3rem;
  }
}
@media (max-width: 576px) {
  .about-v1__content h2 {
    font-size: 2rem;
  }
  .btn {
    width: 100%;
    text-align: center;
  }
}

/* === Animaciones (scroll-anim.js friendly) === */
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
