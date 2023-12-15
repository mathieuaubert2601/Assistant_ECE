<?php

//Déclarations de la base de données 

session_start();

if (isset($_GET['deconnexion'])) {
    if ($_GET['deconnexion'] == true) {
        unset($_SESSION['utilisateur_ID']);
        unset($_SESSION['statusConnexion']);
        unset($_SESSION['accountType']);
        unset($_SESSION['lastPage']);
        header("Location: index.php");
        exit();
    }
}

if (isset($_POST["accountUsername"]) && isset($_POST["accountPassword"]) && isset($_POST["accountType"])) {

    $database = "id21625993_assistante_ece";
    //Connexion à la base de données
    $db_handle = mysqli_connect("localhost", "id21625993_adminece", "123456789aA@", $database);


    $username = mysqli_real_escape_string($db_handle, htmlspecialchars($_POST['accountUsername']));
    $password = mysqli_real_escape_string($db_handle, htmlspecialchars($_POST['accountPassword']));
    $type = mysqli_real_escape_string($db_handle, htmlspecialchars($_POST['accountType']));

    if ($username !== "" && $password !== "") {
        if ($type == "teacher") {
            $query = "SELECT IDProfesseur, PasswordAccount, statusCompte FROM professeur WHERE Email = '" . $username . "'";
        } else if ($type == "student") {
            $query = "SELECT IDAssistant, PasswordAccount, statusCompte FROM assistant WHERE Email = '" . $username . "'";
        } else if ($type == "administrator") {
            $query = 'SELECT idAdministrateur, PasswordAccount FROM administrateur WHERE Email = "' . $username . '"';
        }

        $exec_requete = mysqli_query($db_handle, $query);


        if ($exec_requete) {
            $row = mysqli_fetch_assoc($exec_requete);
            $num_rows = mysqli_num_rows($exec_requete);
            if ($num_rows > 0) {
                $hashedPasswordFromDB = $row['PasswordAccount'];
                if (password_verify($password, $hashedPasswordFromDB)) {
                    if ($type == "administrator") {
                        $_SESSION['utilisateur_ID'] = $row['idAdministrateur'];
                        $_SESSION['statusConnexion'] = "1";
                        $_SESSION['accountType'] = $type;
                        header('Location: index.php');
                        exit();
                    } else if ($type == "student") {
                        if ($row['statusCompte'] == 0) {
                            $_SESSION['utilisateur_ID'] = $row['IDAssistant'];
                            $_SESSION['statusConnexion'] = "1";
                            $_SESSION['accountType'] = $type;
                            header('Location: index.php');
                            exit();
                        } else {
                            header('Location: connexion.php?erreur=4'); // Compte suspendu
                        }
                    } else if ($type == "teacher") {
                        if ($row['statusCompte'] == 0) {
                            $_SESSION['utilisateur_ID'] = $row['IDProfesseur'];
                            $_SESSION['statusConnexion'] = "1";
                            $_SESSION['accountType'] = $type;
                            header('Location: index.php');
                            exit();
                        } else {
                            header('Location: connexion.php?erreur=4'); // Compte suspendu
                        }
                    }
                } else {
                    // Aucun résultat pour cet utilisateur
                    header('Location: connexion.php?erreur=1'); // utilisateur ou mot de passe incorrect
                    exit();
                }
            } else {
                // Aucun résultat pour cet utilisateur
                header('Location: connexion.php?erreur=1'); // utilisateur ou mot de passe incorrect
                exit();
            }
        } else {
            // Erreur dans la requête SQL
            echo "Erreur dans la requête : " . mysqli_error($db_handle);
        }
    } else {
        header('Location: connexion.php?erreur=2'); // utilisateur ou mot de passe non saisis
        exit();
    }
} else if (!isset($_POST["accountType"])) {
    header('Location: connexion.php?erreur=3');
    exit();
}
