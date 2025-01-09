<?php
// Pour deconnecter l'utilisateur
session_start();
session_destroy();
header("Location: connexion_patient.php");
exit();
?>