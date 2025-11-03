(function () {
  const animatedElements = document.querySelectorAll('[data-animate]');
  if (animatedElements.length) {
    const observer = new IntersectionObserver((entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add('is-visible');
          observer.unobserve(entry.target);
        }
      });
    }, { threshold: 0.2 });

    animatedElements.forEach((element) => observer.observe(element));
  }

  const navToggle = document.querySelector('[data-nav-toggle]');
  const navigation = document.getElementById('primary-navigation');
  if (navToggle && navigation) {
    const toggleText = navToggle.querySelector('.toggle-text');
    const originalText = toggleText?.dataset.openText || '';
    const closeText = toggleText?.dataset.closeText || originalText;

    const toggleNavigation = () => {
      const isOpen = navToggle.getAttribute('aria-expanded') === 'true';
      navToggle.setAttribute('aria-expanded', String(!isOpen));
      navigation.classList.toggle('is-open', !isOpen);
      if (toggleText) {
        toggleText.textContent = !isOpen ? closeText : originalText;
      }
    };

    navToggle.addEventListener('click', toggleNavigation);
    navigation.querySelectorAll('a').forEach((link) => {
      link.addEventListener('click', () => {
        if (navToggle.getAttribute('aria-expanded') === 'true') {
          toggleNavigation();
        }
      });
    });
  }
})();
