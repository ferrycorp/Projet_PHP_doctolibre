/*
include_once('database.php');
session_start();

if (isset($_GET["btn"]) && $_GET["btn"] == "logout") {
    session_destroy();
    header("location:connexion_patient.php");
    exit;
}

if (isset($_REQUEST["btn"])) {
    if ($_REQUEST["btn"] == "Se connecter") {
        // Add cookies
        if (isset($_POST["remember"])) {
            setcookie("user", $_POST["user"], time() + 7 * 24 * 3600);
            setcookie("pwd", $_POST["pwd"], time() + 7 * 24 * 3600);
        }

        // Input validation
        if (empty($_POST["user"]) || empty($_POST["pwd"])) {
            header("location:connexion_patient.php?msg=Veuillez remplir tous les champs");
            exit;
        }

        try {
            $conn = dbConnect();
            $query = "SELECT * FROM patients WHERE email_patiens = :id AND mot_de_passe = :pwd";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(":id", $_POST["user"], PDO::PARAM_STR);
            $stmt->bindParam(":pwd", $_POST["pwd"], PDO::PARAM_STR);
            $stmt->execute();

            // Check if a matching user is found
            if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $_SESSION['user'] = $row["id"];
                header("location:recherche.php");
                exit;
            } else {
                header("location:connexion_patient.php?msg=Identifiant ou mot de passe incorrect");
                exit;
            }
        } catch (PDOException $e) {
            // Log error and show user-friendly message
            error_log("Database error: " . $e->getMessage());
            header("location:connexion_patient.php?msg=Erreur interne. Veuillez réessayer.");
            exit;
        }
    }
}
*/
