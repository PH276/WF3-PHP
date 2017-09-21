<?php
echo date('F').'<br>';
echo date('F', mktime(0, 0, 0, 1, 1, 2012)).'<br>';
?>

<h1>Mission 2</h1>
<form method="post">
    <label for="jour">Jour</label>
    <select name="jour">
        <?php
        for ($i=1;$i<=31;$i++){
            $j = ($i<10)?'0'.$i:$i;
            echo '<option value="' . $i . '">'.$j.'</option>';
        }
         ?>
    </select>

    <label for="mois">Mois</label>
    <select name="Mois">
        <?php
        for ($i=1;$i<=12;$i++){
            $dte = date('F', mktime(0, 0, 0, $i, 1, 2017));
            echo '<option value="' . $i . '">' . $dte . '</option>';
        }
         ?>
    </select>

    <label for="annee">Annee</label>
    <select name="annee">
        <?php
        for ($i=date('Y');$i>=1900;$i--){
            echo '<option value="' . $i . '">'.$i.'</option>';
        }
         ?>
    </select>

    <input type="submit" value="envoi">
</form>
