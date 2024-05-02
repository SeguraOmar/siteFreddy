<?php

class Utilisateur
{
    /**
     * Méthode permettant de créer un utilisateur
     *
     * @param string $user_lastname       Nom de l'utilisateur
     * @param string $user_firstname      Prénom de l'utilisateur
     * @param string $user_email          Adresse mail de l'utilisateur
     * @param string $user_password       Mot de passe de l'utilisateur
     */
    public static function create(string $user_lastname, string $user_firstname, string $user_email, string $user_password)
    {
        try {

            // Création de l'objet PDO pour la connexion à la BDD
            $db = new PDO('mysql:host=localhost;dbname=' . DB_NAME, DB_USER, DB_PASS);

            // Paramétrage des erreurs PDO pour les afficher en cas de problème
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Requête SQL pour insérer un utilisateur
            $sql = "INSERT INTO `utilisateur`(`user_lastname`, `user_firstname`, `user_email`, `user_password`) VALUES (:user_lastname, :user_firstname, :user_email, :user_password)";




            // Préparation de la requête pour éviter les injections SQL 
            $query = $db->prepare($sql);

            // On relie les paramètres à nos marqueurs nominatifs à l'aide d'un bindValue 
            $query->bindValue(':user_lastname', htmlspecialchars($user_lastname), PDO::PARAM_STR);
            $query->bindValue(':user_firstname', htmlspecialchars($user_firstname), PDO::PARAM_STR);
            $query->bindValue(':user_email', htmlspecialchars($user_email), PDO::PARAM_STR);
            // Password_default permet à PHP de s'adapter automatiquement pour sécuriser le mot de passe de l'utilisateur 
            $query->bindValue(':user_password', password_hash($user_password, PASSWORD_DEFAULT), PDO::PARAM_STR);

            // Execution de la requête 
            $query->execute();
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
            die();
        }
    }

    /**
     * Méthode permettant de trouver un utilisateur par son email
     *
     * @param string $user_email       Adresse mail de l'utilisateur
     * @return bool                     Retourne true si l'utilisateur existe, false sinon
     */
    public static function findByEmail(string $user_email): bool
    {
        try {
            // Création de l'objet PDO pour la connexion à la BDD
            $db = new PDO('mysql:host=localhost;dbname=' . DB_NAME, DB_USER, DB_PASS);

            // Paramétrage des erreurs PDO pour les afficher en cas de problème
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Requête SQL pour trouver un utilisateur par son email
            $sql = "SELECT * FROM `utilisateur` WHERE `user_email` = :user_email";

            // Préparation de la requête pour éviter les injections SQL 
            $query = $db->prepare($sql);

            // On relie les paramètres à nos marqueurs nominatifs à l'aide d'un bindValue 
            $query->bindValue(':user_email', htmlspecialchars($user_email), PDO::PARAM_STR);

            // Execution de la requête 
            $query->execute();

            // Récupération du nombre de résultats
            $count = $query->rowCount();

            // On retourne true si l'utilisateur existe, false sinon
            return $count > 0;
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
            die();
        }
    }

    /**
     * Méthode permettant de récupérer les informations d'un utilisateur
     *
     * @param string $user_email       Adresse mail de l'utilisateur
     * @return array|bool              Retourne un tableau contenant les informations de l'utilisateur ou false si l'utilisateur n'existe pas
     */
    public static function getInfos(string $user_email): array
    {
        try {
            // Création de l'objet PDO pour la connexion à la BDD
            $db = new PDO('mysql:host=localhost;dbname=' . DB_NAME, DB_USER, DB_PASS);

            // Paramétrage des erreurs PDO pour les afficher en cas de problème
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Requête SQL pour trouver un utilisateur par son email
            $sql = "SELECT * FROM `utilisateur` WHERE `user_email` = :user_email";

            // Préparation de la requête pour éviter les injections SQL 
            $query = $db->prepare($sql);

            // On relie les paramètres à nos marqueurs nominatifs à l'aide d'un bindValue 
            $query->bindValue(':user_email', htmlspecialchars($user_email), PDO::PARAM_STR);

            // Execution de la requête 
            $query->execute();

            // Récupération des résultats de la requête
            $result = $query->fetch(PDO::FETCH_ASSOC);

            // On retourne les résultats
            return $result;
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
            die();
        }
    }
    
}
