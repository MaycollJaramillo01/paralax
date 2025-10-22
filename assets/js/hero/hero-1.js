(function (global) {
  'use strict';

  const App = global.App;
  if (!App || !App.Utils || !App.IO) {
    console.warn('[hero-design-1] App core utilities not available.');
    return;
  }

  const { Utils, IO, Feature } = App;

  function init() {
    const root = Utils.qs('[data-hero="conversational"]');
    if (!root) return;

    const typingHost = Utils.qs('[data-hero-typing]', root);
    const typingTarget = Utils.qs('[data-hero-typing-target]', root);
    let typed = false;

    if (typingHost && typingTarget) {
      const fullText = typingHost.getAttribute('data-hero-typing') || '';
      const duration = Math.max(1200, fullText.length * 40);

      const runTyping = () => {
        if (typed) return;
        typed = true;
        if (Feature.reduceMotion) {
          typingTarget.textContent = fullText;
          Utils.addClass(typingTarget, 'is-complete');
          return;
        }

        const start = performance.now();
        const tick = (now) => {
          const progress = Math.min((now - start) / duration, 1);
          const chars = Math.floor(progress * fullText.length);
          typingTarget.textContent = fullText.slice(0, chars);
          if (progress < 1) {
            requestAnimationFrame(tick);
          } else {
            typingTarget.textContent = fullText;
            Utils.addClass(typingTarget, 'is-complete');
          }
        };

        requestAnimationFrame(tick);
      };

      IO.observe('[data-hero-typing]', () => runTyping(), { once: true, threshold: [0.55, 0.75] });
    }

    const onScroll = Utils.throttle(() => {
      const isScrolled = (global.scrollY || 0) > 64;
      Utils.toggleClass(root, 'hero--scrolled', isScrolled);
    }, 120);

    Utils.on(global, 'scroll', onScroll);
    onScroll();
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init, { once: true });
  } else {
    init();
  }
})(window);

