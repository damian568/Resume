function scrollToSection(sectionId) {
  const section = document.getElementById(sectionId);
  if (section) {
    section.scrollIntoView({ behavior: 'smooth' });
  }
  closeMobileMenu();
}

const navToggle = document.getElementById('nav-toggle');
const navMenu = document.getElementById('nav-menu');

function closeMobileMenu() {
  if (!navMenu || !navToggle) return;
  navMenu.classList.remove('open');
  navToggle.setAttribute('aria-expanded', 'false');
}

if (navToggle && navMenu) {
  navToggle.addEventListener('click', () => {
    const isOpen = navMenu.classList.toggle('open');
    navToggle.setAttribute('aria-expanded', String(isOpen));
  });
}

// Highlight the nav link matching the section currently in view
const observedSections = document.querySelectorAll('main .section');
const navLinks = document.querySelectorAll('.nav-link');

if (observedSections.length && navLinks.length) {
  const sectionObserver = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          navLinks.forEach((link) => link.classList.remove('active'));
          const activeLink = document.querySelector(
            `.nav-link[data-section="${entry.target.id}"]`
          );
          if (activeLink) activeLink.classList.add('active');
        }
      });
    },
    { rootMargin: '-40% 0px -55% 0px' }
  );

  observedSections.forEach((section) => sectionObserver.observe(section));
}

const yearEl = document.getElementById('year');
if (yearEl) {
  yearEl.textContent = new Date().getFullYear();
}
