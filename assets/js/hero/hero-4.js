(function (w, d) {
  'use strict';
  const hero = d.getElementById('hero-4');
  if (!hero) return;

  const slides = [...hero.querySelectorAll('.hero4__slide')];
  const thumbs = [...hero.querySelectorAll('.hero4__thumb')];
  const nextBtns = [...hero.querySelectorAll('.hero4__arrow.next')];
  const prevBtns = [...hero.querySelectorAll('.hero4__arrow.prev')];

  let index = 0;
  const delay = 6000;
  let timer = null;

  function showSlide(n) {
    slides[index].classList.remove('active');
    thumbs[index].classList.remove('active');
    index = (n + slides.length) % slides.length;

    const img = slides[index].querySelector('img[data-src]');
    if (img) {
      img.src = img.dataset.src;
      img.removeAttribute('data-src');
    }

    slides[index].classList.add('active');
    thumbs[index].classList.add('active');
  }

  function nextSlide() { showSlide(index + 1); }
  function prevSlide() { showSlide(index - 1); }

  function start() {
    stop();
    timer = setInterval(nextSlide, delay);
  }
  function stop() {
    if (timer) clearInterval(timer);
  }

  nextBtns.forEach(btn =>
    btn.addEventListener('click', () => {
      nextSlide();
      start();
    })
  );
  prevBtns.forEach(btn =>
    btn.addEventListener('click', () => {
      prevSlide();
      start();
    })
  );

  thumbs.forEach((btn, i) => {
    btn.addEventListener('click', () => {
      showSlide(i);
      start();
    });
  });

  hero.addEventListener('mouseenter', stop);
  hero.addEventListener('mouseleave', start);
  d.addEventListener('visibilitychange', () => (d.hidden ? stop() : start()));

  slides[0].classList.add('active');
  thumbs[0].classList.add('active');
  start();
})(window, document);
