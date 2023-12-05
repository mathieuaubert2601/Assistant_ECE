<?php
session_start();

if (isset($_SESSION["accountType"])) {
    if ($_SESSION["accountType"] == "teacher") {
        if (isset($_GET['idSession'])) {

            $database = "id21625993_assistante_ece";
            //Connexion à la base de données
            $db_handle = mysqli_connect("localhost", "id21625993_adminece", "123456789aA@", $database);

            $idSessionTP = $_GET['idSession'];
            $query = 'SELECT * FROM tp WHERE IDTp = "' . $idSessionTP . '"';
            $exec_requete = mysqli_query($db_handle, $query);

            if (mysqli_num_rows($exec_requete) > 0) {
                $query = 'UPDATE tp SET StatusSession= 1 WHERE IDTp = "' . $idSessionTP . '"';
                $exec_requete = mysqli_query($db_handle, $query);
                header('Location: validateSession.php');
            } else {
                header('Location: validateSession.php?erreur=1');
            }

        }
    } else {
        header("Location: index.php");
    }
} else {
    header("Location: index.php");
}
?>