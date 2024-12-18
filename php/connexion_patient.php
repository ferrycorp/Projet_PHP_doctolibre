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
    <style>
        /* Style global pour le bleu #2895D5 */
        .header {
            background-color: #2895D5; /* Bleu harmonisé */
            color: white;
            width: 100%; /* S'assurer que la largeur est maximale */
        }
        .header, .btn-custom {
            background-color: #2895D5; /* Bleu harmonisé */
            color: white;
        }
        .logo {
            font-family: 'Great Vibes', cursive;
            font-size: 48px;
            color: black;
            margin: 0;
        }
        .btn-custom:hover {
            background-color: #217BB0; /* Variation pour le hover */
        }
        .form-container {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        body {
            background-color: #f8f9fa; /* Fond général */
        }
    </style>
</head>
<body>
    <!-- En-tête -->
    <header class="header py-3">
        <div class="container">
            <h1 class="logo">Doctolibre</h1>
        </div>
    </header>

    <!-- Contenu principal : Formulaire de connexion -->
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6 form-container">
                <h3 class="text-center mb-4">Connectez-vous</h3>
                <form action="traitement_connexion.php" method="POST">
                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label"><strong>Email</strong></label>
                        <input type="email" class="form-control" placeholder="exemple@gmail.com" name="email" required>
                    </div>
                    <!-- Mot de passe -->
                    <div class="mb-4">
                        <label for="password" class="form-label"><strong>Mot de passe</strong></label>
                        <input type="password" class="form-control" placeholder="******" name="password" required>
                    </div>
                    <!-- Bouton Se connecter -->
                    <div class="text-center mb-3">
                        <button type="submit" class="btn btn-custom px-4">Se connecter</button>
                    </div>
                    <!-- Lien pour s'inscrire -->
                    <div class="text-center">
                        <p>Pas de compte ? <a href="inscription_patient.php" style="color: #2895D5;">S'inscrire</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
