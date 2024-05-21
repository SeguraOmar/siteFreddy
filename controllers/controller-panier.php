<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (!isset($_SESSION['user']['ID_utilisateur'])) {
    // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    header('Location: controller-home.php');
    exit();
}

require_once '../config/config.php';
require_once '../models/Panier.php';

$userId = $_SESSION['user']['ID_utilisateur'];

// Gestion de la suppression du panier
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'supprimer') {
    $idFormation = intval($_POST['id_formation']);
    
    // Supprimer la formation du panier en base de données
    Panier::supprimerDuPanier($userId, $idFormation);
    
    // Supprimer la formation du panier dans la session
    if (($key = array_search($idFormation, $_SESSION['panier'])) !== false) {
        unset($_SESSION['panier'][$key]);
    }
}

// Vérifier si le panier n'est pas vide
if (!empty($_SESSION['panier'])) {
    // Initialiser un tableau pour stocker les détails des formations dans le panier
    $formationsPanier = array();

    // Boucle pour parcourir chaque formation dans le panier
    foreach ($_SESSION['panier'] as $idFormation) {
        // Récupérer les informations de la formation à partir de son ID
        $formation = Panier::getFormationById($idFormation);
        if ($formation) {
            // Ajouter les détails de la formation au tableau
            $formationsPanier[] = $formation;
        } else {
            // Ajouter un message si la formation n'est pas trouvée
            $formationsPanier[] = array('ID_formation' => $idFormation, 'Titre' => 'Formation introuvable', 'Prix' => '');
        }
    }
} else {
    // Si le panier est vide, initialiser le tableau des formations à afficher comme vide
    $formationsPanier = array();
}

include_once '../views/view-panier.php';
?>
