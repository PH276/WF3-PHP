<?php
// Session
session_start();

// connexxion BDD
$pdo = new PDO("mysql:host=localhost;dbname=site", 'root', '', array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
));

//var
$msg = ''; // message pour l'utilisateur
$page = ''; // page en cours
$contenu = '';
// chemins
define('RACINE_SITE', '/PHP/site/');

// autres inclusions
require('fonctions.inc.php');
