<?php
$tab = array("tableau" => array(0 => "julien", 1 => "nicolas", 2 => "mathieu", 3 => "christelle", 4 => "nina", 5 => "johanna"));
echo '<pre>';
print_r($tab);
echo '</pre>';

$mathieu = $tab['tableau'][2];
echo $mathieu ;

$f = fopen('prenom.txt', 'a');

fwrite($f, $mathieu."\r\n");

 ?>
