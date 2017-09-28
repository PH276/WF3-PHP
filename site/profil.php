<?php
require_once ('inc/init.inc.php');
$page = 'profil';
if (!userConnecte()){
    header('location:connexion.php');
}


extract($_SESSION['membre']);

require_once ('inc/header.inc.php');
?>

<!--  contenu HTML  -->
<h1>Profil de <?= $pseudo ?></h1>
<div class="profil">
    <div class="">
        <p>Bonjour <?= $pseudo ?> !!</p>
    </div>

    <div class="profil_img">
        <img src="img/default.jpg" alt="">
    </div>
    <div class="profil_infos">
        <ul>
            <li>Pseudo : <b><?= $pseudo ?></b></li>
            <li>Nom : <b><?= $nom ?></b></li>
            <li>Prénom : <b><?= $prenom ?></b></li>
            <li>Email : <b><?= $email ?></b></li>
        </ul>
    </div>
    <div class="profil_adresse">
        <ul>
            <li>Adresse : <b><?= $adresse ?></b></li>
            <li>Code postal : <b><?= $code_postal ?></b></li>
            <li>Ville : <b><?= $ville ?></b></li>
        </ul>
    </div>
</div>
<div class="profil">
    <h2>Détail des commandes</h2>
    <p>Vous n'avez pa encore passé de commande !<br>Venez visiter <a href="boutique.php"><u>notre boutique</u></a></p>
</div>
<?php require_once ('inc/footer.inc.php'); ?>
