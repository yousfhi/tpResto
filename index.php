<?php
include "getRacine.php";
include "$racine/controleur/controleurPrincipal.php";
include_once "$racine/modele/authentification.inc.php";

if (isset($_GET["action"])) {
    $action = $_GET["action"];
} else {
    $action = "defaut";
}

// Ajoutez une condition pour gérer l'action "inscription"
if ($action === "inscription") {
    $fichier = "vueinscription.php";
} else {
    $fichier = controleurPrincipal($action);
}

include "$racine/controleur/$fichier";
?>
