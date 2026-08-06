function scrollToTop() {
  window.scrollTo({ top: 0, behavior: 'smooth' });
}

const backToTopBtn = document.querySelector('#btn-back-top .button');

if (backToTopBtn) {
  window.addEventListener('scroll', () => {
    backToTopBtn.classList.toggle('show', window.scrollY > 400);
  });
}
