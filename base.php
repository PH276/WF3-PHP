<h2>Ecriture et afficher</h2>
<!-- Prelmière chose : on constate du HTML dans du PHP (l'inverse n'est pas possible) -->


<?php
echo 'Bonjour'; //

echo '<br>';

echo "<h2>Les commentaires</h2>";
echo 'texte'; // Ceci est un saut de ligne
echo 'texte'; /* Ceci est un saut
sur plusieurs
lignes */

echo "<h2>Variables : Types, déclaration et affectation :</h2>";

$a = 127;

echo gettype($a); // entier (integer)

$b = 1.5222;
echo gettype($b); // nombre à virgule (double)

$c = 'chaîne de caractères';
echo gettype($c); // chaîne de caractères (string)

$d = true;
echo gettype($d); // booléen (boolean)

// $ma-variable;  // le '-' est utilisé pour la soustraction
// $ma variable;  // Pas d'espace

$ma_variable = 1; // OK snake_case
$maVariable = 1; // OK camelCase
$MaVariable = 1; // OK StreadyCase ou PascalCase
// $prénom = 'Yannick' // pas d'accent
$prenom = 'Yannick'; // OK
$prenom1 = 'Yannick'; // OK

// $2prenom = 'Yannick'; // ne commence pas par un chiffre

echo "<h2>La concaténation</h2>";
$x = 'Bonjour';
$y = ' tout le monde !';

echo $x.$y.'<br>';
echo "$x $y <br>";

echo "Hey ! $x $y <br>";
echo 'Hey ! '.$x.$y.'<br>';

echo 'Hey ! ',$x,$y,'<br>'; // existe avec des virgules ',' mais est très peu utilisé

echo '<h2>concaténation lors de l\'affectation</h2>';

$prenom1 = 'Bruno'; // affetation initiale
$prenom1 = 'Claire'; // affectation de remplacement

$prenom2 = 'Nicolas'; // affetation initiale
$prenom2 .= ' Marie'; // ajout d'une nouvelle
echo $prenom2;

echo '<h2>Guillement et quote</h2>';
$jour = "ajourd'hui";
$jour = 'ajourd`\'hui'; // faire attention

$txt = 'Bonjour';

echo $txt.' tout le monde !<br>';
echo $txt." tout le monde !<br>";

echo "$txt tout le monde !<br>";
echo '$txt tout le monde !<br>'; // entre quotes, les var ne sont pas évaluées mais simplement considérées comme une chaine de caractères

echo '<h2>Constantes et constantes magiques</h2>';
define('CAPITALE', 'Paris');

echo CAPITALE.'<br>';

/* define permet de créer une constante. Elle attend 2 arguments :
1 : le nom en MAJUSCULE et
2 : la valeur stockée
*/

// constantes magique
echo __DIR__.'<br>'; // répertoire où on est
echo __FILE__.'<br>';// fichier où on est
echo __LINE__.'<br>';// ligne où on est
echo __LINE__.'<br>';// ligne où on est

//  __FUNCTION__, __CLASS__, __METHOD__

// exo
// 1 : Afficher 'Bonjour' Yakine HAMIDA en rouge
$prenom = "Pascal";
$nom = "HUITOREL";
echo "<p style='color:red;'>";
echo "Bonjour ".$prenom." ".$nom;
echo "</p><br>";

// 2 : Afficher : 'Bleu - Blanc - Rouge' (3 var concaténées)
$bleu = 'Bleu';
$blanc = "Blanc";
$rouge = "Rouge";
echo $bleu." - ".$blanc." - ".$rouge."<br>";

echo '<h2>Opérateurs arithmétiques : </h2>';
$a = 10;
$b = 2;

echo $a + $b;
echo $a - $b;
echo $a / $b;
echo $a%$b;

$a += $b; // 12
$a -= $b; // 10
$a *= $b; // 20
$a /= $b; // 10

echo '<h2>Structures conditionnelles : </h2>';

// empty() : vide
// isset() : existe
$var1 = '42';
$var2 = 'Mon prénom';
$var3 = '';

if (empty($var1)) {
    echo "OK<br>";
}

// if, else, elseif
$a = 10;
$b = 5;
$c = 2;

if ($a>$b) {
    echo 'oui $a est supérieur est supérieur à $b<br>';
} else{
    echo 'non $a n\'est pas supérieur est supérieur à $b<br>';
}

