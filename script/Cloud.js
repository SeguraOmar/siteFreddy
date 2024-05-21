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
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Formation ajoutée au panier avec succès');
                } else {
                    alert(data.message || 'Une erreur est survenue lors de l\'ajout au panier');
                }
            })
            .catch(error => {
                alert('Une erreur est survenue : ' + error.message);
            });
    });
});