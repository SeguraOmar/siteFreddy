<?php
session_start(); // Démarrage de la session

// Activation du rapport d'erreurs pour afficher toutes les erreurs
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (!isset($_SESSION['user']['ID_utilisateur'])) { // Vérifie si l'utilisateur est connecté en vérifiant la présence de son ID utilisateur dans la session
    // Redirection vers la page de connexion si l'utilisateur n'est pas connecté
    header('Location: controller-home.php');
    exit(); // Arrêt de l'exécution du script
}

require_once '../config/config.php'; // Inclusion du fichier de configuration
require_once '../models/Panier.php'; // Inclusion du modèle Panier

$userId = $_SESSION['user']['ID_utilisateur']; // Récupération de l'ID de l'utilisateur à partir de la session

// Gestion de la suppression d'une formation du panier
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'supprimer') {
    $idFormation = intval($_POST['id_formation']); // Récupération de l'ID de la formation à supprimer

    // Suppression de la formation du panier dans la base de données
    Panier::supprimerDuPanier($userId, $idFormation);

    // Suppression de la formation du panier dans la session
    if (($key = array_search($idFormation, $_SESSION['panier'])) !== false) { // Recherche de la clé correspondant à l'ID de la formation dans le panier
        unset($_SESSION['panier'][$key]); // Suppression de l'élément du panier correspondant à l'ID de la formation
    }
}

// Vérification si le panier n'est pas vide
if (!empty($_SESSION['panier'])) {
    // Initialisation d'un tableau pour stocker les détails des formations dans le panier
    $formationsPanier = array();

    // Boucle pour parcourir chaque formation dans le panier
    foreach ($_SESSION['panier'] as $idFormation) {
        // Récupération des informations de la formation à partir de son ID
        $formation = Panier::getFormationById($idFormation);
        if ($formation) {
            // Ajout des détails de la formation au tableau
            $formationsPanier[] = $formation;
        } else {
            // Ajout d'un message si la formation n'est pas trouvée
            $formationsPanier[] = array('ID_formation' => $idFormation, 'Titre' => 'Formation introuvable', 'Prix' => '');
        }
    }
} else {
    // Si le panier est vide, initialisation du tableau des formations à afficher comme vide
    $formationsPanier = array();
}

// Inclusion de la vue pour afficher le panier
include_once '../views/view-panier.php';
?>
