<?php
$mysqli = new Mysqli('localhost', 'root', '', 'entreprise');

// serveur
// Login
// MDP
// BDD

// echo '<pre>';
// var_dump($mysqli).'<br>';
// print_r($mysqli).'<br>';
// echo '</pre>';
/*
methode (fonction) Query() : méthode de l'objet $mysqli
val de retour :
SELECT - SHOW :
succès : Mysqli_result (obj) ==> stocker le résultat
echec : false

UPDATE - INSERT - REPLACE - DELETE :
succès : true
echec : false
*/

// 0 : erreur volontaire de requete
// $mysqli->query('mklu,il,ugohi,u');
// echo $mysqli->error; // erreur SQL
// erreurs SQL non affichées par défaut

// 1 : INSERT
$mysqli->query("INSERT into employes(prenom, nom, service, sexe, salaire, date_embauche) VALUES ('Yakine', 'Hamida', 'informatique', 'm', 5000, curdate())");

// 2 : SELECT (un seul résultat)
$resultat = $mysqli->query('SELECT * FROM employes WHERE id_employes=780');
//resultat = objet de la classe Mysqli_result (et est inexploitable)
$employe = $resultat->fetch_assoc(); // crée un tableau indexé avec les noms des champs de la table (indexation associative) PAR en enregistrement
// il existe
// fetch_row : indexation numérique
// fetch_array : = fetch_row + fetch_assoc


echo '<pre>';
print_r($resultat);
print_r($employe);
echo '</pre>';

echo 'Prénom : '.$employe['prenom'];
// 3 : SELECT (plusieurs résultats)
$resultat = $mysqli->query('SELECT * FROM employes'); // crée un tableau indexé avec les noms des champs de la table (indexation associative) PAR en enregistrement ==> besoin d'une boucle
// qui se comporte comme un curseur qui parcourt chaque enregistrement, pendant fetch_assoc, les indexes...
// un seul résultat ==> pas de boucle
// plusieurs résultats ==> une boucle
// si normalement , mais potentiellement plusiueurs résirltats ==> boucle

while ($employes = $resultat->fetch_assoc()){
    echo '<pre>';
    print_r($employes);
    echo '</pre>';
}

// 4 : Dupliquer une table SQD en tableau html
$resultat = $mysqli->query('SELECT * FROM employes');

echo '<table border=1>';
echo '<tr>';

while ($colonnes = $resultat->fetch_field()){
    echo '<th>';
        echo $colonnes->name;
    echo '</th>';
}

echo '</tr>';

while ($lignes = $resultat->fetch_assoc()){
    echo '<tr>';
    foreach($lignes as $val){
        echo '<td>';
            echo $val;
        echo '</td>';
    }
    echo '</tr>';
}
echo '</table>';
