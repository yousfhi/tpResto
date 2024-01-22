<?php
include_once "$racine/modele/authentification.inc.php";
include_once "$racine/modele/bd.utilisateur.inc.php";
include_once "$racine/modele/bd.typecuisine.inc.php";
include_once "$racine/modele/bd.resto.inc.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérez les données du formulaire
    $note = $_POST['note'];
    $commentaire = $_POST['commentaire'];
    $dateVisite = $_POST['dateVisite'];

    // Validez que la note est comprise entre 1 et 5
    if ($note >= 1 && $note <= 5) {
        // Connexion à la base de données
        try {
            $pdo = new PDO('mysql:host=serveur;dbname=avis', 'root', '');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('Erreur de connexion à la base de données : ' . $e->getMessage());
        }

        // Utilisation de requêtes préparées pour éviter les injections SQL
        $query = "INSERT INTO Critiquer (idUtilisateur, idRestaurant, note, commentaire, dateVisite)
                  VALUES (:idUtilisateur, :idRestaurant, :note, :commentaire, :dateVisite)";

        
        $idUtilisateur = 1; 
        $idRestaurant = 123; // Remplacez par l'id du restaurant associé

        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':idUtilisateur', $idUtilisateur, PDO::PARAM_INT);
        $stmt->bindParam(':idRestaurant', $idRestaurant, PDO::PARAM_INT);
        $stmt->bindParam(':note', $note, PDO::PARAM_INT);
        $stmt->bindParam(':commentaire', $commentaire, PDO::PARAM_STR);
        $stmt->bindParam(':dateVisite', $dateVisite, PDO::PARAM_STR);

        // Exécution de la requête
        if ($stmt->execute()) {
            // Redirigez l'utilisateur vers une page de confirmation ou de succès
            header('Location: confirmation.php');
            exit();
        } else {
            // Gérez ici le cas où l'insertion a échoué
            echo "Erreur lors de l'enregistrement de la critique.";
        }
    } else {
        // Gérez ici le cas où la note n'est pas valide
        echo "La note doit être comprise entre 1 et 5.";
    }
}
?>
