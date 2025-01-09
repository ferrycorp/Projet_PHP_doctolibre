<?php
include_once('database.php');
session_start();

// Vérifier si l'ID du patient est dans l'URL
if (!isset($_GET['patient_id']) || !is_numeric($_GET['patient_id'])) {
    echo '<p>Identifiant du patient invalide. <a href="rendez_vous_medecin.php">Retour à l\'accueil</a></p>';
    exit;
}

// Récupérer l'ID depuis l'URL
$patient_id = intval($_GET['patient_id']);

// Vérifier si la connexion à la base de données a réussi
if (!$databaseConnexion) {
    echo '<p>Erreur de connexion à la base de données. <a href="rendez_vous_medecin.php">Retour à l\'accueil</a></p>';
    exit;
}

try {
    // Récupérer les informations du patient
    $query = "SELECT * FROM patients WHERE id_patients = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $patient_id, PDO::PARAM_INT);
    $stmt->execute();
    $patient = $stmt->fetch(PDO::FETCH_ASSOC);

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
        <div class="container-fluid d-flex align-items-center justify-content-between">
            <a href="connexion_medecin.php" class="text-decoration-none">
                <h1>Doctolibre</h1>
            </a>
            <div>
                <a href="deconnexion.php" class="btn btn-danger">Déconnexion</a>
                <div class="alert alert-info text-center" role="alert">
                    <?php echo $_SESSION['roleMessage']; ?> <br>
                    <?php
                    if (isset($_SESSION['nom_utilisateur']) && $_SESSION['nom_utilisateur'] !== '') {
                    echo 'Bienvenue, ' . $_SESSION['nom_utilisateur'] . ' !';
                    }
                    ?>
                </div>
            </div>
        </div>
    </header>

    <!-- Contenu principal -->
    <div class="container">
        <h2 class="text-center mb-4">Fiche du Patient</h2>
        <div class="row">
            <div class="col-md-6">
                <p><strong>Nom :</strong> <?= htmlspecialchars($patient['nom_patients']); ?></p>
                <p><strong>Prénom :</strong> <?= htmlspecialchars($patient['prenom_patients']); ?></p>
                <p><strong>Téléphone :</strong> <?= htmlspecialchars($patient['telephone_patients']); ?></p>
                <p><strong>Email :</strong> <?= htmlspecialchars($patient['email_patients']); ?></p>
                <p><strong>Date de naissance :</strong> <?= htmlspecialchars($patient['date_naissance']); ?></p>
                <p><strong>Sexe :</strong> <?= htmlspecialchars($patient['sexe']); ?></p>
            </div>
            <div class="col-md-6">
                <p><strong>Code postal :</strong> <?= htmlspecialchars($patient['code_postal']); ?></p>
                <p><strong>Adresse :</strong> <?= htmlspecialchars($patient['adresse']); ?></p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
