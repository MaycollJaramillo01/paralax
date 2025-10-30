(function () {
  const header = document.querySelector('.template-header');
  if (!header) return;

  const toggle = header.querySelector('[data-menu-toggle]');
  const closeBtn = header.querySelector('[data-menu-close]');
  const overlay = header.querySelector('[data-menu-overlay]');
  const mobileNav = header.querySelector('.template-header__mobile');
  const submenuTriggers = header.querySelectorAll('[data-submenu-toggle]');

  const closeAllSubmenus = () => {
    submenuTriggers.forEach((trigger) => {
      trigger.setAttribute('aria-expanded', 'false');
      const item = trigger.closest('.template-header__item--has-submenu');
      if (item) item.classList.remove('template-header__item--open');
    });
  };

  const openMenu = () => {
    header.classList.add('is-open');
    if (toggle) toggle.setAttribute('aria-expanded', 'true');
    if (mobileNav) mobileNav.setAttribute('aria-hidden', 'false');
  };

  const closeMenu = () => {
    header.classList.remove('is-open');
    if (toggle) toggle.setAttribute('aria-expanded', 'false');
    if (mobileNav) mobileNav.setAttribute('aria-hidden', 'true');
  };

  toggle?.addEventListener('click', () => {
    if (header.classList.contains('is-open')) {
      closeMenu();
    } else {
      openMenu();
    }
  });

  closeBtn?.addEventListener('click', closeMenu);
  overlay?.addEventListener('click', closeMenu);

  window.addEventListener('resize', () => {
    if (window.innerWidth > 992) {
      closeMenu();
    }
  });

  document.addEventListener('keydown', (event) => {
    if (event.key === 'Escape') {
      closeMenu();
      closeAllSubmenus();
    }
  });

  document.addEventListener('click', (event) => {
    if (!header.contains(event.target)) {
      closeAllSubmenus();
      if (header.classList.contains('is-open')) {
        closeMenu();
      }
    }
  });

  submenuTriggers.forEach((trigger) => {
    const item = trigger.closest('.template-header__item--has-submenu');
    if (!item) return;

    trigger.addEventListener('click', (event) => {
      event.preventDefault();
      const isOpen = item.classList.toggle('template-header__item--open');
      trigger.setAttribute('aria-expanded', isOpen ? 'true' : 'false');

      if (!isOpen) return;

      submenuTriggers.forEach((other) => {
        if (other !== trigger) {
          other.setAttribute('aria-expanded', 'false');
          const otherItem = other.closest('.template-header__item--has-submenu');
          if (otherItem) otherItem.classList.remove('template-header__item--open');
        }
      });
    });

    const submenu = item.querySelector('.template-header__submenu');
    if (submenu) {
      submenu.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') {
          trigger.focus();
          item.classList.remove('template-header__item--open');
          trigger.setAttribute('aria-expanded', 'false');
        }
      });
    }
  });
})();
