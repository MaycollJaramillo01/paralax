// HERO-4 Quantum Canvas — integra ParallaxKit + ScrollAnim, spotlight reactivo y slider 3 imgs
(function (w, d) {
  'use strict';
  const root = d.querySelector('#hero-quantum');
  if (!root) return;

  // 1) Spotlight reactivo (actualiza CSS vars)
  const spot = root.querySelector('.q-bg--spotlight');
  root.addEventListener('pointermove', (e) => {
    const rect = root.getBoundingClientRect();
    const mx = ((e.clientX - rect.left) / rect.width) * 100;
    const my = ((e.clientY - rect.top) / rect.height) * 100;
    spot.style.setProperty('--mx', mx + '%');
    spot.style.setProperty('--my', my + '%');
  });

  // 2) Split headline en palabras con entrada escalonada
  const title = root.querySelector('[data-split="words"]');
  if (title && !title.dataset.splitted) {
    const words = title.textContent.trim().split(/\s+/);
    title.textContent = '';
    words.forEach((wrd, i) => {
      const span = d.createElement('span');
      span.textContent = wrd + (i < words.length - 1 ? ' ' : '');
      span.style.display = 'inline-block';
      span.style.opacity = '0';
      span.style.transform = 'translateY(16px)';
      span.style.transition = `all .6s cubic-bezier(.16,.84,.38,1) ${i * 55}ms`;
      title.appendChild(span);
    });
    title.dataset.splitted = '1';
  }

  // 3) Init Parallax + ScrollAnim (si existen); fallback para .in-view
  if (w.ParallaxKit && typeof w.ParallaxKit.init === 'function') w.ParallaxKit.init();
  if (w.ScrollAnim && typeof w.ScrollAnim.init === 'function') {
    w.ScrollAnim.init();
  } else {
    const io = new IntersectionObserver((entries) => {
      entries.forEach(e => {
        if (e.isIntersecting) e.target.classList.add('in-view');
        if (e.target === title) {
          // revela palabras escalonadas
          requestAnimationFrame(() => {
            title.querySelectorAll('span').forEach(s => {
              s.style.opacity = '1'; s.style.transform = 'none';
            });
          });
        }
      });
    }, { threshold: 0.3 });
    root.querySelectorAll('[data-animate]').forEach(el => io.observe(el));
  }

  // 4) Cross-fade de 3 imágenes (si existen)
  const img = root.querySelector('.q-img');
  const dots = Array.from(root.querySelectorAll('.q-dots button'));
  const sources = [img.dataset.src1, img.dataset.src2, img.dataset.src3].filter(Boolean);
  if (sources.length > 1) {
    let idx = 0, timer = null;
    const go = (i) => {
      idx = i % sources.length;
      img.classList.add('is-fade');
      setTimeout(() => {
        img.src = sources[idx];
        img.classList.remove('is-fade');
        dots.forEach((d, j) => d.classList.toggle('is-active', j === idx));
      }, 260);
    };
    timer = setInterval(() => go(idx + 1), 4500);
    dots.forEach((d, j) => d.addEventListener('click', () => { clearInterval(timer); go(j); }));
  }

  // 5) Microinteracción: botones magnéticos
  root.querySelectorAll('.q-btn').forEach(btn => {
    btn.addEventListener('pointermove', (e) => {
      const r = btn.getBoundingClientRect();
      const x = ((e.clientX - r.left) / r.width - 0.5) * 6;
      const y = ((e.clientY - r.top) / r.height - 0.5) * 6;
      btn.style.transform = `translate(${x}px, ${y}px)`;
    });
    btn.addEventListener('pointerleave', () => btn.style.transform = '');
  });
})(window, document);
