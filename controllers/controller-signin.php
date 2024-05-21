<?php
session_start(); // Démarrage de la session

// Inclusion des modèles utilisateur.php et Panier.php
require_once '../models/utilisateur.php';
require_once '../models/Panier.php';

$errors = []; // Initialisation d'un tableau pour stocker les erreurs

if ($_SERVER['REQUEST_METHOD'] === 'POST') { // Vérification si la requête est de type POST
    if (empty($_POST['Email']) || empty($_POST['Mot_de_passe'])) { // Vérification si les champs Email et Mot_de_passe sont vides
        $errors['connexion'] = 'Veuillez remplir tous les champs'; // Ajout d'une erreur dans le tableau des erreurs
    } else {
        $email = $_POST['Email']; // Récupération de l'email depuis le formulaire
        $password = $_POST['Mot_de_passe']; // Récupération du mot de passe depuis le formulaire

        // Vérification de l'utilisateur dans la base de données
        $UserInfos = Utilisateur::getInfos($email); // Récupération des informations de l'utilisateur par son email

        if ($UserInfos && password_verify($password, $UserInfos['Mot_de_passe'])) { // Vérification du mot de passe
            // Stockage des informations de l'utilisateur dans la session
            $_SESSION["user"]["ID_utilisateur"] = $UserInfos['ID_utilisateur'];
            $_SESSION["user"]["Email"] = $UserInfos['Email'];
            $_SESSION["user"]["Nom"] = $UserInfos['Nom'];
            $_SESSION["user"]["Prenom"] = $UserInfos['Prenom'];

            // Chargement du panier de l'utilisateur depuis la base de données
            $_SESSION["panier"] = Panier::obtenirFormationsDuPanier($UserInfos['ID_utilisateur']);

            header('Location: controller-home.php'); // Redirection vers la page d'accueil après la connexion réussie
            exit; // Arrêt de l'exécution du script
        } else {
            $errors['connexion'] = 'Email ou mot de passe incorrect'; // Ajout d'une erreur si l'email ou le mot de passe est incorrect
        }
    }
}

// Inclusion de la vue view-signin.php pour afficher le formulaire de connexion
include_once '../views/view-signin.php';
?>
