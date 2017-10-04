<?php
$pdo = new PDO("mysql:host=localhost;dbname=exercice_3", 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

$contenu = '';

$resultat = $pdo->prepare('SELECT * FROM movies WHERE id_movies=:id');
$resultat->bindParam(':id', $_GET['id'], PDO::PARAM_STR);
$resultat->execute();

if ($resultat->rowCount() > 0){
    $film = $resultat -> fetch(PDO::FETCH_ASSOC);
    
    $contenu .= '<ul>Fiche du film :';
    foreach ($film as $key => $value) {
        if ($key != 'id_movies'){
            $contenu .= "<li>$key : $value</li>";
        }
    }
    $contenu .= '</ul>';
}
else{
    $contenu = "le film n'existe pas<br>";
}

echo $contenu;
?>
<a href="films.php">affichage des films </a>
