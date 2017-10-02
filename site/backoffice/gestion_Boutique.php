<?php
require_once ('../inc/init.inc.php');

if (isset($_GET['msg']) && $_GET['msg'] == 'validation' && isset($_GET['id'])){
    $msg .= '<div class="validation">Le produit n° '.$_GET['id'].' a été correctement enregistré !</div>';
}

if (isset($_GET['msg']) && $_GET['msg'] == 'suppr' && isset($_GET['id'])){
    $msg .= '<div class="validation">Le produit n° '.$_GET['id'].' a été correctement supprimé !</div>';
}

$resultat = $pdo->query('SELECT * FROM produit');
$produits = $resultat -> fetchAll(PDO::FETCH_ASSOC);
$contenu .=  '<br>Nombre de produits : '.$resultat->rowCount().'<br><hr>';

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
$euro = ' €';
foreach ($produits as $val){
    $contenu .= '<tr>';
    foreach($val as $key => $val2){

        $contenu .= '<td>';
        if ($key == 'photo') {
            $contenu .= '<img src="' . RACINE_SITE . 'photo/' .$val2 .'" height="90" alt="" />';
        }
        elseif ($key == 'prix') {
            $contenu .=  $val2.$euro;
        }
        else {
            $contenu .=  $val2;
        }

        $contenu .= '</td>';
    }
    $contenu .= '<td>';
    $contenu .= '<a href="formulaire_produit.php?id='.$val['id_produit'].'"><img src="'.RACINE_SITE.'img/edit.png"  alt=""></a>';
    $contenu .= '</td>';
    $contenu .= '<td>';
    $contenu .= '<a href="supprimer_produit.php?id='.$val['id_produit'].'"><img src="'.RACINE_SITE.'img/delete.png" alt="" /></a>';
    $contenu .= '</td>';
    $contenu .= '</tr>';
}
$contenu .= '</table>';


$page = 'gboutique';
require_once ('../inc/header.inc.php');
?>

<!--  contenu HTML  -->
<h1>Gestion des produits de la boutique</h1>
<button type="button" name="button"><a class="btn-add"href="formulaire_produit.php">Ajouter un produit</a></button>

<br>

<?= $contenu ?>
<?php require_once ('../inc/footer.inc.php'); ?>
