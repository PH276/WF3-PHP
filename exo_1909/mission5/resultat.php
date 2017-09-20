<?php
extract ($_POST);
if (is_numeric($champ1) && is_numeric($champ2)){
    switch ($operateur){
        case '+' :
            $resultat = $champ1 + $champ2;
            break;
        case '-' :
            $resultat = $champ1 - $champ2;
            break;
        case '*' :
            $resultat = $champ1 * $champ2;
            break;
        case '/' :
            $resultat = $champ1 / $champ2;
            break;
        default:
            header("Location: calculatrice.php");
    }
    echo "Le résultat est : ".$resultat."<br><br>";
}
else{
    header("Location: calculatrice.php");
}
?>
<a href="calculatrice.php">Effectuer un autre calcul</a>
