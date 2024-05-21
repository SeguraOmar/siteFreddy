<?php
session_start();

// Activer le rapport d'erreurs
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['id_formation'])) {
        $idFormation = $_POST['id_formation'];

        if (!isset($_SESSION['panier'])) {
            $_SESSION['panier'] = [];
        }

        if (!in_array($idFormation, $_SESSION['panier'])) {
            $_SESSION['panier'][] = $idFormation;
            echo json_encode(['success' => true, 'message' => 'Formation ajoutée au panier', 'panier' => $_SESSION['panier']]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Cette formation est déjà dans votre panier']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'ID de formation manquant']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Requête non valide']);
}
