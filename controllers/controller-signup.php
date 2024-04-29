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
    if (empty($_POST["user_lastname"])) {
        $errors["user_lastname"] = "Le nom est obligatoire.";
    } else if (!preg_match("/^[a-zA-ZÀ-ÿ\-\d ]+$/" , $_POST["user_lastname"])) {
        $errors["user_lastname"] = "Le nom n'est pas valide.";
    }

    // Vérification du prénom
    if (empty($_POST["user_firstname"])) {
        $errors["user_firstname"] = "Le prénom est obligatoire.";
    } else if (!preg_match("/^[a-zA-ZÀ-ÿ\-\d ]+$/" , $_POST["user_firstname"])) {
        $errors["user_firstname"] = "Le prénom n'est pas valide.";
    }

    // Vérification de l'email 
    // Ajout d'une condition pour qu'on ne puisse pas s'inscrire avec une adresse email déjà existante

    if (empty($_POST["user_email"])) {
        $errors["user_email"] = "L'email est obligatoire.";
    } else if (!filter_var($_POST["user_email"], FILTER_VALIDATE_EMAIL)) {
        $errors["user_email"] = "L'email n'est pas valide.";
    }  else if (Utilisateur::findByEmail($_POST["user_email"])) {
        $errors["user_email"] = "L'email est déjà utilisé.";
    }

    // Vérification du mot de passe 
    $user_password = $_POST["user_password"];
    $confirm_password = $_POST["confirm_password"];
    if (empty($user_password) || strlen($user_password) < 8 || $user_password !== $confirm_password) {
        $errors['user_password'] = "Le mot de passe doit comporter au moins 8 caractères et correspondre.";
    }

    if (empty($errors)) {

        try {
             
            $user_lastname = $_POST["user_lastname"];
            $user_firstname = $_POST["user_firstname"];
            $user_email = $_POST["user_email"];
            $user_password = $_POST["user_password"];

            Utilisateur::create($user_lastname, $user_firstname, $user_email, $user_password);
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
