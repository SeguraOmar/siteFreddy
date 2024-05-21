<?php

require_once '../config/config.php';

class Formation
{
    // Méthode pour récupérer les formations liées à l'intelligence artificielle (IA)
    public static function getFormationIA()
    {
        try {
            // Établir une connexion à la base de données
            $db = new PDO('mysql:host=localhost;dbname=' . DB_NAME, DB_USER, DB_PASS);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Requête SQL pour sélectionner les formations liées à l'IA
            $sql = "SELECT ID_formation, Titre, Description, Durée, Prix
                    FROM formation
                    WHERE Titre LIKE '%IA%' OR Description LIKE '%IA%';"; // Recherche par titre ou description
            $query = $db->prepare($sql);
            $query->execute();

            // Renvoyer les résultats sous forme de tableau associatif
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Gérer les erreurs PDO
            echo 'Erreur : ' . $e->getMessage();
            die();
        }
    }

    // Méthode pour récupérer les formations liées au cloud
    public static function getFormationCloud()
    {
        try {
            // Établir une connexion à la base de données
            $db = new PDO('mysql:host=localhost;dbname=' . DB_NAME, DB_USER, DB_PASS);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Requête SQL pour sélectionner les formations liées au cloud
            $sql = "SELECT ID_formation, Titre, Description, Durée, Prix
                    FROM formation
                    WHERE Titre LIKE '%Cloud%' OR Description LIKE '%Cloud%';"; // Recherche par titre ou description
            $query = $db->prepare($sql);
            $query->execute();

            // Renvoyer les résultats sous forme de tableau associatif
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Gérer les erreurs PDO
            echo 'Erreur : ' . $e->getMessage();
            die();
        }
    }
}
