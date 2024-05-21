<?php 

include_once '../config/config.php';
include_once '../models/formation.php';
include_once '../models/panier.php';


$formationsIA = Formation::getFormationIA();


require_once '../views/view-IA.php';