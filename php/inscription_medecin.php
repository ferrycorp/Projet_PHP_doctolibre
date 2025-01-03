<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctolibre - Inscription Soignant</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Font - Great Vibes -->
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">
    <!-- CSS personnalisé -->
    <link rel="stylesheet" href="../css/inscription_medecin.css">
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
                <a href="connexion_medecin.php" class="btn btn-custom me-2">Vous avez deja un compte ?</a>
            </div>
        </div>
    </header>

    <!-- Contenu principal -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 form-container">
                <h3 class="text-center mb-4">Inscription soignant</h3>
                <form action="traitement_inscription_medecin.php" method="POST">
                    <!-- Nom, Prénom, Code postal, Téléphone -->
                    <div class="row mb-3">
                        <div class="col">
                            <input type="text" class="form-control" placeholder="Nom" name="nom" required>
                        </div>
                        <div class="col">
                            <input type="text" class="form-control" placeholder="Prénom" name="prenom" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <input type="text" class="form-control" placeholder="Code postal" name="code_postal" required>
                        </div>
                        <div class="col">
                            <input type="text" class="form-control" placeholder="Téléphone" name="telephone" required>
                        </div>
                    </div>
                    <!-- Spécialité -->
                    <div class="mb-3">
                        <input type="text" class="form-control" placeholder="Spécialité" name="specialite" required>
                    </div>
                    <!-- Email et confirmation -->
                    <div class="row mb-3">
                        <div class="col">
                            <input type="email" class="form-control" placeholder="Email" name="email" required>
                        </div>
                        <div class="col">
                            <input type="email" class="form-control" placeholder="Confirmer email" name="confirm_email" required>
                        </div>
                    </div>
                    <!-- Mot de passe et confirmation -->
                    <div class="row mb-4">
                        <div class="col">
                            <input type="password" class="form-control" placeholder="Mot de passe" name="password" required>
                        </div>
                        <div class="col">
                            <input type="password" class="form-control" placeholder="Confirmer mot de passe" name="confirm_password" required>
                        </div>
                    </div>
                    <!-- Bouton Confirmer -->
                    <div class="text-center">
                        <button type="submit" class="btn btn-custom px-4">Confirmer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
