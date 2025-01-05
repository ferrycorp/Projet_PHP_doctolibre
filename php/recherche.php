<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recherche</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Font - Great Vibes -->
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">
    <!-- Styles personnalisés -->
    <link rel="stylesheet" href="../css/recherche.css">
    <style>
        /* Header */
        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 20px;
            width: 100%;
            background-color: #2895D5; 
            position: relative;
            z-index: 1000;
        }

        .header h1 {
            font-family: 'Great Vibes', cursive;
            font-size: 3rem;
            color: rgb(0, 0, 0);
            margin: 0;
        }

        .btn-custom {
            background-color: #0056b3;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 1rem;
        }

        .btn-custom:hover {
            background-color: #003d80;
            color: white;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        .container {
            margin-top: 100px; /* Ajuste cette valeur selon la hauteur du header */
        }
    </style>
</head>

<body>
    <!-- Header (Barre de navigation) -->
    <header class="header">
        <div class="container-fluid d-flex align-items-center justify-content-between">
            <a href="connexion_patient.php" class="text-decoration-none">
                <h1>Doctolibre</h1>
            </a>
        </div>
    </header>

    <div class="container d-flex justify-content-end">
        <a href="rendez_vous_passé.php" class="btn btn-custom mb-2">Rendez-vous passé</a>
    </div>

    <!-- Recherche -->
    <div class="container">
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
