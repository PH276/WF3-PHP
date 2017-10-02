<?php
require('inc/init.inc.php');

// 1/ récuprer ttes les cat existante ds la boutique
// 2/ on les affiche ds la partie gauche de la page
// 3/ on crée un lien pour chacune

// 4/ récuprer ts les produits existants ds la boutique
// 5/ on les affiche ds la partie droite de la page
// 6/ on crée un lien pour chacun

// 1/
$resultat = $pdo->query("SELECT DISTINCT categorie FROM produit");
$categories = $resultat->fetchAll(PDO::FETCH_ASSOC);
debug($categories);

if (isset($_GET['cat']) && !empty($_GET['cat']) && is_string($_GET['cat'])){
    $resultat = $pdo->prepare("SELECT * FROM produit WHERE categorie=:categorie");
    $resultat->bindParam(':categorie', $_GET['cat'], PDO::PARAM_STR);
    $resultat->execute();

    if ($resultat->rowCount() == 0) {
        $resultat = $pdo->query("SELECT * FROM produit");
    }
} else{
    $resultat = $pdo->query("SELECT * FROM produit");
}
$produits = $resultat->fetchAll(PDO::FETCH_ASSOC);
debug($produits);


$page = 'Boutique';
require('inc/header.inc.php');
?>
</h1>Boutique</h1>

<div class="boutique-gauche">
    <ul>
        <li><a href="boutique.php">Tous les produits</a></li>
        <?php for ($i=0; $i <count($categories) ; $i++) : ?>
            <li><a href="?cat=<?= $categories[$i]['categorie'] ?>"><?= $categories[$i]['categorie'] ?></a></li>
        <?php endfor; ?>


    </ul>
</div>

<div class="boutique-droite">

    <?php for ($i=0; $i < count($produits) ; $i++) : ?>

        <!-- Debut vignette produit -->
        <div class="boutique-produit">
            <h3><?= $produits[$i]['titre'] ?></h3>
            <a href="fiche_produit.php?id=<?= $produits[$i]['id_produit'] ?>"><img src="photo/<?= $produits[$i]['photo'] ?>" height="100"/></a>
            <p style="font-weight: bold; font-size: 20px;"><?= $produits[$i]['prix'] ?>€</p>

            <p style="height: 40px"><?= substr($produits[$i]['description'], 0, 40); ?>...</p>
            <a href="fiche_produit.php?id=<?= $produits[$i]['id_produit'] ?>" style="padding:5px 15px; background: red; color:white; text-align: center; border: 2px solid black; border-radius: 3px" >Voir la fiche</a>
            <!-- href="fiche_produit.php?id=id_du_produit" -->
        </div>
        <!-- Fin vignette produit -->
    <?php endfor; ?>

</div>
<!-- Fin vignette produit -->

</div>
<!-- Fin vignette produit -->

</div>

<?php
require('inc/footer.inc.php');
?>
