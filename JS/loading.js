var text = document.querySelector('.text');
var percent = document.querySelector('.percent');
var progress = document.querySelector('.progress');
var loadingDiv = document.querySelector('.div-loading');
var count = 4;
var per = 16;
var loading = setInterval(animate, 50);

function animate() {

  // Start the bar from the top
  window.scrollTo(0, 0);

  if (count === 100 && per === 400) {
    text.textContent = "Completed!";
    text.style.fontSize = "80px";
    text.style.textAlign = "center";
    text.style.border = "none";
    text.classList.add("add");
    clearInterval(loading);

    // Allow user interaction and reveal content
    document.body.classList.remove("loading");

    // Add a delay before hiding the loading screen and showing the content
    setTimeout(() => {
      // Hide the loading container
      loadingDiv.style.opacity = 0;
      loadingDiv.style.transition = "opacity 1s ease-in-out";

      // After hiding, completely remove the loading container
      setTimeout(() => {
        loadingDiv.style.display = "none";
        
        // Show the main content container
        document.querySelector('#container').style.opacity = 1;
        document.querySelector('#footer').style.opacity = 1;
        
      }, 1000); // Wait for the fade-out transition to complete
    }, 2000); // Initial delay before hiding
    
  } else {
    per += 4;
    count += 1;
    progress.style.width = per + 'px';
    percent.textContent = count + '%';
  }
}
