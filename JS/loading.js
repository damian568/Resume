var text = document.querySelector('.text');
var percent = document.querySelector('.percent');
var progress = document.querySelector('.progress');
var loadingDiv = document.querySelector('.div-loading');
var count = 0;
var loading = setInterval(animate, 18);

function animate() {
  count += 2;
  progress.style.width = count + '%';
  percent.textContent = count + '%';

  if (count >= 100) {
    clearInterval(loading);
    text.textContent = 'Ready.';
    text.classList.add('add');

    setTimeout(() => {
      loadingDiv.style.opacity = 0;
      document.body.classList.remove('loading');

      setTimeout(() => {
        loadingDiv.style.display = 'none';
        document.querySelector('#container').style.opacity = 1;
        document.querySelector('#footer').style.opacity = 1;
      }, 800);
    }, 400);
  }
}
