<?php
require_once ('../inc/init.inc.php');

if (isset($_GET['msg']) && $_GET['msg'] == 'validation' && isset($_GET['id'])){
    $msg .= '<div class="validation">Le membre n° '.$_GET['id'].' a été correctement enregistré !</div>';
}

if (isset($_GET['msg']) && $_GET['msg'] == 'suppr' && isset($_GET['id'])){
    $msg .= '<div class="validation">Le membre n° '.$_GET['id'].' a été correctement supprimé !</div>';
}

$resultat = $pdo->query('SELECT * FROM membre');
$membres = $resultat -> fetchAll(PDO::FETCH_ASSOC);
$contenu .=  '<br>Nombre de membres : '.$resultat->rowCount().'<br><hr>';

$contenu .= '<table border=1>';
$contenu .= '<tr>';

for($i=0;$i < $resultat->columnCount();$i++){
    $colonne = $resultat->getColumnMeta($i);
    if ($colonne['name']!='mdp'){
        $contenu .=  '<th>';
        $contenu .=  $colonne['name'];
        $contenu .= '</th>';
    }
}
$contenu .=  '<th colspan="2">';
$contenu .=  'Action';
$contenu .= '</th>';

$contenu .= '</tr>';
$euro = ' €';
foreach ($membres as $val){
    $contenu .= '<tr>';
    foreach($val as $key => $val2){
        if ($key !='mdp'){
            $contenu .= '<td>';
            $contenu .=  $val2;
            $contenu .= '</td>';
        }
    }
    $contenu .= '<td>';
    $contenu .= '<a href="../inscription.php?id='.$val['id_membre'].'"><img src="'.RACINE_SITE.'img/edit.png"  alt=""></a>';
    $contenu .= '</td>';
    $contenu .= '<td>';
    $contenu .= '<a href="supprimer_membre.php?id='.$val['id_membre'].'"><img src="'.RACINE_SITE.'img/delete.png" alt="" /></a>';
    $contenu .= '</td>';
    $contenu .= '</tr>';
}
$contenu .= '</table>';


$page = 'gmembre';
require_once ('../inc/header.inc.php');
?>

<!--  contenu HTML  -->
<h1>Gestion des membres de la boutique</h1>
<button type="button" name="button"><a class="btn-add"href="../inscription.php">Ajouter un membre</a></button>

<br>

<?= $contenu ?>
<?php require_once ('../inc/footer.inc.php'); ?>
