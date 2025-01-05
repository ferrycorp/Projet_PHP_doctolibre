<?php
session_start();  // Démarre la session

include_once('database.php');  // Inclure la connexion à la base de données

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['id_patients']) && !isset($_SESSION['id_medecin'])) {
    // Si aucun utilisateur n'est connecté, afficher un message
    $_SESSION['roleMessage'] = 'Aucun utilisateur n\'est connecté.';
    $_SESSION['nom_utilisateur'] = '';  // Aucun nom d'utilisateur à afficher
} else {
    // Vérifier si l'utilisateur est un patient ou un médecin
    if (isset($_SESSION['id_patients'])) {
        // Si l'utilisateur est un patient
        $_SESSION['role'] = 'patient';
        // Récupérer le nom du patient
        $query = "SELECT nom_patients, prenom_patients FROM patients WHERE id_patients = ?;";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(1, $_SESSION['id_patients'], PDO::PARAM_INT);
        $stmt->execute();
        $patient = $stmt->fetch(PDO::FETCH_ASSOC);
        $_SESSION['nom_utilisateur'] = $patient['prenom_patients'] . ' ' . $patient['nom_patients']; // Stocker le nom complet
        $_SESSION['roleMessage'] = 'Vous êtes connecté en tant que Patient.';
    } elseif (isset($_SESSION['id_medecin'])) {
        // Si l'utilisateur est un médecin
        $_SESSION['role'] = 'medecin';
        // Récupérer le nom du médecin
        $query = "SELECT nom_medecin, prenom_medecin FROM medecins WHERE id_medecin = ?;";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(1, $_SESSION['id_medecin'], PDO::PARAM_INT);
        $stmt->execute();
        $medecin = $stmt->fetch(PDO::FETCH_ASSOC);
        $_SESSION['nom_utilisateur'] = $medecin['prenom_medecin'] . ' ' . $medecin['nom_medecin']; // Stocker le nom complet
        $_SESSION['roleMessage'] = 'Vous êtes connecté en tant que Médecin.';
    }
}
?>