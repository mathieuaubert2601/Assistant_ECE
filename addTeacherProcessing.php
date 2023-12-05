<?php
session_start();

if (isset($_SESSION["accountType"])) {
    if ($_SESSION["accountType"] == "administrator") {
        $database = "id21625993_assistante_ece";
        //Connexion à la base de données
        $db_handle = mysqli_connect("localhost", "id21625993_adminece", "123456789aA@", $database);

        if (isset($_POST["firstNameTeacher"]) && isset($_POST["lastNameTeacher"]) && isset($_POST["emailTeacher"]) && isset($_POST["passwordTeacher"]) && isset($_POST["confirmationPasswordTeacher"])) {
            $emailTeacher = mysqli_real_escape_string($db_handle, htmlspecialchars($_POST['emailTeacher']));
            $firstNameTeacher = mysqli_real_escape_string($db_handle, htmlspecialchars($_POST['firstNameTeacher']));
            $lastNameTeacher = mysqli_real_escape_string($db_handle, htmlspecialchars($_POST['lastNameTeacher']));
            $passwordTeacher = mysqli_real_escape_string($db_handle, htmlspecialchars($_POST['passwordTeacher']));
            $confirmationPasswordTeacher = mysqli_real_escape_string($db_handle, htmlspecialchars($_POST['confirmationPasswordTeacher']));

            if ($emailTeacher == "" || $firstNameTeacher == "" || $lastNameTeacher == "" || $passwordTeacher == "" || $confirmationPasswordTeacher == "") {
                header('Location: addTeacher.php?erreur=2'); // champ de saisie saisie vide
            } else {
                if ($passwordTeacher == $confirmationPasswordTeacher) {
                    $query = "SELECT Email from professeur where Email = '" . $emailTeacher . "'";
                    $exec_requete = mysqli_query($db_handle, $query);

                    if ($exec_requete) {
                        $row = mysqli_fetch_assoc($exec_requete);
                        $num_rows = mysqli_num_rows($exec_requete);

                        if ($num_rows > 0) {
                            header('Location: addTeacher.php?erreur=4'); // Email déja existant
                        } else {
                            $query = $db_handle->prepare("INSERT INTO professeur (FirstName,LastName,Email,PasswordAccount) VALUES(?,?,?,?)");
                            $query->bind_param("ssss", $firstNameTeacher, $lastNameTeacher, $emailTeacher, $passwordTeacher);
                            $query->execute();

                            header("Location: adminFirstPage.php");
                        }
                    }
                } else {
                    header('Location: addTeacher.php?erreur=3'); // Deux mots de passe différent
                }
            }
        } else {
            header('Location: addTeacher.php?erreur=1'); // Saisie incomplète
        }
    } else {
        header("Location: index.php");
    }
} else {
    header("Location: index.php");
}
?>