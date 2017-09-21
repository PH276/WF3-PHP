<?php
/*
Méthode exec()
-------------
préférable avec les requetes d'écritire (IDUR)

succes : n (int) : nombre de lignes affectées
echec : false


Méthode prepare() et execute()
-------------------------------
prepare valable pour ttes les rerequetes y (compris show)

utilisé ds le cas de donnéees sensibles ($_GET et $_POST) ds la requet
val de retour :
prepare() :
succes ou echec : objet PDOStatement

execute() :
succes : true
echec : false

*/
$pdo = new PDO("mysql:host=localhost;dbname=entreprise", 'root', '', array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
));

try {

    // 0/ erreur volontaire de requete
    // $resultat = $pdo->exec(";jhgb;kyn hkj");

    // 1/ INSERT
    $resultat = $pdo->exec("INSERT INTO employes(prenom, nom, service, sexe, salaire, date_embauche) VALUES ('Yakine', 'Hamida', 'informatique', 'm', 1500, curdate())");

    echo 'Nombre de lignes affectées : '.$resultat.'<br>';
    echo 'Dernier enregistrement : '.$pdo->lastInsertId().'<br>';


    // 2/ prepare() + execute() + passage d'arguments
    // 2.1 : marqueur '?'
    $prenom = 'Amandine';
    $resultat = $pdo->prepare("SELECT * FROM employes WHERE prenom=?");
    $resultat->execute(array(
        $prenom
    ));
    $nom = 'Thoyer';
    $resultat = $pdo->prepare("SELECT * FROM employes WHERE prenom = ? AND nom = ?");
    $resultat->execute(array(
        $prenom,
        $nom
    ));

    // 2.2 : marqueur ':' (nominatif) (permet de transmettre les valeurs sensibles)

    $prenom = 'Amandine';
    $nom = 'Thoyer';
    $resultat = $pdo->prepare("SELECT * FROM employes WHERE prenom = :prenom AND nom = :nom");
    $resultat->execute(array(
        'prenom' => $prenom,
        'nom' => $nom
    ));

    // 2.3 : marqueur ':' + bindParam() (nominatif) (permet de transmettre les valeurs sensibles)

    $prenom = 'Amandine';
    $nom = 'Thoyer';
    $resultat = $pdo->prepare("SELECT * FROM employes WHERE prenom = :prenom AND nom = :nom");

    $resultat->bindParam(':prenom', $prenom, PDO::PARAM_STR);
    $resultat->bindParam(':nom', $nom, PDO::PARAM_STR);
    $resultat->execute();
    // l'argument PDO::PARAM_STR caste la valeur en string





} catch (PDOException $e) {
    ?>
    <div style="background:red;font-weight:bold;color:white;padding:10px">
        <p>erreur SQL :</p>
        <p>Code : <?php echo $e->getCode() ?></p>
        <p>Message : <?php echo $e->getMessage() ?></p>
        <p>Fichier : <?php echo $e->getFile() ?></p>
        <p>Line : <?php echo $e->getLine() ?></p>
    </div>

    <?php
    $erreur = $e->getTrace();
    $f=fopen('error_log.txt', 'a');
    fwrite($f, date('d/m/Y H:i:s').' - '.$erreur[0]['file'].' - '.$erreur[0]['args'][0]."\r\n");
    exit();
}
