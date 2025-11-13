<section id="contact-v3" class="contact-v3">
  <div class="contact-map">
    <iframe src="https://maps.google.com/maps?q=<?= urlencode($Address) ?>&output=embed" loading="lazy"></iframe>
  </div>
  <div class="contact-form-wrap">
    <h2>Contact <?= $Company ?></h2>
    <p>We’re located in <?= $City ?>, ready to help you grow your digital presence.</p>
    <form id="contact-form-v3" action="mail.php" method="POST">
      <input type="text" name="name" placeholder="Your Name" required>
      <input type="email" name="email" placeholder="Your Email" required>
      <textarea name="message" placeholder="How can we help you?" required></textarea>
      <button type="submit">Send Message</button>
      <p id="form-status3"></p>
    </form>
  </div>
</section>

<style>
.contact-v3 {
  display: grid;
  grid-template-columns: repeat(auto-fit,minmax(400px,1fr));
  min-height: 500px;
}
.contact-map iframe {
  width: 100%; height: 100%;
  border: 0; filter: grayscale(1);
}
.contact-form-wrap {
  background: var(--color-dark);
  color: var(--color-light); display: flex;
  flex-direction: column; justify-content: center;
  padding: clamp(3rem,6vw,6rem);
  animation: fadeSlide 1.2s ease;
}
@keyframes fadeSlide { from {opacity:0;transform:translateX(80px);} to {opacity:1;transform:translateX(0);} }
.contact-form-wrap input, .contact-form-wrap textarea {
  width: 100%; padding: 1rem;
  border-radius: .5rem; border: none;
  margin-bottom: 1rem;
}
.contact-form-wrap button {
  background: var(--color-accent);
  color: var(--color-light); border: none; border-radius: .5rem;
  padding: 1rem 2rem; cursor: pointer;
  transition: transform .3s;
}
.contact-form-wrap button:hover { transform: translateY(-3px); }
</style>

<script>
document.querySelector('#contact-form-v3').addEventListener('submit', async (e)=>{
  e.preventDefault();
  const res = await fetch('mail.php',{method:'POST',body:new FormData(e.target)});
  const msg = await res.text();
  document.querySelector('#form-status3').textContent = msg;
  e.target.reset();
});
</script>
