<?php
session_start();

if (isset($_SESSION["lastPage"])) {
    $lastPage = $_SESSION["lastPage"];
}

if (isset($_SESSION["accountType"])) {
    if ($_SESSION["accountType"] == "administrator") {
        if (isset($_GET['idSession'])) {

            $database = "id21625993_assistante_ece";
            //Connexion à la base de données
            $db_handle = mysqli_connect("localhost", "id21625993_adminece", "123456789aA@", $database);

            $idAssistant = $_GET['idSession'];
            $query = 'SELECT * FROM assistant WHERE IDAssistant = "' . $idAssistant . '"';
            $exec_requete = mysqli_query($db_handle, $query);

            if (mysqli_num_rows($exec_requete) > 0) {
                $query = 'UPDATE assistant SET statusCompte= 0 WHERE IDAssistant = "' . $idAssistant . '"';
                $exec_requete = mysqli_query($db_handle, $query);
                header("Location: $lastPage");
                exit();
            } else {
                header("Location: $lastPage?erreur=1");
                exit();
            }
        }
    } else {
        header("Location: index.php");
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}
