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
    succès : Mysqli_result (obj)
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

// 3 : SELECT (plusieurs résultats)
// $req = $ysqli->query('SELECT * FROM employes');

// 4 : Dupliquer une table SQD en tableau html
