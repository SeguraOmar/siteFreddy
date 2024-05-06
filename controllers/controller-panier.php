<?php 

session_start();

include_once '../config/config.php';
include_once '../models/formation.php';

if (isset($_POST['add_to_cart'])) {
    $formation_id = $_POST['id_formation'];

    if (!isset($_SESSION['panier'])) {
        $_SESSION['panier'] = [];
    }

    // Ajoute l'ID de la formation au panier 
    $_SESSION['panier'][] = $formation_id;

    // Redirige l'utilisateur vers la page du panier
    header('Location: controller-panier.php');
    exit();
}

require_once '../views/view-panier.php';