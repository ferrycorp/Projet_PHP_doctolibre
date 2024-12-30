<?php
if (isset($_SESSION)) {
    header("location:accueil.php");
    exit;
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
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <!-- En-tête -->
    <header class="header py-3 navbar-custom">
    <div class="container-fluid d-flex align-items-center">
        <!-- Lien vers la page de connexion_patient.php, sans soulignement -->
        <a href="connexion_patient.php" class="btn logo me-auto ms-3">
            <h1>Doctolibre</h1>
        </a>

        <!-- Boutons de la navbar -->
        <div class="d-flex">
            <a href="connexion_medecin.php" class="btn btn-custom me-2">Vous êtes soignant ?</a>
        </div>
    </div>
</header>

    
    <!-- Contenu principal -->
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6 form-container">
                <h3 class="text-center mb-4">Connectez-vous</h3>
                <form action="recherche.php" method="post">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="exemple@gmail.com" required value="<?php if(isset($_COOKIE["user"])) echo $_COOKIE["user"];?>">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Mot de passe</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="********" required value="<?php if(isset($_COOKIE["pwd"])) echo $_COOKIE["pwd"];?>">
                    </div>
                    <button type="submit" class="btn btn-custom w-100">Se connecter</button>
                    <?php if (!empty($error)): ?>
                        <div class="alert alert-danger mt-3"><?php echo $error; ?></div>
                    <?php endif; ?>
                    <!-- Lien pour s'inscrire -->
                     
                    <div class="text-center">
                        <br>
                        <p>Pas de compte ? <a href="inscription_patient.php">S'inscrire</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <?php
        if (isset($_GET["msg"])) {
            echo "<div class=\"msg\">".$_GET["msg"]."</div>";
        }
    ?>
</body>
</html>