if ($a>$b && $b>$c) {
    echo 'OK pour les 2 conditions<br>';
}

if($a == 9 || $b > $c){
    echo 'OK pour au moins une condition<br>';
}

if($a == 9 XOR $b > $c){
    echo 'OK pour uniquement une condition<br>';
}

if ($a == 8) {
    echo 'a est = à 8<br>';
} elseif ($a != 10){
    echo 'a est <> de 10<br>';
} else{
    echo 'a est = 10<br>';
}

echo '<h2>condition switch : </h2>';
$couleur = 'bleu';
switch ($couleur){
    case 'bleu' :
    echo 'vous aimez le bleu<br>';
    break;
    case 'rouge' :
    echo 'vous aimez le rouge<br>';
    break;
    case 'vert' :
    echo 'vous aimez le vert<br>';
    break;
    default :
    echo 'vous aimez aucune de ces 3 couleurs<br>';
    break;

}

// exo avec elseif
if  ($couleur == 'bleu') {
    echo 'vous aimez le bleu<br>';
} elseif ($couleur == 'rouge'){
    echo 'vous aimez le rouge<br>';
}elseif ($couleur == 'vert'){
    echo 'vous aimez le vert<br>';
} else {
    echo 'vous aimez aucune de ces 3 couleurs<br>';
}

echo '<h2>Fonctions prédéfinies</h2>';
/* Les Fonctions prédéfinies : traitements spécifiques
exite des centaines
doc officielle: voir php.net
*/

echo date('d/m/Y').'<br>'; // date() récupère la date du jour et attend en argument (string) le format pour la récupérer

echo date('d/m/Y h:m:s').'<br>'; // date() récupère la date du

echo '<h2>Fonctions prédéfinies sur les chaînesde carac</h2>';

$email = "p.H@adr.fr";


//strpos($email); // (string position) nous retourne l'emplacement d'un carac ds une CC
/*
2 arguments :
1 : la cc
2 : la chaine qu'on recherche

val de retour :
Succès : n (int)
Echec : false (boolean);
*/

$a = strpos($email, '@');
echo $a."<br>";

$phrase = "Il ne fait pas beau aujourd'hui";
echo strlen($phrase)."<br>"; // (string length) retourne le nombre de caractères (plus précisément 'octets' d'une CC (ex ç = 2 octets) ==> utiliser utf8_decode(CC)
/*
1 argument : la CC en question

réponse :
succès : n (int)
echec : false (boolean)
*/

echo empty($_POST)."<br>";

$texte = "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.";

echo substr($texte, 0, 40).'...<br>'; // (sub string) retourne une partie de CC
/*  3 arguments :
1 : La CC
2 : point de départ
3 : le nombre de carac (optionnel)

val d retour :
Succès : XXXXXXXXXXX (string)
echec : false (boolean)

*/

echo '<h2>Fonctions prédéfinies sur les chaînesde carac</h2>';

// fonctions utilisateurs

// 1/ exemple pour afficher Bonjour
// déclaration :
function bonjour(){
    echo 'bonjour !';
}

// exécution :
bonjour();
echo '<br>';

// 2/ afficher 'Hadi'
function bonjourPrenom($arg){
    echo 'Bonjour '.$arg.' !<br>';
}

bonjourPrenom('Hadi');

// 3/ afficher un titre h2
function titre($arg){
    echo '<h2>'.$arg.'</h2>';
}

// 4/ afficher un pirx TTC
function appliqueTva($prixHt){
    return $prixHt*1.2;
}

$montantHt = 164;
echo 'Le montant de votre commande '.$montantHt.'€ HT  revient à  '.appliqueTva($montantHt). '€ TTC<br>';


// exo function appliqueTva2 pout TVA de 5.5%, 10% ou 20%
function appliqueTva2($prixHt, $tva = 1.2){ // tva par défaut
    return $prixHt*(1 + $tva/100);
}

$montantHt = 10;
$tva = 10;
echo 'Le montant de votre commande '.$montantHt.'€ HT  revient à  '.appliqueTva2($montantHt, $tva). '€ TTC avec une TVA de '.$tva.'%<br>';


titre("Inclusions de fichier");
echo "include() : S'il y a une rreur ds le fich inclus ==> affiche les erreurs, et continue le script<br><br>";

