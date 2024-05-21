<?php 

include_once '../config/config.php';
include_once '../models/formation.php';
include_once '../models/panier.php';


$formationsCloud = Formation::getFormationCloud();

require_once '../views/view-cloud.php';