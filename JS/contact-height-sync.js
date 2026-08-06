(function () {
  var cards = document.querySelector('.contact-cards');
  var form = document.querySelector('.contact-form');
  var textarea = form ? form.querySelector('textarea') : null;
  if (!cards || !form || !textarea) return;

  var mq = window.matchMedia('(max-width: 880px)');
  var MIN_TEXTAREA_HEIGHT = 40;

  function sync() {
    if (mq.matches) {
      form.style.height = '';
      textarea.style.height = '';
      return;
    }

    form.style.height = '';
    textarea.style.height = '';

    var targetHeight = cards.offsetHeight;
    form.style.height = targetHeight + 'px';

    // Measure how much room everything except the textarea already takes,
    // then give the textarea exactly what's left so the form's own bottom
    // edge (the Send button/footer) never gets pushed past targetHeight.
    var formStyle = getComputedStyle(form);
    var contentHeight = form.clientHeight
      - parseFloat(formStyle.paddingTop)
      - parseFloat(formStyle.paddingBottom);

    var usedHeight = 0;
    Array.prototype.forEach.call(form.children, function (child) {
      if (child.contains(textarea)) return;
      var cs = getComputedStyle(child);
      usedHeight += child.getBoundingClientRect().height + parseFloat(cs.marginTop) + parseFloat(cs.marginBottom);
    });

    var messageGroup = textarea.closest('.form-group');
    var groupCs = getComputedStyle(messageGroup);
    usedHeight += parseFloat(groupCs.marginTop) + parseFloat(groupCs.marginBottom);

    Array.prototype.forEach.call(messageGroup.children, function (child) {
      if (child === textarea) return;
      var cs = getComputedStyle(child);
      usedHeight += child.getBoundingClientRect().height + parseFloat(cs.marginTop) + parseFloat(cs.marginBottom);
    });

    var available = contentHeight - usedHeight;
    textarea.style.height = Math.max(MIN_TEXTAREA_HEIGHT, available) + 'px';
  }

  window.addEventListener('load', sync);
  window.addEventListener('resize', sync);
  mq.addEventListener('change', sync);
  window.syncContactFormHeight = sync;
})();
