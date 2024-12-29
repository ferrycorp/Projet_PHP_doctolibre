<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctolibre - Rendez-vous Passés</title>
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
        </div>
    </header>

    <!-- Contenu principal -->
    <div class="container mt-5">
        <div class="row">
            <!-- Section Dernier rendez-vous -->
            <div class="col-md-8">
                <div class="bg-light p-4 rounded shadow-sm">
                    <h4 class="text-center mb-4">Dernier rendez-vous</h4>
                    <!-- Rendez-vous 1 -->
                    <div class="d-flex justify-content-between align-items-center mb-3 p-3 border rounded">
                        <div>
                            <p class="mb-1"><strong>Praticien</strong>: Cardiologue</p>
                            <p class="mb-1"><strong>Christophe Loger</strong></p>
                            <p class="mb-0">28/04/2024</p>
                            <p class="mb-0">Durée : 20 min</p>
                        </div>
                        <a href="recherche.php" class="btn btn-custom">
                            <img src="../image/calendar.svg" alt="">
                            Reprendre rendez-vous
                        </a> 
                    </div>
                    <!-- Rendez-vous 2 -->
                    <div class="d-flex justify-content-between align-items-center mb-3 p-3 border rounded">
                        <div>
                            <p class="mb-1"><strong>Praticien</strong>: Cardiologue</p>
                            <p class="mb-1"><strong>Christophe Loger</strong></p>
                            <p class="mb-0">28/04/2024</p>
                            <p class="mb-0">Durée : 20 min</p>
                        </div>

                        <a href="recherche.php" class="btn btn-custom">
                            <img src="../image/calendar.svg" alt="">
                             Reprendre rendez-vous
                        </a>
                    </div>
                </div>
            </div>

            <!-- Section Nouveau rendez-vous -->
            <div class="col-md-4">
                <div class="text-center">
                    <a href="recherche.php" class="btn btn-custom">
                        <img src="../image/calendar.svg" alt="">
                        Reprendre rendez-vous
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
