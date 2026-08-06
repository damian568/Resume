document.addEventListener('DOMContentLoaded', () => {
  const tabs = document.querySelectorAll('.filter-tab');
  const cards = document.querySelectorAll('.project-card');
  if (!tabs.length || !cards.length) return;

  tabs.forEach((tab) => {
    tab.addEventListener('click', () => {
      tabs.forEach((t) => t.classList.remove('active'));
      tab.classList.add('active');

      const filter = tab.dataset.filter;
      cards.forEach((card) => {
        const categories = (card.dataset.category || '').split(' ');
        const show = filter === 'all' || categories.includes(filter);
        card.style.display = show ? '' : 'none';
      });
    });
  });
});
