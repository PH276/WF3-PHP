<?php
require_once ('inc/init.inc.php');

if (userConnecte()){
    header('location:profil.php');
}

// Traitement pour l'iscription
//  --> vérif form activé
//  --> print_r
//  --> contrôle des ch pseudo et mdp
// --> Enregistrer l'utilisateur
//     --> pseudo dispo ? / email dispo
//     --> redirection vers la connexion

if (!empty($_POST)){
    debug($_POST);

    // verification pseudo
    $verif_pseudo = preg_match('#^([a-zA-Z0-9._-]{3,20})$#', $_POST['pseudo']);
    if (!empty($_POST['pseudo'])){
        if ($verif_pseudo == FALSE){
            $msg .= '<div class="erreur">pseudo : Caractères autorisés (0 à 9, A à Z et a à z) , 3 caractères, maxi 20 caractères</div>';
        }
    }
    else{
        $msg .=  '<div class="erreur">Veuillez renseigner un pseudo</div>';
    }
    // -----------------------------------------------------------
    // verification mdp
    $verif_pwd = preg_match('#^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,20}$#', $_POST['mdp']); // 8 à 20 caractères avec minimum un chiffre et une majuscule

    if (!empty( $_POST['mdp'])){
        if (!$verif_pwd){
            $msg .=  '<div class="erreur">mdp : 8 à 20 caractères avec minimum un chiffre, une minuscule et une majuscule</div>';
        }
    }
    else{
        $msg .=  '<div class="erreur">Veuillez renseigner un mot de passe</div>';
    }
    // -----------------------------------------------------------

    // verification email
    $verif_email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL); // vérifie le format de l'email

    $pos = strpos($_POST['email'], '@');
    $ext = substr($_POST['email'], $pos +1);

    $ext_non_autorisees = array('wimsg.com', 'yopmail.com', 'mailinator.com', 'tafmail.com', 'mvrht.net');

    if (!empty( $_POST['email'])){
        if (!$verif_email  || in_array($ext, $ext_non_autorisees)){
            $msg .=  '<div class="erreur">Veuillez saisir un email valide</div>';
        }
    }
    else{
        $msg .=  '<div class="erreur">Veuillez renseigner un email</div>';
    }
    // -----------------------------------------------------------

    // verification nom
    if (!empty($_POST['nom'])){
        if (strlen($_POST['nom']) > 20){
            $msg .=  '<div class="erreur">nom : Veuillez renseigner un nom de moins de 20 caractère maxi</div>';
        }
    }
    else {
        $msg .=  '<div class="erreur">Veuillez renseigner un nom</div>';
    }
    // -----------------------------------------------------------

    // verification prénom
    if (!empty($_POST['prenom'])){
        if (strlen($_POST['prenom']) > 20){
            $msg .=  '<div class="erreur">prénom : Veuillez renseigner un prénom de 20 caractère maxi</div>';
        }
    }
    else {
        $msg .=  '<div class="erreur">Veuillez renseigner un prénom</div>';
    }
    // -----------------------------------------------------------

    // verification civilite
    if (in_array (array('m', 'f'), $_POST['civilite'])) {
        $msg .=  '<div class="erreur">Civilité : Veuillez renseigner homme ou femme </div>';
    }
    // -----------------------------------------------------------

    // verification ville
    if (!empty($_POST['ville'])){
        if (strlen($_POST['ville']) > 20){
            $msg .=  '<div class="erreur">ville : Veuillez renseigner une ville de 50 caractère maxi</div>';
        }
    }
    else {
        $msg .=  '<div class="erreur">Veuillez renseigner un ville</div>';
    }
    // -----------------------------------------------------------

    // verification adresse
    if (!empty($_POST['adresse'])){
        if (strlen($_POST['adresse']) > 50){
            $msg .=  '<div class="erreur">adresse : Veuillez renseigner une adresse de 50 caractère maxi</div>';
        }
    }
    else {
        $msg .=  '<div class="erreur">Veuillez renseigner une adresse</div>';
    }
    // -----------------------------------------------------------

    // verification code_postal
    if (!empty($_POST['code_postal'])){
        if (!is_numeric($_POST['code_postal']) || strlen($_POST['code_postal']) != 5){
            $msg .= '<div class="erreur">code postal : Veuillez renseigner un code postal avec 5 chiffres</div>';
        }
    }
    else {
        $msg .=  '<div class="erreur">Veuillez renseigner un code postal</div>';
    }
    // -----------------------------------------------------------

    // --------------------------------------------------------------------
    //                                         faire les autres vérifs
    // --------------------------------------------------------------------

    // $msg encore vide ==> pas d'eereur détectée

    if (empty ($msg)){
        // enregistrement du nouveau membre que le pseudo n'existe pas
        $resultat = $pdo->prepare("SELECT * FROM membre WHERE pseudo = :pseudo");
        $resultat->bindParam(':pseudo', $_POST['pseudo'], PDO::PARAM_STR);
        $resultat->execute();

        if ($resultat->rowCount() > 0){
            // nous aurions pu proposer 2 à 3 variantes de  son pseudo, en ayant vérifié qu'ils sont dispo
            $msg .= '<div class="erreur">Le pseudo '.$_POST['pseudo'].' n\'est pas disponible, Veuillez en choisir un autre.</div>';
        }
        else{
            $resultat = $pdo->prepare("SELECT * FROM membre WHERE pseudo = :email");
            $resultat->bindParam(':pseudo', $_POST['email'], PDO::PARAM_STR);
            $resultat->execute();

            if ($resultat->rowCount() > 0){
                // nous aurions pu proposer 2 à 3 variantes de  son pseudo, en ayant vérifié qu'ils sont dispo
                $msg .= '<div class="erreur">L\'email' '.$_POST['email'].' n\'est pas disponible, Veuillez en choisir un autre.</div>';
            }
            else{

                //pseudo OK
                // --------------------------------------------------------------------
                //                                      (faire de même avec l'email)
                // --------------------------------------------------------------------

                // crypte le mdp
                $mdp = md5($_POST['mdp']);

                //requete INSERT
                $resultat = $pdo->prepare("INSERT INTO membre (pseudo, mdp, nom, prenom, email, civilite, ville, code_postal, adresse, statut) VALUES (:pseudo, :mdp, :nom, :prenom, :email, :civilite, :ville, :code_postal, :adresse, '0')");
                $resultat->bindParam(':pseudo', $_POST['pseudo'], PDO::PARAM_STR);
                $resultat->bindParam(':mdp', $mdp, PDO::PARAM_STR);
                $resultat->bindParam(':nom', $_POST['nom'], PDO::PARAM_STR);
                $resultat->bindParam(':prenom', $_POST['prenom'], PDO::PARAM_STR);
                $resultat->bindParam(':email', $_POST['email'], PDO::PARAM_STR);
                $resultat->bindParam(':civilite', $_POST['civilite'], PDO::PARAM_STR);
                $resultat->bindParam(':ville', $_POST['ville'], PDO::PARAM_STR);
                $resultat->bindParam(':adresse', $_POST['adresse'], PDO::PARAM_STR);

                $resultat->bindParam(':code_postal', $_POST['code_postal'], PDO::PARAM_INT);

                // redirection
                if ($resultat->execute()){
                    header('location:connexion.php');
                }
            }
        }


    } // fin empty ($msg)
    extract($_POST);
} // fin empty ($_POST)

