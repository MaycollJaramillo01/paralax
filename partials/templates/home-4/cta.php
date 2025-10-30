<?php
@session_start();
if (!isset($Phone)) {
    include_once dirname(__DIR__, 3) . '/text.php';
}

$phone = $Phone ?? '(305) 555-MAVN';
$email = $Mail ?? 'developer1@gomavenhub.com';
$base  = $BaseURL ?? '';
?>
<section id="home4-cta" class="h4-cta" aria-labelledby="home4-cta-title">
  <div class="h4-cta__inner">
    <div class="h4-cta__copy">
      <span class="h4-cta__chip">Let’s talk</span>
      <h2 id="home4-cta-title">Ready to build your growth roadmap?</h2>
      <p>Book a 30-minute strategy lab with our senior team. We will review analytics, opportunities, and ROI drivers.</p>
    </div>
    <div class="h4-cta__actions">
      <a class="h4-cta__btn" href="tel:<?= htmlspecialchars(preg_replace('/[^0-9+]/', '', $phone)) ?>">
        <i class="fa-solid fa-phone"></i>
        <?= htmlspecialchars($phone) ?>
      </a>
      <a class="h4-cta__btn h4-cta__btn--ghost" href="mailto:<?= htmlspecialchars($email) ?>">
        <i class="fa-solid fa-envelope"></i>
        <?= htmlspecialchars($email) ?>
      </a>
      <a class="h4-cta__link" href="<?= htmlspecialchars($base . '/contact.php') ?>">Book your session</a>
    </div>
  </div>
</section>

<style>
.h4-cta{
  background:radial-gradient(circle at top,#0d283f,#03101d 60%);
  color:#fff;
  padding:clamp(3rem,6vw,4.8rem) 0;
}
.h4-cta__inner{
  width:min(1100px,90%);
  margin:0 auto;
  border-radius:26px;
  border:1px solid rgba(124,246,255,.22);
  padding:clamp(2rem,5vw,3rem);
  display:grid;
  gap:2rem;
  background:rgba(4,18,31,.92);
  box-shadow:0 40px 80px rgba(2,12,21,.45);
}
.h4-cta__copy h2{
  margin:1rem 0 .8rem;
  font-family:var(--font-heading);
  font-size:clamp(2.2rem,4vw,2.9rem);
  line-height:1.1;
}
.h4-cta__copy p{
  margin:0;
  color:rgba(255,255,255,.72);
  font-size:1.05rem;
}
.h4-cta__chip{
  display:inline-flex;
  align-items:center;
  gap:.4rem;
  padding:.35rem .75rem;
  border-radius:999px;
  text-transform:uppercase;
  letter-spacing:.14em;
  font-weight:700;
  background:rgba(124,246,255,.15);
  color:#7cf6ff;
}
.h4-cta__actions{
  display:flex;
  flex-direction:column;
  gap:1rem;
}
.h4-cta__btn{
  display:inline-flex;
  align-items:center;
  gap:.75rem;
  padding:1rem 1.3rem;
  border-radius:16px;
  font-size:1.05rem;
  font-weight:700;
  text-decoration:none;
  background:#7cf6ff;
  color:#062133;
  box-shadow:0 20px 40px rgba(11,60,98,.35);
}
.h4-cta__btn i{ color:#062133; }
.h4-cta__btn--ghost{
  background:transparent;
  border:1px solid rgba(124,246,255,.45);
  color:#7cf6ff;
  box-shadow:none;
}
.h4-cta__btn--ghost i{ color:#7cf6ff; }
.h4-cta__link{
  text-transform:uppercase;
  letter-spacing:.18em;
  font-weight:800;
  color:#fff;
  text-decoration:none;
  align-self:flex-start;
}
.h4-cta__link::after{
  content:' →';
}
@media (min-width:960px){
  .h4-cta__inner{
    grid-template-columns:1.1fr .9fr;
    align-items:center;
  }
}
</style>
