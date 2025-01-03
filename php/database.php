<?php
    include('constants.php');

    function dbConnect() {
        $dsn ="pgsql:host=127.0.0.1;port=5432;dbname=doctolibre";//il faut regler le problème de constante
        $pdo = new PDO($dsn, 'postgres', 'new_password');
        return $pdo;
    }
?>