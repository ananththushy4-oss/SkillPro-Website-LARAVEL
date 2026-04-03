// public/js/dashboard.js

document.addEventListener("DOMContentLoaded", function () {
    // Toggle sidebar (for mobile)
    const sidebar = document.querySelector(".sidebar");
    const toggleBtn = document.createElement("button");
    toggleBtn.innerHTML = '<i class="fas fa-bars"></i>';
    toggleBtn.classList.add("sidebar-toggle");

    document.querySelector(".navbar").prepend(toggleBtn);

    toggleBtn.addEventListener("click", () => {
        sidebar.classList.toggle("active");
    });

    // Highlight active menu item
    const menuLinks = document.querySelectorAll(".sidebar .menu a");
    const currentPath = window.location.pathname;

    menuLinks.forEach(link => {
        if (link.getAttribute("href") === currentPath) {
            link.classList.add("active-link");
        }
    });

    // Logout confirmation
    const logoutBtn = document.querySelector(".logout-btn");
    if (logoutBtn) {
        logoutBtn.addEventListener("click", function (e) {
            if (!confirm("Are you sure you want to log out?")) {
                e.preventDefault();
            }
        });
    }
});
