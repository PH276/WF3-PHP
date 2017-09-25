<?php
$pdo = new PDO("mysql:host=localhost;dbname=tchat", 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

$msg_error = '';

if (!empty($_POST)){
    if (!empty($_FILES['photo']['name'])){
        $nom_photo = time().'_'.rand(0,5000).'_'.$_FILES['photo']['name'];
        // echo $nom_photo.'<br>';

        if ($_FILES['photo']['type']=='image/jpeg' ||
          $_FILES['photo']['type']=='image/png' ||
          $_FILES['photo']['type']=='image/gif'){

            if ($_FILES['photo']['size']<=1000000){
                copy($_FILES['photo']['tmp_name'], __DIR__ . '/photo/' . $nom_photo);
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
        $msg_error .= "Le pseudo doit être saisi<br>";
    }

    if (empty($_POST['mdp'])){
        $msg_error .= "Le mot de passe doit être saisi<br>";
    }

    if(empty($_POST['email'])){
        $msg_error .= "L'email' doit être saisi<br>";
    }

    if (empty($msg_error)){
        $resultat = $pdo->prepare('INSERT INTO membre(pseudo, mdp, email, photo, statut) VALUES (:pseudo, :mdp, :email, :photo, "1")');

        $resultat->bindParam(':pseudo', $_POST['pseudo'], PDO::PARAM_STR);
        $resultat->bindParam(':mdp', $_POST['mdp'], PDO::PARAM_STR);
        $resultat->bindParam(':email', $_POST['email'], PDO::PARAM_INT);
        $resultat->bindParam(':photo', $nom_photo, PDO::PARAM_INT);


        $resultat->execute();
        $msg_error = $_POST['pseudo'].' a bien été enregistré';
    }
}

?>

<form method="post" action="" enctype="multipart/form-data">
    <?php echo $msg_error; ?>

    <!-- <label for="pseudo">Pseudo</label><br> -->
    <input type="text" id="pseudo" name="pseudo" placeholder="pseudo">
    <!-- <input type="text" id="pseudo" name="pseudo" value="<?php echo (isset($_POST['pseudo']))?$_POST['pseudo']:'' ?>"> -->
    <!-- <br> -->
    <label>votre avatar :</label>
    <input type="file" name="photo">
    <!-- <label for="mdp">Mot de passe</label><br> -->
    <input type="password" id="mdp" name="mdp" placeholder="mot de passe">
    <!-- <br> -->

    <!-- <label for="email">Email</label><br> -->
    <input type="text" id="email" name="email" placeholder="email">
    <!-- <br> -->

    <input type="submit" value="Enregistrer">
</fieldset>

</form>
