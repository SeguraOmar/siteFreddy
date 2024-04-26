document.addEventListener('DOMContentLoaded', function () {
    const menuToggle = document.getElementById('menuToggle');
    const menu = document.getElementById('menu');

    menuToggle.addEventListener('click', () => {
        menu.classList.toggle('hidden');
        menu.classList.toggle('mb-20');
        if (!menu.classList.contains('hidden')) {
            menu.style.top = `${menuToggle.offsetHeight}px`;
        } else {
            menu.style.top = '';
        }
    });
});
