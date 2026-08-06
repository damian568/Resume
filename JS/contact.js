document.addEventListener('DOMContentLoaded', () => {
  const form = document.getElementById('contact-form-el');
  const statusEl = document.getElementById('form-status');
  if (!form || !statusEl) return;

  form.addEventListener('submit', async (event) => {
    event.preventDefault();
    const submitBtn = form.querySelector('button[type="submit"]');

    submitBtn.disabled = true;
    statusEl.textContent = 'Sending...';
    statusEl.className = 'form-status';

    try {
      const response = await fetch('PHP/contact.php', {
        method: 'POST',
        body: new FormData(form),
      });
      const data = await response.json();

      statusEl.textContent = data.message;
      statusEl.classList.add(data.success ? 'success' : 'error');
      if (data.success) form.reset();
    } catch (err) {
      statusEl.textContent = 'Network error — please try again later, or email me directly.';
      statusEl.classList.add('error');
    } finally {
      submitBtn.disabled = false;
    }
  });
});
