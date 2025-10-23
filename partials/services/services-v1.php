<?php
@session_start();
if (!isset($SN)) include_once __DIR__ . '/text.php';
$TitleServices = $TitleServices ?? "Our Services";
$SubServices   = $SubServices ?? "We combine design, technology and motion to build immersive, high-performance websites.";
?>
<section id="services-v4" class="sv4 section" data-animate="fade-in" data-once="true">
  <div class="sv4__container">
    <aside class="sv4__intro">
      <h2 class="sv4__title"><?= htmlspecialchars($TitleServices) ?></h2>
      <p class="sv4__text"><?= htmlspecialchars($SubServices) ?></p>
      <a class="sv4__cta" href="contact.php"><i class="fa-solid fa-screwdriver-wrench"></i> Request a quote</a>
    </aside>

    <div class="sv4__grid">
      <?php if (!empty($SN)): foreach ($SN as $i => $name):
        $idx  = $i + 1;
        $desc = $ExSD[$idx] ?? '';
        $img  = "assets/images/services/s{$idx}.jpg";
      ?>
      <article class="sv4__item reveal">
        <div class="sv4__imgwrap">
          <img src="<?= htmlspecialchars($img) ?>" alt="<?= htmlspecialchars($name) ?>" loading="lazy" decoding="async" />
          <div class="sv4__glow"></div>
        </div>
        <div class="sv4__body">
          <h3 class="sv4__name"><?= htmlspecialchars($name) ?></h3>
          <?php if ($desc): ?><p class="sv4__desc"><?= htmlspecialchars($desc) ?></p><?php endif; ?>
          <a class="sv4__more" href="contact.php">See details <i class="fa-solid fa-arrow-right"></i></a>
        </div>
      </article>
      <?php endforeach; endif; ?>
    </div>
  </div>
</section>

<style>
.sv4{background:var(--color-light);color:var(--color-dark);padding:clamp(3rem,5vw,6rem) 0}
.sv4__container{width:min(1200px,92%);margin:0 auto;display:grid;grid-template-columns:360px 1fr;gap:2rem}
@media (max-width: 960px){.sv4__container{grid-template-columns:1fr}}
.sv4__title{font-family:var(--font-heading);font-size:clamp(2rem,3.4vw,2.6rem);margin-bottom:.6rem}
.sv4__text{color:var(--color-neutral);margin-bottom:1rem}
.sv4__cta{display:inline-flex;gap:.6rem;align-items:center;background:var(--color-primary);color:var(--color-light);padding:.75rem 1.1rem;border-radius:12px;text-decoration:none;font-weight:800;transition:var(--transition-fast)}
.sv4__cta:hover{background:var(--color-accent)}

.sv4__grid{display:grid;grid-template-columns:repeat(3,1fr);gap:1.25rem}
@media (max-width: 992px){.sv4__grid{grid-template-columns:repeat(2,1fr)}}
@media (max-width: 560px){.sv4__grid{grid-template-columns:1fr}}

.sv4__item{background:var(--color-secondary);border-radius:18px;overflow:hidden;box-shadow:var(--shadow-soft);transition:transform .35s ease,box-shadow .35s ease;will-change:transform}
.sv4__item:hover{transform:translateY(-6px);box-shadow:var(--shadow-hard)}
.sv4__imgwrap{position:relative;aspect-ratio:16/10;overflow:hidden}
.sv4__imgwrap img{width:100%;height:100%;object-fit:cover;transform:scale(1.02);transition:transform .6s var(--transition-smooth)}
.sv4__item:hover .sv4__imgwrap img{transform:scale(1.12)}
/* Glow border on hover */
.sv4__glow{position:absolute;inset:-1px;border-radius:inherit;background:radial-gradient(1200px 400px at var(--mx,50%) var(--my,120%), rgba(184,134,11,.35), transparent 60%);opacity:0;transition:opacity .3s ease}
.sv4__item:hover .sv4__glow{opacity:1}
.sv4__body{padding:1rem 1rem 1.25rem;background:var(--color-primary)}
.sv4__name{color:var(--color-light);font-family:var(--font-heading);margin-bottom:.35rem}
.sv4__desc{color:rgba(255,255,255,.85);font-size:.95rem;margin-bottom:.5rem}
.sv4__more{display:inline-flex;gap:.5rem;align-items:center;color:var(--color-soft);text-decoration:none;font-weight:800}
.sv4__more:hover{color:var(--color-accent)}
</style>

<script>
/* Glow cursor position */
document.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('#services-v4 .sv4__item').forEach(card => {
    const glow = card.querySelector('.sv4__glow');
    if(!glow) return;
    card.addEventListener('mousemove', e => {
      const r = card.getBoundingClientRect();
      const mx = ((e.clientX - r.left) / r.width) * 100;
      const my = ((e.clientY - r.top) / r.height) * 100;
      glow.style.setProperty('--mx', mx+'%');
      glow.style.setProperty('--my', my+'%');
    }, {passive:true});
  });
});
</script>
