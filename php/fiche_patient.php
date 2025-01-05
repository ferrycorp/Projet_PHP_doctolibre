<?php
include_once('database.php');
session_start();  // Démarre la session pour récupérer les informations du patient connecté

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['id_patients'])) {
    echo '<p>Veuillez vous connecter pour accéder à votre fiche. <a href="connexion_patient.php">Connexion</a></p>';
    exit;
}

// Vérifier si la connexion à la base de données a réussi
if (!$databaseConnexion) {
    echo '<p>Erreur de connexion à la base de données. <a href="rendez_vous_medecin.php">Retour à l\'accueil</a></p>';
    exit;
}

// Définir la table, la colonne, et la valeur pour la requête
$table = "patients";
$column = "id_patients";
$value = $_SESSION['id_patients'];  // Utiliser l'ID du patient connecté

try {
    // Construire et exécuter la requête SQL
    $query = "SELECT * FROM " . $table . " WHERE " . $column . " = ?;";
    $request = $conn->prepare($query);
    $request->bindParam(1, $value, PDO::PARAM_INT);
    $request->execute();

    // Récupérer les données du patient
    $patient = $request->fetch(PDO::FETCH_ASSOC);

    // Vérifier si le patient existe
    if (!$patient) {
        echo '<p>Patient non trouvé. <a href="rendez_vous_medecin.php">Retour à l\'accueil</a></p>';
        exit;
    }
} catch (PDOException $e) {
    echo '<p>Erreur lors de la récupération des informations. <a href="rendez_vous_medecin.php">Retour à l\'accueil</a></p>';
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fiche Patient - Doctolibre</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/fiche_patient.css">
</head>
<body>
    <!-- En-tête -->
    <header class="header py-3 navbar-custom">
        <div class="d-flex align-items-center justify-content-between">
            <a href="connexion_patient.php" class="text-decoration-none">
                <h1>Doctolibre</h1>
            </a>
            <div>
                <a href="deconnexion.php" class="btn btn-danger btn-sm">Se déconnecter</a>
            </div>
        </div>
    </header>

    <!-- Contenu principal -->
    <div class="container">
        <h2 class="text-center mb-4">Fiche du Patient</h2>
        <div class="row">
            <div class="col-md-6">
                <p><strong>Nom :</strong> <?php echo htmlspecialchars($patient['nom_patients']); ?></p>
                <p><strong>Prénom :</strong> <?php echo htmlspecialchars($patient['prenom_patients']); ?></p>
                <p><strong>Téléphone :</strong> <?php echo htmlspecialchars($patient['telephone_patients']); ?></p>
                <p><strong>Email :</strong> <?php echo htmlspecialchars($patient['email_patients']); ?></p>
                <p><strong>Date de naissance :</strong> <?php echo htmlspecialchars($patient['date_naissance']); ?></p>
                <p><strong>Sexe :</strong> <?php echo htmlspecialchars($patient['sexe']); ?></p>
            </div>
            <div class="col-md-6">
                <p><strong>Code postal :</strong> <?php echo htmlspecialchars($patient['code_postal']); ?></p>
                <p><strong>Adresse :</strong> <?php echo htmlspecialchars($patient['adresse']); ?></p>
            </div>
        </div>

        <!-- Autres informations si nécessaire -->
        <div class="row mt-4">
            <div class="col-md-12">
                <h4>Rendez-vous et Historique Médical</h4>
                <p>Vous pouvez ajouter des informations concernant les rendez-vous médicaux ou l'historique médical ici.</p>
                <!-- Vous pouvez ajouter ici des sections supplémentaires si nécessaire -->
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
