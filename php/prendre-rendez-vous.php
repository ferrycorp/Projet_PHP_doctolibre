<?php
include_once('session.php');
include_once('database.php');

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['id_patients'])) {
    header('Location: connexion_patient.php');
    exit;
}

$error = '';
$success = '';
$medecin_id = isset($_GET['medecin_id']) ? (int)$_GET['medecin_id'] : 0;

// Récupérer les informations du médecin
try {
    $stmt = $conn->prepare("SELECT m.nom_medecins, m.prenom_medecins, s.nom_specialite, l.ville, l.code_postal 
                            FROM medecins m
                            INNER JOIN specialite s ON m.specialite_id = s.id_specialite
                            INNER JOIN lieu l ON m.lieu = l.code_postal
                            WHERE m.id_medecins = ?");
    $stmt->execute([$medecin_id]);
    $medecin = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$medecin) {
        $error = "Médecin introuvable.";
    }
} catch (PDOException $e) {
    $error = "Erreur lors de la récupération des données : " . $e->getMessage();
}

// Récupérer les horaires disponibles
try {
    $horaires = $conn->query("SELECT id_horraire, heure_debut FROM horraire")->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $error = "Erreur lors du chargement des horaires : " . $e->getMessage();
}

// Enregistrement du rendez-vous
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $date_rendezvous = $_POST['date_rendezvous'] ?? '';
    $horraire_id = $_POST['horraire_id'] ?? '';

    if (empty($date_rendezvous) || empty($horraire_id)) {
        $error = "Veuillez remplir tous les champs.";
    } else {
        try {
            // Vérifier la disponibilité du rendez-vous
            $stmt = $conn->prepare("SELECT COUNT(*) FROM rendezvous 
                                    WHERE medecin_id = ? AND date_rendezvous = ? AND horraire = ?");
            $stmt->execute([$medecin_id, $date_rendezvous, $horraire_id]);
            $alreadyBooked = $stmt->fetchColumn();

            if ($alreadyBooked > 0) {
                $error = "Ce créneau est déjà réservé. Veuillez en choisir un autre.";
            } else {
                // Insére le rendez-vous
                $stmt = $conn->prepare("INSERT INTO rendezvous (commentaire, patients_id, medecin_id, code_postal, horraire, date_rendezvous)
                                        VALUES (?, ?, ?, ?, ?, ?)");
                $stmt->execute([
                    $_POST['commentaire'] ?? '',
                    $_SESSION['id_patients'],
                    $medecin_id,
                    $medecin['code_postal'],
                    $horraire_id,
                    $date_rendezvous
                ]);

                $success = "Rendez-vous pris avec succès.";
            }
        } catch (PDOException $e) {
            $error = "Erreur lors de la prise du rendez-vous : " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prendre un Rendez-vous</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">
    <link href="../css/recherche.css" rel="stylesheet">
</head>
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
<body>
    <div class="container">
        <h1 class="text-center">Prendre un Rendez-vous</h1>

        <!-- Affichage des messages d'erreur ou de succès -->
        <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php elseif (!empty($success)): ?>
            <div class="alert alert-success"><?php echo $success; ?></div>
        <?php endif; ?>

        <?php if (!empty($medecin)): ?>
            <!-- Informations sur le médecin -->
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">
                        Dr. <?php echo htmlspecialchars($medecin['prenom_medecins'] . ' ' . $medecin['nom_medecins']); ?>
                    </h5>
                    <p class="card-text">
                        <strong>Spécialité :</strong> <?php echo htmlspecialchars($medecin['nom_specialite']); ?><br>
                        <strong>Lieu :</strong> <?php echo htmlspecialchars($medecin['ville'] . ' (' . $medecin['code_postal'] . ')'); ?>
                    </p>
                </div>
            </div>

            <!-- Formulaire de prise de rendez-vous -->
            <form method="POST">
                <div class="mb-3">
                    <label for="date_rendezvous" class="form-label">Date du rendez-vous</label>
                    <input type="date" class="form-control" id="date_rendezvous" name="date_rendezvous" required>
                </div>
                <div class="mb-3">
                    <label for="horraire_id" class="form-label">Horaire</label>
                    <select class="form-select" id="horraire_id" name="horraire_id" required>
                        <option value="" selected>Choisir un horaire</option>
                        <?php foreach ($horaires as $horraire): ?>
                            <option value="<?php echo $horraire['id_horraire']; ?>">
                                <?php echo htmlspecialchars($horraire['heure_debut']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="commentaire" class="form-label">Commentaire (optionnel)</label>
                    <textarea class="form-control" id="commentaire" name="commentaire" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Confirmer le rendez-vous</button>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>
