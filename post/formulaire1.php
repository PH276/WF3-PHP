<?php
echo '<pre>';
print_r($_POST);
echo '</pre>';


// $_POST : informations postées via un formulaire
// à partir des champs ayant l'attribut 'name'


?>

<h1>Formulaire 1</h1>
<form method="post" action="">
    <label for="prenom">Prénom :</label><br>
    <input type="text" id="prenom" name="prenom" ><br><br>

    <label for="description">Description :</label><br>
    <textarea rows="5" cols="22" id="description" name="description"></textarea><br><br>

    <input type="submit" value="Valider">

</form>
