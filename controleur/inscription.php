<?php
// Inclure le fichier de configuration de la base de données
include_once "$racine/modele/authentification.inc.php";
include_once "$racine/modele/bd.utilisateur.inc.php";
include_once "$racine/modele/bd.typecuisine.inc.php";
include_once "$racine/modele/bd.resto.inc.php";

// Définir des variables pour stocker les valeurs du formulaire
$nom = "";
$email = "";
$motDePasse = "";

// Tableau pour stocker les messages d'erreur
$erreurs = [];

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Récupérer les données du formulaire
    $nom = trim($_POST["nom"]);
    $email = trim($_POST["email"]);
    $motDePasse = trim($_POST["motDePasse"]);

    // Valider les données
    if (empty($nom)) {
        $erreurs[] = "Le nom est requis.";
    }

    if (empty($email)) {
        $erreurs[] = "L'adresse e-mail est requise.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erreurs[] = "L'adresse e-mail n'est pas valide.";
    }

    if (empty($motDePasse)) {
        $erreurs[] = "Le mot de passe est requis.";
    }

    // Si les données sont valides, enregistrez l'utilisateur dans la base de données
    if (empty($erreurs)) {
        // Hasher le mot de passe (assurez-vous d'utiliser des méthodes sécurisées pour le hachage)
        $motDePasseHash = password_hash($motDePasse, PASSWORD_DEFAULT);

        // Insérer l'utilisateur dans la base de données
        $sql = "INSERT INTO utilisateurs (nom, email, mot_de_passe) VALUES (:nom, :email, :motDePasse)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':motDePasse', $motDePasseHash, PDO::PARAM_STR);

        if ($stmt->execute()) {
            // L'inscription a réussi, redirigez l'utilisateur vers une page de confirmation
            header("Location: inscription_reussie.php");
            exit();
        } else {
            // Erreur lors de l'inscription
            $erreurs[] = "Une erreur s'est produite lors de l'inscription. Veuillez réessayer.";
        }
    }
}
    $titre = "Inscription";
    include "$racine/vue/entete.html.php";
    include "$racine/vue/pied.html.php";
// Afficher le formulaire d'inscription
?>


