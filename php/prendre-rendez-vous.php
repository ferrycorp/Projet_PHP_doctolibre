<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prendre un Rendez-vous</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Font - Great Vibes -->
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">
    <!-- CSS commun -->
    <link rel="stylesheet" href="../css/recherche.css">
</head>
<body>
    <!-- En-tête -->
    <header class="header py-3 navbar-custom">
        <div class="container-fluid d-flex align-items-center justify-content-between">
            <a href="connexion_patient.php" class="text-decoration-none">
                <h1>Doctolibre</h1>
            </a>
        </div>
    </header>

    <div class="container">

        <!-- Calendrier -->
        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <th>Lun</th>
                    <th>Mar</th>
                    <th>Mer</th>
                    <th>Jeu</th>
                    <th>Ven</th>
                    <th>Sam</th>
                    <th>Dim</th>
                </tr>
            </thead>
            <tbody id="calendarBody">
                <!-- Les jours seront générés dynamiquement -->
            </tbody>
        </table>
    <a href="recherche.php" class="btn btn-primary">
        Prendre un rendez-vous
    </a>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const calendarBody = document.getElementById('calendarBody');
            const appointmentForm = document.getElementById('appointmentForm');
            const appointmentDate = document.getElementById('appointmentDate');
            const selectedDoctorInput = document.getElementById('selectedDoctor');
            const selectDoctor = document.getElementById('selectDoctor');

            // Génération dynamique du calendrier
            const today = new Date();
            const year = today.getFullYear();
            const month = today.getMonth();

            function generateCalendar(year, month) {
                const firstDay = new Date(year, month, 1).getDay();
                const daysInMonth = new Date(year, month + 1, 0).getDate();

                // Réinitialiser le calendrier
                calendarBody.innerHTML = '';

                let date = 1;
                for (let i = 0; i < 6; i++) {
                    const row = document.createElement('tr');

                    for (let j = 0; j < 7; j++) {
                        const cell = document.createElement('td');

                        if (i === 0 && j < (firstDay === 0 ? 6 : firstDay - 1)) {
                            cell.textContent = '';
                        } else if (date > daysInMonth) {
                            break;
                        } else {
                            cell.textContent = date;
                            cell.classList.add('selectable-date');
                            cell.dataset.date = `${year}-${String(month + 1).padStart(2, '0')}-${String(date).padStart(2, '0')}`;
                            date++;
                        }

                        row.appendChild(cell);
                    }

                    calendarBody.appendChild(row);

                    if (date > daysInMonth) {
                        break;
                    }
                }
            }

            generateCalendar(year, month);

            // Ajouter un événement de clic sur les dates
            calendarBody.addEventListener('click', function (event) {
                if (event.target.classList.contains('selectable-date')) {
                    if (selectDoctor.value === "") {
                        alert("Veuillez sélectionner un médecin avant de choisir une date.");
                        return;
                    }

                    // Afficher le formulaire et remplir la date sélectionnée
                    appointmentForm.classList.remove('d-none');
                    appointmentDate.value = event.target.dataset.date;
                    selectedDoctorInput.value = selectDoctor.value;
                }
            });
        });
    </script>
</body>
</html>
