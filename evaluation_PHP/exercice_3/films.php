<?php

$pdo = new PDO("mysql:host=localhost;dbname=exercice_3", 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

$resultat = $pdo->query('SELECT id_movies, title, director, year_of_prod FROM movies');
$films = $resultat -> fetchAll(PDO::FETCH_ASSOC);

$contenu = '<table border=1>';
$entete = array ('titre', 'réalisateur', 'année de production') ;

$contenu .= '<tr>';

foreach ($entete as $value) {
    $contenu .=  '<th>';
    $contenu .=  $value ;
    $contenu .= '</th>';
}


$contenu .= '</tr>';
foreach ($films as $val){
    $contenu .= '<tr>';
    foreach($val as $key => $val2){
        if ($key != 'id_movies'){
            $contenu .= '<td>';
            $contenu .=  $val2;
            $contenu .= '</td>';
        }
    }
    $contenu .= '<td>';
    $contenu .= '<a href="film.php?id='.$val['id_movies'].'">plus d\'infos</a>';
    $contenu .= '</td>';
    $contenu .= '</tr>';
}
$contenu .= '</table>';
echo $contenu;
