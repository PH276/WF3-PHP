<?php

$entete = array (
    'Prenom',
    'Nom',
    'Adresse',
    'Code Postal',
    'Ville',
    'Email',
    'Telephone',
    'Date_de_naissance'
);

$contenu = '<table border=1>';
$contenu .= '<tr>';

for($i=0;$i < count($entete);$i++){
    $contenu .=  '<th>';
    $contenu .=  "$entete[$i]";
    $contenu .= '</th>';
}
$contenu .= '</tr>';
// fin entête

$data = array (
    'Pascal',
    'HUITOREL',
    '10 rue Henri Barbusse',
    '92390',
    'Villeneve-la-Garenne',
    'pascal.huitorel@lepoles.com',
    '0174546406',
    '1966-07-22'
);
$contenu .= '<tr>';

for($i=0;$i < count($data);$i++){
    $contenu .=  '<td>';
    $contenu .=  "$data[$i]";
    $contenu .= '</td>';
}

$contenu .= '</tr>';


$contenu .= '</table>';
echo $contenu;
?>
