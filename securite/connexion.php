<?php
/*
injection SQl qui permet de détourner
---------
exemple 1 :
pseudo : juju'#
mdp :

    ==> SELECT * FROM membre WHERE pseudo = 'juju'#'' && mdp = ''

'#'permet de mettre de commentaires
exemple 2 :
pseudo : ' OR id_membre = 2'
  ==> SELECT * FROM membre WHERE pseudo = '' && mdp = '' OR id_membre = '2'
  id_membre = '2' existe ==> requete OK

  exemple 3
  pseudo :
  mdp : ' OR 1='1
  ==> SELECT * FROM membre WHERE pseudo = '' && mdp = '' OR 1='1'
  1='1' ==> OK

pseudo  : <div style="background:green;color:white;padding:5px">test</p>
mdp :

*/

session_start();
$pdo = new PDO('mysql:host=localhost;dbname=securite', 'root', '');

if (!empty($_POST)){
    extract($_POST);

    echo $pseudo.'<br>';
    echo $mdp.'<hr>';

    $pseudo = htmlentities(addslashes($pseudo));
    $mdp = htmlentities(addslashes($mdp));

    echo $pseudo.'<br>';
    echo $mdp.'<hr>';

    echo 'Après nettoyage';

    $req = "SELECT * FROM membre WHERE pseudo = '$pseudo' && mdp = '$mdp'";
    echo $req.'<hr>';
    $resultat = $pdo-> query ($req);

    if ($resultat->rowCount()>0){
        $membre = $resultat->fetch(PDO::FETCH_ASSOC);
        foreach($membre as $indice => $val){
            $_SESSION[$indice] = $val;
        }
        extract($membre);
        echo '<div style="background:green;color:white;padding:5px">';
        echo 'Félicitations, vous êtes connecté. Voici votre profil :';
        echo '  <ul>';
        echo '      <li>Pseudo : '.$pseudo.'</li>';
        echo '      <li>Prénom : '.$prenom.'</li>';
        echo '      <li>Nom : '.$nom.'</li>';
        echo '      <li>Email : '.$email.'</li>';
        echo '  </ul>';
        echo '</div>';

    }
    else {
        echo '<p style="background:red;color:white;padding:5px">Erreur d\'identifiant !<p>.';
    }
    echo '<br>';
}

?>


<html>
<form class="" action="connexion.php" method="post">
    <input type="text" name="pseudo">
    <input type="text" name="mdp">
    <input type="submit" value="Connexion">
</form>
</html>
