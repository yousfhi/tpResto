<?php

include_once "bd.inc.php";

function getTypesCuisine() {
    $resultat = array();

    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("select * from typeCuisine");
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

function getTypesCuisinePreferesByMailU($mailU) {
    $resultat = array();

    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("select typeCuisine.* from typeCuisine join preferer on typeCuisine.idTC = preferer.idTC WHERE preferer.mailU = :mailU");
        $req->bindValue(':mailU', $mailU, PDO::PARAM_STR);
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

function getTypesCuisineNonPreferesByMailU($mailU) {
    $resultat = array();

    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("select * from typeCuisine where idTC not in (select typeCuisine.idTC from typeCuisine join preferer on typeCuisine.idTC = preferer.idTC WHERE preferer.mailU = :mailU)");
        $req->bindValue(':mailU', $mailU, PDO::PARAM_STR);
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

function getTypesCuisineByIdR($idR){
    $resultat = array();

    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("select typeCuisine.* from typeCuisine join proposer on typeCuisine.idTC = proposer.idTC WHERE proposer.idR = :idR");
        $req->bindValue(':idR', $idR, PDO::PARAM_INT);
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

if (str_replace('/','\\',$_SERVER["SCRIPT_FILENAME"]) == __FILE__) {

    // prog principal de test
    header('Content-Type:text/plain');

    echo "getTypesCuisine() : \n";
    print_r(getTypesCuisine());

    echo "getTypesCuisineByIdR(idR) : \n";
    print_r(getTypesCuisineByIdR(4));
    
    echo "getTypesCuisinePreferesByMailU(mailU) : \n";
    print_r(getTypesCuisinePreferesByMailU("test@bts.sio"));
    
      
}
?>


