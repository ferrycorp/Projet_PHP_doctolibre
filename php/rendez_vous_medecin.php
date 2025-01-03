<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctolibre - Rendez-vous à venir</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Font - Great Vibes -->
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">
    <!-- CSS commun -->
    <link rel="stylesheet" href="../css/rendez_vous_medecin.css">
</head>
<body>
    <!-- En-tête -->
    <header class="header  py-3 navbar-custom">
        <div class="container-fluid d-flex justify-content-start">
            <!-- Lien vers la page de connexion_patient.php, sans soulignement -->
            <a href="connexion_patient.php" class="text-decoration-none">
                <h1>Doctolibre</h1>
            </a>
        </div>
    </header>

    <!-- Contenu principal -->
    <div class="container">
        <div class="row">
            <!-- Section des rendez-vous -->
            <div class="col-md-8">
                <div class="card p-4">
                    <h3 class="text-center mb-4">Rendez-vous à venir</h3>
                    <div class="row">
                        <!-- Matinée -->
                        <div class="col-md-6">
                            <h5 class="text-center">Matinée</h5>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <p><strong>Patient :</strong> Christophe Loger</p>
                                    <p><strong>Le :</strong> 28/04/2024 à 8h</p>
                                    <a href="fiche_patient.php" class="text-decoration-none">Information sur le patient</a>
                                </div>
                            </div>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <p><strong>Patient :</strong> Christophe Loger</p>
                                    <p><strong>Le :</strong> 28/04/2024 à 10h</p>
                                    <a href="fiche_patient.php" class="text-decoration-none">Information sur le patient</a>
                                </div>
                            </div>
                        </div>

                        <!-- Après-midi -->
                        <div class="col-md-6">
                            <h5 class="text-center">Après-midi</h5>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <p><strong>Patient :</strong> Christophe Loger</p>
                                    <p><strong>Le :</strong> 28/04/2024 à 15h</p>
                                    <a href="fiche_patient.php" class="text-decoration-none">Information sur le patient</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Calendrier -->
            <div class="col-md-4">
                <div class="card p-4 calendar">
                    <h5 class="text-center">Sélectionnez une date</h5>
                    <input type="date" class="form-control mt-3">
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
