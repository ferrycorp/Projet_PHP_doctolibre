<?php
    include('constants.php');

    function dbConnect() {
        $dsn ="pgsql:dbname=;host=;port=";//il faut regler le problème de constante
        $pdo = new PDO($dsn, '', '');
        return $pdo;
    }
?>