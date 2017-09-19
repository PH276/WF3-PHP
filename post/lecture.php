<?php
$fichier = file('liste.txt'); //==> array ; ligne (fichier) par ligne (array)
echo '<pre>';
print_r($fichier);
echo '</pre>';


// Afficher :
//

foreach ($fichier as $key => $val){
    $separ = ' - ';
    $inter = strpos($val, $separ);
    $pseudo = substr($val, 0, $inter);
    $email = substr($val, $inter+strlen($separ));
    echo "<h5>Inscrit n° ".$key."</h5>";
    echo "pseudo : ".$pseudo."<br>";
    echo "email : ".$email."<br><br>";

}








 ?>
