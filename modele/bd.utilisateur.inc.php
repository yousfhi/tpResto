<?php

include_once "bd.inc.php";

function getUtilisateurs() {
    $resultat = array();

    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("select * from utilisateur");
        $req->execute();

        $ligne = $req->fetch(PDO::FETCH_ASSOC);
        while ($ligne) {
            $resultat[] = $ligne;
            $ligne = $req->fetch(PDO::FETCH_ASSOC);
        }
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}

function getUtilisateurByMailU($mailU) {
    $resultat = array();

    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("select * from utilisateur where mailU=:mailU");
        $req->bindValue(':mailU', $mailU, PDO::PARAM_STR);
        $req->execute();
        
        $resultat = $req->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}



function ajouterUtilisateur($mailU, $mdpU) {
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("INSERT INTO utilisateur (mailU, mdpU) VALUES (:mailU, :mdpU)");
        $req->bindValue(':mailU', $mailU, PDO::PARAM_STR);
        $req->bindValue(':mdpU', $mdpU, PDO::PARAM_STR);
        $req->execute();
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
}



if (str_replace('/','\\',$_SERVER["SCRIPT_FILENAME"]) == __FILE__) {

    // prog principal de test
    header('Content-Type:text/plain');

    echo "getUtilisateurs() : \n";
    print_r(getUtilisateurs());

    echo "getUtilisateurByMailU('mathieu.capliez@gmail.com') : \n";
    print_r(getUtilisateurByMailU("mathieu.capliez@gmail.com"));

}


?>