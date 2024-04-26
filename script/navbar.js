const menuToggle = document.getElementById('menuToggle');
const menu = document.getElementById('menu');

menuToggle.addEventListener('click', () => {
    menu.classList.toggle('hidden');
    if (!menu.classList.contains('hidden')) {
        menu.style.top = `${menuToggle.offsetHeight}px`;
    } else {
        menu.style.top = '';
    }
});