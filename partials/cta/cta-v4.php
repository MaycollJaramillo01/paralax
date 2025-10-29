
<!-- ==============================
     CTA – SEO Friendly (FA6)
============================== -->
<section class="cta-nova" id="cta-estimate"
  itemscope itemtype="https://schema.org/ProfessionalService">
  <style>
    :root{
      --cta-primary: <?php echo $BrandColors['primary']; ?>;
      --cta-accent:  <?php echo $BrandColors['secondary']; ?>;
      --cta-white:   var(--color-light);
      --cta-dark:    var(--color-slate-ink);
    }
    .cta-nova{
      position: relative;
      isolation: isolate;
      padding: clamp(48px,6vw,84px) 0;
      background:
        radial-gradient(1200px 300px at 80% -20%, var(--color-light-alpha-10), transparent 60%) ,
        linear-gradient(180deg, var(--color-snow) 0%, var(--color-slate-haze) 100%);
    }
    .cta-nova .wrap{
      display:grid;
      grid-template-columns: 1.2fr .8fr;
      gap: clamp(24px,4vw,48px);
      align-items: center;
    }
    @media (max-width: 992px){
      .cta-nova .wrap{ grid-template-columns: 1fr; }
    }

    .cta-head .eyebrow{
      display:inline-flex; align-items:center; gap:8px;
      color: var(--cta-accent);
      font-weight:800; letter-spacing:.06em; text-transform:uppercase;
      font-size:.9rem;
    }
    .cta-title{
      margin:10px 0 8px;
      font: 800 clamp(26px,4.6vw,40px)/1.15 var(--title-font, Exo);
      color: var(--cta-primary);
    }
    .cta-sub{
      color:var(--color-slate-700);
      font: 500 1.05rem/1.6 var(--body-font, Inter);
      max-width: 60ch;
    }

    .cta-points{
      margin:18px 0 0; padding:0; list-style:none;
      display:grid; grid-template-columns: repeat(auto-fit, minmax(240px,1fr)); gap:10px 18px;
    }
    .cta-points li{
      color:var(--color-night-indigo); display:flex; gap:10px; align-items:flex-start;
      font:500 .98rem/1.5 var(--body-font, Inter);
    }
    .cta-points i{ color: var(--cta-accent); margin-top:.15rem; }

    .cta-actions{
      display:flex; flex-wrap:wrap; gap:12px; margin-top:20px;
    }
    .btn-cta{
      display:inline-flex; align-items:center; gap:10px;
      padding:12px 22px; border-radius:50px; font-weight:800; text-decoration:none;
      transition: all .28s ease;
    }
    .btn-cta--primary{
      background: var(--cta-primary); color: var(--cta-white);
      box-shadow: 0 10px 24px var(--color-dark-alpha-15);
    }
    .btn-cta--primary:hover{ transform: translateY(-2px); }
    .btn-cta--ghost{
      border: 2px solid var(--cta-primary); color: var(--cta-primary); background: transparent;
    }
    .btn-cta--ghost:hover{
      background: var(--cta-primary); color: var(--cta-white);
    }
    .btn-cta i{ font-size:1.05rem; }

    /* Card lateral con datos de confianza */
    .cta-aside{
      background: var(--cta-dark);
      color:var(--color-ice); border-radius:18px; padding:24px;
      box-shadow: inset 0 0 0 1px var(--color-light-alpha-06), 0 10px 28px var(--color-deep-space-alpha-35);
      position: relative; overflow:hidden;
    }
    .cta-aside::after{
      content:""; position:absolute; inset:-40% -20% auto auto; height:140%;
      width:60%; transform:rotate(35deg);
      background: linear-gradient(90deg, var(--color-light-alpha-06), transparent 40%);
      pointer-events:none;
    }
    .trust{
      display:grid; gap:12px; margin-top:10px;
    }
    .trust div{ display:flex; align-items:center; gap:10px; }
    .trust i{ color: var(--cta-accent); }
    .cta-aside small{ color:var(--color-steel-blue); }
  </style>

  <meta itemprop="name" content="<?= htmlspecialchars($Company) ?>">
  <meta itemprop="areaServed" content="<?= htmlspecialchars($Address) ?>">
  <meta itemprop="url" content="<?= htmlspecialchars($Domain) ?>">

  <div class="container">
    <div class="wrap">
      <!-- Copy principal SEO -->
      <div class="cta-head" itemprop="makesOffer" itemscope itemtype="https://schema.org/Offer">
        <span class="eyebrow">
          <i class="fa-solid fa-star"></i> Free Estimates
        </span>
        <h2 class="cta-title">
          Residential & Commercial Painting in <?= htmlspecialchars($Address) ?>
        </h2>
        <p class="cta-sub">
          <?= htmlspecialchars($Company) ?> delivers professional interior & exterior painting, drywall, flooring and pressure washing.
          Licensed & insured. <?= htmlspecialchars($CoverageText ?? 'We cover nearby areas.') ?>
        </p>

        <ul class="cta-points" aria-label="Key reasons to choose us">
          <li><i class="fa-solid fa-clipboard-check"></i> Detailed, written estimates — no surprises.</li>
          <li><i class="fa-solid fa-shield-halved"></i> Fully licensed & insured crew.</li>
          <li><i class="fa-solid fa-clock"></i> On-time, on-budget project delivery.</li>
          <li><i class="fa-solid fa-paint-roller"></i> Premium materials for long-lasting finishes.</li>
        </ul>

        <div class="cta-actions" itemprop="potentialAction" itemscope itemtype="https://schema.org/ContactAction">
          <?php if (!empty($PhoneRef) && !empty($Phone)): ?>
            <a class="btn-cta btn-cta--primary" href="<?= htmlspecialchars($PhoneRef) ?>"
               aria-label="Call <?= htmlspecialchars($Company) ?> at <?= htmlspecialchars($Phone) ?>" itemprop="target">
              <i class="fa-solid fa-phone-volume"></i> Call <?= htmlspecialchars($Phone) ?>
            </a>
          <?php endif; ?>
          <a class="btn-cta btn-cta--ghost" href="contact.php" rel="nofollow"
             aria-label="Request a free estimate online">
            <i class="fa-solid fa-envelope-open-text"></i> Get a Free Estimate
          </a>
        </div>

        <meta itemprop="price" content="0.00">
        <meta itemprop="priceCurrency" content="USD">
        <link itemprop="url" href="<?= htmlspecialchars($Domain) ?>contact.php">
      </div>

      <!-- Aside de confianza -->
      <aside class="cta-aside" aria-label="Company info and trust">
        <h3 style="margin:0 0 6px; font:800 1.15rem/1.25 var(--title-font, Exo);">Trusted Local Painters</h3>
        <small><?= htmlspecialchars($Experience ?? 'Experienced team') ?></small>
        <div class="trust" style="margin-top:14px;">
          <?php if (!empty($LicenseNote)): ?>
            <div><i class="fa-solid fa-certificate"></i><span><?= htmlspecialchars($LicenseNote) ?></span></div>
          <?php endif; ?>
          <?php if (!empty($Estimates)): ?>
            <div><i class="fa-solid fa-hand-holding-dollar"></i><span><?= htmlspecialchars($Estimates) ?></span></div>
          <?php endif; ?>
          <?php if (!empty($BilingualNote)): ?>
            <div><i class="fa-solid fa-language"></i><span><?= htmlspecialchars($BilingualNote) ?></span></div>
          <?php endif; ?>
        </div>
      </aside>
    </div>
  </div>

  <!-- JSON-LD ContactPoint -->
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "ProfessionalService",
    "name": "<?= htmlspecialchars($Company) ?>",
    "url": "<?= htmlspecialchars($Domain) ?>",
    "areaServed": "<?= htmlspecialchars($Address) ?>",
    "contactPoint": {
      "@type": "ContactPoint",
      "telephone": "<?= htmlspecialchars($Phone ?? '') ?>",
      "contactType": "customer service",
      "availableLanguage": ["English","Spanish"]
    }
  }
  </script>
</section>
