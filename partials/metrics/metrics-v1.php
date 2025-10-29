<?php
@session_start();
if (!isset($SN)) include_once __DIR__ . '/text.php';

$Achievements = [
  ["icon" => "fa-helmet-safety", "value" => "35%", "label" => "Reduction in subcontractor costs"],
  ["icon" => "fa-chart-line", "value" => "12%", "label" => "Improvement in working capital employed"],
  ["icon" => "fa-bolt", "value" => "40%", "label" => "Increase in productivity"],
  ["icon" => "fa-clock", "value" => "40%", "label" => "Reduction in downtime"],
  ["icon" => "fa-leaf", "value" => "15%", "label" => "Reduction in energy costs"],
  ["icon" => "fa-tools", "value" => "30%", "label" => "Reduction in maintenance costs"]
];
?>

<section id="achievements" class="achievements">
  <div class="achievements-container">
    
    <!-- Left: Image -->
    <div class="achievements-image">
      <img src="./assets//images/services/s1.jpg" alt="Mining Truck Achievements" loading="lazy">
    </div>

    <!-- Right: Content -->
    <div class="achievements-content">
      <h2>Our Achievements</h2>
      <p class="subtitle">Featured successes for digital performance clients.</p>

      <div class="achievements-grid">
        <?php foreach ($Achievements as $a): ?>
        <div class="achievement-item">
          <div class="achievement-icon">
            <i class="fa-solid <?= htmlspecialchars($a['icon']) ?>"></i>
          </div>
          <div class="achievement-text">
            <h3><?= htmlspecialchars($a['value']) ?></h3>
            <p><?= htmlspecialchars($a['label']) ?></p>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>
/* =========================================================
   SECTION: Achievements (Layout: Image Left / Stats Right)
   ========================================================= */
.achievements {
  background: var(--color-light);
  padding: clamp(3rem, 5vw, 5rem) 1rem;
  font-family: 'Poppins', sans-serif;
  color: var(--color-slate-800);
}

.achievements-container {
  display: flex;
  flex-wrap: wrap;
  align-items: center;
  max-width: 1200px;
  margin: 0 auto;
  gap: 3rem;
}

/* LEFT SIDE IMAGE */
.achievements-image {
  flex: 1 1 420px;
  border-radius: 20px;
  overflow: hidden;
  box-shadow: 0 10px 35px var(--color-dark-alpha-10);
}
.achievements-image img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  display: block;
}

/* RIGHT SIDE TEXT */
.achievements-content {
  flex: 1 1 480px;
}

.achievements-content h2 {
  font-size: clamp(1.8rem, 3vw, 2.4rem);
  font-weight: 800;
  color: var(--color-midnight);
  margin-bottom: 0.5rem;
}

.achievements-content .subtitle {
  font-size: 1rem;
  color: var(--color-slate-500);
  margin-bottom: 2rem;
}

/* GRID OF ACHIEVEMENTS */
.achievements-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
  gap: 1.5rem 2rem;
}

.achievement-item {
  display: flex;
  align-items: flex-start;
  gap: 1rem;
  transition: transform 0.25s ease;
}

.achievement-item:hover {
  transform: translateY(-4px);
}

.achievement-icon {
  width: 48px;
  height: 48px;
  border-radius: 50%;
  background: var(--color-brand-blue-bright);
  color: var(--color-light);
  display: grid;
  place-items: center;
  font-size: 1.3rem;
}

.achievement-text h3 {
  font-size: 1.5rem;
  font-weight: 700;
  color: var(--color-midnight);
  margin: 0;
  line-height: 1;
}

.achievement-text p {
  font-size: 0.95rem;
  color: var(--color-slate-600);
  margin: 0.3rem 0 0;
}

/* RESPONSIVE */
@media (max-width: 900px) {
  .achievements-container {
    flex-direction: column;
  }
  .achievements-content {
    text-align: center;
  }
  .achievement-item {
    justify-content: center;
  }
}
</style>
