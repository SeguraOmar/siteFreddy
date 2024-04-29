<?php

session_start();

require_once '../config/config.php';
require_once '../models/utilisateur.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = [];

    // Validation du champ e-mail
    if (empty($_POST['user_email'])) {
        $errors['user_email'] = 'Veuillez saisir votre E-Mail';
    }

    // Validation du champ mot de passe
    if (empty($_POST['user_password'])) {
        $errors['user_password'] = 'Veuillez saisir votre mot de passe';
    }

    // Si les champs sont valides, commence les tests
    if (empty($errors)) {
        // Vérification de l'existence de l'utilisateur avec la méthode findByEmail de la classe Utilisateur
        if (!Utilisateur::findByEmail($_POST['user_email'])) {
            $errors['user_email'] = 'Adresse mail inconnue';
        } else {
            // Récupération des informations de l'utilisateur via la méthode getInfos()
            $UserInfos = Utilisateur::getInfos($_POST['user_email']);
    
            // Utilisation de password_verify pour valider le mot de passe
            if ($UserInfos !== null && password_verify($_POST['user_password'], $UserInfos['user_password'])) {
                $_SESSION["user"] = $UserInfos;
                unset($_SESSION["user"]["user_password"]);
                // Si la validation du mot de passe est réussie, redirection vers controller-home.php
                header('Location: controller-home.php');
                exit;
            } else {
                // Sinon, ajout d'une erreur de connexion au tableau d'erreurs
                $errors['connexion'] = 'Mauvais mot de passe';
            }
        }
    }
    
}

include_once "../views/view-signin.php";
?>




