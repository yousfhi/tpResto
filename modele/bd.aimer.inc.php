<?php

include_once "bd.inc.php";

// Fonction pour ajouter un "j'aime" d'un utilisateur pour un restaurant
function addAimer($mailU, $idR) {
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("INSERT INTO aimer (mailU, idR) VALUES (:mailU, :idR)");
        $req->bindValue(':mailU', $mailU, PDO::PARAM_STR);
        $req->bindValue(':idR', $idR, PDO::PARAM_INT);
        $req->execute();
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
}

// Fonction pour vérifier si un utilisateur a déjà aimé un restaurant
function getAimerById($mailU, $idR) {
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("SELECT COUNT(*) FROM aimer WHERE mailU = :mailU AND idR = :idR");
        $req->bindValue(':mailU', $mailU, PDO::PARAM_STR);
        $req->bindValue(':idR', $idR, PDO::PARAM_INT);
        $req->execute();
        $result = $req->fetchColumn();
        return ($result > 0);
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
}

// Fonction pour retirer un "j'aime" d'un utilisateur pour un restaurant
function delAimer($mailU, $idR) {
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("DELETE FROM aimer WHERE mailU = :mailU AND idR = :idR");
        $req->bindValue(':mailU', $mailU, PDO::PARAM_STR);
        $req->bindValue(':idR', $idR, PDO::PARAM_INT);
        $req->execute();
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
}

?>
