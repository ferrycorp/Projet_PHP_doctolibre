<?php
include_once('database.php'); // Inclure la connexion à la base de données

$error = ''; // Variable pour les erreurs
$medecins = []; // Tableau pour stocker les résultats de recherche

// Récupérer les spécialités et les codes postaux depuis la base de données
try {
    $specialites = $conn->query("SELECT id_specialite, nom_specialite FROM specialite")->fetchAll(PDO::FETCH_ASSOC);
    $lieux = $conn->query("SELECT DISTINCT code_postal, ville FROM lieu")->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erreur lors du chargement des données : " . $e->getMessage());
}

// Gestion de la recherche
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $nom_medecin = isset($_GET['nom_medecin']) ? trim($_GET['nom_medecin']) : '';
    $specialite_id = isset($_GET['specialite']) ? trim($_GET['specialite']) : '';
    $lieu = isset($_GET['lieu']) ? trim($_GET['lieu']) : '';

    try {
        // Construire la requête SQL dynamiquement
        $query = "SELECT m.nom_medecins, m.prenom_medecins, m.telephone_medecins, m.email_medecins, s.nom_specialite, l.code_postal, l.ville 
                  FROM medecins m
                  INNER JOIN specialite s ON m.specialite_id = s.id_specialite
                  INNER JOIN lieu l ON m.lieu = l.code_postal
                  WHERE 1=1";

        $params = [];
        if (!empty($nom_medecin)) {
            $query .= " AND (m.nom_medecins ILIKE ? OR m.prenom_medecins ILIKE ?)";
            $params[] = '%' . $nom_medecin . '%';
            $params[] = '%' . $nom_medecin . '%';
        }
        if (!empty($specialite_id)) {
            $query .= " AND m.specialite_id = ?";
            $params[] = $specialite_id;
        }
        if (!empty($lieu)) {
            $query .= " AND m.lieu = ?";
            $params[] = $lieu;
        }

        $stmt = $conn->prepare($query);
        $stmt->execute($params);
        $medecins = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        $error = "Erreur lors de la recherche : " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctolibre - Recherche Médecin</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Font - Great Vibes -->
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">
    <!-- CSS commun -->
    <link rel="stylesheet" href="../css/recherche.css">
</head>
<body>
    <!-- En-tête -->
    <header class="header py-3 navbar-custom">
        <div class="container-fluid d-flex align-items-center justify-content-between">
            <a href="connexion_patient.php" class="text-decoration-none">
                <h1>Doctolibre</h1>
            </a>
            <div>
                <a href="rendez_vous_passé.php" class="btn btn-custom me-2">Rendez-vous passés</a>
            </div>
        </div>
    </header>

    <!-- Contenu principal -->
    <div class="container">
        <h3 class="text-center mb-4">Recherchez un Médecin</h3>
        
        <!-- Formulaire de recherche -->
        <form method="GET" action="recherche.php" class="mb-5">
            <div class="row g-3">
                <div class="col-md-4">
                    <label for="nom_medecin" class="form-label">Nom du Médecin</label>
                    <input type="text" class="form-control" id="nom_medecin" name="nom_medecin" placeholder="Ex : Dupont" value="<?php echo htmlspecialchars($nom_medecin ?? ''); ?>">
                </div>
                <div class="col-md-4">
                    <label for="specialite" class="form-label">Spécialité</label>
                    <select class="form-select" id="specialite" name="specialite">
                        <option value="" selected>Toutes les spécialités</option>
                        <?php foreach ($specialites as $specialite): ?>
                            <option value="<?php echo $specialite['id_specialite']; ?>" <?php echo (isset($_GET['specialite']) && $_GET['specialite'] == $specialite['id_specialite']) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($specialite['nom_specialite']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="lieu" class="form-label">Code Postal</label>
                    <select class="form-select" id="lieu" name="lieu">
                        <option value="" selected>Tous les lieux</option>
                        <?php foreach ($lieux as $lieu): ?>
                            <option value="<?php echo $lieu['code_postal']; ?>" <?php echo (isset($_GET['lieu']) && $_GET['lieu'] == $lieu['code_postal']) ? 'selected' : ''; ?>>
                                <?php echo $lieu['code_postal'] . ' - ' . htmlspecialchars($lieu['ville']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="text-center mt-4">
                <button type="submit" class="btn btn-custom px-4">Rechercher</button>
            </div>
        </form>

        <!-- Résultats de recherche -->
        <div class="results">
            <?php if (!empty($error)): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php elseif (!empty($medecins)): ?>
                <h5 class="mb-4">Résultats de recherche :</h5>
                <ul class="list-group">
                    <?php foreach ($medecins as $medecin): ?>
                        <li class="list-group-item">
                            <h6><?php echo htmlspecialchars($medecin['prenom_medecins'] . ' ' . $medecin['nom_medecins']); ?></h6>
                            <p>
                                <strong>Spécialité :</strong> <?php echo htmlspecialchars($medecin['nom_specialite']); ?><br>
                                <strong>Téléphone :</strong> <?php echo htmlspecialchars($medecin['telephone_medecins']); ?><br>
                                <strong>Email :</strong> <?php echo htmlspecialchars($medecin['email_medecins']); ?><br>
                                <strong>Adresse :</strong> <?php echo htmlspecialchars($medecin['code_postal'] . ' - ' . $medecin['ville']); ?>
                            </p>
                            <a href="prendre-rendez-vous.php" class="btn btn-primary">
                                Prendre un rendez-vous
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p class="text-center">Aucun médecin trouvé pour votre recherche.</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
