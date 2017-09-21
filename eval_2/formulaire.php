
<pre>
    <?php
    if (!empty($_POST)){

        extract($_POST);
        if(strlen($nom)>=3
        && strlen($prenom)>=3
        && is_numeric($telephone)
        && strlen($telephone)<=10
        && is_numeric($codepostal)) {
            print_r($_POST);
            $pdo = new PDO("mysql:host=localhost;dbname=repertoire", 'root', '1111', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            try {
                $resultat = $pdo->exec("INSERT INTO annuaire(nom, prenom, telephone, profession, ville, codepostal, adresse, date_de_naissance, sexe, description) VALUES ('$nom', '$prenom', '$telephone', '$profession', '$ville', '$codepostal', '$adresse', '$date_de_naissance', '$sexe', '$description')");


            } catch (PDOException $e) {
                ?>
                <div style="background:red;font-weight:bold;color:white;padding:10px">
                    <p>erreur SQL :</p>
                    <p>Code : <?php echo $e->getCode() ?></p>
                    <p>Message : <?php echo $e->getMessage() ?></p>
                    <p>Fichier : <?php echo $e->getFile() ?></p>
                    <p>Line : <?php echo $e->getLine() ?></p>
                </div>

                <?php
                $erreur = $e->getTrace();
                $f=fopen('error_log.txt', 'a');
                fwrite($f, date('d/m/Y H:i:s').' - '.$erreur[0]['file'].' - '.$erreur[0]['args'][0]."\r\n");
                exit();
            }


        }
    }
    ?>
</pre>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Répertoire</title>
</head>
<body>
    <form method="post" action="">
        <fieldset style="width:300px">
            <legend>Informations</legend>

            <label for="nom">Nom *</label><br>
            <input type="text" id="nom" name="nom"><br>

            <label for="prenom">Prénom *</label><br>
            <input type="text" id="prenom" name="prenom"><br>

            <label for="tel">Télephone *</label><br>
            <input type="text" id="tel" name="telephone"><br>

            <label for="profession">Prodession</label><br>
            <input type="text" id="profession" name="profession"><br>

            <label for="ville">Ville</label><br>
            <input type="text" id="ville" name="ville"><br>

            <label for="cp">Code postal</label><br>
            <input type="text" id="cp" name="codepostal"><br>

            <label for="adresse">Adresse</label><br>
            <textarea id="adresse" rows="2" cols="20" name="adresse"></textarea><br>

            <label for="date_de_naissance">Date de naissance</label><br>
            <input type="date" id="date_de_naissance" name="date_de_naissance"><br><br>

            <label>Sexe</label><br>
            <label for="m">homme : </label>
            <input id="m" type="radio" name="sexe" value="m" checked>
            <label for="f">femme : </label>
            <input id="f" type="radio" name="sexe" value="f"><br><br>

            <label for="description">Description</label><br>
            <textarea id="description" rows="6" cols="30" name="description"></textarea><br><br>

            <input type="submit" name="Envoyer" value="Enregistrer">
        </fieldset>

    </form>

</body>
</html>
