<?php
require_once ('../inc/init.inc.php');

if (!empty($_POST)){
    debug($_POST);
    debug($_FILES);

    // renommer photo / ref_time_nom.ext
    // ctrl sur la photo
    // Enregistrer la photo
    //
    // ctrl sur les infos
    // requete insererr les infos ds la BD
    // redirection sur gestion_boutique

    $nom_photo = 'default.jpg';

    if (!empty($_FILES['photo']['name'])){
        $nom_photo = $_POST['reference'].'_'.time().'_'.$_FILES['photo']['name']; // photo renommer pour éviter les doublons

        $chemin_photo = $_SERVER['DOCUMENT_ROOT'] . RACINE_SITE . 'photo/' . $nom_photo;
        // chemin :
        // c:\\xampp/htdocs  PHP/site/    photo/    nom_photo

        // vérification si le fichier est de type image
        $ext = array('image/png', 'image/jpeg', 'image/gif');
        if (!in_array($_FILES['photo']['type'], $ext)){
            $msg .= '<div class="erreur">Images autorisées de type : PNG, JPG et GIF</div>';
        }

        // vérification de la taille maxi d'une image
        if ($_FILES['photo']['size'] > 2000000){
            $msg .= '<div class="erreur">taille maximum des photos : 2 Mo</div>';
        }

        if (empty($msg) && $_FILES['photo']['size']){
            copy($_FILES['photo']['tmp_name'], $chemin_photo);
        }
    }
    // insérer les infos du produit en BDD...
    // Au préalable, nous autions vérifier ts les ch (taille , caractères, no_empty, ...)

    if (empty($msg)){

        $resultat = $pdo->prepare("INSERT INTO produit (reference, categorie, titre, description, couleur, taille, public, photo, prix, stock) VALUES
        (:reference, :categorie, :titre, :description, :couleur, :taille, :public, :photo, :prix, :stock)");
        $resultat->bindParam(':reference', $_POST['reference'], PDO::PARAM_STR);
        $resultat->bindParam(':categorie', $_POST['categorie'], PDO::PARAM_STR);
        $resultat->bindParam(':titre', $_POST['titre'], PDO::PARAM_STR);
        $resultat->bindParam(':description', $_POST['description'], PDO::PARAM_STR);
        $resultat->bindParam(':couleur', $_POST['couleur'], PDO::PARAM_STR);
        $resultat->bindParam(':taille', $_POST['taille'], PDO::PARAM_STR);
        $resultat->bindParam(':public', $_POST['public'], PDO::PARAM_STR);
        $resultat->bindParam(':photo', $nom_photo, PDO::PARAM_STR);
        $resultat->bindParam(':prix', $_POST['prix'], PDO::PARAM_STR);
        $resultat->bindParam(':stock', $_POST['stock'], PDO::PARAM_INT);

        if ($resultat->execute()){
            $pdt_insert = $pdo -> lastInsertId();
            header('location:gestion_boutique.php?msg=validation&id='.$pdt_insert);
        }
    }



}

$page='gboutique';

if (!userAdmin()){
    header('location:../connexion.php');
}

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
<h1>Produit</h1>
<?php extract($_POST); ?>
<form method="post" action="" enctype="multipart/form-data">
    <?= $msg  ?>

    <input type="text" id="idproduit" name="idproduit" value="<?= isset($id_produit)?$id_produit:'' ?>" hidden>

    <label for="ref">Référence</label>
    <input type="text" id="ref" name="reference" value="<?= isset($reference)?$reference:'' ?>">

    <label for="cat">Catégorie</label>
    <input type="text" id="cat" name="categorie" value="<?= isset($categorie)?$categorie:'' ?>">

    <label for="titre">Titre</label>
    <input  type="text" name="titre" value="<?= isset($titre)?$titre:'' ?>">

    <label for="description">Description</label>
    <textarea name="description" rows="8" cols="80"><?= isset($description)?$description:'' ?></textarea>

    <label for="couleur">Couleur</label>
    <input type="text" id="couleur" name="couleur" value="<?= isset($catégorie)?$catégorie:'' ?>">

    <label for="taille">Taille</label>
    <input type="text" id="taille" name="taille" value="<?= isset($taille)?$taille:'' ?>">

    <label for="public">Public</label>
    <select name="public" id="public">
        <option value="m">Homme</option>
        <option value="f">Femme</option>
        <option value="mixte">Mixte</option>
    </select>

    <label for="photo">Photo</label>
    <input type="file" id="photo" name="photo">

    <label for="prix">Prix</label>
    <input type="text" id="prix" name="prix" value="<?= isset($prix)?$prix:'' ?>">

    <label for="stock">Stock</label>
    <input type="text" id="stock" name="stock" value="<?= isset($stock)?$stock:'' ?>">


    <input type="submit" value="Ajouter">


</form>
