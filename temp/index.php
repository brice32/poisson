<?php
define('Poisson', '');
define('ROOT_PATH', '__DIR__');
define('APPLICATION_PATH', 'ROOT_PATH' . '/application');
require_once './utilisateur.php';
require_once './groupe.php';
require './apparence.php';
$nom = "WANG";
$prenom = "Yuchen";
$app = new Utilisateur($nom, $prenom);
$app->direBonjour();
require './apparence.php';
?>
