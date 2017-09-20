<?php
if (isset($_GET['lang'])){
    $langue = $_GET['lang'];
}
elseif (isset($_COOKIE['lang'])){ // cela signifie était déjà venu et j'avais déjà enregistré son choix dans un cookie
    $langue = $_COOKIE['lang'];
}
else { // ni cookie ni get précisant la langue , il est possible que l'utilisateur vienne pour la 1ère fois et que la langue par défaut lui convienne très bien
    $langue = 'fr';
}

setCookie('lang', $langue, time() + 365 * 24 * 3600);
/* permet de créer un cookie . 3 arguments
1 : nom du cookie
2 : valeur du cookie
3 : date d'expiration (timestamp)
*/

switch ($langue) {
    case 'fr':
        echo 'Bonjour. Bienvenue !';
    break;

    case 'es':
        echo 'Hola. Bienvenido !';
    break;

    case 'en':
        echo 'Hi, you\'re welcome!';
    break;

    case 'it':
        echo 'Buonjorno. Benvenuto !';
    break;

    default:
        echo 'Veuillez choisir une langue dans la liste présente !';
    break;
}

?>

<ul>
    <li><a href="?lang=fr">France</a></li>
    <li><a href="?lang=it">Italie</a></li>
    <li><a href="?lang=en">Angleterre</a></li>
    <li><a href="?lang=es">Espagne</a></li>
</ul>
<hr>
