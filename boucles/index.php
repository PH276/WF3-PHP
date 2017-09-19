<?php
 // télécharger 5 images de image1.jpg
 // 1 : affiche l'image1
 // 2 : afficher 5 fois image1
 // 3 : afficher  image1 à image5

echo '<img src="image1.jpg" width="150" alt=""><br>';

$i = 1;
while($i <= 5){
    echo '<img src="image1.jpg" width="150" alt="">';
    $i++;
}
echo '<br>';
$i = 1;
while($i <= 5){
    echo '<img src="image'.$i.'.jpg"  width="150" alt="">';
    $i++;
}

 ?>
