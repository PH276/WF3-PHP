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
?>
<div style="width:50%;position:absolute;top:0;left:0">

    <?php
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
        $contenu .= '<a href="ajout_abonne.php?id='.$val['id_abonne'].'"><img src="img/edit.png"  alt=""></a>';
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
        $contenu .= '<a href="ajout_livre.php?id='.$val['id_livre'].'"><img src="img/edit.png"  alt=""></a>';
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
    ?>
</div>
<div style="width:50%;position:absolute;top:0;right:0">
    <ul>

        <?php
        $contenu2 = '';
        // nb_abonnes
        $resultat = $pdo->query("SELECT count(*) FROM abonne");
        $abonnes = $resultat->fetch();
        $contenu2 .= "<li>Il y a $abonnes[0] abonnés</li>";

        // nb_livres
        $resultat = $pdo->query("SELECT count(*) FROM livre");
        $livres = $resultat->fetch();
        $contenu2 .= "<li>Il y a $livres[0] livres</li>";


        // nb_emprunt
        $resultat = $pdo->query("SELECT count(*) FROM emprunt");
        $emprunts = $resultat->fetch();
        $contenu2 .= "<li>Il y a $emprunts[0] emprunts</li>";

        // id et titre des livres non rendus
        $resultat = $pdo->query("SELECT e.id_livre, titre FROM emprunt e LEFT JOIN livre l ON l.id_livre=e.id_livre WHERE date_rendu IS NULL");
        $livre_non_rendu = $resultat->fetchAll(PDO::FETCH_ASSOC);
        $contenu2 .= "<li>Livre(s) non rendu : <ul>";
        foreach ($livre_non_rendu as $value) {
            $contenu2 .= "<li>$value[id_livre] - $value[titre]</li>";
        }
        $contenu2 .= "</ul></li>";

        // id des livres empruntés par Chloé
        $resultat = $pdo->query("SELECT id_livre FROM emprunt AS e LEFT JOIN abonne AS a ON a.id_abonne=e.id_abonne WHERE prenom = 'Chloe'");
        $id_livre_chloe = $resultat->fetchAll(PDO::FETCH_ASSOC);
        $contenu2 .= "<li>Livre(s) empruntés par Chloé : <ul>";
        foreach ($id_livre_chloe as $value) {
            $contenu2 .= "<li>$value[id_livre]</li>";
        }
        $contenu2 .= "</ul></li>";

        // abonnés ayant empruntés un livre d'Alphonse DAUDET
        $resultat = $pdo->query("SELECT prenom FROM emprunt e LEFT JOIN abonne a ON a.id_abonne=e.id_abonne LEFT JOIN livre l ON l.id_livre=e.id_livre WHERE auteur = 'Alphonse DAUDET'");
        $AlphonseDAUDET = $resultat->fetchAll(PDO::FETCH_ASSOC);
        $contenu2 .= "<li>abonnés ayant empruntés un livre d'Alphonse DAUDET : <ul>";
        foreach ($AlphonseDAUDET as $value) {
            $contenu2 .= "<li>$value[prenom]</li>";
        }
        $contenu2 .= "</ul></li>";

        // titre des livres non rendus par Chloé
        $resultat = $pdo->query("SELECT titre FROM emprunt AS e LEFT JOIN abonne AS a ON a.id_abonne=e.id_abonne LEFT JOIN livre l ON l.id_livre=e.id_livre WHERE prenom = 'Chloe' AND date_rendu IS NULL");
        $id_livre_chloe = $resultat->fetchAll(PDO::FETCH_ASSOC);
        $contenu2 .= "<li>Livre(s) non rendus par Chloé : <ul>";
        foreach ($id_livre_chloe as $value) {
            $contenu2 .= "<li>$value[titre]</li>";
        }
        $contenu2 .= "</ul></li>";


        // Livres non emprunté par Chloé
        $resultat = $pdo->query("SELECT titre FROM `livre`
            WHERE id_livre not in (SELECT id_livre FROM emprunt AS e LEFT JOIN abonne AS a ON a.id_abonne=e.id_abonne WHERE prenom = 'Chloe')");
            $id_livre_chloe = $resultat->fetchAll(PDO::FETCH_ASSOC);
            $contenu2 .= "<li>Livres non empruntés par Chloé : <ul>";
            foreach ($id_livre_chloe as $value) {
                $contenu2 .= "<li>$value[titre]</li>";
            }
            $contenu2 .= "</ul></li>";














            // Ceux qui ont empruntés le plus de livres
            $resultat = $pdo->query("SELECT prenom, count(e.id_abonne) cpt FROM emprunt e
            LEFT JOIN abonne a ON a.id_abonne = e.id_abonne
            GROUP BY e.id_abonne
            HAVING cpt=(SELECT count(e.id_abonne) cpt FROM emprunt e
            LEFT JOIN abonne a ON a.id_abonne = e.id_abonne
            GROUP BY e.id_abonne
            ORDER BY cpt DESC
            LIMIT 0,1)
            ORDER BY cpt DESC
            ");
            $res = $resultat->fetchALL(PDO::FETCH_ASSOC);

            $contenu2 .= "<li>Ceux qui ont empruntés le plus de livres : <ul>";
            foreach ($res as $value) {
                $contenu2 .= "<li>$value[prenom]</li>";
            }
            $contenu2 .= "</ul></li>";

            // nombre de liuvres empruntés par Guillaume
            $resultat = $pdo->query("SELECT count(*) cpt FROM emprunt e
            JOIN abonne a ON a.id_abonne=e.id_abonne
            WHERE prenom='Guillaume'
            ");
            $res = $resultat->fetch(PDO::FETCH_ASSOC);

            $contenu2 .= "<li>nombre de liuvres empruntés par Guillaume :";
            $contenu2 .= "$res[cpt]";
            $contenu2 .= "</li>";

            // abonnés ayant emprunté le livre « Une Vie » sur l’année 2011
            $resultat = $pdo->query("SELECT prenom FROM emprunt e
                JOIN abonne a ON a.id_abonne=e.id_abonne
                JOIN livre l ON l.id_livre=e.id_livre
                WHERE titre='Une vie' AND year(date_sortie)=2011");
                $res = $resultat->fetchAll(PDO::FETCH_ASSOC);

                $contenu2 .= "<li>abonnés ayant emprunté le livre « Une Vie » sur l’année 2011 : <ul>";
                foreach ($res as $value) {
                    $contenu2 .= "<li>$value[prenom]</li>";
                }
                $contenu2 .= "</ul></li>";

                // nombre de livre emprunté par chaque abonné
                $resultat = $pdo->query("SELECT prenom, count(*) cpt FROM emprunt e
                JOIN abonne a ON a.id_abonne=e.id_abonne
                GROUP BY prenom");
                $res = $resultat->fetchAll(PDO::FETCH_ASSOC);

                $contenu2 .= "<li>nombre de livre emprunté par chaque abonné : <ul>";
                foreach ($res as $value) {
                    $contenu2 .= "<li>$value[prenom]     $value[cpt]</li>";
                }
                $contenu2 .= "</ul></li>";

                // liste des emprunts
                $resultat = $pdo->query("SELECT prenom, titre, day(date_sortie) d, month(date_sortie) m, year(date_sortie) y FROM emprunt e
                JOIN abonne a ON a.id_abonne=e.id_abonne
                JOIN livre l ON l.id_livre=e.id_livre");
                $res = $resultat->fetchAll(PDO::FETCH_ASSOC);

                $contenu2 .= "<li>liste des emprunts : <ul>";
                foreach ($res as $value) {

                    $contenu2 .= "<li>$value[prenom]  a emprunté '$value[titre]' le $value[d]/$value[m]/$value[y]</li>";
                }
                $contenu2 .= "</ul></li>";

                echo $contenu2;
                ?>


            </ul>
        </div>
