<section class="partners-v2" aria-label="Certifications Carousel">
  <div class="partners-v2-track">
    <div class="partners-v2-slide"><img src="assets/images/partners/google-partner.png" alt="Google Partner"></div>
    <div class="partners-v2-slide"><img src="assets/images/partners/meta-ads.png" alt="Meta Ads Certified"></div>
    <div class="partners-v2-slide"><img src="assets/images/partners/semrush.png" alt="Semrush Partner"></div>
    <div class="partners-v2-slide"><img src="assets/images/partners/ahrefs.png" alt="Ahrefs Partner"></div>
    <div class="partners-v2-slide"><img src="assets/images/partners/shopify.png" alt="Shopify Partner"></div>
    <div class="partners-v2-slide"><img src="assets/images/partners/google-partner.png" alt="Google Partner"></div>
    <div class="partners-v2-slide"><img src="assets/images/partners/meta-ads.png" alt="Meta Ads Certified"></div>
  </div>
</section>

<style>
.partners-v2 {
  background: var(--color-light);
  overflow:hidden;
  padding: clamp(3rem,5vw,5rem) 0;
}
.partners-v2-track {
  display:flex;
  gap:3rem;
  width:max-content;
  animation: partners-scroll 20s linear infinite;
  align-items:center;
}
.partners-v2-slide img {
  height:200px;
  width:auto;
  opacity:.8;
  filter:grayscale(100%);
  transition:all .3s ease;
}
.partners-v2-slide img:hover {
  opacity:1;
  filter:none;
  transform:scale(1.05);
}
@keyframes partners-scroll {
  from { transform:translateX(0); }
  to { transform:translateX(-50%); }
}
</style>
