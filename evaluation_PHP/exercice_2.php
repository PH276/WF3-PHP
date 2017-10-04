<?php
function conversion ($valeur, $monnaie){

    if (!is_numeric($valeur)){
        return "Le premier paramètre doit être un nombre<br>";
    }
    if ($monnaie == "USD"){
        $resultat = $valeur * 1.085965;
    } elseif ($monnaie == "EUR"){
        $resultat = $valeur / 1.085965;
    } else {
        $resultat = "Le deuxième paramètre doit être 'USD' ou 'EUR'<br>";
    }

     return $resultat;
}

// tests de paramètres non respectés
echo conversion('olihj', '1').'<br>';
echo conversion('olihj', '1').'<br>';
echo conversion('1', 1).'<br>';
echo conversion(1, 'dsf').'<br>';

// test normal
echo '1 euro = '.conversion(1, 'USD').' dollar américain<br>';
echo '1 dollar américain = '.conversion(1, 'EUR').' euro<br>';
