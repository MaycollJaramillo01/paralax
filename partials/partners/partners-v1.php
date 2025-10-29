<section id="partners" class="partners-v1 gradient-accent" aria-labelledby="partners-title">
  <div class="partners-v1-container" data-animate="fade-in">
    <h2 id="partners-title">Our Trusted Partners</h2>
    <p>We collaborate with world-class platforms and certified technologies.</p>

    <div class="partners-v1-grid">
      <img src="assets/images/partners/google-partner.png" alt="Google Partner" loading="lazy">
      <img src="assets/images/partners/meta-ads.png" alt="Meta Ads Certified" loading="lazy">
      <img src="assets/images/partners/semrush.png" alt="Semrush Agency Partner" loading="lazy">
      <img src="assets/images/partners/ahrefs.png" alt="Ahrefs Data Certified" loading="lazy">
      <img src="assets/images/partners/shopify.png" alt="Shopify Partner" loading="lazy">
    </div>
  </div>
</section>

<style>
.partners-v1 {
  text-align:center;
  padding: clamp(3rem,5vw,5rem) 1rem;
  color: #fff;
}
.partners-v1-container { width:min(1100px,95%); margin:0 auto; }
.partners-v1 h2 { font-family:var(--font-heading); font-size:clamp(1.8rem,3vw,2.4rem); }
.partners-v1 p { opacity:.9; margin-bottom:2.5rem; }
.partners-v1-grid {
  display:flex;
  flex-wrap:wrap;
  justify-content:center;
  align-items:center;
  gap:2rem;
}
.partners-v1-grid img {
  width:140px; height:auto;
  filter:brightness(0) invert(1);
  opacity:.9;
  transition:all .3s ease;
}
.partners-v1-grid img:hover {
  transform:scale(1.1);
  opacity:1;
}
</style>
