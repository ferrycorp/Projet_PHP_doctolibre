<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctolibre - Inscription</title>
    <!-- Intégration de Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Police Great Vibes -->
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">
    <style>
        /* Style pour le logo */
        .header {
            background-color: #2895D5; /* Bleu harmonisé */
            color: white;
            width: 100%; /* S'assurer que la largeur est maximale */
        }
        .logo {
            font-family: 'Great Vibes', cursive;
            font-size: 48px;
            color: black;
            margin: 0;
        }
        /* Style personnalisé */
        body {
            background-color: #f8f9fa;
        }
        .header {
            background-color: #2895D5;
            padding: 20px;
        }
        .form-container {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .btn-custom {
            background-color: #2895D5;
            color: white;
        }
    </style>
</head>
<body>
    <!-- En-tête avec logo -->
    <header class="header text-start">
        <div class="container">
            <h1 class="logo">Doctolibre</h1>
        </div>
    </header>

    <!-- Formulaire d'inscription -->
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8 form-container">
                <h3 class="text-center mb-4">Inscrivez-vous</h3>
                <form action="traitement_inscription.php" method="POST">
                    <div class="row mb-3">
                        <!-- Nom -->
                        <div class="col-md-4">
                            <input type="text" class="form-control" placeholder="Nom" name="nom" required>
                        </div>
                        <!-- Prénom -->
                        <div class="col-md-4">
                            <input type="text" class="form-control" placeholder="Prénom" name="prenom" required>
                        </div>
                        <!-- Téléphone -->
                        <div class="col-md-4">
                            <input type="tel" class="form-control" placeholder="Téléphone" name="telephone" required>
                        </div>
                    </div>
                    <!-- Email et confirmation -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="email" class="form-label"><strong>Email</strong></label>
                            <input type="email" class="form-control" placeholder="exemple@gmail.com" name="email" required>
                        </div>
                        <div class="col-md-6">
                            <label for="confirm-email" class="form-label"><strong>Confirmer email</strong></label>
                            <input type="email" class="form-control" placeholder="exemple@gmail.com" name="confirm_email" required>
                        </div>
                    </div>
                    <!-- Mot de passe et confirmation -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label for="password" class="form-label"><strong>Mot de passe</strong></label>
                            <input type="password" class="form-control" placeholder="******" name="password" required>
                        </div>
                        <div class="col-md-6">
                            <label for="confirm-password" class="form-label"><strong>Confirmer mot de passe</strong></label>
                            <input type="password" class="form-control" placeholder="******" name="confirm_password" required>
                        </div>
                    </div>
                    <!-- Bouton de confirmation -->
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
