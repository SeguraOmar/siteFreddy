<?php

class Utilisateur
{
    /**
     * Méthode permettant de créer un utilisateur
     *
     * @param string $Nom       Nom de l'utilisateur
     * @param string $Prenom      Prénom de l'utilisateur
     * @param string $Email         Adresse mail de l'utilisateur
     * @param string $Mot_de_passe      Mot de passe de l'utilisateur
     */
    public static function create(string $Nom, string $Prenom, string $Email, string $Mot_de_passe)
    {
        try {

            // Création de l'objet PDO pour la connexion à la BDD
            $db = new PDO('mysql:host=localhost;dbname=' . DB_NAME, DB_USER, DB_PASS);

            // Paramétrage des erreurs PDO pour les afficher en cas de problème
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Requête SQL pour insérer un utilisateur
            $sql = "INSERT INTO `utilisateur`(`Nom`, `Prenom`, `Email`, `Mot_de_passe`) VALUES (:Nom, :Prenom, :Email, :Mot_de_passe)";




            // Préparation de la requête pour éviter les injections SQL 
            $query = $db->prepare($sql);

            // On relie les paramètres à nos marqueurs nominatifs à l'aide d'un bindValue 
            $query->bindValue(':Nom', htmlspecialchars($Nom), PDO::PARAM_STR);
            $query->bindValue(':Prenom', htmlspecialchars($Prenom), PDO::PARAM_STR);
            $query->bindValue(':Email', htmlspecialchars($Email), PDO::PARAM_STR);
            // Password_default permet à PHP de s'adapter automatiquement pour sécuriser le mot de passe de l'utilisateur 
            $query->bindValue(':Mot_de_passe', password_hash($Mot_de_passe, PASSWORD_DEFAULT), PDO::PARAM_STR);

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
     * @param string $Email       Adresse mail de l'utilisateur
     * @return bool                     Retourne true si l'utilisateur existe, false sinon
     */
    public static function findByEmail(string $Email): bool
    {
        try {
            // Création de l'objet PDO pour la connexion à la BDD
            $db = new PDO('mysql:host=localhost;dbname=' . DB_NAME, DB_USER, DB_PASS);

            // Paramétrage des erreurs PDO pour les afficher en cas de problème
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Requête SQL pour trouver un utilisateur par son email
            $sql = "SELECT * FROM `utilisateur` WHERE `Email` = :Email";

            // Préparation de la requête pour éviter les injections SQL 
            $query = $db->prepare($sql);

            // On relie les paramètres à nos marqueurs nominatifs à l'aide d'un bindValue 
            $query->bindValue(':Email', htmlspecialchars($Email), PDO::PARAM_STR);

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
     * @param string $Email       Adresse mail de l'utilisateur
     * @return array|bool              Retourne un tableau contenant les informations de l'utilisateur ou false si l'utilisateur n'existe pas
     */
    public static function getInfos(string $Email): array
    {
        try {
            // Création de l'objet PDO pour la connexion à la BDD
            $db = new PDO('mysql:host=localhost;dbname=' . DB_NAME, DB_USER, DB_PASS);

            // Paramétrage des erreurs PDO pour les afficher en cas de problème
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Requête SQL pour trouver un utilisateur par son email
            $sql = "SELECT * FROM `utilisateur` WHERE `Email` = :Email";

            // Préparation de la requête pour éviter les injections SQL 
            $query = $db->prepare($sql);

            // On relie les paramètres à nos marqueurs nominatifs à l'aide d'un bindValue 
            $query->bindValue(':Email', htmlspecialchars($Email), PDO::PARAM_STR);

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
