<?php
$msg='';
if (!empty($_POST)){
    echo '<pre>';
    print_r($_POST);
    echo '</pre>';

    // foreach ($_POST as $key => $val){
    //     if (empty($_POST[$key])) {
    //         $msg.="le champ '.$key.' n'a pas été renseigné<br>";
    //     }
    // }
    extract($_POST);

    $header = "From: $email \r\n";
    $header .= "Reply-to: $email \r\n";
    $header .= "MIME-Version: 1.0 \r\n";
    $header .= "Content-type: text/html; charset=iso-8859-1 \r\n";
    $header .= "X-Mailer: PHP/".phpversion();

    $contenu .= "<h1>$sujet</h1>";
    $contenu .= "<ul>";
    $contenu .= "<li>Prénom : $prenom</li>";
    $contenu .= "<li>Nom : $nom</li>";
    $contenu .= "<li>Email : $email</li>";
    $contenu .= "</ul><hr>";
    $contenu .= "<p>$message</p>";

    mail ($destinataire, $sujet, $contenu, $header); // dest, obj, contenu, entete
}

// echo $msg.'<br>';

?>
<h1>Formulaire 5</h1>
<form method="post">
    <label for="prenom">Prénom :</label><br>
    <input type="text" name="prenom" id="prenom"><br><br>

    <label for="nom">Nom :</label><br>
    <input type="text" name="nom" id="nom"><br><br>

    <label for="email">Email :</label><br>
    <input type="text" name="email" id="email"><br><br>

    <label for="sujet">Sujet :</label><br>
    <select class="" name="sujet">
        <option value="">Service client</option>
        <option value="">Problème technique</option>
        <option value="">Service presse</option>
        <option value="">Autre</option>
    </select>
    <br><br>
    <label for="message">Message :</label><br>
    <textarea rows="5" cols="22" id="message" name="message"></textarea><br><br>

    <input type="submit" value="Valider">
</form>
