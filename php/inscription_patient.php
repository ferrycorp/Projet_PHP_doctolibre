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
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <!-- En-tête -->
    <header class="header py-3">
        <div class="container-fluid d-flex align-items-center">
            <h1 class="logo me-auto ms-3">Doctolibre</h1>
            <a href="connexion_soignant.php" class="btn btn-soignant">Vous êtes soignant ?</a>
        </div>
    </header>

    <!-- Contenu principal -->
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6 form-container">
                <h3 class="text-center mb-4">Inscrivez-vous</h3>
                <form action="traitement_inscription.php" method="POST">
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
</body>
</html>
