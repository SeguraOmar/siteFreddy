// Sélectionne tous les éléments ayant la classe 'btnAjouterPanier' et ajoute un écouteur d'événement 'click' à chacun d'eux.
document.querySelectorAll('.btnAjouterPanier').forEach(button => {
    // Ajoute un écouteur d'événement 'click' à chaque bouton
    button.addEventListener('click', function () {
        // Récupère l'attribut 'data-id-formation' du bouton cliqué
        const idFormation = this.getAttribute('data-id-formation');

        // Effectue une requête fetch vers 'controller-add-to-cart.php' avec la méthode POST
        fetch('../controllers/controller-add-to-cart.php', {
            method: 'POST', // Spécifie la méthode de la requête
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded' // Spécifie le type de contenu
            },
            body: new URLSearchParams({ // Définit le corps de la requête avec les paramètres
                id_formation: idFormation // Ajoute l'ID de la formation au corps de la requête
            })
        })
            .then(response => response.text()) // Convertit la réponse en texte
            .then(data => {
                try {
                    // Tente de parser la réponse JSON
                    data = JSON.parse(data);
                    if (data.success) {
                        // Affiche une alerte si la formation a été ajoutée avec succès au panier
                        alert('Formation ajoutée au panier avec succès. Panier: ');
                    } else {
                        // Affiche une alerte avec le message d'erreur retourné par le serveur
                        alert(data.message || 'Une erreur est survenue lors de l\'ajout au panier');
                    }
                } catch (e) {
                    // Affiche une alerte en cas de réponse inattendue du serveur
                    alert('Réponse inattendue du serveur : ' + data);
                }
            })
            .catch(error => {
                // Affiche une alerte en cas d'erreur lors de la requête fetch
                alert('Une erreur est survenue : ' + error.message);
            });
    });
});
