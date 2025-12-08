// Mobile menu toggle
const menuBtn = document.getElementById('menu-btn');
const navbar = document.getElementById('navbar');

if (menuBtn && navbar) {
    menuBtn.addEventListener('click', () => {
        navbar.classList.toggle('active');
        const isExpanded = navbar.classList.contains('active');
        menuBtn.setAttribute('aria-expanded', isExpanded);
    });
}

// Smooth scrolling for navigation links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            if (navbar) {
                navbar.classList.remove('active');
            }
        }
    });
});
