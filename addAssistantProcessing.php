<?php
session_start();

if (isset($_SESSION["accountType"])) {
    if ($_SESSION["accountType"] == "administrator") {
        $database = "assistant_ece";
        //Connexion à la base de données
        $db_handle = mysqli_connect("localhost", "root", "123456789", $database);

        if (isset($_POST["firstNameAssistant"]) && isset($_POST["lastNameAssistant"]) && isset($_POST["emailAssistant"]) && isset($_POST["passwordAssistant"]) && isset($_POST["confirmationPasswordAssistant"])) {
            $emailAssistant = mysqli_real_escape_string($db_handle, htmlspecialchars($_POST['emailAssistant']));
            $firstNameAssistant = mysqli_real_escape_string($db_handle, htmlspecialchars($_POST['firstNameAssistant']));
            $lastNameAssistant = mysqli_real_escape_string($db_handle, htmlspecialchars($_POST['lastNameAssistant']));
            $passwordAssistant = mysqli_real_escape_string($db_handle, htmlspecialchars($_POST['passwordAssistant']));
            $confirmationPasswordAssistant = mysqli_real_escape_string($db_handle, htmlspecialchars($_POST['confirmationPasswordAssistant']));

            if ($emailAssistant == "" || $firstNameAssistant == "" || $lastNameAssistant == "" || $passwordAssistant == "" || $confirmationPasswordAssistant == "") {
                header('Location: addAssistant.php?erreur=2'); // champ de saisie saisie vide
            } else {
                if ($passwordAssistant == $confirmationPasswordAssistant) {
                    $query = "SELECT Email from assistant where Email = '" . $emailAssistant . "'";
                    $exec_requete = mysqli_query($db_handle, $query);

                    if ($exec_requete) {
                        $row = mysqli_fetch_assoc($exec_requete);
                        $num_rows = mysqli_num_rows($exec_requete);

                        if ($num_rows > 0) {
                            header('Location: addAssistant.php?erreur=4'); // Email déja existant
                        } else {
                            $query = $db_handle->prepare("INSERT INTO assistant (FirstName,LastName,Email,PasswordAccount) VALUES(?,?,?,?)");
                            $query->bind_param("ssss", $firstNameAssistant, $lastNameAssistant, $emailAssistant, $passwordAssistant);
                            $query->execute();

                            header("Location: adminFirstPage.php");
                        }
                    }
                } else {
                    header('Location: addAssistant.php?erreur=3'); // Deux mots de passe différent
                }
            }
        } else {
            header('Location: addAssistant.php?erreur=1'); // Saisie incomplète
        }
    } else {
        header("Location: index.php");
    }
} else {
    header("Location: index.php");
}
?>