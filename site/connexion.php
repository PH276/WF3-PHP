<?php
require_once ('inc/init.inc.php');

if (isset($_GET['action'] && $_GET['action']=='deconnexion')){
    unset($_SESSION['membre']);
    header('location:connexion.php');
}

// Traitement pour l'iscription
//  --> vérif form activé
//  --> debug()
//  --> contrôle des ch pseudo et mdp
// --> on connecte en enregistrant ses infos ds ma session
//     --> pseudo existe ? / mdp dispo
//     --> enregistre en session
//     --> redirection vers le profil
if (userConnecte()){
    header('location:profil.php');
}

if (!empty($_POST)){
    debug($_POST);

    // verification pseudo
    if (!empty($_POST['pseudo']) && !empty($_POST['mdp'])){
        $resultat = $pdo->prepare("SELECT * FROM membre WHERE pseudo = :pseudo");
        $resultat->bindParam(':pseudo', $_POST['pseudo'], PDO::PARAM_STR);
        $resultat->execute();
        if ($resultat->rowCount() > 0){
            // nous aurions pu proposer 2 à 3 variantes de  son pseudo, en ayant vérifié qu'ils sont dispo
            $membre = $resultat->fetch(PDO::FETCH_ASSOC);

            if ($membre['mdp'] == md5($_POST['mdp'])){ // tout est OK
                foreach($membre as $key => $val){
                    if ($key != 'mdp'){
                        $_SESSION['membre'][$key] = $val;
                    }
                }
                // debug($_SESSION);
                header("location:profil.php");

            }
            else{
                $msg .= '<div class="erreur">mot de passe erroné.</div>';

            }
        }
        else{
            $msg .= '<div class="erreur">Le pseudo '.$_POST['pseudo'].' n\'existe pas disponible, Veuillez en choisir un autre.</div>';
        }
    }
    else{
        $msg .=  '<div class="erreur">Veuillez renseigner un pseudo et un mot de passe</div>';
    }
    // -----------------------------------------------------------

}

require_once ('inc/header.inc.php');
?>

<!--  contenu HTML  -->
<h1>Connexion</h1>
<form method="post" action="">
    <?= $msg; ?>

    <label for="pseudo">Pseudo :</label>
    <input type="text" id="pseudo" name="pseudo" value="<?= (isset($_POST['pseudo']))?$_POST['pseudo']:'' ?>">

    <label for="mdp">Mot de passe :</label>
    <input type="password" id="mdp" name="mdp"  value="<?= (isset($mdp))?$mdp:'' ?>">

    <input type="submit" value="Connexion">


</form>

<?php require_once ('inc/footer.inc.php'); ?>
