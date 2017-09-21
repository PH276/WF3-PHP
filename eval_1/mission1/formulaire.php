<?php
if (!empty($_POST)){

    echo '<pre>';
    print_r($_POST);
    echo '</pre>';

    foreach($_POST as $key => $val){
        echo $key.' : '.$val.'<br>';
    }
}

?>

<h1>Mission 1</h1>
<form method="post">
    <label for="nom">Nom</label>
    <input type="text" name="nom" id="nom"><br>

    <label for="prenom">Prénom</label>
    <input type="text" name="prenom" id="prenom"><br>

    <label for="adresse">Adresse</label>
    <input type="text" name="adresse" id="adresse"><br>

    <label for="ville">Ville</label>
    <input type="text" id="ville" name="ville" ><br>

    <label for="cp">Code postal</label>
    <input type="text" id="cp" name="cp" title="5 chiffres entre 0 et 9"><br>

    <label for="email">Email</label>
    <input type="text" name="email" id="email"><br>

    <label for="sexe">Sexe</label>
    <select name="sexe">
        <option value="m">Homme</option>
        <option value="f">Femme</option>
    </select>
    <br>
    <label for="description">Description</label>
    <textarea rows="10" cols="80" id="description" name="description"></textarea><br><br>

    <input type="submit" value="envoi">
</form>
