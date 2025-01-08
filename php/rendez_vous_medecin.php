<?php
include_once('session.php');
include_once('database.php'); // Connexion via database.php

// Vérifier la connexion
if (!$databaseConnexion) {
    die('Erreur : Impossible de se connecter à la base de données.');
}

// Vérifier si un médecin est connecté
if (!isset($_SESSION['id_medecins'])) {
    die('Erreur : Aucun médecin connecté.');
}

// Récupération des rendez-vous du médecin connecté depuis la base de données
$query = "
    SELECT 
        r.commentaire,
        p.id_patients,
        p.nom_patients,
        p.prenom_patients,
        h.heure_debut,
        l.ville,
        m.nom_medecins,
        m.prenom_medecins
    FROM 
        rendezvous r
    JOIN patients p ON r.patients_id = p.id_patients
    JOIN medecins m ON r.medecin_id = m.id_medecins
    JOIN lieu l ON r.code_postal = l.code_postal
    JOIN horraire h ON r.horraire = h.id_horraire
    WHERE m.id_medecins = :medecin_id
    ORDER BY h.heure_debut ASC
";

try {
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':medecin_id', $_SESSION['id_medecins'], PDO::PARAM_INT); // Lier l'ID du médecin
    $stmt->execute();
    $rendez_vous = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Trier les rendez-vous en matin et soir
    $rendez_vous_matin = [];
    $rendez_vous_soir = [];
    foreach ($rendez_vous as $rdv) {
        $heure = strtotime($rdv['heure_debut']);
        if ($heure < strtotime('12:00:00')) {
            $rendez_vous_matin[] = $rdv;
        } else {
            $rendez_vous_soir[] = $rdv;
        }
    }
} catch (PDOException $e) {
    die('Erreur : ' . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctolibre - Rendez-vous à venir</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">
    <link href="../css/rendez_vous_medecin.css" rel="stylesheet">
</head>
<body>
    <!-- En-tête -->
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

    <!-- Contenu principal -->
    <div class="container">
        <h3 class="text-center">Rendez-vous à venir</h3>

        <!-- Section des rendez-vous du matin -->
        <h4 class="mt-4">Rendez-vous du Matin</h4>
        <div class="row">
            <?php if (!empty($rendez_vous_matin)): ?>
                <?php foreach ($rendez_vous_matin as $rdv): ?>
                    <div class="col-md-6">
                        <div class="card mb-3">
                            <div class="card-body">
                                <p><strong>Patient :</strong> <?= htmlspecialchars($rdv['prenom_patients'] . ' ' . $rdv['nom_patients']); ?></p>
                                <p><strong>Médecin :</strong> <?= htmlspecialchars($rdv['prenom_medecins'] . ' ' . $rdv['nom_medecins']); ?></p>
                                <p><strong>Lieu :</strong> <?= htmlspecialchars($rdv['ville']); ?></p>
                                <p><strong>Heure :</strong> <?= htmlspecialchars($rdv['heure_debut']); ?></p>
                                <p><strong>Commentaire :</strong> <?= htmlspecialchars($rdv['commentaire']); ?></p>
                                <a href="fiche_patient.php?patient_id=<?= urlencode($rdv['id_patients']); ?>" class="btn btn-custom me-2">Voir la fiche du patient</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Aucun rendez-vous programmé le matin.</p>
            <?php endif; ?>
        </div>

        <!-- Section des rendez-vous du soir -->
        <h4 class="mt-4">Rendez-vous de l'après-midi</h4>
        <div class="row">
            <?php if (!empty($rendez_vous_soir)): ?>
                <?php foreach ($rendez_vous_soir as $rdv): ?>
                    <div class="col-md-6">
                        <div class="card mb-3">
                            <div class="card-body">
                                <p><strong>Patient :</strong> <?= htmlspecialchars($rdv['prenom_patients'] . ' ' . $rdv['nom_patients']); ?></p>
                                <p><strong>Médecin :</strong> <?= htmlspecialchars($rdv['prenom_medecins'] . ' ' . $rdv['nom_medecins']); ?></p>
                                <p><strong>Lieu :</strong> <?= htmlspecialchars($rdv['ville']); ?></p>
                                <p><strong>Heure :</strong> <?= htmlspecialchars($rdv['heure_debut']); ?></p>
                                <p><strong>Commentaire :</strong> <?= htmlspecialchars($rdv['commentaire']); ?></p>
                                <a href="fiche_patient.php?patient_id=<?= urlencode($rdv['id_patients']); ?>" class="btn btn-custom me-2">Voir la fiche du patient</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Aucun rendez-vous programmé l'après-midi.</p>
            <?php endif; ?>
        </div>
        <div class="col-md-4">
                <div class="card p-4 calendar">
                    <h5 class="text-center">Sélectionnez une date</h5>
                    <input type="date" class="form-control mt-3">
                </div>
            </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