require_once ('inc/header.inc.php');
?>
<!--  contenu HTML  -->
<h1>Inscription</h1>
<form method="post" action="">
    <?php echo $msg; ?>

    <label for="pseudo">Pseudo</label>
    <input type="text" id="pseudo" name="pseudo" value="<?= (isset($pseudo))?$pseudo:'' ?>">

    <label for="mdp">Mot de passe</label>
    <input type="password" id="mdp" name="mdp"  value="<?= (isset($mdp))?$mdp:'' ?>">

    <label for="nom">Nom</label>
    <input type="text" id="nom" name="nom" value="<?= (isset($nom))?$nom:'' ?>">

    <label for="prenom">Prénom</label>
    <input type="text" id="prenom" name="prenom" value="<?= (isset($prenom))?$prenom:'' ?>">

    <label for="email">Email</label>
    <input type="text" id="email" name="email" value="<?= (isset($email))?$email:'' ?>">

    <label for="civilite">Civilite</label>
    <select name="civilite" id="civilite">
        <option value="m">Homme</option>
        <option value="f">Femme</option>
    </select>

    <label for="ville">Ville</label>
    <input type="text" id="ville" name="ville" value="<?= (isset($ville))?$ville:'' ?>">

    <label for="code_postal">Code postal</label>
    <input type="text" id="code_postal" name="code_postal" value="<?= (isset($code_postal))?$code_postal:'' ?>">

    <label for="adresse">Adresse</label>
    <input type="text" id="adresse" name="adresse" value="<?= (isset($adresse))?$adresse:'' ?>">

    <input type="submit" value="Enregistrer">


</form>
