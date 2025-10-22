// ===== HERO CANVAS (Peeps) – PH4 namespace
(function (w, d) {
  'use strict';

  const gsap = w.gsap; // requiere GSAP
  const canvas = d.getElementById('canvas');
  if (!canvas || !gsap) return;

  const ctx = canvas.getContext('2d');
  const stage = { width: 0, height: 0 };

  const CONFIG = {
    src: 'https://s3-us-west-2.amazonaws.com/s.cdpn.io/175711/open-peeps-sheet.png',
    rows: 15,
    cols: 7
  };

  // ====== Utils
  const rand  = (min, max) => min + Math.random() * (max - min);
  const rIdx  = (arr) => (rand(0, arr.length)) | 0;
  const rrm   = (arr) => arr.splice(rIdx(arr), 1)[0]; // remove random
  const pick  = (arr) => arr[rIdx(arr)];

  // ====== Peep class
  class Peep {
    constructor({ image, rect }) {
      this.image = image;
      this.setRect(rect);
      this.x = 0; this.y = 0; this.anchorY = 0; this.scaleX = 1; this.walk = null;
    }
    setRect(rect) {
      this.rect = rect;
      this.width = rect[2]; this.height = rect[3];
      this.drawArgs = [this.image, ...rect, 0, 0, this.width, this.height];
    }
    render(ctx) {
      ctx.save();
      ctx.translate(this.x, this.y);
      ctx.scale(this.scaleX, 1);
      ctx.drawImage(...this.drawArgs);
      ctx.restore();
    }
  }

  // ====== Crowd state
  const img = new Image();
  const all = [], pool = [], crowd = [];

  img.onload = init;
  img.src = CONFIG.src;

  function init() {
    createPeeps();
    resize();
    gsap.ticker.add(render);
    w.addEventListener('resize', resize, { passive: true });
  }

  function createPeeps() {
    const { rows, cols } = CONFIG;
    const { naturalWidth: w0, naturalHeight: h0 } = img;
    const total = rows * cols;
    const rw = w0 / rows, rh = h0 / cols;

    for (let i = 0; i < total; i++) {
      all.push(new Peep({
        image: img,
        rect: [ (i % rows) * rw, ((i / rows) | 0) * rh, rw, rh ]
      }));
    }
  }

  function resize() {
    // ocupar todo el hero
    const dpr = Math.min(2, w.devicePixelRatio || 1);
    const box = canvas.getBoundingClientRect();
    stage.width = box.width;
    stage.height = box.height;
    canvas.width = Math.round(stage.width * dpr);
    canvas.height = Math.round(stage.height * dpr);
    ctx.setTransform(dpr, 0, 0, dpr, 0, 0);

    // reset tweens
    crowd.forEach(p => p.walk && p.walk.kill());
    crowd.length = 0;
    pool.length = 0;
    pool.push(...all);
    populate();
  }

  function populate() {
    while (pool.length) {
      addPeep().walk.progress(Math.random());
    }
  }

  function resetPeep(peep) {
    const dir = Math.random() > 0.5 ? 1 : -1;
    const offsetY = 100 - 250 * gsap.parseEase('power2.in')(Math.random());
    const y = stage.height - peep.height + offsetY;
    let x0, x1;

    if (dir === 1) { x0 = -peep.width; x1 = stage.width; peep.scaleX = 1; }
    else { x0 = stage.width + peep.width; x1 = 0; peep.scaleX = -1; }

    peep.x = x0; peep.y = y; peep.anchorY = y;
    return { x0, y, x1 };
  }

  function addPeep() {
    const peep = rrm(pool);
    const { x0, y, x1 } = resetPeep(peep);

    const xDuration = 10;
    const yDuration = 0.25;

    const tl = gsap.timeline().timeScale(rand(0.5, 1.5));
    tl.to(peep, { duration: xDuration, x: x1, ease: 'none' }, 0);
    tl.to(peep, { duration: yDuration, repeat: xDuration / yDuration, yoyo: true, y: y - 10 }, 0);
    tl.eventCallback('onComplete', () => {
      remove(peep);
      addPeep();
    });

    peep.walk = tl;
    crowd.push(peep);
    crowd.sort((a,b) => a.anchorY - b.anchorY);
    return peep;
  }

  function remove(peep) {
    const i = crowd.indexOf(peep);
    if (i > -1) crowd.splice(i, 1);
    pool.push(peep);
  }

  function render() {
    // limpiar rápido sin re-layout
    ctx.clearRect(0, 0, stage.width, stage.height);
    crowd.forEach(p => p.render(ctx));
  }

})(window, document);
