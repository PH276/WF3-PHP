<?php
session_start(); // fn qui va créer un fichier de session. ou qui l'ouvre s'il exsite
$_SESSION['pseudo']='Yakine';
echo  '<pre>';
print_r($_SESSION);
echo  '</pre>';

$_SESSION['email'] = 'yakine.hamida@evogue.fr';

echo  '<pre>';
print_r($_SESSION);
echo  '</pre>';

// unset($_SESSION['email']); // vide la partie nommée 'email' de session

//session_destroy(); //supprime le fichier de session

 ?>
