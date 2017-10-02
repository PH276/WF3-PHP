<?php
require_once ('../inc/init.inc.php');
if (!userAdmin()){
    header('location:../connexion.php');
}

if (!empty($_POST)){
    debug($_POST);

    // renommer photo / ref_time_nom.ext
    // ctrl sur la photo
    // Enregistrer la photo
    //
    // ctrl sur les infos
    // requete insererr les infos ds la BD
    // redirection sur gestion_boutique



    // insérer les infos du membre en BDD...
    // Au préalable, nous autions vérifier ts les ch (taille , caractères, no_empty, ...)

    if (empty($msg)){

        if (isset($_POST['Modifier'])) {
            $resultat = $pdo->prepare("UPDATE membre SET id_membre=:id_membre,pseudo=:pseudo,mdp=:mdp,nom=:nom,prenom=:prenom,email=:email,civilite=:civilite,ville=:ville,code_postal=:code_postal,adresse=:adresse,statut=:statut WHERE id_membre=:id_membre");



            $resultat->bindParam(':id_membre', $_POST['id_membre'], PDO::PARAM_INT);
        }else {
            $resultat = $pdo->prepare("INSERT INTO membre(pseudo, mdp, nom, prenom, email, civilite, ville, code_postal, adresse, statut) VALUES (:pseudo, :mdp, :nom, :prenom, :email, :civilite, :ville, :code_postal, :adresse, :statut)");

        }

        $resultat->bindParam(':pseudo,', $_POST['reference'], PDO::PARAM_STR);
        $resultat->bindParam(':mdp,', $_POST['reference'], PDO::PARAM_STR);
        $resultat->bindParam(':nom,', $_POST['reference'], PDO::PARAM_STR);
        $resultat->bindParam(':prenom,', $_POST['reference'], PDO::PARAM_STR);
        $resultat->bindParam(':email,', $_POST['reference'], PDO::PARAM_STR);
        $resultat->bindParam(':civilite,', $_POST['reference'], PDO::PARAM_STR);
        $resultat->bindParam(':ville,', $_POST['reference'], PDO::PARAM_STR);
        $resultat->bindParam(':code_postal,', $_POST['reference'], PDO::PARAM_STR);
        $resultat->bindParam(':adresse,', $_POST['reference'], PDO::PARAM_STR);
        $resultat->bindParam(':statut', $_POST['reference'], PDO::PARAM_STR);

        if ($resultat->execute()){

            $pdt_insert = (isset($_POST['Modifier'])) ? $_POST['id_membre'] : $pdo -> lastInsertId();
            header('location:gestion_membre.php?msg=validation&id='.$pdt_insert);
        }
    }

}
// fin !empty($_POST
// traitement pour modifier un membre
// 1/ oon récupère les infos duu membre
// 2/ on insert les infos de ce membre ds le formulaire
// 3/ gestion de la photo : si on modifie un autre champ, il faut renvoyer l'ancienne image. Si on la modifie, il faut pouvoir la récupérer
// 4/ enregistrement des modifs

if (isset($_GET['id']) && !empty($_GET['id']) && is_numeric($_GET['id']))    {
    // s'il y a un id ds l'url non vide et numérique
    $resultat = $pdo->prepare("SELECT * FROM membre WHERE id_membre = ?");
    $resultat->execute(array($_GET['id']));

    if ($resultat->rowCount() > 0){
        $membre_actuel = $resultat->fetch(PDO::FETCH_ASSOC);
        debug($membre_actuel);
    }
}

// Créons des variables pour chq elt à insérer ds le formulaire
$id_membre = (isset($membre_actuel)) ? $membre_actuel['id_membre'] : '';


$pseudo = (isset($membre_actuel)) ? $membre_actuel['pseudo'] : '';
$mdp = (isset($membre_actuel)) ? $membre_actuel['mdp'] : '';
$nom = (isset($membre_actuel)) ? $membre_actuel['nom'] : '';
$prenom = (isset($membre_actuel)) ? $membre_actuel['prenom'] : '';
$email = (isset($membre_actuel)) ? $membre_actuel['email'] : '';
$civilite = (isset($membre_actuel)) ? $membre_actuel['civilite'] : '';
$ville = (isset($membre_actuel)) ? $membre_actuel['ville'] : '';
$code_postal = (isset($membre_actuel)) ? $membre_actuel['code_postal'] : '';
$adresse = (isset($membre_actuel)) ? $membre_actuel['adresse'] : '';
$statut = (isset($membre_actuel)) ? $membre_actuel['statut'] : '';

$action = (isset($membre_actuel)) ? 'Modifier' : 'Ajouter';


$page='gmembre';

// Traitement pour l'iscription
//  --> vérif form activé
//  --> print_r
//  --> contrôle des ch pseudo et mdp
// --> Enregistrer l'utilisateur
//     --> pseudo dispo ? / email dispo
//     --> redirection vers la connexion


require_once ('../inc/header.inc.php');
?>
<!--  contenu HTML  -->
<h1><?= $action ?> un membre</h1>
<!-- <?php extract($_POST); ?> -->
<form method="post" action="">
    <?= $msg  ?>

    <input type="text" name="id_membre" value="<?= $id_membre ?>" hidden>

    <label for="pseudo">Pseudo</label>
    <input type="text" id="pseudo" name="pseudo" value="<?= $pseudo ?>">

    <label for="nom">Nom</label>
    <input type="text" id="nom" name="nom" value="<?= $nom ?>">

    <label for="prenom">Prénom</label>
    <input  type="text" name="prenom" value="<?= $prenom ?>">

    <label for="email">Email</label>
    <input  type="text" name="email" value="<?= $email ?>">

    <label for="ville">ville</label>
    <input  type="text" name="ville" value="<?= $ville ?>">

    <label for="code_postal">Code postal</label>
    <input  type="text" name="code_postal" value="<?= $code_postal ?>">

    <label for="adresse">Adresse</label>
    <input  type="text" name="adresse" value="<?= $adresse ?>">

    <label for="civilite">Civilite</label>
    <select name="public" id="public">
        <option <?= $public=='m'?' selected ':'' ?>value="m">Homme</option>
        <option <?= $public=='f'?' selected ':'' ?>value="f">Femme</option>
    </select>

    <input type="submit" name="<?= $action ?>" value="<?= $action ?>">

</form>
