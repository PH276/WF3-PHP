<?php
$pdo = new PDO("mysql:host=localhost;dbname=bibliotheque", 'root', '1111', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

$msg = '';

if (isset($_GET['id'])){
    $resultat = $pdo->prepare("SELECT * FROM abonne WHERE id_abonne=".$_GET['id']);
    $resultat->bindParam(':id_abonne', $_POST['id_abonne'], PDO::PARAM_INT);
    $resultat->execute();
    $abonne = $resultat->fetch(PDO::FETCH_ASSOC);

}

if (!empty($_POST)){
    echo '<pre>';
    print_r($_POST);
    echo '</pre>';

    if (empty($_POST['prenom'])){
        $msg .= "Le prénom doit être saisi<br>";
    }

    if (empty($msg)){
        $resultat = $pdo->prepare('INSERT INTO abonne(prenom) VALUES (:prenom)');

        $resultat->bindParam(':prenom', $_POST['prenom'], PDO::PARAM_STR);

        $resultat->execute();
        $msg = $_POST['prenom'].' a bien été enregistré';
    }
}

?>

<form method="post" action="" style="width:300px">
    <?php echo $msg; ?>
    <fieldset>
        <legend>Ajout d'un abonné</legend>

        <label for="prenom">Prénom :</label><br>
        <input type="text" id="prenom" name="prenom" value="<?= (isset($_GET['id']))?$abonne['prenom']:'' ?>"><br><br>

        <input type="submit" value="Enregistrement">
    </fieldset>

</form>
