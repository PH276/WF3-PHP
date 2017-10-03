<?php
$pdo = new PDO("mysql:host=localhost;dbname=bibliotheque", 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

$msg = '';

if (isset($_GET['id'])){
    $resultat = $pdo->prepare("SELECT * FROM livre WHERE id_livre=".$_GET['id']);
    $resultat->bindParam(':id_livre', $_POST['id_livre'], PDO::PARAM_INT);
    $resultat->execute();
    $livre = $resultat->fetch(PDO::FETCH_ASSOC);

}







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
        <input type="text" id="titre" name="titre" value="<?= (isset($_GET['id']))?$livre['titre']:'' ?>"><br><br>

        <label for="auteur">Auteur :</label><br>
        <input type="text" id="auteur" name="auteur" value="<?= (isset($_GET['id']))?$livre['auteur']:'' ?>"><br><br>

        <input type="submit" value="Enregistrement">
    </fieldset>

</form>
