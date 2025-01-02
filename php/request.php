<?php
include_once('database.php');
session_start();

if (isset($_GET["btn"]) && $_GET["btn"] == "logout") {

}

if(isset($_REQUEST["btn"])) {

    if ($_REQUEST["btn"]=="Se connecter") {
        // Add cookies
        if (isset($_POST["remember"])) {
            setcookie("user", $_POST["user"],time()+7*24*3600);
            setcookie("pwd", $_POST["pwd"],time()+7*24*3600);
        }

        $conn=dbConnect();
        $query = "SELECT * from patients WHERE email_patiens=:id AND mot_de_passe=:pwd";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":id", $_POST["user"]);
        $stmt->bindParam(":pwd", $_POST["pwd"]);
        $stmt->execute();
        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // Si existe
            $_SESSION['user'] = $row["id"];
            header("location:recherche.php");
            exit;
        }
        else {
            // N'existe pas: id/pwd incorrects
            header("location:connexion_patient.php?msg=Identifiant ou mot de passe incorrect");
            exit;
        }
    }
    else if ($_REQUEST["btn"]=="logout") {
        session_destroy();
        header("location:connexion_patient.php");
        exit;
    }
}
?>