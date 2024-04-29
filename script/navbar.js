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

const clientContainer = document.getElementById('clientContainer');
const clientMenu = document.getElementById('clientMenu');

let timeout; // Variable pour stocker le délai avant de masquer le menu

// Fonction pour afficher le menu client
function showClientMenu() {
    clearTimeout(timeout); // Réinitialise le délai avant de masquer le menu
    clientMenu.classList.remove('hidden');
}

// Fonction pour masquer le menu client avec un léger délai
function hideClientMenu() {
    timeout = setTimeout(() => {
        clientMenu.classList.add('hidden');
    }, 400); // 400 millisec de délai avant de masquer le menu
}

// Ajout des écouteurs d'événements pour gérer le survol et le retrait du curseur du conteneur client
clientContainer.addEventListener('mouseenter', showClientMenu);
clientContainer.addEventListener('mouseleave', hideClientMenu);
clientMenu.addEventListener('mouseenter', showClientMenu); // Maintient le menu affiché lorsque la souris est sur le menu
clientMenu.addEventListener('mouseleave', hideClientMenu);

