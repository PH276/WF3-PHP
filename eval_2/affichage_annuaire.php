<?php
$pdo = new PDO('mysql:host=localhost;dbname=repertoire', 'root', '', array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING
) );


$resultat = $pdo->query('SELECT * FROM annuaire');
echo "<h1>Liste des entrées dans l'annuaire</h1>";

// style="border:5px solid red red yellow yellow"
echo '<table border=10 style="border-top:10px solid #ff7fff;border-right:10px solid red;border-bottom:10px solid red;border-left:10px solid #ff7fff">';
echo '<tr>';

for($i=0;$i < $resultat->columnCount();$i++){
    $colonne = $resultat->getColumnMeta($i);
    echo '<th>';
    echo $colonne['name'];
    echo '</th>';
}

echo '</tr>';
$contacts = $resultat->fetchAll(PDO::FETCH_ASSOC);

foreach ($contacts as $val){
    echo '<tr>';
    foreach($val as $val2){
        echo '<td>';
        echo $val2;
        echo '</td>';
    }
    echo '</tr>';
}
echo '</table>';

$resultat = $pdo->query('SELECT sexe, count(*) AS nb_sexe FROM annuaire GROUP BY sexe');
$res=$resultat->fetchAll();

echo '<br>il y a '.$res[0][1].' homme(s) et '.$res[1][1].' femmes(s)';

 ?>
