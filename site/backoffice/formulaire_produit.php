<?php
require_once ('../inc/init.inc.php');

if (!empty($_POST)){
    debug($_POST);
    debug($_FILES);
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
<form method="post" action="" enctype="multipart/form-data">

    <input type="text" id="idproduit" name="idproduit" hidden>

    <label for="ref">Référence</label>
    <input type="text" id="ref" name="reference">

    <label for="cat">Catégorie</label>
    <input type="text" id="cat" name="catégorie">

    <label for="description">Description</label>
    <textarea name="description" rows="8" cols="80"></textarea>

    <label for="couleur">Couleur</label>
    <input type="text" id="couleur" name="couleur">

    <label for="taille">Taille</label>
    <input type="text" id="taille" name="taille">

    <label for="public">Public</label>
    <input type="text" id="public" name="public">

    <label for="photo">Public</label>
    <select name="titre" id="titre">
        <option value="m">Homme</option>
        <option value="f">Femme</option>
        <option value="mixte">Mixte</option>
    </select>

    <label for="photo">Photo</label>
    <input type="file" id="photo" name="photo">

    <label for="prix">Prix</label>
    <input type="text" id="prix" name="prix">

    <label for="stock">Stock</label>
    <input type="text" id="stock" name="stock">

    <label for="stock">Stock</label>
    <input type="text" id="stock" name="stock">


    <input type="submit" value="Enregistrer">


</form>
