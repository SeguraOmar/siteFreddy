<?php

require_once '../config/config.php'; // Inclusion du fichier de configuration
require_once '../models/utilisateur.php'; // Inclusion du modèle utilisateur.php

// Vérification si le formulaire de connexion est soumis
if (isset($_POST['login_submit'])) {
    header("Location: ../controllers/controller-signin.php"); // Redirection vers le contrôleur de connexion
    exit(); // Arrêt de l'exécution du script
}

if ($_SERVER["REQUEST_METHOD"] == "POST") { // Vérification si la requête est de type POST
    $errors = []; // Initialisation d'un tableau pour stocker les erreurs

    // Vérification du nom
    if (empty($_POST["Nom"])) {
        $errors["Nom"] = "Le nom est obligatoire."; // Message d'erreur si le nom est vide
    } else if (!preg_match("/^[a-zA-ZÀ-ÿ\-\d ]+$/", $_POST["Nom"])) {
        $errors["Nom"] = "Le nom n'est pas valide."; // Message d'erreur si le nom n'est pas valide
    }

    // Vérification du prénom
    if (empty($_POST["Prenom"])) {
        $errors["Prenom"] = "Le prénom est obligatoire."; // Message d'erreur si le prénom est vide
    } else if (!preg_match("/^[a-zA-ZÀ-ÿ\-\d ]+$/", $_POST["Prenom"])) {
        $errors["Prenom"] = "Le prénom n'est pas valide."; // Message d'erreur si le prénom n'est pas valide
    }

    // Vérification de l'email 
    if (empty($_POST["Email"])) {
        $errors["Email"] = "L'email est obligatoire."; // Message d'erreur si l'email est vide
    } else if (!filter_var($_POST["Email"], FILTER_VALIDATE_EMAIL)) {
        $errors["Email"] = "L'email n'est pas valide."; // Message d'erreur si l'email n'est pas valide
    } else if (Utilisateur::findByEmail($_POST["Email"])) {
        $errors["Email"] = "L'email est déjà utilisé."; // Message d'erreur si l'email est déjà utilisé
    }

    // Vérification du mot de passe 
    $Mot_de_passe = $_POST["Mot_de_passe"];
    $confirm_password = $_POST["confirm_password"];
    if (empty($Mot_de_passe) || strlen($Mot_de_passe) < 8 || $Mot_de_passe !== $confirm_password) {
        $errors['Mot_de_passe'] = "Le mot de passe doit comporter au moins 8 caractères et correspondre."; // Message d'erreur si le mot de passe n'est pas valide
    }

    if (empty($errors)) { // Vérification s'il n'y a pas d'erreurs

        try {
            // Récupération des données du formulaire
            $Nom = $_POST["Nom"];
            $Prenom = $_POST["Prenom"];
            $Email = $_POST["Email"];
            $Mot_de_passe = $_POST["Mot_de_passe"];

            // Création d'un nouvel utilisateur dans la base de données
            Utilisateur::create($Nom, $Prenom, $Email, $Mot_de_passe);
            $_SESSION['success_message'] = "Vous pouvez maintenant vous connecter."; // Message de succès après l'inscription
            if (isset($_SESSION['success_message'])) {
                $success_message = $_SESSION['success_message']; // Stockage du message de succès dans une variable
                unset($_SESSION['success_message']); // Suppression du message de succès de la session
            }
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage(); // Affichage de l'erreur PDO
            die();
        }
    }
}

include_once '../views/view-signup.php'; // Inclusion de la vue view-signup.php pour afficher le formulaire d'inscription
exit(); // Arrêt de l'exécution du script
