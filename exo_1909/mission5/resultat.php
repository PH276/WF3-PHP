<?php
if (empty($_POST)){
    extract ($_POST);
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
    }
    echo "Le résultat est : ".$resultat."<br><br>";
}
else{
    header("Location: calculatrice.php");
}
?>
<a href="calculatrice.php">Effectuer un autre calcul</a>
