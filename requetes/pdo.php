<?php
// PDO : PHP Data Object
$pdo = new PDO('mysql:host=localhost;dbname=entreprise', 'root', '', array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING
) );


// serveur;BDD
// Login
// MDP
/*
méthodes PDO :
- query()
- exec()
- prepare
- execute()

*/



// echo '<pre>';
// var_dump($pdo).'<br>';
// print_r($pdo).'<br>';
// echo '</pre>';
/*
methode (fonction) Query() : méthode de l'objet $pdo
val de retour :
SELECT - SHOW :
succès : PDOStatement (obj) ==> stocker le résultat
echec : false

UPDATE - INSERT - REPLACE - DELETE :
succès : true
echec : false
*/

// 0 : erreur volontaire de requete
//$pdo->query('mklu,il,ugohi,u');
// echo $pdo->error; // erreur SQL
// erreurs SQL non affichées par défaut
// Pour les afficher on ajoute de le moxde d'erreur WARNING au moment de la connexion à la BDD (option PDO)

// 1 : DELETE
$pdo->query("DELETE FROM employes WHERE prenom='Yakine'");
// 2 : SELECT (un seul résultat)
$resultat = $pdo->query('SELECT * FROM employes WHERE id_employes=780');
var_dump($resultat);

//resultat = objet de la classe pdo_result (et est inexploitable)
$employe = $resultat->fetch(PDO::FETCH_ASSOC); // crée un tableau indexé avec les noms des champs de la table (indexation associative) PAR en enregistrement
// il existe
// PDO::FETCH_ASSOC : indexation associative
// PDO::FETCH_NUM : indexation numérique
// PDO::FETCH_OBJ : indexation sous forme d'objet (les noms des champs sont les propriétés de l'objet)
// 0 argument : indexation associative & indexation numérique
// mais cela est réglable ds les options PDO

echo '<pre>';
print_r($resultat);
print_r($employe);
echo '</pre>';

echo 'Prénom : '.$employe['prenom'];

// 3 : SELECT (plusieurs résultats)
$resultat = $pdo->query('SELECT * FROM employes'); // crée un tableau indexé avec les noms des champs de la table (indexation associative) PAR en enregistrement ==> besoin d'une boucle
// qui se comporte comme un curseur qui parcourt chaque enregistrement, pendant fetch_assoc, les indexes...
// un seul résultat ==> pas de boucle
// plusieurs résultats ==> une boucle
// si normalement , mais potentiellement plusiueurs résirltats ==> boucle
echo '<br>Nombre d\'employes : '.$resultat->rowCount().'<br>';

while ($employes = $resultat->fetch(PDO::FETCH_ASSOC)){
    echo '<pre>';
    print_r($employes);
    echo '</pre>';
}
// 3.2 : SELECT (plusieurs résultats + fetchAll)
$resultat = $pdo->query('SELECT * FROM employes'); // crée un tableau indexé avec les noms des champs de la table (indexation associative) PAR en

$employes = $resultat->fetchAll();

echo '<pre>';
print_r($employes);
echo '</pre>';
// fetchAll est pratique car permet de récupérer directementun tableau multidimentionnel contenant ts les résultats de la requete. évite un fetch() ds une boucle


// 4 : Dupliquer une table SQD en tableau html

$resultat = $pdo->query('SELECT * FROM employes');
echo '<br>Nombre d\'employes : '.$resultat->rowCount().'<br>';

echo '<table border=1>';
echo '<tr>';

for($i=0;$i < $resultat->columnCount();$i++){
    $colonne = $resultat->getColumnMeta($i);
    echo '<th>';
    echo $colonne['name'];
    echo '</th>';
}

echo '</tr>';

foreach ($employes as $val){
    echo '<tr>';
    foreach($val as $val2){
        echo '<td>';
        echo $val2;
        echo '</td>';
    }
    echo '</tr>';
}
echo '</table>';
