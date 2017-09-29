<?php
require_once ('../inc/init.inc.php');


if (isset($_GET['id']) && !empty($_GET['id']) && is_numeric($_GET['id'])){
    $resultat = $pdo->prepare("SELECT * FROM produit WHERE id_produit = :id");
    $resultat->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
    $resultat->execute();

    if ($resultat->rowCount() > 0){
        $produit = $resultat -> fetch(PDO::FETCH_ASSOC);
        debug($produit);

        // chemin absolu de la photo
        $chemin_photo_a_supprimer = $_SERVER['DOCUMENT_ROOT'] . RACINE_SITE . 'photo/' . $produit['photo'];

        if (file_exists($chemin_photo_a_supprimer) && $chemin_photo_a_supprimer != 'default.jpg') {
            unlink($chemin_photo_a_supprimer);
        }

        $resultat = $pdo -> exec("DELETE FROM produit WHERE id_produit=".$produit[id_produit]);

        if ($resultat){
            header('Location:gestion_boutique.php?msg=suppr&id=' . $produit[id_produit]);
        }


    }
    else{
        $msg .= '<div class="erreur">Le produit '.$_GET['id'].' n\'existe, veuillez en choisir un autre.</div>';
    }
}
// $resultat = $pdo ->  ("DELETE FROM `produit` WHERE id_produit=".$_GET['id']);
