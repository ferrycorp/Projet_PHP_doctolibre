<?php
include_once('database.php'); // Inclure la connexion à la base de données

$error = ''; // Variable pour stocker les erreurs
$success = ''; // Variable pour stocker le message de succès

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $nom = trim($_POST['nom']);
    $prenom = trim($_POST['prenom']);
    $telephone = trim($_POST['telephone']);
    $email = trim($_POST['email']);
    $confirm_email = trim($_POST['confirm_email']);
    $mot_de_passe = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);
    
    // Vérification des champs
    if (empty($nom) || empty($prenom) || empty($telephone) || empty($email) || empty($mot_de_passe) || empty($confirm_email) || empty($confirm_password)) {
        $error = "Tous les champs doivent être remplis.";
    } elseif ($email !== $confirm_email) {
        $error = "Les adresses email ne correspondent pas.";
    } elseif ($mot_de_passe !== $confirm_password) {
        $error = "Les mots de passe ne correspondent pas.";
    } else {
        try {
            // Vérifier si l'email existe déjà dans la base de données
            $stmt = $conn->prepare("SELECT COUNT(*) FROM patients WHERE email_patients = ?");
            $stmt->execute([$email]);
            $count = $stmt->fetchColumn();

            if ($count > 0) {
                $error = "Cet email est déjà utilisé.";
            } else {
                // Insertion des données dans la base de données
                $query = "INSERT INTO patients (nom_patients, prenom_patients, telephone_patients, email_patients, mot_de_passe, date_naissance, sexe, code_postal, adresse) 
          VALUES (?, ?, ?, ?, ?, ? , ? , ? , ? )";
                $stmt = $conn->prepare($query);
                $stmt->execute([
                    $nom, 
                    $prenom, 
                    $telephone, 
                    $email, 
                    $mot_de_passe, // Mot de passe en clair (non recommandé)
                    '1900-01-01', // Date de naissance non renseignée
                    "M", // Sexe non renseigné
                    "75001", // Code postal par défaut
                    "adresse inconnue" // Adresse vide
                ]);
                $success = "Inscription réussie ! Vous pouvez maintenant vous connecter.";
            }
        } catch (PDOException $e) {
            $error = "Erreur lors de l'insertion : " . $e->getMessage();
        }
    }
}
?>

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
    <link rel="stylesheet" href="../css/inscription_medecin.css">
</head>
<body>
    <!-- En-tête -->
    <header class="header py-3 navbar-custom">
        <div class="container-fluid d-flex align-items-center justify-content-between">
            <a href="connexion_patient.php" class="text-decoration-none">
                <h1>Doctolibre</h1>
            </a>
            <div>
                <a href="connexion_medecin.php" class="btn btn-custom me-2">Vous êtes soignant ?</a>
            </div>
        </div>
    </header>

    <!-- Contenu principal -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 form-container">
                <h3 class="text-center mb-4">Inscrivez-vous</h3>
                
                <!-- Affichage des messages d'erreur ou de succès -->
                <?php if (!empty($error)): ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php endif; ?>
                <?php if (!empty($success)): ?>
                    <div class="alert alert-success"><?php echo $success; ?></div>
                <?php endif; ?>

                <!-- Formulaire d'inscription -->
                <form action="inscription_patient.php" method="POST">
                    <div class="mb-3">
                        <input type="text" class="form-control" placeholder="Nom" name="nom" required>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" placeholder="Prénom" name="prenom" required>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" placeholder="Téléphone" name="telephone" required>
                    </div>
                    <div class="mb-3">
                        <input type="email" class="form-control" placeholder="Email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <input type="email" class="form-control" placeholder="Confirmer l'Email" name="confirm_email" required>
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control" placeholder="Mot de passe" name="password" required>
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control" placeholder="Confirmer le Mot de passe" name="confirm_password" required>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-custom px-4">S'inscrire</button>
                    </div>
                </form>
                <div class="text-center mt-3">
                    <p>Déjà un compte ? <a href="connexion_patient.php">Se connecter</a></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
