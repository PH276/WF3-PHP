<?php
$pdo = new PDO("mysql:host=localhost;dbname=exercice_3", 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

$msg = '';

if (!empty($_POST)){
    echo '<pre>';
    print_r($_POST);
    echo '</pre>';

    if (strlen($_POST['title']) < 5){
        $msg .= '<p style="color:red">Le champ titre doit être saisi avec au moins 5 caractères</p>';
    }

    if (strlen($_POST['director']) < 5){
        $msg .= '<p style="color:red">Le champ du nom du réalisateur doit être saisi avec au moins 5 caractères</p>';
    }

    if (strlen($_POST['actors']) < 5){
        $msg .= '<p style="color:red">Le champ acteurs doit être saisi avec au moins 5 caractères</p>';
    }

    if (strlen($_POST['producer']) < 5){
        $msg .= '<p style="color:red">Le champ producteur doit être saisi avec au moins 5 caractères</p>';
    }

    if (strlen($_POST['storyline']) < 5){
        $msg .= '<p style="color:red">Le champ synopsis doit être saisi avec au moins 5 caractères</p>';
    }

    if (empty($_POST['year_of_prod']) || !is_numeric($_POST['year_of_prod']) || $_POST['year_of_prod'] < 1920 || $_POST['year_of_prod'] > date('Y')){
        $msg .= '<p style="color:red">Le champ année doit être entre 1920 et '.date('Y').'</p>';
    }

    if (empty($_POST['language']) || is_numeric($_POST['language'])){
        $msg .= '<p style="color:red">Le champ langue doit être saisi correctement</p>';
    }

    if ($_POST['category']<1 || $_POST['category']>3) {
        $msg .= '<p style="color:red">La catégorie doit être : thriller, comédie ou western</p>';
    }

    if (empty($_POST['video'])){
        $msg .= '<p style="color:red"></p>';
    }

    if (substr($_POST['video'], -4, 4) != '.mp4' && substr($_POST['video'], -5, 5) != '.mpeg') {
        $msg .= '<p style="color:red">Le lien video doit être saisi et être le nom d\'un fichier video</p>';
    }

    if (empty($msg)){
        $resultat = $pdo->prepare("INSERT INTO movies(title, actors, director, producer, year_of_prod, language, category, storyline, video) VALUES (:title, :actors, :director, :producer, :year_of_prod, :language, :category, :storyline, :video)");
        $resultat->bindParam(':title', $_POST['title'], PDO::PARAM_STR);
        $resultat->bindParam(':actors', $_POST['actors'], PDO::PARAM_STR);
        $resultat->bindParam(':director', $_POST['director'], PDO::PARAM_STR);
        $resultat->bindParam(':producer', $_POST['producer'], PDO::PARAM_STR);
        $resultat->bindParam(':year_of_prod', $_POST['year_of_prod'], PDO::PARAM_STR);
        $resultat->bindParam(':language', $_POST['language'], PDO::PARAM_STR);
        $resultat->bindParam(':category', $_POST['category'], PDO::PARAM_STR);
        $resultat->bindParam(':storyline', $_POST['storyline'], PDO::PARAM_STR);
        $resultat->bindParam(':video', $_POST['video'], PDO::PARAM_STR);

        if ($resultat->execute()){
            $msg .= '<p style="color:green">Votre film a bien été enregistré</p>';
        }
    }

}

?>
<form method="post" action="">
    <?php echo $msg; ?>

    <input type="hidden" name="id_movies">

    <label>titre :</label><br>
    <input type="text" name="title"><br><br>

    <label>Acteurs :</label><br>
    <input type="text" name="actors"><br><br>

    <label>Nom du réalisateur :</label><br>
    <input type="text" name="director"><br><br>

    <label>Producteur :</label><br>
    <input type="text" name="producer"><br><br>

    <label>année de production :</label><br>
    <select name="year_of_prod">
        <?php for ($i=date('Y'); $i > 1920; $i--) : ?>
            <option><?= $i ?></option>
        <?php endfor; ?>
    </select><br><br>

    <label>langue :</label><br>
    <select name="language">
        <option>français</option>
        <option>anglais</option>
        <option>allemand</option>
        <option>espagnol</option>
        <option>italien</option>
    </select><br><br>

    <label>categorie :</label><br>
    <select name="category">
        <option value="1">comédie</option>
        <option value="2">thriller</option>
        <option value="3">western</option>
    </select><br><br>

    <label>Synopsis :</label><br>
    <textarea name="storyline" rows="4" cols="60"></textarea><br><br>

    <label>video :</label><br>
    <input type="text" name="video"><br><br>


    <input type="submit" value="Enregistrer">

</form>
