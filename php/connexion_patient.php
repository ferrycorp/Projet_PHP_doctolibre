<?php
include_once('session.php');
include_once('database.php');
session_start();

$error = ''; // Pour afficher les erreurs de connexion

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['user']);
    $password = trim($_POST['pwd']);

    if (!empty($email) && !empty($password)) {
        try {
            // Requête préparée pour récupérer l'utilisateur par email
            $query = "SELECT * FROM patients WHERE email_patients = ?;";
            $stmt = $conn->prepare($query);
            $stmt->execute([$email]);
            $patient = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($patient && $password === $patient['mot_de_passe']) {  // Comparaison directe
                // Connexion réussie
                $_SESSION['email'] = $patient['email_patients'];
                $_SESSION['id_patients'] = $patient['id_patients'];

                // Gestion du cookie "Se souvenir de moi"
                if (isset($_POST['remember'])) {
                    setcookie('user', $email, time() + 86400 * 30, '/'); // Cookie pour 30 jours
                    setcookie('pwd', $password, time() + 86400 * 30, '/'); // Cookie pour 30 jours
                }

                header("Location: recherche.php"); // Redirige vers la page de recherche
                exit;
            } else {
                $error = "Email ou mot de passe incorrect.";
            }
        } catch (PDOException $e) {
            $error = "Erreur de connexion à la base de données.";
        }
    } else {
        $error = "Veuillez remplir tous les champs.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctolibre - Connexion Patient</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Font - Great Vibes -->
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">
    <!-- CSS commun -->
    <link rel="stylesheet" href="../css/connexion_medecin.css">
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
                <div>
                     <a href="deconnexion.php" class="btn btn-danger">Déconnexion</a>
                </div>
               
            </div>
            
        </div>
    </header>
    <!-- Contenu principal -->
    <div class="container ">
        <div class="row justify-content-center">
            <div class="col-md-6 form-container">
                <h3 class="text-center mb-4">Connectez-vous</h3>
                <form action="connexion_patient.php" method="post">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="user" placeholder="exemple@gmail.com" required value="<?php echo isset($_COOKIE['user']) ? htmlspecialchars($_COOKIE['user']) : ''; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Mot de passe</label>
                        <input type="password" class="form-control" id="password" name="pwd" placeholder="********" required value="<?php echo isset($_COOKIE['pwd']) ? htmlspecialchars($_COOKIE['pwd']) : ''; ?>">
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="remember" name="remember" <?php echo isset($_COOKIE['user']) ? 'checked' : ''; ?>>
                        <label class="form-check-label" for="remember">Se souvenir de moi</label>
                    </div>
                    <button type="submit" class="btn btn-custom w-100">Se connecter</button>
                    <?php if (!empty($error)): ?>
                        <div class="alert alert-danger mt-3"><?php echo $error; ?></div>
                    <?php endif; ?>
                    <div class="text-center mt-3">
                        <p>Pas de compte ? <a href="inscription_patient.php">S'inscrire</a></p>
                    </div>
                </form>
                    <!-- Message de rôle et nom de l'utilisateur -->
                    <div class="container mt-3">
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
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
