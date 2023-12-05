<?php
session_start();

if (isset($_SESSION["accountType"])) {
    $database = "id21625993_assistante_ece";
    //Connexion à la base de données
    $db_handle = mysqli_connect("localhost", "id21625993_adminece", "123456789aA@", $database);

    if ($_SESSION["accountType"] == "administrator") {
        $emailAssistant = mysqli_real_escape_string($db_handle, htmlspecialchars($_POST['assistantEmail']));
        $emailProf = mysqli_real_escape_string($db_handle, htmlspecialchars($_POST['teacherEmail']));
        $startingDate = mysqli_real_escape_string($db_handle, htmlspecialchars($_POST['dateHeureStart']));
        $endingDate = mysqli_real_escape_string($db_handle, htmlspecialchars($_POST['dateHeureEnd']));
        $promoSession = mysqli_real_escape_string($db_handle, htmlspecialchars($_POST['promoGroupSession']));
        $tdSession = mysqli_real_escape_string($db_handle, htmlspecialchars($_POST['TDGroupSession']));
        $statusSession = 1;

        $query = 'SELECT IDProfesseur FROM professeur WHERE Email = "' . $emailProf . '"';
        $exec_requete = mysqli_query($db_handle, $query);

        if ($exec_requete) {
            $row = mysqli_fetch_assoc($exec_requete);
            $num_rows = mysqli_num_rows($exec_requete);
            if ($num_rows > 0) {
                $idProfesseur = $row['IDProfesseur'];

                $query = 'SELECT IDAssistant  FROM assistant WHERE Email = "' . $emailAssistant . '"';
                $exec_requete = mysqli_query($db_handle, $query);
                if ($exec_requete) {
                    $row = mysqli_fetch_assoc($exec_requete);
                    $num_rows = mysqli_num_rows($exec_requete);
                    if ($num_rows > 0) {
                        $idAssistant = $row['IDAssistant'];
                        $query = $db_handle->prepare("INSERT INTO tp (DateDebut,DateFin,IDAssistant,IDProfesseur,StatusSession,groupTP,promoTP) VALUES(?,?,?,?,?,?,?)");
                        $query->bind_param("ssiiiss", $startingDate, $endingDate, $idAssistant, $idProfesseur, $statusSession, $tdSession, $promoSession);
                        $query->execute();

                        header("Location: index.php");
                    } else {
                        // Aucun résultat pour cet utilisateur
                        header('Location: addSession.php?erreur=2'); // Assistant incorrecte
                    }
                } else {
                    // Erreur dans la requête SQL
                    echo "Erreur dans la requête : " . mysqli_error($db_handle);
                }

            } else {
                // Aucun résultat pour cet utilisateur
                header('Location: addSession.php?erreur=1'); //Professeur incorrecte
            }
        } else {
            // Erreur dans la requête SQL
            echo "Erreur dans la requête : " . mysqli_error($db_handle);
        }
    } else if ($_SESSION["accountType"] == "teacher") {
        $emailAssistant = mysqli_real_escape_string($db_handle, htmlspecialchars($_POST['assistantEmail']));
        $idProfesseur = $_SESSION["utilisateur_ID"];
        $startingDate = mysqli_real_escape_string($db_handle, htmlspecialchars($_POST['dateHeureStart']));
        $endingDate = mysqli_real_escape_string($db_handle, htmlspecialchars($_POST['dateHeureEnd']));
        $promoSession = mysqli_real_escape_string($db_handle, htmlspecialchars($_POST['promoGroupSession']));
        $tdSession = mysqli_real_escape_string($db_handle, htmlspecialchars($_POST['TDGroupSession']));
        $statusSession = 1;

        $query = 'SELECT IDAssistant FROM assistant WHERE Email = "' . $emailAssistant . '"';
        $exec_requete = mysqli_query($db_handle, $query);

        if ($exec_requete) {
            $row = mysqli_fetch_assoc($exec_requete);
            $num_rows = mysqli_num_rows($exec_requete);
            if ($num_rows > 0) {
                $idAssistant = $row['IDAssistant'];
                $query = $db_handle->prepare("INSERT INTO tp (DateDebut,DateFin,IDAssistant,IDProfesseur,StatusSession,groupTP,promoTP) VALUES(?,?,?,?,?,?,?)");
                $query->bind_param("ssiiiss", $startingDate, $endingDate, $idAssistant, $idProfesseur, $statusSession, $tdSession, $promoSession);
                $query->execute();

                header("Location: index.php");
            } else {
                // Aucun résultat pour cet utilisateur
                header('Location: addSession.php?erreur=1'); //Assistant incorrecte
            }
        } else {
            // Erreur dans la requête SQL
            echo "Erreur dans la requête : " . mysqli_error($db_handle);
        }




    } else if ($_SESSION["accountType"] == "student") {
        $idAssistant = $_SESSION["utilisateur_ID"];
        $emailProf = mysqli_real_escape_string($db_handle, htmlspecialchars($_POST['teacherEmail']));
        $startingDate = mysqli_real_escape_string($db_handle, htmlspecialchars($_POST['dateHeureStart']));
        $endingDate = mysqli_real_escape_string($db_handle, htmlspecialchars($_POST['dateHeureEnd']));
        $promoSession = mysqli_real_escape_string($db_handle, htmlspecialchars($_POST['promoGroupSession']));
        $tdSession = mysqli_real_escape_string($db_handle, htmlspecialchars($_POST['TDGroupSession']));
        $statusSession = 0;

        $query = 'SELECT IDProfesseur FROM professeur WHERE Email = "' . $emailProf . '"';
        $exec_requete = mysqli_query($db_handle, $query);

        if ($exec_requete) {
            $row = mysqli_fetch_assoc($exec_requete);
            $num_rows = mysqli_num_rows($exec_requete);
            if ($num_rows > 0) {
                $idProfesseur = $row['IDProfesseur'];
                $query = $db_handle->prepare("INSERT INTO tp (DateDebut,DateFin,IDAssistant,IDProfesseur,StatusSession,groupTP,promoTP) VALUES(?,?,?,?,?,?,?)");
                $query->bind_param("ssiiiss", $startingDate, $endingDate, $idAssistant, $idProfesseur, $statusSession, $tdSession, $promoSession);
                $query->execute();

                header("Location: index.php");
            } else {
                // Aucun résultat pour cet utilisateur
                header('Location: addSession.php?erreur=1'); //Professeur incorrecte
            }
        } else {
            // Erreur dans la requête SQL
            echo "Erreur dans la requête : " . mysqli_error($db_handle);
        }

    }
} else {
    header('Location: index.php');


}
?>