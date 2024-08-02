document.addEventListener('DOMContentLoaded', () => {
    const hamburger = document.querySelector('.hamburger');
    const navMenu = document.querySelector('.nav-menu ul');

    hamburger.addEventListener('click', () => {
        navMenu.classList.toggle('active');
    });
});
