<?php 

include_once '../config/config.php';
include_once '../models/formation.php';


// Données JSON
$json_data = '[
    {"type":"header","version":"5.2.1","comment":"Export to JSON plugin for PHPMyAdmin"},
    {"type":"database","name":"sitedeformation"},
    {"type":"table","name":"cours","database":"sitedeformation","data":
    [
        {"ID_cours":"1","cours_titre":"Fondamentaux du Cloud Computing","cours_description":"Ce cours explore les concepts de base du Cloud Computing, y compris les modèles de déploiement et les services Cloud.","cours_prix":"59.99"},
        {"ID_cours":"2","cours_titre":"Architecture Cloud","cours_description":"Ce cours examine les principes de conception d\'architectures Cloud évolutives et hautement disponibles.","cours_prix":"89.99"},
        {"ID_cours":"3","cours_titre":"Sécurité dans le Cloud","cours_description":"Ce cours aborde les meilleures pratiques de sécurité pour les environnements Cloud, y compris la gestion des identités et des accès.","cours_prix":"79.99"}
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





require_once '../views/view-cloud.php';