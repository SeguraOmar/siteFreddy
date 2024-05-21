<?php 

require_once '../config/config.php';
require_once '../models/utilisateur.php';

// Vérifier si le formulaire de connexion est soumis
if(isset($_POST['login_submit'])) {
    header("Location: ../controllers/controller-signin.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = [];
    
    // Vérification du nom
    if (empty($_POST["Nom"])) {
        $errors["Nom"] = "Le nom est obligatoire.";
    } else if (!preg_match("/^[a-zA-ZÀ-ÿ\-\d ]+$/" , $_POST["Nom"])) {
        $errors["Nom"] = "Le nom n'est pas valide.";
    }

    // Vérification du prénom
    if (empty($_POST["Prenom"])) {
        $errors["Prenom"] = "Le prénom est obligatoire.";
    } else if (!preg_match("/^[a-zA-ZÀ-ÿ\-\d ]+$/" , $_POST["Prenom"])) {
        $errors["Prenom"] = "Le prénom n'est pas valide.";
    }

    // Vérification de l'email 
    // Ajout d'une condition pour qu'on ne puisse pas s'inscrire avec une adresse email déjà existante

    if (empty($_POST["Email"])) {
        $errors["Email"] = "L'email est obligatoire.";
    } else if (!filter_var($_POST["Email"], FILTER_VALIDATE_EMAIL)) {
        $errors["Email"] = "L'email n'est pas valide.";
    }  else if (Utilisateur::findByEmail($_POST["Email"])) {
        $errors["Email"] = "L'email est déjà utilisé.";
    }

    // Vérification du mot de passe 
    $Mot_de_passe = $_POST["Mot_de_passe"];
    $confirm_password = $_POST["confirm_password"];
    if (empty($Mot_de_passe) || strlen($Mot_de_passe) < 8 || $Mot_de_passe !== $confirm_password) {
        $errors['Mot_de_passe'] = "Le mot de passe doit comporter au moins 8 caractères et correspondre.";
    }

    if (empty($errors)) {

        try {
             
            $Nom = $_POST["Nom"];
            $Prenom = $_POST["Prenom"];
            $Email = $_POST["Email"];
            $Mot_de_passe = $_POST["Mot_de_passe"];

            Utilisateur::create($Nom, $Prenom, $Email, $Mot_de_passe);
            $_SESSION['success_message'] = "Vous pouvez maintenant vous connecter.";
            if (isset($_SESSION['success_message'])) {
                $success_message = $_SESSION['success_message'];
                unset($_SESSION['success_message']);
            }
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
            die();
        }

        
    }
    
    
}

include_once '../views/view-signup.php';
exit();


?>
