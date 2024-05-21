<?php
session_start();

// Activer le rapport d'erreurs
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] == 'POST') { // Vérifie si la requête HTTP est de type POST

    if (isset($_POST['id_formation'])) { // Vérifie si la clé 'id_formation' est présente dans les données POST

        $idFormation = $_POST['id_formation']; // Récupère l'ID de la formation à partir des données POST

        if (!isset($_SESSION['panier'])) { // Vérifie si la variable de session 'panier' n'est pas encore initialisée
            $_SESSION['panier'] = []; // Initialise la variable de session 'panier' comme un tableau vide si elle n'existe pas
        }

        if (!in_array($idFormation, $_SESSION['panier'])) { // Vérifie si l'ID de la formation n'est pas déjà dans le panier
            $_SESSION['panier'][] = $idFormation; // Ajoute l'ID de la formation au panier s'il n'est pas déjà présent
            echo json_encode(['success' => true, 'message' => 'Formation ajoutée au panier', 'panier' => $_SESSION['panier']]); // Retourne une réponse JSON indiquant que la formation a été ajoutée avec succès au panier, avec le contenu actuel du panier
        } else { // Sinon, si l'ID de la formation est déjà dans le panier
            echo json_encode(['success' => false, 'message' => 'Cette formation est déjà dans votre panier']); // Retourne une réponse JSON indiquant que la formation est déjà dans le panier
        }

    } else { // Sinon, si l'ID de la formation est manquant dans les données POST
        echo json_encode(['success' => false, 'message' => 'ID de formation manquant']); // Retourne une réponse JSON indiquant que l'ID de la formation est manquant
    }

} else { // Sinon, si la requête HTTP n'est pas de type POST
    echo json_encode(['success' => false, 'message' => 'Requête non valide']); // Retourne une réponse JSON indiquant que la requête est invalide
}
?>
