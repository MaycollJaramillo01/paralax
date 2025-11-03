(function () {
  const slider = document.querySelector('[data-slider]');
  if (!slider) return;

  const track = slider.querySelector('[data-slider-track]');
  const slides = Array.from(track?.children || []);
  if (!track || slides.length === 0) return;

  const prevButton = slider.querySelector('[data-slider-prev]');
  const nextButton = slider.querySelector('[data-slider-next]');
  const dots = Array.from(slider.querySelectorAll('[data-slider-dot]'));
  const toggleButton = slider.querySelector('[data-slider-toggle]');
  const labelHolder = toggleButton?.querySelector('.toggle-label');
  const playLabel = toggleButton?.dataset.playLabel || '';
  const pauseLabel = toggleButton?.dataset.pauseLabel || '';

  let current = 0;
  let autoPlay = true;
  let timer = null;
  const duration = 6000;

  const updateActiveSlide = (index) => {
    slides.forEach((slide, idx) => {
      slide.classList.toggle('is-active', idx === index);
      slide.style.transform = `translateX(${(idx - index) * 100}%)`;
    });
    dots.forEach((dot, idx) => {
      dot.classList.toggle('is-active', idx === index);
      dot.setAttribute('aria-pressed', idx === index ? 'true' : 'false');
    });
    current = index;
  };

  const goToSlide = (index) => {
    const newIndex = (index + slides.length) % slides.length;
    updateActiveSlide(newIndex);
  };

  const startAutoPlay = () => {
    if (timer) window.clearInterval(timer);
    timer = window.setInterval(() => {
      goToSlide(current + 1);
    }, duration);
    if (toggleButton && labelHolder) {
      toggleButton.setAttribute('data-state', 'playing');
      toggleButton.setAttribute('aria-label', pauseLabel);
      labelHolder.textContent = pauseLabel;
    }
  };

  const stopAutoPlay = () => {
    if (timer) window.clearInterval(timer);
    timer = null;
    if (toggleButton && labelHolder) {
      toggleButton.setAttribute('data-state', 'paused');
      toggleButton.setAttribute('aria-label', playLabel);
      labelHolder.textContent = playLabel;
    }
  };

  const handlePrev = () => goToSlide(current - 1);
  const handleNext = () => goToSlide(current + 1);

  prevButton?.addEventListener('click', handlePrev);
  nextButton?.addEventListener('click', handleNext);

  dots.forEach((dot, idx) => {
    dot.addEventListener('click', () => {
      goToSlide(idx);
      if (autoPlay) {
        stopAutoPlay();
        autoPlay = false;
      }
    });
  });

  toggleButton?.addEventListener('click', () => {
    autoPlay = !autoPlay;
    if (autoPlay) {
      startAutoPlay();
    } else {
      stopAutoPlay();
    }
  });

  slider.addEventListener('mouseenter', () => {
    if (autoPlay) stopAutoPlay();
  });

  slider.addEventListener('mouseleave', () => {
    if (autoPlay) startAutoPlay();
  });

  updateActiveSlide(0);
  if (autoPlay) {
    startAutoPlay();
  }
})();
