<?php
require_once '../config/config.php';

class Panier
{
    // Méthode pour ajouter une formation au panier d'un utilisateur
    public static function ajouterAuPanier(int $ID_utilisateur, int $ID_formation)
    {
        try {
            $db = new PDO('mysql:host=localhost;dbname=' . DB_NAME, DB_USER, DB_PASS);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "INSERT INTO utilisateur_formation (ID_utilisateur, ID_formation) VALUES (:ID_utilisateur, :ID_formation)";
            $query = $db->prepare($sql);
            $query->bindValue(':ID_utilisateur', $ID_utilisateur, PDO::PARAM_INT);
            $query->bindValue(':ID_formation', $ID_formation, PDO::PARAM_INT);
            $query->execute();
        } catch (PDOException $e) {
            // Gérer les erreurs
            echo 'Erreur : ' . $e->getMessage();
            die();
        }
    }

    // Méthode pour récupérer les formations ajoutées au panier par un utilisateur
    public static function obtenirFormationsDuPanier(int $ID_utilisateur)
    {
        try {
            $db = new PDO('mysql:host=localhost;dbname=' . DB_NAME, DB_USER, DB_PASS);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT formation.* 
                    FROM formation 
                    INNER JOIN utilisateur_formation 
                    ON formation.ID_formation = utilisateur_formation.ID_formation 
                    WHERE utilisateur_formation.ID_utilisateur = :ID_utilisateur";
            $query = $db->prepare($sql);
            $query->bindValue(':ID_utilisateur', $ID_utilisateur, PDO::PARAM_INT);
            $query->execute();

            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Gérer les erreurs
            echo 'Erreur : ' . $e->getMessage();
            die();
        }
    }

    // Méthode pour récupérer les détails d'une formation par son ID
    public static function obtenirDetailsFormation(int $ID_formation)
    {
        try {
            $db = new PDO('mysql:host=localhost;dbname=' . DB_NAME, DB_USER, DB_PASS);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT * FROM formation WHERE ID_formation = :ID_formation";
            $query = $db->prepare($sql);
            $query->bindValue(':ID_formation', $ID_formation, PDO::PARAM_INT);
            $query->execute();

            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Gérer les erreurs
            echo 'Erreur : ' . $e->getMessage();
            die();
        }
    }

    // Méthode pour récupérer une formation par son ID
    public static function getFormationById($id)
    {
        try {
            $db = new PDO('mysql:host=localhost;dbname=' . DB_NAME, DB_USER, DB_PASS);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT ID_formation, Titre, Description, Durée, Prix
                    FROM formation
                    WHERE ID_formation = :id;";
            $query = $db->prepare($sql);
            $query->bindParam(':id', $id, PDO::PARAM_INT);
            $query->execute();

            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
            die();
        }
    }

    // Méthode pour supprimer une formation du panier d'un utilisateur
    public static function supprimerDuPanier(int $ID_utilisateur, int $ID_formation)
    {
        try {
            $db = new PDO('mysql:host=localhost;dbname=' . DB_NAME, DB_USER, DB_PASS);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "DELETE FROM utilisateur_formation WHERE ID_utilisateur = :ID_utilisateur AND ID_formation = :ID_formation";
            $query = $db->prepare($sql);
            $query->bindValue(':ID_utilisateur', $ID_utilisateur, PDO::PARAM_INT);
            $query->bindValue(':ID_formation', $ID_formation, PDO::PARAM_INT);
            $query->execute();
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
            die();
        }
    }
}
