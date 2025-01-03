<!DOCTYPE html>
<html lang="fr">

<?php
//session_start();
//if (!isset($_SESSION['user'])) {
//    header("location:connexion_patient.php?msg=Veuillez vous connecter pour accéder à cette page.");
//    exit;
//}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recherche</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Font - Great Vibes -->
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">
    <!-- Styles personnalisés -->
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/recherche.css">
</head>
<body>
    <!-- Header (Barre de navigation) -->
    <header class="header py-3 navbar-custom">
        <div class="container-fluid d-flex align-items-center justify-content-between">
            <!-- Lien vers la page de connexion_patient.php, sans soulignement -->
            <a href="connexion_patient.php" class="text-decoration-none">
                <h1>Doctolibre</h1>
            </a>
    </header>

    <!-- Bouton "Rendez-vous passé" en haut à droite -->
    <div class="container mt-3 d-flex justify-content-end">
        <a href="rendez_vous_passé.php" class="btn btn-custom mb-2">Rendez-vous passé</a>
    </div>

    <!-- Recherche -->
    <div class="container mt-5">
        <div class="form-group mb-4">
            <input type="text" class="form-control" id="searchInput" placeholder="Rechercher un médecin..." aria-label="Rechercher">
        </div>

        <!-- Résultats -->
        <div id="resultsContainer">
            <!-- Les résultats de la recherche seront insérés ici -->
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Exemple de médecins à partir de la base de données
        const doctors = [
            { nom: 'Lemoine', prenom: 'Alice', specialite: 'Cardiologie', ville: 'Paris', id: 1 },
            { nom: 'Carpentier', prenom: 'Marc', specialite: 'Dermatologie', ville: 'Lyon', id: 2 },
            { nom: 'Dubois', prenom: 'Claire', specialite: 'Pédiatrie', ville: 'Marseille', id: 3 },
            { nom: 'Morel', prenom: 'Antoine', specialite: 'Gynécologie', ville: 'Bordeaux', id: 4 },
            { nom: 'Blanc', prenom: 'Julie', specialite: 'Orthopédie', ville: 'Toulouse', id: 5 }
        ];

        // Fonction pour afficher les résultats
        function displayResults(filteredDoctors) {
            const resultsContainer = document.getElementById('resultsContainer');
            resultsContainer.innerHTML = ''; // Clear previous results

            if (filteredDoctors.length === 0) {
                resultsContainer.innerHTML = '<p>Aucun médecin trouvé.</p>';
                return;
            }

            filteredDoctors.forEach(doctor => {
                const doctorCard = `
                    <div class="card mb-4">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <div class="rounded-circle bg-secondary" style="width: 60px; height: 60px;"></div>
                                <div class="ms-3">
                                    <h5 class="card-title mb-0">${doctor.prenom} ${doctor.nom}</h5>
                                    <p class="card-text text-muted">${doctor.specialite}<br>${doctor.ville}</p>
                                </div>
                            </div>
                            <div>
                                <a href="prendre_rdv.php" class="btn btn-custom mb-2">Prendre rendez-vous</a>
                            </div>
                        </div>
                    </div>
                `;
                resultsContainer.innerHTML += doctorCard;
            });
        }

        // Fonction de recherche
        function searchDoctors() {
            const query = document.getElementById('searchInput').value.toLowerCase();
            const filteredDoctors = doctors.filter(doctor => {
                return doctor.nom.toLowerCase().includes(query) || doctor.prenom.toLowerCase().includes(query) || doctor.specialite.toLowerCase().includes(query) || doctor.ville.toLowerCase().includes(query);
            });
            displayResults(filteredDoctors);
        }

        // Ajouter un écouteur d'événement pour la recherche
        document.getElementById('searchInput').addEventListener('input', searchDoctors);
    </script>
</body>
</html>
