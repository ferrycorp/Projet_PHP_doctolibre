<?php
session_start();
include_once('database.php'); // Inclure la connexion à la base de données

// Récupérer les informations du médecin connecté
$id_medecins = $_SESSION['id_medecins'];
$email_medecins = $_SESSION['email'];
try {
    $query = "SELECT * FROM medecins WHERE id_medecins = ?;";
    $stmt = $conn->prepare($query);
    $stmt->execute([$id_medecins]);
    $medecin = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$medecin) {
        // Si le médecin n'existe pas dans la base, détruire la session et rediriger
        session_destroy();
        header("Location: connexion_medecin.php");
        exit();
    }

    // Stocker les données du médecin pour l'affichage
    $nom_medecin = $medecin['nom_medecins'];
    $prenom_medecin = $medecin['prenom_medecins'];
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctolibre - Rendez-vous à venir</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Font - Great Vibes -->
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">
    <!-- CSS commun -->
    <link rel="stylesheet" href="../css/rendez_vous_medecin.css">
</head>
<body>
    <!-- En-tête -->
    <header class="header py-3 navbar-custom">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <a href="index.php" class="text-decoration-none">
                <h1>Doctolibre</h1>
            </a>
            <div>
                <p class="mb-0">Bienvenue, Dr. <?php echo htmlspecialchars($medecin['prenom_medecins'] . ' ' . $medecin['nom_medecins']); ?></p>
                <a href="deconnexion.php" class="btn btn-danger btn-sm">Se déconnecter</a>
            </div>
        </div>
    </header>

    <!-- Contenu principal -->
    <div class="container">
        <div class="row">
            <!-- Section des rendez-vous -->
            <div class="col-md-8">
                <div class="card p-4">
                    <h3 class="text-center mb-4">Rendez-vous à venir</h3>
                    <div class="row">
                        <?php if (!empty($rendez_vous)): ?>
                            <!-- Matinée et Après-midi -->
                            <?php foreach ($rendez_vous as $rdv): ?>
                                <?php
                                    $heure = (new DateTime($rdv['date_heure']))->format('H');
                                    $periode = $heure < 12 ? "Matinée" : "Après-midi";
                                ?>
                                <div class="col-md-6">
                                    <h5 class="text-center"><?php echo $periode; ?></h5>
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <p><strong>Patient :</strong> <?php echo htmlspecialchars($rdv['prenom_patients'] . ' ' . $rdv['nom_patients']); ?></p>
                                            <p><strong>Le :</strong> <?php echo (new DateTime($rdv['date_heure']))->format('d/m/Y à H\hi'); ?></p>
                                            <a href="fiche_patient.php?patient_id=<?php echo urlencode($rdv['id_patients']); ?>" class="text-decoration-none">Information sur le patient</a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p class="text-center">Aucun rendez-vous à venir.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Calendrier -->
            <div class="col-md-4">
                <div class="card p-4 calendar">
                    <h5 class="text-center">Sélectionnez une date</h5>
                    <input type="date" class="form-control mt-3">
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
