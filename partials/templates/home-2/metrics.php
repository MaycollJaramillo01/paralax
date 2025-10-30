<section id="process" class="process">
  <div class="process-container">
    <h2 class="process-title">Our Proven Process</h2>
    <p class="process-subtitle">From concept to conversion — our workflow ensures measurable growth.</p>

    <div class="process-steps">
      <div class="step reveal">
        <span class="step-number">01</span>
        <h3>Strategy</h3>
        <p>We start by understanding your goals, analyzing your audience, and defining a roadmap that aligns marketing, design, and technology.</p>
      </div>
      <div class="step reveal">
        <span class="step-number">02</span>
        <h3>Build</h3>
        <p>Our developers and designers bring concepts to life with speed, SEO structure, and accessibility built right into the code.</p>
      </div>
      <div class="step reveal">
        <span class="step-number">03</span>
        <h3>Optimize</h3>
        <p>Post-launch, we measure performance, implement A/B testing, and continuously refine for better ROI and engagement.</p>
      </div>
    </div>
  </div>
</section>

<style>
.process {
  background: var(--color-light);
  color: var(--color-dark);
  text-align: center;
  padding: clamp(3rem,5vw,5rem) 1rem;
}
.process-container { width: min(1100px, 92%); margin: 0 auto; }
.process-title {
  font-family: var(--font-heading);
  font-size: clamp(1.8rem,3vw,2.4rem);
  margin-bottom: .5rem;
  color: var(--color-primary);
}
.process-subtitle {
  color: var(--color-neutral);
  margin-bottom: 2.5rem;
}
.process-steps {
  display: grid;
  grid-template-columns: repeat(auto-fit,minmax(260px,1fr));
  gap: 2rem;
}
.step {
  background: var(--color-light);
  padding: 2rem 1.5rem;
  border-radius: var(--radius-lg);
  box-shadow: var(--shadow-soft);
  transition: transform .4s var(--transition-smooth);
}
.step:hover { transform: translateY(-6px); box-shadow: var(--shadow-hard); }
.step-number {
  display: inline-block;
  background: var(--color-accent);
  color: var(--color-light);
  width: 46px; height: 46px;
  border-radius: 50%;
  font-weight: 800;
  line-height: 46px;
  margin-bottom: .8rem;
}
.step h3 {
  font-family: var(--font-heading);
  margin: .4rem 0;
  color: var(--color-primary);
}
.step p { font-size: .95rem; color: var(--color-neutral); }
</style>

<script>
document.querySelectorAll('.process .reveal').forEach(el=>{
  const io=new IntersectionObserver(e=>{
    e.forEach(x=>{ if(x.isIntersecting){x.target.classList.add('active');io.unobserve(x.target);} });
  },{threshold:.2});
  io.observe(el);
});
</script>
