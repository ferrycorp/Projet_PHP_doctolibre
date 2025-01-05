<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctolibre - Inscription Patient</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Font - Great Vibes -->
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">
    <!-- CSS commun -->
    <link rel="stylesheet" href="../css/connexion_patient.css">
</head>
<body>
    <!-- En-tête -->
    <header class="header py-3 navbar-custom">
        <div class="container-fluid d-flex align-items-center justify-content-between">
            <!-- Lien vers la page de connexion_patient.php, sans soulignement -->
            <a href="connexion_patient.php" class="text-decoration-none">
                <h1>Doctolibre</h1>
            </a>

            <!-- Boutons de la navbar -->
            <div>
                <a href="connexion_medecin.php" class="btn btn-custom me-2">Vous êtes soignant ?</a>
            </div>
        </div>
    </header>

    <!-- Contenu principal -->
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6 form-container">
                <h3 class="text-center mb-4">Inscrivez-vous</h3>
                <form action="recherche.php" method="POST">
                    <!-- Nom et Prénom -->
                    <div class="row mb-3">
                        <div class="col">
                            <input type="text" class="form-control" placeholder="Nom" name="nom" required>
                        </div>
                        <div class="col">
                            <input type="text" class="form-control" placeholder="Prénom" name="prenom" required>
                        </div>
                    </div>
                    <!-- Téléphone -->
                    <div class="mb-3">
                        <input type="text" class="form-control" placeholder="Téléphone" name="telephone" required>
                    </div>
                    <!-- Email -->
                    <div class="mb-3">
                        <input type="email" class="form-control" placeholder="Email" name="email" required>
                    </div>
                    <!-- Confirmation Email -->
                    <div class="mb-3">
                        <input type="email" class="form-control" placeholder="Confirmer Email" name="confirm_email" required>
                    </div>
                    <!-- Mot de passe -->
                    <div class="mb-3">
                        <input type="password" class="form-control" placeholder="Mot de passe" name="password" required>
                    </div>
                    <!-- Confirmation Mot de passe -->
                    <div class="mb-4">
                        <input type="password" class="form-control" placeholder="Confirmer Mot de passe" name="confirm_password" required>
                    </div>
                    <!-- Bouton S'inscrire -->
                    <div class="text-center">
                        <button type="submit" class="btn btn-custom px-4">S'inscrire</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <?php
// Connexion à la base de données
include_once('database.php');
session_start();

$pdo = dbConnect();

// Vérification si les données POST sont reçues
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer et nettoyer les données du formulaire
    $nom = htmlspecialchars(trim($_POST['nom']));
    $prenom = htmlspecialchars(trim($_POST['prenom']));
    $telephone = htmlspecialchars(trim($_POST['telephone']));
    $email = htmlspecialchars(trim($_POST['email']));
    $confirm_email = htmlspecialchars(trim($_POST['confirm_email']));
    $password = htmlspecialchars(trim($_POST['password']));
    $confirm_password = htmlspecialchars(trim($_POST['confirm_password']));
    $date_naissance = htmlspecialchars(trim($_POST['date_naissance'] ?? null)); // Optionnel
    $sexe = htmlspecialchars(trim($_POST['sexe'] ?? null)); // Optionnel
    $adresse = htmlspecialchars(trim($_POST['adresse'] ?? null)); // Optionnel
    $code_postal = htmlspecialchars(trim($_POST['code_postal'] ?? null)); // Optionnel

    // Validation des données
    if ($email !== $confirm_email) {
        die("Les emails ne correspondent pas.");
    }
    if ($password !== $confirm_password) {
        die("Les mots de passe ne correspondent pas.");
    }

    // Hashage du mot de passe
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Préparer la requête SQL
    $sql = "INSERT INTO patients (nom_patients, prenom_patients, telephone_patiens, email_patiens, mot_de_passe) 
            VALUES (:nom, :prenom, :telephone, :email, :password)";
    
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':nom' => $nom,
            ':prenom' => $prenom,
            ':telephone' => $telephone,
            ':email' => $email,
            ':password' => $hashed_password,
        ]);

        echo "Inscription réussie !";
    } catch (PDOException $e) {
        die("Erreur lors de l'insertion des données : " . $e->getMessage());
    }
} else {
    echo "Méthode non autorisée.";
}
?>
</body>
</html>
