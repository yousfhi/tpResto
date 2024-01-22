<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Assurez-vous que l'utilisateur est connecté et récupérez son ID d'utilisateur depuis la session
    if (isset($_SESSION["mailU"])) {
        $idUtilisateur = $_SESSION["mailU"];
        var_dump($idUtilisateur);
        // Récupérez les données du formulaire
        $idRestaurant = intval($_POST['idRestaurant']);
        $note = $_POST['note'];
        $commentaire = $_POST['commentaire'];
        $dateVisite = $_POST['dateVisite'];
var_dump($_POST);
        // Validez les données (assurez-vous que la note est comprise entre 1 et 5)
        if ($note >= 1 && $note <= 5) {
            // Connexion à la base de données (à adapter selon votre configuration)
            $pdo = new PDO('mysql:host=localhost;dbname=avis', 'root', '');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Requête SQL pour insérer la critique dans la table Critiquer
            $query = "INSERT INTO Critiquer ( idR, mailU, note, commentaire, dateVisite)
                      VALUES (:idRestaurant,:idUtilisateur,  :note, :commentaire, :dateVisite)";

            $stmt = $pdo->prepare($query);

            $stmt->bindParam(':idRestaurant', $idRestaurant, PDO::PARAM_INT);
            $stmt->bindParam(':idUtilisateur', $idUtilisateur, PDO::PARAM_STR);
            $stmt->bindParam(':note', $note, PDO::PARAM_INT);
            $stmt->bindParam(':commentaire', $commentaire, PDO::PARAM_STR);
            $stmt->bindParam(':dateVisite', $dateVisite, PDO::PARAM_STR);

            // Exécution de la requête
            if ($stmt->execute()) {
                // Redirigez l'utilisateur vers une page de confirmation
                header('Location: confirmationCritique.php');
                exit();
            } else {
                echo "Erreur lors de l'enregistrement de la critique.";
            }
        } else {
            echo "La note doit être comprise entre 1 et 5.";
        }
    }
}
?>
