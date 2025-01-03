<?php
include_once('database.php');

// Connexion à la base de données
$conn = dbConnect();

// Utilisation d'un ID de patient spécifique pour tester
$id_patient = 1; // Remplacer par l'ID d'un patient existant pour tester

// Requête pour récupérer les informations du patient
$query = "SELECT * FROM patients WHERE id_patients = :id";
$stmt = $conn->prepare($query);
$stmt->bindParam(':id', $id_patient, PDO::PARAM_INT);
$stmt->execute();

// Vérifier si le patient existe
$patient = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$patient) {
    echo 'Patient non trouvé.';
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
    <link rel="stylesheet" href="css/fiche_patient.css"> <!-- Lien vers le CSS spécifique -->
</head>
<body>
    <!-- En-tête -->
    <header class="header">
        <a href="index.php" class="text-decoration-none">
            <h1>Doctolibre</h1>
        </a>
    </header>

    <!-- Contenu principal -->
    <div class="container">
        <h2 class="text-center mb-4">Fiche du Patient</h2>
        <div class="row">
            <div class="col-md-6">
                <p><strong>Nom :</strong> <?php echo htmlspecialchars($patient['nom_patients']); ?></p>
                <p><strong>Prénom :</strong> <?php echo htmlspecialchars($patient['prenom_patients']); ?></p>
                <p><strong>Téléphone :</strong> <?php echo htmlspecialchars($patient['telephone_patients']); ?></p>
                <p><strong>Email :</strong> <?php echo htmlspecialchars($patient['email_patiens']); ?></p>
                <p><strong>Date de naissance :</strong> <?php echo htmlspecialchars($patient['date_naissance']); ?></p>
                <p><strong>Sexe :</strong> <?php echo htmlspecialchars($patient['sexe']); ?></p>
            </div>
            <div class="col-md-6">
                <p><strong>Code postal :</strong> <?php echo htmlspecialchars($patient['code_postal']); ?></p>
                <p><strong>Adresse :</strong> <?php echo htmlspecialchars($patient['adresse']); ?></p>
            </div>
        </div>
        <a href="modification_patient.php?id=<?php echo $patient['id_patients']; ?>" class="btn btn-custom">Modifier les informations</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
