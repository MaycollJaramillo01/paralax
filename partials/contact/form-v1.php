<section id="contact-v1" class="contact-section">
  <div class="contact-container">
    <div class="contact-info">
      <h2>Get in Touch</h2>
      <p>Let's discuss your digital growth strategy today.</p>
      <ul>
        <li><strong>Address:</strong> <?= $Address ?></li>
        <li><strong>Phone:</strong> <a href="<?= $PhoneRef ?>"><?= $Phone ?></a></li>
        <li><strong>Email:</strong> <a href="mailto:<?= $Mail ?>"><?= $Mail ?></a></li>
        <li><strong>Schedule:</strong> <?= $Schedule ?></li>
      </ul>
    </div>

    <form id="contact-form-v1" action="mail.php" method="POST" class="contact-form">
      <input type="text" name="name" placeholder="Full Name" required>
      <input type="email" name="email" placeholder="Email Address" required>
      <textarea name="message" rows="4" placeholder="Your Message" required></textarea>
      <button type="submit">Send Message</button>
      <p id="form-status"></p>
    </form>
  </div>
</section>

<style>
#contact-v1 {
  background: linear-gradient(135deg,var(--color-primary),var(--color-secondary));
  color: var(--color-light);
  padding: clamp(3rem,6vw,6rem) 2rem;
}
.contact-container {
  display: grid;
  grid-template-columns: repeat(auto-fit,minmax(320px,1fr));
  gap: 2rem;
  max-width: 1100px;
  margin: 0 auto;
  align-items: center;
}
.contact-info ul { list-style: none; padding: 0; margin-top: 1rem; }
.contact-info li { margin: .5rem 0; }
.contact-info a { color: var(--color-light); text-decoration: underline; }
.contact-form input, .contact-form textarea {
  width: 100%; border: none; outline: none;
  padding: 1rem; border-radius: .5rem;
  margin-bottom: 1rem; font-size: 1rem;
}
.contact-form button {
  background: var(--color-accent);
  color: var(--color-light); border: none; padding: 1rem 2rem;
  border-radius: .5rem; cursor: pointer;
  transition: transform .3s ease, background .3s ease;
}
.contact-form button:hover { transform: translateY(-3px); background: var(--color-light); color: var(--color-dark); }
</style>

<script>
document.querySelector('#contact-form-v1').addEventListener('submit', async (e)=>{
  e.preventDefault();
  const form = e.target;
  const res = await fetch(form.action,{method:'POST',body:new FormData(form)});
  const txt = await res.text();
  document.querySelector('#form-status').textContent = txt;
  form.reset();
});
</script>
