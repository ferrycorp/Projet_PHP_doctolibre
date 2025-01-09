<?php

$host = 'localhost'; // PostgreSQL
$dbname = 'doctolibre'; //nom de la base de données
$username = 'postgres'; 
$password = 'isen'; // mot de passe a modifier selon l'utilisateur

$databaseConnexion = false;

try {
    $conn = new PDO("pgsql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $databaseConnexion = true;
} 
catch (PDOException $e) {

}