<?php 

include_once '../config/config.php';
include_once '../models/utilisateur.php';


$success_message = "";
$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $email = $_POST['email'];
    $message = $_POST['message'];
    
    // Adresse email de destination
    $to = "omarsegura76300@gmail.com";
    
    // Sujet de l'email
    $subject = "Formations";
    
    // Corps de l'email
    $body = "Email: " . $email . "\n\nMessage: " . $message;
    
    // En-têtes de l'email
    $headers = "From: " . $email;
    
    // Envoyer l'email
    if (mail($to, $subject, $body, $headers)) {
        $success_message = "Votre message a été envoyé avec succès.";
    } else {
        $error_message = "Une erreur s'est produite lors de l'envoi de votre message. Veuillez réessayer plus tard.";
    }
}



require_once '../views/view-contact.php';