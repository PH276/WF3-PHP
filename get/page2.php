<?php
if (!empty($_GET)){

    echo '<pre>';
    print_r($_GET);
    echo '</pre>';

    echo 'parametre 1 : '.$_GET['article'].'<br>';
    echo 'parametre 2 : '.$_GET['couleur'].'<br>';
    echo 'parametre 3 : '.$_GET['prix'].'€ <br>';

}
/*
?article=jean&couleur=bleu&prix=10 

*/






?>

<h1>Page 2</h1>
<a href="page1.php">retour vers page1</a>
