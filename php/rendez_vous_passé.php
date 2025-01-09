<?php
include_once('database.php');
session_start(); 


// Si l'utilisateur est connecté, récupérer l'ID du patient
if (!isset($_SESSION['id_patients'])) {
    echo "Veuillez vous connecter pour accéder à vos rendez-vous.";
    exit;
}

$currentDate = date('Y-m-d');

// Requête SQL pour récupérer les rendez-vous passés
$sql = "SELECT r.commentaire, r.date_rendezvous,m.id_medecins, m.nom_medecins, m.prenom_medecins, r.horraire 
        FROM rendezvous r
        JOIN medecins m ON r.medecin_id = m.id_medecins
        WHERE r.date_rendezvous < :currentDate
        AND r.patients_id = :patient_id
        ORDER BY r.date_rendezvous DESC";

$stmt = $conn->prepare($sql);
$stmt->execute(['currentDate' => $currentDate, 'patient_id' => $_SESSION['id_patients']]);

$rendezvous = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctolibre - Rendez-vous Passés</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/rendez_vous_passé.css">
</head>
<body>
<header class="header py-3 navbar-custom">
        <div class="container-fluid d-flex align-items-center justify-content-between">
            <a href="connexion_medecin.php" class="text-decoration-none">
                <h1>Doctolibre</h1>
            </a>
            <div>
                
                <div class="alert alert-info text-center" role="alert">
                    <?php echo $_SESSION['roleMessage']; ?> <br>
                    <?php
                    if (isset($_SESSION['nom_utilisateur']) && $_SESSION['nom_utilisateur'] !== '') {
                        echo 'Bienvenue, ' . $_SESSION['nom_utilisateur'] . ' !';
                    }
                    ?>
                </div>
                <a href="deconnexion.php" class="btn btn-danger">Déconnexion</a>
            </div>
        </div>
    </header>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8">
                <div class="bg-light p-4 rounded shadow-sm">
                    <h4 class="text-center mb-4">Derniers Rendez-vous Passés</h4>
                    <?php if (count($rendezvous) > 0): ?>
    <?php foreach ($rendezvous as $r): ?>
        <div class="d-flex justify-content-between align-items-center mb-3 p-3 border rounded">
            <div>
                <p class="mb-1"><strong>Praticien</strong>: <?= htmlspecialchars($r['nom_medecins']) . ' ' . htmlspecialchars($r['prenom_medecins']) ?></p>
                <p class="mb-1"><strong>Date</strong>: <?= htmlspecialchars($r['date_rendezvous']) ?></p>
                <p class="mb-0"><strong>Commentaire</strong>: <?= htmlspecialchars($r['commentaire']) ?></p>
                <p class="mb-0"><strong>Durée</strong>: 20 min</p>
            </div>
            <!-- Bouton pour reprendre un rendez-vous avec le meme médecin -->
            <a href="prendre-rendez-vous.php?medecin_id=<?= $r['id_medecins']; ?>" class="btn btn-primary">
                <img src="../image/calendar.svg" alt="calendar icon">
                Prendre un rendez-vous
            </a>
        </div>
        <?php endforeach; ?>
        <?php else: ?>
        <p class="text-center">Aucun rendez-vous passé.</p>
        <?php endif;?>
                </div>
            </div>

            <div class="col-md-4">
                <div class="text-center">
                    <a href="recherche.php" class="btn btn-custom">
                        <img src="../image/calendar.svg" alt="calendar icon">
                        Reprendre rendez-vous
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
