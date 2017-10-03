<?php
$pdo = new PDO("mysql:host=localhost;dbname=bibliotheque", 'root', '1111', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));



$resultat = $pdo->query("SELECT * FROM abonne");
$abonnes = $resultat->fetchAll(PDO::FETCH_ASSOC);
// echo '<pre>';
// print_r($abonnes);
// echo '</pre>';

$resultat = $pdo->query("SELECT * FROM livre");
$livres = $resultat->fetchAll(PDO::FETCH_ASSOC);
// echo '<pre>';
// print_r($livres);
// echo '</pre>';

if (isset($_GET['id'])){
    $resultat = $pdo->prepare("SELECT * FROM emprunt WHERE id_emprunt=".$_GET['id']);
    $resultat->bindParam(':id_emprunt', $_POST['id_emprunt'], PDO::PARAM_INT);
    $resultat->execute();
    $emprunt = $resultat->fetch(PDO::FETCH_ASSOC);

}


$msg = '';

if (!empty($_POST)){
    echo '<pre>';
    print_r($_POST);
    echo '</pre>';

    if (empty($_POST['date_sortie'])){
        $msg .= "La date de sortie doit être saisie<br>";
    }

    if (empty($msg)){
        if (!isset($_GET['id'])) {
            $resultat = $pdo->prepare('INSERT INTO emprunt(id_abonne, id_livre, date_sortie, date_rendu) VALUES (:id_abonne, :id_livre, :date_sortie, :date_rendu)');

        }
        else{
            $resultat = $pdo->prepare('UPDATE emprunt SET
                 id_livre=:id_livre,
                 id_abonne=:id_abonne,
                 date_sortie=:date_sortie,
                 date_rendu=:date_rendu
                 WHERE id_emprunt=:id_emprunt');
        }
        $resultat->bindParam(':id_abonne', $_POST['id_abonne'], PDO::PARAM_INT);
        $resultat->bindParam(':id_livre', $_POST['id_livre'], PDO::PARAM_INT);
        $resultat->bindParam(':date_sortie', $_POST['date_sortie'], PDO::PARAM_STR);
        $resultat->bindParam(':date_rendu', $_POST['date_rendu'], PDO::PARAM_STR);
        $resultat->bindParam(':id_emprunt', $_GET['id'], PDO::PARAM_INT);

        $resultat->execute();
        $msg = $_POST['id_emprunt'].' a été enregistré';
    }
}

?>

<form method="post" action="" style="width:300px">
    <?php echo $msg; ?>
    <fieldset>
        <legend>Ajout d'un umprunt</legend>

        <input type="text" name="id_emprunt" value="<?= $_GET['id'] ?>" hidden>

        <label for="abonne">Abonné :</label><br>
        <select id="abonne" name="id_abonne">
            <?php foreach($abonnes as $val) : ?>
                <option value="<?= $val['id_abonne'] ?>" <?= (isset($_GET['id']) && $val['id_abonne']==$emprunt['id_abonne'])?' selected ':'' ?>><?= $val['id_abonne'].' - '.$val['prenom'] ?></option>
            <?php endforeach; ?>
        </select><br><br>

        <label for="livre">Livre :</label><br>
        <select id="livre" name="id_livre">
            <?php foreach($livres as $val) : ?>
                <option value="<?= $val['id_livre'] ?>" <?= (isset($_GET['id']) && $val['id_livre']==$emprunt['id_livre'])?' selected ':'' ?>><?= $val['id_livre'].' - '.$val['auteur'].' | '.$val['titre'] ?></option>
            <?php endforeach; ?>
        </select><br><br>

        <label for="date_de_sortie">Date de sortie :</label><br>
        <input type="date" id="date_de_sortie" name="date_sortie" value="<?= (isset($_GET['id']))?$emprunt['date_sortie']:'' ?>"><br><br>

        <label for="date_de_rendu">Date de Rendu :</label><br>
        <input type="date" id="date_de_rendu" name="date_rendu" value="<?= (isset($_GET['id']))?$emprunt['date_rendu']:'' ?>"><br><br>

        <input type="submit" value="Enregistrement">
    </fieldset>

</form>
