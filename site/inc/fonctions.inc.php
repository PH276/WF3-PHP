<?php
// fonction pour affi les debug (print_r)
function debug($tab){
    echo '<div style="color:white;padding:20px;font-weight:bold;background:#'.rand(111111, 999999).'">';
    $trace = debug_backtrace();
    echo 'Le debug a été demandé dans le fichier : ' .$trace[0]['file'].' à la ligne '.$trace[0]['line'].'<hr>'; // retourne les infos sur l'emplacement où est exécutée une fonction

    echo '<pre>';
    print_r($tab);
    echo '</pre>';

    echo '</div>';
}


// fonction pour voir si un utilisateur est connecté :
function userConnecte(){
    if (isset($_SESSION['membre'])){
        return true;
    }
    else {
        return false;
    }
}


// fonction pour voir si l'utilisateur est admin
function userAdmin(){
    if (userConnecte() && $_SESSION['membre']['statut']==1){
        return true;
    }
    else {
        return false;
    }
}


// creation du panier
function creationPanier(){
    if (!isset($_SESSION['panier'])) {
        $_SESSION['panier'] = array();
        $_SESSION['panier']['id_produit'] = array();
        $_SESSION['panier']['quantite'] = array();
        $_SESSION['panier']['prix'] = array();
        $_SESSION['panier']['titre'] = array();
        $_SESSION['panier']['photo'] = array();
    }
}

// ajouter un produit au panier
function ajouterProduit ($id_produit, $quantite, $photo, $titre, $prix){
    creationPanier();

    $position_pdt = array_search($id_produit, $_SESSION['panier']['id_produit']);
    if ($position_pdt !== false){
        $_SESSION['panier']['quantite'][$position_pdt] += $quantite;
    }
    else{
        $_SESSION['panier']['id_produit'][] = $id_produit;
        $_SESSION['panier']['quantite'][] = $quantite;
        $_SESSION['panier']['photo'][] = $photo;
        $_SESSION['panier']['titre'][] = $titre;
        $_SESSION['panier']['prix'][] = $prix;
        // crochets vide permet d'ajouter un elt au tableau

    }
}

// function pour calculer le nb de produit ds le panier
function quantitePanier(){

    $nbreProduit = 0;
    if (isset($_SESSION['panier'])){
        foreach($_SESSION['panier']['quantite'] as $quantite){
            $nbreProduit += $quantite;
        }
    }

    if ($nbreProduit != 0) {
        return $nbreProduit;
    }
    else{
        return false;
    }

}
// fonction montant total du panier
function montantTotal(){
    $total = 0;
    if (isset($_SESSION['panier']['id_produit'])){
        for ($i=0; $i < count($_SESSION['panier']['id_produit']); $i++) {
            $total += $_SESSION['panier']['quantite'][$i] * $_SESSION['panier']['prix'][$i];
        }
    }

    return $total;

}

// supprimer un article du panier
function retirerProduit($id_produit){
    $position_pdt_a_supprimer = array_search($id_produit, $_SESSION['panier']['id_produit']);

    if ($position_pdt_a_supprimer !== false){
        // array_splice() supprime un elt d'un tableau en réindexant le tableau
        array_splice($_SESSION['panier']['id_produit'], $position_pdt_a_supprimer, 1);
        array_splice($_SESSION['panier']['quantite'], $position_pdt_a_supprimer, 1);
        array_splice($_SESSION['panier']['prix'], $position_pdt_a_supprimer, 1);
        array_splice($_SESSION['panier']['photo'], $position_pdt_a_supprimer, 1);
        array_splice($_SESSION['panier']['titre'], $position_pdt_a_supprimer, 1);
    }
}
