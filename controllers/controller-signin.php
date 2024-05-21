<?php
session_start();
require_once '../models/utilisateur.php';
require_once '../models/Panier.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($_POST['Email']) || empty($_POST['Mot_de_passe'])) {
        $errors['connexion'] = 'Veuillez remplir tous les champs';
    } else {
        $email = $_POST['Email'];
        $password = $_POST['Mot_de_passe'];

        // Vérification de l'utilisateur
        $UserInfos = Utilisateur::getInfos($email);

        if ($UserInfos && password_verify($password, $UserInfos['Mot_de_passe'])) {
            $_SESSION["user"]["ID_utilisateur"] = $UserInfos['ID_utilisateur'];
            $_SESSION["user"]["Email"] = $UserInfos['Email'];
            $_SESSION["user"]["Nom"] = $UserInfos['Nom'];
            $_SESSION["user"]["Prenom"] = $UserInfos['Prenom'];

            // Charger le panier depuis la base de données
            $_SESSION["panier"] = Panier::obtenirFormationsDuPanier($UserInfos['ID_utilisateur']);

            header('Location: controller-home.php');
            exit;
        } else {
            $errors['connexion'] = 'Email ou mot de passe incorrect';
        }
    }
}

include_once '../views/view-signin.php';
?>
