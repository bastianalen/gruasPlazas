document.addEventListener("DOMContentLoaded", function() {
    const submenu = document.querySelector(".submenu");
    const dropdown = submenu.querySelector(".dropdown");

    submenu.addEventListener("mouseenter", function() {
        dropdown.style.display = "block";
        dropdown.style.opacity = "0";
        dropdown.style.transition = "opacity 0.3s";
        setTimeout(() => dropdown.style.opacity = "1", 10);
    });

    submenu.addEventListener("mouseleave", function() {
        dropdown.style.opacity = "0";
        setTimeout(() => dropdown.style.display = "none", 300);
    });
});
