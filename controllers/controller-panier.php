<?php

require_once '../config/config.php';
require_once '../models/Panier.php';

session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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



