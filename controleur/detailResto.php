<?php
// ...

if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    $racine = "..";
}
include_once "$racine/modele/bd.resto.inc.php";
include_once "$racine/modele/bd.typecuisine.inc.php";
include_once "$racine/modele/bd.photo.inc.php";

// Création du menu burger
$menuBurger = array();
$menuBurger[] = Array("url"=>"#top","label"=>"Le restaurant");
$menuBurger[] = Array("url"=>"#adresse","label"=>"Adresse");
$menuBurger[] = Array("url"=>"#photos","label"=>"Photos");
$menuBurger[] = Array("url"=>"#horaires","label"=>"Horaires");
$menuBurger[] = Array("url"=>"#crit","label"=>"Critiques");

// Récupération des données GET, POST, et SESSION
$idR = $_GET["idR"];

// Appel des fonctions permettant de récupérer les données utiles à l'affichage
$unResto = getRestoByIdR($idR);

$lesTypesCuisine = getTypesCuisineByIdR($idR);
$lesPhotos = getPhotosByIdR($idR);




// Gestion de l'action "aimer" si l'utilisateur a cliqué sur l'étoile
if (isset($_GET["action"]) && $_GET["action"] == "aimer") {
    // Assurez-vous que l'utilisateur est authentifié ici
    
    // Récupérez l'adresse e-mail de l'utilisateur connecté (vous devez avoir cette fonctionnalité)
    $mailU = getMailULoggedOn();
    
    if ($mailU != "") {
        $aimer = getAimerById($mailU, $idR);

        // Traitement si nécessaire des données récupérées
        if ($aimer == false) {
            // Ajouter le restaurant à la liste des restaurants aimés
            addAimer($mailU, $idR);
        } else {
            // Retirer le restaurant de la liste des restaurants aimés
            delAimer($mailU, $idR);
        }
    }
}

// Appel du script de vue qui permet de gérer l'affichage des données
$titre = "Détail d'un restaurant";
include "$racine/vue/entete.html.php";
include "$racine/vue/vueDetailResto.php";
include "$racine/vue/pied.html.php";
?>
