<?php
require_once('inc/init.inc.php');

// 1/ verif id
// 2/ recupere infos du produits
// 3/ verif produit existant
// 4/affiche les infos du produit
// 5/ gestion du nb de produit à ajouter au panier
// 6/ traitement de l'ajout au panier
// 7/ suggestions d'autres produits

if (isset($_GET['id']) && !empty($_GET['id']) && is_numeric($_GET['id'])){
	$resultat = $pdo->prepare("SELECT * FROM produit WHERE id_produit=:id");
	$resultat -> bindParam(':id', $_GET['id'], PDO::PARAM_INT);
	$resultat -> execute();
	if ($resultat -> rowCount() > 0){
		$produit = $resultat -> fetch(PDO::FETCH_ASSOC);
		debug($produit);
		extract($produit);
	}
	else{
		header("Location:boutique.php");
	}
}
else{
	header("Location:boutique.php");
}

if (!empty($_POST)){
	ajouterProduit($id_produit, $_POST['qte'], $photo, $titre, $prix);
}


$page = 'fiche '.$titre;
require_once('inc/header.inc.php');
?>
<h1><?= $titre ?></h1>

<img src="photo/<?= $photo ?>" width="250" />
<p>Détails du produit : </p>
<ul>
	<li>Référence : <b><?= $reference ?></b></li>
	<li>Catégorie : <b><?= $categorie ?></b></li>
	<li>Couleur : <b><?= $couleur ?></b></li>
	<li>Taille : <b><?= $taille ?></b></li>
	<li>Public : <b><?= $public ?></b></li>
	<li>Prix : <b style="color: red; font-size:20px"><?= $prix ?>€ TTC</b></li>
</ul>
<br/>
<p>Description du produit : <br/>
	<em><?= $description ?></em></p>

	<fieldset>
		<legend>Acheter ce produit :</legend>

		<?php if ($stock > 0) : ?>
		<form method="post" action="?produit=<?= $produit ?>">
			<label>Quantité :</label>
			<?php $nb_max_panier = (($stock<5)?$stock:5); ?>
			<select name="quantite">
				<?php for($i=1; $i <= $nb_max_panier && $i <= $stock; $i++) : ?>
					<option><?= $i ?></option>
				<?php endfor; ?>
			</select>
			<input type="submit" value="Ajouter au panier" />
		</form>
	<?php else : ?>
		<i style="color:red">Ruture de stock</i>
	<?php endif; ?>

	</fieldset>


	<div class="profil" style="overflow:hidden;">
		<h2>Suggestions de produits</h2>

		<!-- Dans le PHP faire une requête qui va récupérer des produits (limités à 5):
		Soit des produits de la même catégorie (sauf celui qu'on est en train de visiter)

		Soit les produits des autres catégories
	-->



</div>



<?php
require_once('inc/footer.inc.php');
?>
