<?php
// fonction pour affi les debug (print_r)
function debug($tab){
    echo '<div style="color:white;padding:20px;font-weight:bold;background:#'.rand(111111, 999999).'">';
    $trace = debug_backtrace();
    echo 'Le debug a été demandé dans le fichier : ' .$trace[0]['file'].' à la ligne '.$trace[0]['line'].'<hr>'; // retourne les infos sur l'emplacement où est exécutée une fonction

    echo '<pre>';
    print_r($tab);
    echo '</pre>';

    echo '</div>';
}


// fonction pour voir si un utilisateur est connecté :
function userConnecte(){
    if (isset($_SESSION['membre'])){
        return true;
    }
    else {
        return false;
    }
}