echo "require() : S'il y a une rreur ds le fich inclus ==> affiche les erreurs, et stoppe l'éxécution script<br><br>";

echo "include_once() : comme include(), mais si le fichier est inclus plusieurs fois, il ne l'affichera qu'une seule fois.<br><br>";

echo "require_once() : comme require(), mais si le fichier est inclus plusieurs fois, il ne l'affichera qu'une seule fois.<br><br>";

titre('Structure itérative : les boucles');
// while :
$i = 0;
while($i < 3){
    echo $i.'---';
    $i++;
}
echo '<br>';
// exo : afficher 0---1---2
$i = 0;
$max = 3;
while($i < $max){
    if ($i != $max - 1){
        echo $i.'---';
    } else {
        echo $i;
    }
    $i++;
}
echo '<br>';
// exo : afficher 0---1---2
$i = 0;
$max = 3;
while($i < $max){
    echo $i;
    if ($i != $max - 1){
        echo '---';
    }
    $i++;
}


// boucle for
echo '<h3>boucle for</h3>';
for ($i = 0 ; $i < 3 ; $i++){
    echo $i . '---';
}
echo '<br>';
// exo 1 : afficher 0123456789
for ($i=0;$i<10;$i++){
    echo $i;
}
// exo 2 : 0 à 9 ds un tableau
echo '<table border="2">';
echo '<tr>';
for ($i=0;$i<10;$i++){
    echo "<td>";
    echo $i;
    echo "</td>";
}
echo '</tr>';
echo "</table>";
echo '<br>';
// exo 3 : afficher un tableau 10 ligne pour 0 à 99
echo '<table border="2">';
for ($i=0;$i<10;$i++){
    echo '<tr>';
    for ($j=0;$j<10;$j++){
        echo "<td>";
        echo 10*$i+$j;
        echo "</td>";
    }
    echo '</tr>';
}
echo "</table>";
echo '<br>';

// exo 3 : afficher un tableau 10 ligne pour 0 à 99
echo '<table border="2">';
$z=0;
for ($i=0;$i<10;$i++){
    echo '<tr>';
    for ($j=0;$j<10;$j++){
        echo "<td>";
        echo $z++;
        echo "</td>";
    }
    echo '</tr>';
}
echo "</table>";
echo '<br>';

// exo 3 : afficher un tableau 10 ligne pour 0 à 99
echo '<table border="2">';
for ($i=0;$i<100;$i++){
    if ($i%10 == 0){
        echo "<tr>";
    }
    echo "<td>";
    echo $i;
    echo "</td>";
    if ($i%10 == 9){
        echo "</tr>";
    }
}
echo "</table>";
echo '<br>';

titre("tableau de données array()");
$liste = array('Yakine', 'Hadi', 'Myriem', 'Corinne', 'Pascal');
echo '<pre>';
print_r ($liste);
echo '</pre>';
echo '<br>';

titre("boucle foreach pour les array");
$tab[] = "France";
$tab[] = "Espagne";
$tab[] = "Italie";
$tab[] = "Angleterre";
$tab[] = "Portugal";

echo '<pre>';
print_r ($tab);
echo '</pre>';

echo $tab[2]."<br>";

$tab[4] = "Suisse";
$tab[] = "Allemagne";

echo '<pre>';
print_r ($tab);
echo '</pre>';

foreach ($tab as $valeur){ // permet de parcourir tous les éléments d'un tableau (ou aussi objet)
    echo $valeur.'<br>';
}
echo '<br>';

foreach ($tab as $indice => $valeur){ // permet de parcourir tous les éléments d'un tableau avec l'indice de chaque élément
    echo 'A l\'indice ' . $indice . ' se trouve la valeur : ' .  $valeur.'<br>';
}
echo '<br>';

// Création d'un tableau avec indices choisis
$couleur = array(
    'couleur1' => 'Jaune',
    'couleur2' => 'rouge',
    'couleur3' => 'vert'
);

echo '<pre>';
print_r ($couleur);
echo '</pre>';
echo '<br>';

titre('tableau multidimensionnel');
$tab_multi = array(
    0 => array(
        'prenom' => 'Hadi',
        'nom'    => 'Smail'
    ),
    1 => array(
        'prenom' => 'Myriem',
        'nom'    => 'Boularouk'
    )
);
echo '<pre>';
print_r ($tab_multi);
echo '</pre>';
echo '<br>';


?>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>fin
