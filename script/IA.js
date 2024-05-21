document.querySelectorAll('.btnAjouterPanier').forEach(button => {
    button.addEventListener('click', function() {
        const idFormation = this.getAttribute('data-id-formation');
        fetch('../controllers/controller-add-to-cart.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: new URLSearchParams({
                    id_formation: idFormation
                })
            })
            .then(response => response.text())
            .then(data => {
                try {
                    data = JSON.parse(data);
                    if (data.success) {
                        alert('Formation ajoutée au panier avec succès. Panier: ' + JSON.stringify(data.panier));
                    } else {
                        alert(data.message || 'Une erreur est survenue lors de l\'ajout au panier');
                    }
                } catch (e) {
                    alert('Réponse inattendue du serveur : ' + data);
                }
            })
            .catch(error => {
                alert('Une erreur est survenue : ' + error.message);
            });
    });
});