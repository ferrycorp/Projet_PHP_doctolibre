<?php
    include('constants.php');

    function dbConnect() {
        $dsn ="pgsql:host=127.0.0.1;port=5432;dbname=doctolibre";//il faut regler le problème de constante
        $pdo = new PDO($dsn, 'postgres', 'new_password');
        return $pdo;
    }

    
    function data(){
        try {
            $pdo = dbConnect();

            // Requête SQL
            $query = "SELECT * FROM medecins";
            $stmt = $pdo->query($query);

            // Extraction des données
            $data = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $data[] = $row;
            }

            // Retourner les données sous forme de JSON
            echo json_encode($data);

        } catch (PDOException $e) {
            echo json_encode(["error" => $e->getMessage()]);
        }
    }
?>