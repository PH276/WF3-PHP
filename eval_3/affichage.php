<?php
$pdo = new PDO("mysql:host=localhost;dbname=bibliotheque", 'root', '1111', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

// suppression d'un abonné
if (isset($_GET['supp_abonne'])) : ?>
<p>Etes-vous sûr de vouloir supprimer l'abonné <?= $_GET['supp_abonne'] ?> ?</p>
    <a href="?a_supp_abonne=<?= $_GET['supp_abonne'] ?>">oui</a><br>
    <a href="?non=non">non</a>
<?php endif;
if (isset($_GET['a_supp_abonne'])) {
    $pdo->query("DELETE FROM `abonne` WHERE id_abonne=".$_GET['a_supp_abonne']);
}
// ----------------------------------------------------

// suppression d'un livre
if (isset($_GET['supp_livre'])) : ?>
<p>Etes-vous sûr de vouloir supprimer le livre <?= $_GET['supp_livre'] ?> ?</p>
    <a href="?a_supp_livre=<?= $_GET['supp_livre'] ?>">oui</a><br>
    <a href="?non=non">non</a>
<?php endif;
if (isset($_GET['a_supp_livre'])) {
    $pdo->query("DELETE FROM `livre` WHERE id_livre=".$_GET['a_supp_livre']);
}
// ----------------------------------------------------

// suppression d'un emprunt
if (isset($_GET['supp_emprunt'])) : ?>
<p>Etes-vous sûr de vouloir supprimer l'emprunt <?= $_GET['supp_emprunt'] ?> ?</p>
    <a href="?a_supp_emprunt=<?= $_GET['supp_emprunt'] ?>">oui</a><br>
    <a href="?non=non">non</a>
<?php endif;
if (isset($_GET['a_supp_emprunt'])) {
    $pdo->query("DELETE FROM `emprunt` WHERE id_emprunt=".$_GET['a_supp_emprunt']);
}
// ----------------------------------------------------
// ----------------------------------------------------

// Liste des abonnés
$contenu = '<h1>Affichages des listes</h1>';

$contenu .= '<h2>Liste des abonnés</h2>';
$resultat = $pdo->query("SELECT * FROM abonne");
$abonnes = $resultat->fetchAll(PDO::FETCH_ASSOC);

$contenu .= '<table border=1>';
$contenu .= '<tr>';

for($i=0;$i < $resultat->columnCount();$i++){
    $colonne = $resultat->getColumnMeta($i);
    $contenu .=  '<th>';
    $contenu .=  $colonne['name'];
    $contenu .= '</th>';
}
$contenu .=  '<th colspan="2">';
$contenu .=  'Action';
$contenu .= '</th>';

$contenu .= '</tr>';
foreach ($abonnes as $val){
    $contenu .= '<tr>';
    foreach($val as $key => $val2){

        $contenu .= '<td>';
        $contenu .=  $val2;
        $contenu .= '</td>';
    }

    $contenu .= '<td>';
    $contenu .= '<a href="#"><img src="img/edit.png"  alt=""></a>';
    $contenu .= '</td>';
    $contenu .= '<td>';
    $contenu .= '<a href="?supp_abonne='.$val['id_abonne'].'"><img src="img/delete.png" alt="" /></a>';
    $contenu .= '</td>';

    $contenu .= '</tr>';
}
$contenu .= '</table>';
echo $contenu;
// -------------------------------------------------------

// Liste des livres
$contenu = '<h2>Liste des livres</h2>';
$resultat = $pdo->query("SELECT * FROM livre");
$livres = $resultat->fetchAll(PDO::FETCH_ASSOC);

$contenu .= '<table border=1>';
$contenu .= '<tr>';

for($i=0;$i < $resultat->columnCount();$i++){
    $colonne = $resultat->getColumnMeta($i);
    $contenu .=  '<th>';
    $contenu .=  $colonne['name'];
    $contenu .= '</th>';
}
$contenu .=  '<th colspan="2">';
$contenu .=  'Action';
$contenu .= '</th>';

$contenu .= '</tr>';
foreach ($livres as $val){
    $contenu .= '<tr>';
    foreach($val as $key => $val2){

        $contenu .= '<td>';
        $contenu .=  $val2;
        $contenu .= '</td>';
    }

    $contenu .= '<td>';
    $contenu .= '<a href="#"><img src="img/edit.png"  alt=""></a>';
    $contenu .= '</td>';
    $contenu .= '<td>';
    $contenu .= '<a href="?supp_livre='.$val['id_livre'].'"><img src="img/delete.png" alt="" /></a>';
    $contenu .= '</td>';

    $contenu .= '</tr>';
}
$contenu .= '</table>';
echo $contenu;
// -------------------------------------------------------

// Liste des emprunts
$contenu = '<h2>Liste des emprunts</h2>';
$resultat = $pdo->query("SELECT * FROM emprunt");
$emprunts = $resultat->fetchAll(PDO::FETCH_ASSOC);

$contenu .= '<table border=1>';
$contenu .= '<tr>';

for($i=0;$i < $resultat->columnCount();$i++){
    $colonne = $resultat->getColumnMeta($i);
    $contenu .=  '<th>';
    $contenu .=  $colonne['name'];
    $contenu .= '</th>';
}
$contenu .=  '<th colspan="2">';
$contenu .=  'Action';
$contenu .= '</th>';

$contenu .= '</tr>';
foreach ($emprunts as $val){
    $contenu .= '<tr>';
    foreach($val as $key => $val2){

        $contenu .= '<td>';
        $contenu .=  $val2;
        $contenu .= '</td>';
    }
    $contenu .= '<td>';
    $contenu .= '<a href="ajout_emprunt.php?id='.$val['id_emprunt'].'"><img src="img/edit.png"  alt=""></a>';
    $contenu .= '</td>';
    $contenu .= '<td>';
    $contenu .= '<a href="?supp_emprunt='.$val['id_emprunt'].'"><img src="img/delete.png" alt="" /></a>';
    $contenu .= '</td>';
    $contenu .= '</tr>';
}
$contenu .= '</table>';
echo $contenu;
// -------------------------------------------------------
