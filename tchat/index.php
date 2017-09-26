<?php
session_start();  // on crée le fichier de session
$pdo = new PDO("mysql:host=localhost;dbname=tchat", 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

$msg = '';

// traitement pour la connexion
// vérif que le formulaire de connexion est validé
if (isset($_POST['connexion'])){
	// verif des deux champs remplis
	if (!empty($_POST['pseudo']) && !empty($_POST['mdp'])){ //
		// verif de l'existence du pseudo et du bon mot de passe

		// ext-ce que le pseudo existe ?
		$resultat = $pdo->prepare ("SELECT * FROM membre WHERE pseudo=:pseudo");
		$resultat->bindParam(':pseudo', $_POST['pseudo'], PDO::PARAM_STR);
		$resultat->execute();

		if ($resultat->rowCount() > 0){
			$membre = $resultat->fetch(PDO::FETCH_ASSOC);
			if ($membre['mdp'] === $_POST['mdp']){
				//le pseudo et le mdp sont corrects
				// $_SESSION['pseudo'] = $membre['pseudo'];
				// $_SESSION['pseudo'] = $membre['pseudo'];
				// $_SESSION['pseudo'] = $membre['pseudo'];

				// on récupère toutes les infos du membre dans le fichier session. sauf le mdp à exclure par la suite
				foreach ($membre as $key => $val){
					$_SESSION[$key] = $val;
				}
				header('Location:message.php');
			}
			else{
				$msg .= "Vous n'vez pas saisi le bon mot de passe<br>";
			}
		}
		else {
			$msg .= "Ce pseudo n'est pas reconnu<br>";
		}

	}
	else {
		$msg .= "Tout n'est pas rempli<br>";
	}

}



// traitement pour l'inscription
if (isset($_POST['inscription'])){
	if (!empty($_FILES['photo']['name'])){
		$nom_photo = time().'_'.rand(0,5000).'_'.$_FILES['photo']['name'];
		// echo $nom_photo.'<br>';

		if ($_FILES['photo']['type']=='image/jpeg' ||
		$_FILES['photo']['type']=='image/png' ||
		$_FILES['photo']['type']=='image/gif'){

			if ($_FILES['photo']['size']<=2000000){
				copy($_FILES['photo']['tmp_name'], __DIR__ . '/photo/' . $nom_photo);
			}
			else {
				$msg.= "Veuillez choisir une photo de moins de 2 Mo.";
			}
		}
	}
	else{
		$nom_photo = 'default.jpg';
	}

	// echo '<pre>';
	// print_r($_POST);
	// print_r($_FILES);
	// echo '</pre>';


	if (empty($_POST['pseudo'])){
		$msg .= "Le pseudo doit être saisi<br>";
	}

	if (empty($_POST['mdp'])){
		$msg .= "Le mot de passe doit être saisi<br>";
	}

	if(empty($_POST['email'])){
		$msg .= "L'email' doit être saisi<br>";
	}

	if (empty($msg)){
		$resultat = $pdo->prepare('INSERT INTO membre(pseudo, mdp, email, photo, statut) VALUES (:pseudo, :mdp, :email, :photo, "1")');

		$resultat->bindParam(':pseudo', $_POST['pseudo'], PDO::PARAM_STR);
		$resultat->bindParam(':mdp', $_POST['mdp'], PDO::PARAM_STR);
		$resultat->bindParam(':email', $_POST['email'], PDO::PARAM_INT);
		$resultat->bindParam(':photo', $nom_photo, PDO::PARAM_INT);


		$resultat->execute();
		$msg = $_POST['pseudo'].' a bien été enregistré';
	}
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Tchat Lepoles</title>
	<link rel="stylesheet" href="css/styles.css" type="text/css" />
</head>
<body>
	<header>
	</header>
	<nav>
	</nav>
	<main>
		<?php if (!empty($msg)) :?>
			<p style="background:rgb(222,153,153);color:darkred;padding:5px;border:2px solid darkred;border-radius: 4px;"><?= $msg ?></p>
		<?php endif; ?>
		<h1>Accueil</h1>

		<div class="inscription">
			<h2>Inscription</h2>

			<form method="post" action="" enctype="multipart/form-data">
				<input type="text" name="pseudo" placeholder="Pseudo" />

				<input type="password" name="mdp" placeholder="Mot de passe" /><br>

				<label>Votre avatar : </label>
				<input type="file" name="photo"/>

				<input type="text" name="email" placeholder="email" />

				<input type="submit" value="inscription" name="inscription" />

			</form>




		</div>

		<div class="connexion">
			<h2>Connexion</h2>
			<p>Si vous avez déjà un compte, connectez-vous :</p>
			<form method="post" action="">
				<input type="text" name="pseudo" placeholder="pseudo" />
				<input type="password" name="mdp" placeholder="Mot de passe" />
				<input type="submit" name="connexion" value="Connexion" />
			</form>
		</div>
	</main>
</body>
</html>
