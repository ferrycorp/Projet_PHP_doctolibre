<?php
    include('constants.php');

    function dbConnect() {
        $dsn ="pgsql:dbname=doctolibre;host=127.0.0.1;port=5432";//il faut regler le problème de constante
        $pdo = new PDO($dsn, 'postgres', 'new_password');
        return $pdo;
    }
?>