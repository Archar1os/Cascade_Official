window.addEventListener('scroll', function() {
    const scrollPrompt = document.querySelector('.scroll-prompt');
    scrollPrompt.style.opacity = 0; 
});

// HAMBURGER MENU FUNCTIONALITY
document.addEventListener("DOMContentLoaded", function() {
    const hamburger = document.getElementById("hamburger");
    const overlay = document.getElementById("overlay");

    
    hamburger.addEventListener("click", function() {
        overlay.classList.toggle("active");
    });

    document.addEventListener("click", function(event) {
        if (!overlay.contains(event.target) && !hamburger.contains(event.target)) {
            overlay.classList.remove("active"); 
        }
    });
});

