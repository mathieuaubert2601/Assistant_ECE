<?php

//Déclarations de la base de données 

session_start();
if (isset($_POST["accountUsername"]) && isset($_POST["accountPassword"]) && isset($_POST["accountType"])) {

    $database = "assistant_ece";
    //Connexion à la base de données
    $db_handle = mysqli_connect("localhost", "root", "123456789", $database);



    // on applique les deux fonctions mysqli_real_escape_string et htmlspecialchars
    // pour éliminer toute attaque de type injection SQL et XSS
    $username = mysqli_real_escape_string($db_handle, htmlspecialchars($_POST['accountUsername']));
    $password = mysqli_real_escape_string($db_handle, htmlspecialchars($_POST['accountPassword']));
    $type = mysqli_real_escape_string($db_handle, htmlspecialchars($_POST['accountType']));

    if ($username !== "" && $password !== "") {
        if ($type == "teacher") {
            $query = "SELECT IDProfesseur FROM professeur WHERE Email = '" . $username . "' AND Password = '" . $password . "'";
        } else if ($type == "student") {
            // Ajoutez les colonnes à sélectionner dans la requête pour les étudiants
            $query = "SELECT IDAssistant FROM assistant WHERE Email = '" . $username . "' AND Password = '" . $password . "'";
        } else if ($type == "administrator") {
            $query = 'SELECT idAdministrateur FROM administrateur WHERE Email = "' . $username . '" AND PasswordAccount = "' . $password . '"';
        }

        $exec_requete = mysqli_query($db_handle, $query);


        if ($exec_requete) {
            $row = mysqli_fetch_assoc($exec_requete);
            $num_rows = mysqli_num_rows($exec_requete);
            if ($num_rows > 0) {
                if ($type == "administrator")
                    $_SESSION['utilisateur_ID'] = $row['idAdministrateur'];
                else if ($type == "student")
                    $_SESSION['utilisateur_ID'] = $row['IDAssistant'];
                else if ($type == "teacher")
                    $_SESSION['utilisateur_ID'] = $row['IDProfesseur'];
                $_SESSION['statusConnexion'] = "1";
                $_SESSION['accountType'] = $type;

                header('Location: index.php');
            } else {
                // Aucun résultat pour cet utilisateur
                header('Location: connexion.php?erreur=1'); // utilisateur ou mot de passe incorrect
            }
        } else {
            // Erreur dans la requête SQL
            echo "Erreur dans la requête : " . mysqli_error($db_handle);
        }
    } else {
        header('Location: connexion.php?erreur=2'); // utilisateur ou mot de passe non saisis
    }
} else if (!isset($_POST["accountType"])) {
    header('Location: connexion.php?erreur=3');
}

if (isset($_GET['deconnexion'])) {
    if ($_GET['deconnexion'] == true) {
        unset($_SESSION['utilisateur_ID']);
        unset($_SESSION['statusConnexion']);
        unset($_SESSION['accountType']);
        header("Location: index.php");
    }
}


?>