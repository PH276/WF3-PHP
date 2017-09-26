<?php
session_start();  // on crée le fichier de session
$pdo = new PDO("mysql:host=localhost;dbname=tchat", 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

if (isset($_GET['action']) && $_GET['action']=='deconnexion'){
	session_destroy();

}
if (!isset($_SESSION['pseudo'])){
	header('Location:index.php');
}







// traitement de la saisie d'un message
if (!empty($_POST)){
	if (!empty($_POST['message'])){
		print_r($_POST);
		$resultat = $pdo->prepare("INSERT INTO message(id_membre, content, date_enregistrement) VALUES ($_SESSION[id_membre], :message, now())");
		$resultat->bindParam('message', $_POST['message'], PDO::PARAM_STR);
		$resultat->execute();
	}

}
// récupération des messages déjà enregistrés
$resultat = $pdo -> query("
SELECT membre.*, message.*
FROM message
LEFT JOIN membre
ON message.id_membre=membre.id_membre
");
$messages = $resultat->fetchAll();


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
		<a class="btn" href="?action=deconnexion">Deconnexion</a>
	</nav>
	<main>
		<h1>Message</h1>

		<h2>Bonjour <?=$_SESSION['pseudo'];  ?> ! </h2>
		<p>Bienvue sur le tchat Lepoles, n'hésitez pas à communiquer avec nous :) </p>

		<?php foreach ($messages as $value) : ?>
			<div class="comment <?= ($value['id_membre']==$_SESSION['id_membre'])?' user_connecte ':''; ?>">
				<?php if ($value['id_membre']!=$_SESSION['id_membre']) { ?>
					<div class="triangle"></div>
				<?php } ?>
				<div class="comment_in">
					<div class="img">
						<img src="photo/<?= $value['photo']; ?>" height="25px" alt="avatar"/>
						<p class="auteur">Par <?= $value['pseudo']; ?>, le <?= $value['date_enregistrement']; ?></p>
					</div>
					<div class="content">
						<p class="message"><?= $value['content']; ?></p>
					</div>
				</div>
				<?php if ($value['id_membre']==$_SESSION['id_membre']) { ?>
					<div class="triangle"></div>
				<?php } ?>
			</div>
		<?php endforeach; ?>


		<hr/>
		<h4>Nouveau message : </h4>
		<form method="post" action="" class="tchat">
			<textarea name="message" placeholder="Votre Message"></textarea>
			<input type="submit" name="envoi" value="Envoyer" />
		</form>

	</main>
</body>
</html>
