<?php
echo '<pre>';
print_r($_POST);
echo '</pre>';
$msg='';
if (!empty($_POST)){
    if (empty($_POST['email'])) {
        $msg.="le champ 'mail' n'a pas été renseigné<br>";
    }

    if (empty($_POST['pseudo'])) {
        $msg.="le champ 'pseudo' n'a pas été renseigné<br>";
    }

}

echo $msg.'<br>';

if (empty($msg)){
    echo "tout est ok<br>";

    // enregistrement des infos ds un fichier.txt
    $f = fopen('liste.txt', 'a'); // ouvre le fichier 'liste.txt'. le deuxième argument  : 'a' (mode) permet de  créer le fichier s'il n'existe pas

    // fwrite(arg1, arg2);
    // arg1 : fichier en question
    // arg2 : ce qui est à écrire ds le fichier
    fwrite($f, $_POST['pseudo'].' - '.$_POST['email']."\r\n"); // \r\n : fait un saut de ligne quelque soit lsysytème

}
else{
    echo '<a href="formulaire3.php">Retour au formulaire</a>';
}
?>
<h1>Formulaire 4</h1>
