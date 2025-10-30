<section id="contact-v2" class="contact-v2">
  <div class="overlay"></div>
  <div class="contact-v2-content">
    <h2>Let’s Work Together</h2>
    <p>Ready to take your business to the next level?</p>
    <form id="contact-form-v2" action="mail.php" method="POST">
      <div class="form-group">
        <input type="text" name="name" placeholder="Name" required>
        <input type="email" name="email" placeholder="Email" required>
      </div>
      <textarea name="message" rows="4" placeholder="Tell us about your project" required></textarea>
      <button type="submit">Start Now</button>
      <p id="form-status2"></p>
    </form>
  </div>
</section>

<style>
.contact-v2 {
  position: relative;
  background: url('assets/images/hero/hero3.jpg') center/cover fixed;
  color: var(--color-light);
  padding: clamp(4rem,6vw,8rem) 2rem;
  text-align: center;
}
.contact-v2 .overlay {
  position: absolute; inset: 0;
  background: var(--color-dark-alpha-60);
}
.contact-v2-content {
  position: relative; z-index: 2;
  max-width: 800px; margin: 0 auto;
  animation: floatIn 1.5s ease forwards;
}
@keyframes floatIn {from{opacity:0;transform:translateY(60px);}to{opacity:1;transform:translateY(0);}}
.contact-v2 input, .contact-v2 textarea {
  width: 100%; border: none; outline: none;
  border-radius: .4rem; padding: 1rem;
  margin-bottom: 1rem; font-size: 1rem;
  background: var(--color-light-alpha-15); color: var(--color-light);
}
.contact-v2 input::placeholder, .contact-v2 textarea::placeholder { color: var(--color-light-alpha-70); }
.contact-v2 button {
  background: var(--color-accent);
  border: none; padding: 1rem 2rem;
  border-radius: 2rem; color: var(--color-light);
  cursor: pointer; transition: transform .3s;
}
.contact-v2 button:hover { transform: scale(1.05); }
</style>

<script>
document.querySelector('#contact-form-v2').addEventListener('submit', async (e)=>{
  e.preventDefault();
  const res = await fetch('mail.php',{method:'POST',body:new FormData(e.target)});
  const txt = await res.text();
  document.querySelector('#form-status2').textContent = txt;
  e.target.reset();
});
</script>
