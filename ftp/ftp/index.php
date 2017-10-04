<?php


// II. Connexion à la bdd et traitement du post :
$pdo = new PDO('mysql:host=localhost;dbname=id3141827_pascal', 'id3141827_pascal', '25102229', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

if ($_POST) {
			
	
	$_POST['pseudo'] = htmlspecialchars($_POST['pseudo'], ENT_QUOTES);  
	$_POST['message'] = htmlspecialchars($_POST['message'], ENT_QUOTES); 
		
		
	$stmt = $pdo->prepare("INSERT INTO commentaire (pseudo, message, date_enregistrement) VALUES (:pseudo, :message, NOW())");
	$stmt->bindParam(':pseudo', $_POST['pseudo'], PDO::PARAM_STR);
	$stmt->bindParam(':message', $_POST['message'], PDO::PARAM_STR);
	$stmt->execute();
	
}

?>


<!-- I. Formulaire de saisie du message du post : -->
<form method="post" action="">
	<fieldset>
			<legend><h2>Formulaire</h2></legend>
			<label for="pseudo">Pseudo</label><br />
				<input type="text" id="pseudo" name="pseudo" value=""><br>
		
			<label for="message">Message</label><br>
						<textarea id="message" name="message" cols="50" rows="7" ></textarea><br>
			<input type="submit" name="envoi" value="envoi">
	</fieldset>
</form>



<!-- III. Affichage des messages : -->
<fieldset>
<?php	
	
	$resultat = $pdo->query("SELECT pseudo, message, date_format(date_enregistrement, '%d/%m/%Y') as datefr, date_format(date_enregistrement, '%H:%i:%s') as heurefr FROM commentaire ORDER BY date_enregistrement DESC");	
	
	echo '<legend><h2>'  . $resultat->rowCount() . ' commentaire(s)</h2></legend>';
	
	while($commentaire = $resultat->fetch(PDO::FETCH_ASSOC)) {
		echo '<div class="message">';
			echo '<div class="titre">Par: ' . $commentaire['pseudo'] . ', le ' . $commentaire['datefr'] . ' à ' . $commentaire['heurefr'] . '</div>';
			echo '<div class="contenu">' . $commentaire['message'] . '</div>';
		echo '</div><hr>';
	}
	
	
?>
</fieldset>
















