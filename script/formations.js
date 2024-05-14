document.getElementById('SearchButton').addEventListener('click', function () {
    var category = document.getElementById('category').value;
    if (category === 'IA') {
        document.getElementById('searchForm').action = '../controllers/controller-IA.php';
    } else if (category === 'Cloud') {
        document.getElementById('searchForm').action = '../controllers/controller-cloud.php';
    }
    document.getElementById('searchForm').submit();
});

document.addEventListener('DOMContentLoaded', function () {
    // Récupérer tous les boutons "Ajouter au panier"
    const addToCartButtons = document.querySelectorAll('.addToCart');

    // Ajouter un écouteur d'événements à chaque bouton
    addToCartButtons.forEach(button => {
        button.addEventListener('click', () => {
            // Récupérer l'ID de la formation à partir de l'attribut data-id
            const formationId = button.getAttribute('data-id');

            // Exécuter une action avec l'ID de la formation (par exemple, ajouter au panier)
            addToCart(formationId);
        });
    });

    // Fonction pour ajouter la formation au panier
    function addToCart(formationId) {
        // Vous pouvez ajouter ici la logique pour ajouter la formation au panier, par exemple en envoyant une requête AJAX au serveur
        console.log('Formation ajoutée au panier avec ID :', formationId);
    }
});