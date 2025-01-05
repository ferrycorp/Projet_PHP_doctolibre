<?php

$host = 'localhost'; // PostgreSQL host
$dbname = 'doctolibre'; 
$username = 'postgres'; 
$password = 'isen';

$databaseConnected = false;

try {
    // Create a new PDO instance for PostgreSQL
    $conn = new PDO("pgsql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $databaseConnected = true;
} 
catch (PDOException $e) {
    //nothing to see here :( the site will modify itself if the database is not connected !
}