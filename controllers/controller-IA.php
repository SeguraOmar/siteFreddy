<?php 

include_once '../config/config.php';
include_once '../models/formation.php';


// Données JSON
$json_data = '[
    {"type":"header","version":"5.2.1","comment":"Export to JSON plugin for PHPMyAdmin"},
    {"type":"database","name":"sitedeformation"},
    {"type":"table","name":"cours","database":"sitedeformation","data":
    [
        {"ID_cours":"4","cours_titre":"Intelligence Artificielle dans le Monde Numérique","cours_description":"Découvrez les fondements de l\'intelligence artificielle et son application dans le monde numérique.","cours_prix":"49.99"},
        {"ID_cours":"5","cours_titre":"Modèles de Langage comme ChatGPT et ses Semblables","cours_description":"Explorez les modèles de langage avancés comme ChatGPT, leurs fonctionnalités et leurs applications.","cours_prix":"59.99"},
        {"ID_cours":"11","cours_titre":"Introduction à l\'Intelligence Artificielle pour Débutants","cours_description":"Découvrez les bases de l\'intelligence artificielle, y compris les concepts fondamentaux, les algorithmes populaires et leurs applications.","cours_prix":"29.99"}
    ]
    }
]';

// Convertir le JSON en tableau associatif PHP
$data = json_decode($json_data, true);

// Récupérer les données des cours
$cours = $data[2]['data'];

// Formater les données pour les rendre fonctionnelles dans la vue
$formations = [];
foreach ($cours as $cours_item) {
    $formation = [
        'titre' => $cours_item['cours_titre'],
        'description' => $cours_item['cours_description'],
        'prix' => $cours_item['cours_prix']
    ];
    $formations[] = $formation;
}

require_once '../views/view-IA.php';