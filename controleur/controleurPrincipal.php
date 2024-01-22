<?php

function controleurPrincipal($action){
    $lesActions = array();
    $lesActions["defaut"] = "listeRestos.php";
    $lesActions["liste"] = "listeRestos.php";
    $lesActions["detail"] = "detailResto.php";
    $lesActions["connexion"] = "connexion.php";
    $lesActions["deconnexion"] = "deconnexion.php";
    $lesActions["profil"] = "monProfil.php";
    $lesActions["cgu"] = "cgu.php"; // --> Ajout de l'action pour les CGU
    $lesActions["aimer"] = "aimer.php"; // Ajout de l'action "aimer"
    $lesActions["inscription"] = "inscription.php";
    $lesActions["critique"] = "critique.php";

    
    if (array_key_exists ( $action , $lesActions )){
        return $lesActions[$action];
    }
    else{
        return $lesActions["defaut"];
    }

    if ($action === "inscription") {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Récupérez les données du formulaire d'inscription
            $mailU = $_POST['mailU'];
            $mdpU = $_POST['mdpU'];

            // Validez les données (vous pouvez ajouter des validations ici)

            // Appelez la fonction pour ajouter l'utilisateur à la base de données
            ajouterUtilisateur($mailU, $mdpU);

            
            header('Location: ./?action=confirmation_inscription');
            exit();
        }}
        
    if ($action === "critique" && isLoggedOn()) {
            $note = $_POST["note"];
            $commentaire = $_POST["commentaire"];
            $dateVisite = $_POST["dateVisite"];
            $idR = $_POST["resto"];
            $mailU = $_SESSION["mailU"]; // L'adresse e-mail de l'utilisateur connecté
        
            
            insererCritique($idR, $mailU, $note, $commentaire, $dateVisite);
        
           
            header("Location: ./?action=critique");
            exit();
        }
        
        

}
?>