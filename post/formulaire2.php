<?php
echo '<pre>';
print_r($_POST);
echo '</pre>';

$msg=array();
$msg['adresse'] = '';
$msg['cp'] = '';
$msg['ville'] = '';
if (!empty($_POST)){
    foreach($_POST as $key => $val){
        if (empty($val)) {
            $msg[$key]='le champ \''.$key.'\' n\'a pas été renseignée<br>';
        }
        else {
            echo $key.' : '.$val.'<br>';
        }

    }

    ?>

    <h1>Formulaire 2</h1>
    <form method="post" action="">
        <?php echo $msg['adresse']; ?>
        <label for="ville">Ville :</label><br>
        <input type="text" id="ville" name="ville" ><br><br>

        <?php echo $msg['cp']; ?>
        <label for="cp">Code postal</label><br>
        <input type="text" id="cp" name="cp" max-length="5" pattern="[0-9]{5}" title="5 chiffres entre 0 et 9"><br><br>

        <?php echo $msg['ville']; ?>
        <label for="adresse">Adresse :</label><br>
        <textarea rows="5" cols="22" id="adresse" name="adresse"></textarea><br><br>

        <input type="submit" value="Valider">

    </form>
