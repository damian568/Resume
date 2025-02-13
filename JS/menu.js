var barClick = document.querySelector('.bar');
var concontainerBar = document.querySelector('.container-bar');

barClick.addEventListener('click', ()=>{
    barClick.classList.toggle('active');
    concontainerBar.classList.toggle('active');
})