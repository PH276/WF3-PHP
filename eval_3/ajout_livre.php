<?php
$pdo = new PDO("mysql:host=localhost;dbname=bibliotheque", 'root', '1111', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

$msg = '';

if (!empty($_POST)){
    echo '<pre>';
    print_r($_POST);
    echo '</pre>';

    if (empty($_POST['auteur'])){
        $msg .= "L'auteur doit être saisi<br>";
    }

    if (empty($_POST['titre'])){
        $msg .= "Le titre doit être saisi<br>";
    }

    if (empty($msg)){
        $resultat = $pdo->prepare('INSERT INTO livre(auteur, titre) VALUES (:auteur, :titre)');

        $resultat->bindParam(':auteur', $_POST['auteur'], PDO::PARAM_STR);
        $resultat->bindParam(':titre', $_POST['titre'], PDO::PARAM_STR);

        $resultat->execute();
        $msg = $_POST['titre'].' a bien été enregistré';
    }
}

?>

<form method="post" action="">
    <?php echo $msg; ?>
    <fieldset>
        <legend>Ajout d'un livre</legend>

        <label for="titre">Titre :</label><br>
        <input type="text" id="titre" name="titre"><br><br>

        <label for="auteur">Auteur :</label><br>
        <input type="text" id="auteur" name="auteur"><br><br>

        <input type="submit" value="Enregistrement">
    </fieldset>

</form>
