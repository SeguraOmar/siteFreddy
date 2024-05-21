<?php

require_once '../config/config.php';

class Formation
{
    public static function getFormationIA()
    {
        try {
            $db = new PDO('mysql:host=localhost;dbname=' . DB_NAME, DB_USER, DB_PASS);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT ID_formation, Titre, Description, Durée, Prix
                    FROM formation
                    WHERE Titre LIKE '%IA%'
                       OR Description LIKE '%IA%';";
            $query = $db->prepare($sql);
            $query->execute();

            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
            die();
        }
    }

    public static function getFormationCloud()
    {

        try {
            $db = new PDO('mysql:host=localhost;dbname=' . DB_NAME, DB_USER, DB_PASS);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT ID_formation, Titre, Description, Durée, Prix
                    FROM formation
                    WHERE Titre LIKE '%Cloud%'
                       OR Description LIKE '%Cloud%';";
            $query = $db->prepare($sql);
            $query->execute();

            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
            die();
        }
    }
}
