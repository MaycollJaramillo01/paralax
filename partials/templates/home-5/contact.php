<?php
@session_start();
if (!isset($Phone)) {
    include_once dirname(__DIR__, 3) . '/text.php';
}

$phone = $Phone ?? '(305) 555-MAVN';
$email = $Mail ?? 'developer1@gomavenhub.com';
$base  = $BaseURL ?? '';
?>
<section id="home5-contact" class="h5-contact" aria-labelledby="home5-contact-title">
  <div class="h5-contact__inner">
    <header class="h5-contact__header">
      <span class="h5-contact__chip">Contact</span>
      <h2 id="home5-contact-title">Unlock your next growth sprint</h2>
      <p>Access a cross-functional team dedicated to accelerating acquisition, activation, and retention.</p>
    </header>
    <div class="h5-contact__actions">
      <a class="h5-contact__cta" href="tel:<?= htmlspecialchars(preg_replace('/[^0-9+]/', '', $phone)) ?>">
        <i class="fa-solid fa-phone"></i>
        <?= htmlspecialchars($phone) ?>
      </a>
      <a class="h5-contact__cta" href="mailto:<?= htmlspecialchars($email) ?>">
        <i class="fa-solid fa-envelope"></i>
        <?= htmlspecialchars($email) ?>
      </a>
      <a class="h5-contact__btn" href="<?= htmlspecialchars($base . '/contact.php') ?>">Schedule workshop</a>
    </div>
  </div>
</section>

<style>
.h5-contact{
  background:linear-gradient(135deg,#0f172a,#2f436d);
  color:#fff;
  padding:clamp(3.2rem,6vw,4.8rem) 0;
}
.h5-contact__inner{
  width:min(960px,90%);
  margin:0 auto;
  border-radius:24px;
  padding:clamp(2rem,5vw,3rem);
  background:rgba(3,10,23,.82);
  border:1px solid rgba(124,246,255,.25);
  box-shadow:0 30px 65px rgba(2,10,23,.45);
  display:grid;
  gap:1.8rem;
}
.h5-contact__chip{
  display:inline-flex;
  align-items:center;
  gap:.4rem;
  padding:.3rem .7rem;
  border-radius:999px;
  text-transform:uppercase;
  letter-spacing:.16em;
  font-weight:700;
  background:rgba(124,246,255,.2);
  color:#7cf6ff;
}
.h5-contact__header h2{
  margin:1rem 0 .6rem;
  font-family:var(--font-heading);
  font-size:clamp(2.1rem,4vw,2.8rem);
}
.h5-contact__header p{
  margin:0;
  color:rgba(255,255,255,.75);
}
.h5-contact__actions{
  display:flex;
  flex-wrap:wrap;
  gap:1rem;
}
.h5-contact__cta{
  flex:1 1 260px;
  display:flex;
  align-items:center;
  gap:.8rem;
  padding:1rem 1.2rem;
  border-radius:14px;
  background:rgba(5,19,33,.9);
  border:1px solid rgba(124,246,255,.35);
  text-decoration:none;
  color:#7cf6ff;
  font-weight:700;
}
.h5-contact__cta i{ color:#7cf6ff; }
.h5-contact__btn{
  flex:1 1 100%;
  display:inline-flex;
  justify-content:center;
  align-items:center;
  padding:1rem 1.4rem;
  border-radius:14px;
  text-transform:uppercase;
  letter-spacing:.16em;
  background:#7cf6ff;
  color:#021220;
  font-weight:800;
  text-decoration:none;
}
.h5-contact__btn:hover{
  background:#fff;
}
</style>
