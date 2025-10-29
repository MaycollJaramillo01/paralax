<section class="partners-v3 parallax-section">
  <div class="partners-v3-bg" style="background-image:url('assets/images/bg/texture-dark.jpg');"></div>
  <div class="partners-v3-content parallax-content">
    <h2 data-animate="fade-in">Certified & Recognized Expertise</h2>
    <p data-animate="slide-up">We’re proud to partner with global leaders in marketing technology and analytics.</p>

    <div class="partners-v3-grid">
      <div class="partners-v3-card layer-1"><img src="assets/images/partners/google-partner.png" alt="Google Partner"></div>
      <div class="partners-v3-card layer-2"><img src="assets/images/partners/meta-ads.png" alt="Meta Ads Certified"></div>
      <div class="partners-v3-card layer-3"><img src="assets/images/partners/semrush.png" alt="Semrush Partner"></div>
      <div class="partners-v3-card layer-1"><img src="assets/images/partners/ahrefs.png" alt="Ahrefs Partner"></div>
      <div class="partners-v3-card layer-2"><img src="assets/images/partners/shopify.png" alt="Shopify Partner"></div>
    </div>
  </div>
</section>

<style>
.partners-v3 {
  position:relative;
  color:var(--color-light);
  text-align:center;
  padding:clamp(3rem,5vw,5rem) 1rem;
  overflow:hidden;
}
.partners-v3-bg {
  position:absolute;
  inset:0;
  background-size:cover;
  background-position:center;
  filter:brightness(.4);
  z-index:var(--z-bg);
}
.partners-v3-content {
  position:relative;
  z-index:var(--z-content);
  width:min(1100px,90%);
  margin:0 auto;
}
.partners-v3 h2 {
  font-family:var(--font-heading);
  font-size:clamp(1.8rem,3vw,2.5rem);
  color:#fff;
}
.partners-v3 p { opacity:.9; margin-bottom:2rem; }
.partners-v3-grid {
  display:flex;
  flex-wrap:wrap;
  justify-content:center;
  gap:2rem;
}
.partners-v3-card {
  background:rgba(255,255,255,0.1);
  backdrop-filter:blur(12px);
  border:1px solid rgba(255,255,255,0.15);
  border-radius:var(--radius-md);
  padding:1rem 1.5rem;
  width:150px;
  transition:transform .4s var(--transition-smooth);
}
.partners-v3-card:hover {
  transform:translateY(-6px) scale(1.08);
  box-shadow:var(--shadow-hard);
}
.partners-v3-card img {
  width:100%;
  height:auto;
  object-fit:contain;
  filter:brightness(0) invert(1);
}
</style>
