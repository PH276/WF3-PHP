<?php
require_once('inc/init.inc.php');
debug($_SESSION['panier']);
if (isset($_GET['action']) &&  $_GET['action']=='vider'){
	unset($_SESSION['panier']);
}

if (isset($_GET['action']) &&  $_GET['action']=='supprimer' && isset($_GET['id']) && !empty($_GET['id']) == 'supprimer' && is_numeric($_GET['id'])){
	retirerProduit($_GET['id']);
}

// traitement pour finaliser une commande
// verifier la dispo des produits
// si non dispo (2 cas)
// 1 - stock < à la commande
// -> diminuer la quantité commandée, et prévenir l'urillisateur
// 2 - stock nul
// -> supprimer le produit et prévenir l'utilisateur

// enregistrer les infos en BD
// table commande
// table détail on enregistre pour chaque produit
// table commande, on retire les quantités commandées pour chaque produit

// envoi d'un email au client avec n° de commande

if (isset($_POST['paiement'])){
	for ($i=0; $i < sizeof($_SESSION['panier']['id_produit']) ; $i++) {
		$stock_commande = $_SESSION['panier']['quantite'][$i];
		$id_produit_commande = $_SESSION['panier']['id_produit'][$i];

		$resultat = $pdo->query("SELECT stock FROM produit WHERE id_produit=$id_produit_commande");
		$produit = $resultat -> fetch(PDO::FETCH_ASSOC);

		if ($stock_commande > $produit['stock']) {
			// stock insuffisant
			if ($produit['stock'] > 0){ // stock insuffisant
				$_SESSION['panier']['quantite'][$i] = $produit['stock'];
				$msg .= "<div class='erreur'>Le sotock du produit "
				. $_SESSION['panier']['titre'][$i] . " n'est malheureusement pas suffisant. Votre commande a été modifiée, veuillez vérifier la nouvelle quantité avant de valider votre panier.</div>";
			}
			else{ // stock nul
				$msg .= "<div class='erreur'>Le sotock du produit "
				. $_SESSION['panier']['titre'][$i] . " n'est malheureusement plus disponible. Votre commande a été modifiée, veuillez vérifier avant de valider votre panier.</div>";
				retirerProduit($_SESSION['panier']['id_produit'][$i]);
				$i--;  // suite au tableau(panier) réindexé avec la suppression d'un produit
			}// if ($produit['stock'] > 0)

		} //if ($stock_commande > $produit['stock'])


	} 	// for ($i=0; $i < sizeof($_SESSION['panier']['id_produit']) ; $i++)


	if (empty($msg)){
		// EXECUTION DU PAIEMENT AVEC PARTENAIRE (paypal, stripe, banque, paysafe, ...)
		$id_membre = $_SESSION['membre']['id_membre'];
		$montant = montantTotal();

		$resultat = $pdo->exec("INSERT INTO commande(id_membre, montant, date_enregistrement, etat) VALUES ($id_membre, $montant, now(), 'en cours de traitement')");

		$id_commande = $pdo->lastInsertId();

		for ($i=0; $i < sizeof($_SESSION['panier']['id_produit']) ; $i++) {
			// enregistrements ds detail_commande
			$id_produit = $_SESSION['panier']['id_produit'][$i];
			$quantite = $_SESSION['panier']['quantite'][$i];
			$prix = $_SESSION['panier']['prix'][$i];

			$resultat = $pdo->exec("INSERT INTO details_commande(id_commande, id_produit, quantite, prix) VALUES ($id_commande, $id_produit, $quantite, $prix)");

			// modif du stck des produits commandés
			$resultat = $pdo->exec("UPDATE produit SET stock = stock - $quantite WHERE id_produit = $id_produit");

		}
		// félicitation
		$msg .= "<div class='validation'>Félicitations, vote commande " . $id_commande . " est terminée. Vous allez recevoir un mail de confirmation.</div>";
		// unset panier
		unset ($_SESSION['panier']);

		// mail de confirmation (cf formulaire 5 ds dossier POST)

	}
}  // if (isset($_POST['paiement']]))

$page="Panier";
require_once('inc/header.inc.php');
?>
<h1>Panier</h1>
<?= $msg ?>
<table border="1" style="border-collapse : collapse; cellpadding:7;">
	<tr>
		<th colspan="6" >PANIER <?= (quantitePanier()) ? quantitePanier() : '' ?></th>
	</tr>
	<tr>
		<th>Photo</th>
		<th>Titre</th>
		<th>Quantité</th>
		<th>Prix unitaire</th>
		<th>Total</th>
		<th>Supprimer</th>
	</tr>

	<?php if (empty($_SESSION['panier']['id_produit'])) : ?>
		<tr>
			<td colspan="6">Votre panier est vide. N'hésitez pas à consulter notre <a href="boutique.php"><u>boutique</u> </a></td>
		</tr>
	<?php else :

		for ($i=0; $i < sizeof($_SESSION['panier']['id_produit']); $i++) :

			?>
			<!-- Ligne Produit -->
			<tr>
				<td><a href="fiche_produit.php?id=<?= $_SESSION['panier']['id_produit'][$i] ?>"><img src="photo/<?= $_SESSION['panier']['photo'][$i] ?>" height="30" /></a></td>
				<td><?= $_SESSION['panier']['titre'][$i] ?></td>
				<td><span style="padding: 3px; border: solid 1px black; text-align: center; width: 20px; display: inline-block"><?= $_SESSION['panier']['quantite'][$i] ?></span></td>
				<td><?= $_SESSION['panier']['prix'][$i] ?>€</td>
				<td><?= $_SESSION['panier']['quantite'][$i] * $_SESSION['panier']['prix'][$i] ?>€</td>
				<td>
					<a href="?action=supprimer&id=<?= $_SESSION['panier']['id_produit'][$i] ?>"><img src="img/delete.png" height="22"/></a>
				</td>
			</tr>
			<!-- Fin ligne Produit -->
		<?php endfor; ?>

		<tr>
			<td colspan="4">TOTAL :</td>
			<td colspan="2"><?= (montantTotal()>0) ? montantTotal(): ''; ?>€</td>
		</tr>

		<tr>
			<td colspan="6">
				<?php if (userConnecte()) : ?>
				<form method="post" action="">
					<input type="hidden" name="amount" value="" />
					<input type="submit" value="Payer" name="paiement" />
				</form>
			<?php else : ?>
				<p>Veuillez vous connecter pour finaliser votre commande.</p> <a href="connexion.php">Connexion</a>
			<?php endif; ?>
			</td>
		</tr>

		<tr>
			<td colspan="6"><a href="?action=vider"><u>Vider le panier</u></a></td>
		</tr>
	<?php endif; ?>

</table>
















<?php
require_once('inc/footer.inc.php');
?>
