document.documentElement.classList.add('js');

document.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('[data-mds-header]').forEach((header) => {
    const menuToggle = header.querySelector('[data-mds-menu-toggle]');
    const searchToggle = header.querySelector('[data-mds-search-toggle]');
    const searchPanel = header.querySelector('[data-mds-search-panel]');
    const searchInput = header.querySelector('[data-mds-search-input]');
    const navigation = header.querySelector('[data-mds-nav]');

    const setMenuOpen = (isOpen) => {
      header.classList.toggle('is-menu-open', isOpen);

      if (menuToggle) {
        menuToggle.setAttribute('aria-expanded', String(isOpen));
        menuToggle.setAttribute('aria-label', isOpen ? 'بستن منو' : 'باز کردن منو');
      }
    };

    const setSearchOpen = (isOpen) => {
      if (!searchPanel || !searchToggle) return;

      searchPanel.hidden = !isOpen;
      searchToggle.setAttribute('aria-expanded', String(isOpen));

      if (isOpen && searchInput) {
        window.requestAnimationFrame(() => searchInput.focus());
      }
    };

    menuToggle?.addEventListener('click', () => {
      const willOpen = menuToggle.getAttribute('aria-expanded') !== 'true';
      setSearchOpen(false);
      setMenuOpen(willOpen);
    });

    searchToggle?.addEventListener('click', () => {
      const willOpen = searchToggle.getAttribute('aria-expanded') !== 'true';
      setMenuOpen(false);
      setSearchOpen(willOpen);
    });

    navigation?.addEventListener('click', (event) => {
      if (event.target.closest('a')) {
        setMenuOpen(false);
      }
    });

    document.addEventListener('click', (event) => {
      if (!header.contains(event.target)) {
        setMenuOpen(false);
        setSearchOpen(false);
      }
    });

    document.addEventListener('keydown', (event) => {
      if (event.key === 'Escape') {
        setMenuOpen(false);
        setSearchOpen(false);
        menuToggle?.focus();
      }
    });

    window.addEventListener('resize', () => {
      if (window.matchMedia('(min-width: 64.0625rem)').matches) {
        setMenuOpen(false);
      }
    });
  });

  document.querySelectorAll('[data-mds-selection-track]').forEach((track) => {
    const section = track.closest('.mds-home-selection');
    const nextButton = section?.querySelector('[data-mds-selection-next]');

    nextButton?.addEventListener('click', () => {
      const direction = getComputedStyle(track).direction === 'rtl' ? -1 : 1;
      const card = track.querySelector('.mds-selection-card');
      const distance = card ? card.getBoundingClientRect().width + 10 : track.clientWidth * .8;

      track.scrollBy({
        left: direction * distance,
        behavior: 'smooth',
      });
    });
  });
});
