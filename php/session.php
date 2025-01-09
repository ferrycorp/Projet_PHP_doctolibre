<?php
session_start(); 

include_once('database.php'); 

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['id_patients']) && !isset($_SESSION['id_medecins'])) {
    $_SESSION['roleMessage'] = 'Aucun utilisateur n\'est connecté.';
    $_SESSION['nom_utilisateur'] = '';  // Aucun nom d'utilisateur à afficher
} else {
    // Vérifier si l'utilisateur est un patient ou un médecin
    if (isset($_SESSION['id_patients'])) {
        // Si l'utilisateur est un patient
        $_SESSION['role'] = 'patient';
        $query = "SELECT nom_patients, prenom_patients FROM patients WHERE id_patients = ?;";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(1, $_SESSION['id_patients'], PDO::PARAM_INT);
        $stmt->execute();
        $patient = $stmt->fetch(PDO::FETCH_ASSOC);
        $_SESSION['nom_utilisateur'] = $patient['prenom_patients'] . ' ' . $patient['nom_patients']; // Stocker le nom complet
        $_SESSION['roleMessage'] = 'Vous êtes connecté en tant que Patient.';
    } elseif (isset($_SESSION['id_medecins'])) {
        // Si l'utilisateur est un médecin
        $_SESSION['role'] = 'medecin';
        $query = "SELECT nom_medecins, prenom_medecins FROM medecins WHERE id_medecins = ?;";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(1, $_SESSION['id_medecins'], PDO::PARAM_INT);
        $stmt->execute();
        $medecin = $stmt->fetch(PDO::FETCH_ASSOC);
        $_SESSION['nom_utilisateur'] = $medecin['prenom_medecins'] . ' ' . $medecin['nom_medecins']; // Stocker le nom complet
        $_SESSION['roleMessage'] = 'Vous êtes connecté en tant que Médecin.';
    }
}
?>
