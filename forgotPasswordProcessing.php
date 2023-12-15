<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Importer la bibliothèque "PHPMailer"
require 'PHPMailer-master\src\PHPMailer.php';
require 'PHPMailer-master\src\SMTP.php';
require 'PHPMailer-master\src\Exception.php';

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

if (isset($_POST["accountUsername"]) && isset($_POST["accountType"])) {

    $database = "id21625993_assistante_ece";
    //Connexion à la base de données
    $db_handle = mysqli_connect("localhost", "id21625993_adminece", "123456789aA@", $database);


    $username = mysqli_real_escape_string($db_handle, htmlspecialchars($_POST['accountUsername']));
    $type = mysqli_real_escape_string($db_handle, htmlspecialchars($_POST['accountType']));

    if ($username !== "") {
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
                if ($type == "administrator") {
                    $passwordRandom = uniqid();

                    $password = password_hash($passwordRandom, PASSWORD_DEFAULT, ['cost' => 14]);
                    $query = 'UPDATE administrateur SET PasswordAccount= "' . $password . '" WHERE Email = "' . $username . '"';
                    $exec_requete = mysqli_query($db_handle, $query);

                    ini_set('SMTP', 'smtp.office365.com');
                    ini_set('smtp_port', 587);
                    $mail = new PHPMailer(true);

                    try {
                        // Configuration du serveur SMTP
                        $mail->isSMTP();
                        $mail->Host = 'smtp.office365.com';
                        $mail->SMTPAuth = true;
                        $mail->Username = 'assistant_ece_it@outlook.fr';
                        $mail->Password = '123456789aA';
                        $mail->SMTPSecure = 'tls';
                        $mail->Port = 587;

                        // Destinataire et expéditeur
                        $mail->setFrom('assistant_ece_it@outlook.fr', 'Admin Assistant ECE');
                        $mail->addAddress($username, 'Admin');

                        // Contenu de l'e-mail
                        $subject = 'Récupération du mot de passe';
                        $mail->Subject = mb_encode_mimeheader($subject, "UTF-8");
                        $mail->Body = "Voici votre nouveau mot de passe : $passwordRandom";

                        // Envoi de l'e-mail
                        $mail->send();
                    } catch (Exception $e) {
                        echo 'Erreur lors de l\'envoi de l\'e-mail : ' . $mail->ErrorInfo;
                        header('Location: forgotPassword.php?erreur=5'); // Erreur lors de l'envoie de l'email
                        exit();
                    }

                    header('Location: forgotPassword.php?erreur=2'); // Email envoyé avec succès
                    exit();
                } else if ($type == "student") {
                    if ($row['statusCompte'] == 0) {

                        $passwordRandom = uniqid();

                        $password = password_hash($passwordRandom, PASSWORD_DEFAULT, ['cost' => 14]);
                        $query = 'UPDATE assistant SET PasswordAccount= "' . $password . '" WHERE Email = "' . $username . '"';
                        $exec_requete = mysqli_query($db_handle, $query);

                        ini_set('SMTP', 'smtp.office365.com');
                        ini_set('smtp_port', 587);
                        $mail = new PHPMailer(true);

                        try {
                            // Configuration du serveur SMTP
                            $mail->isSMTP();
                            $mail->Host = 'smtp.office365.com';
                            $mail->SMTPAuth = true;
                            $mail->Username = 'assistant_ece_it@outlook.fr';
                            $mail->Password = '123456789aA';
                            $mail->SMTPSecure = 'tls';
                            $mail->Port = 587;

                            // Destinataire et expéditeur
                            $mail->setFrom('assistant_ece_it@outlook.fr', 'Admin Assistant ECE');
                            $mail->addAddress($username, 'Assistant');

                            // Contenu de l'e-mail
                            $subject = 'Récupération du mot de passe';
                            $mail->Subject = mb_encode_mimeheader($subject, "UTF-8");
                            $mail->Body = "Voici votre nouveau mot de passe : $passwordRandom";

                            // Envoi de l'e-mail
                            $mail->send();
                        } catch (Exception $e) {
                            echo 'Erreur lors de l\'envoi de l\'e-mail : ' . $mail->ErrorInfo;
                            header('Location: forgotPassword.php?erreur=5'); // Erreur lors de l'envoie de l'email
                            exit();
                        }

                        header('Location: forgotPassword.php?erreur=2'); // Email envoyé avec succès
                        exit();
                    } else {
                        header('Location: forgotPassword.php?erreur=4'); // Compte suspendu
                    }
                } else if ($type == "teacher") {
                    if ($row['statusCompte'] == 0) {

                        $passwordRandom = uniqid();

                        $password = password_hash($passwordRandom, PASSWORD_DEFAULT, ['cost' => 14]);
                        $query = 'UPDATE professeur SET PasswordAccount= "' . $password . '" WHERE Email = "' . $username . '"';
                        $exec_requete = mysqli_query($db_handle, $query);

                        ini_set('SMTP', 'smtp.office365.com');
                        ini_set('smtp_port', 587);
                        $mail = new PHPMailer(true);

                        try {
                            // Configuration du serveur SMTP
                            $mail->isSMTP();
                            $mail->Host = 'smtp.office365.com';
                            $mail->SMTPAuth = true;
                            $mail->Username = 'assistant_ece_it@outlook.fr';
                            $mail->Password = '123456789aA';
                            $mail->SMTPSecure = 'tls';
                            $mail->Port = 587;

                            // Destinataire et expéditeur
                            $mail->setFrom('assistant_ece_it@outlook.fr', 'Admin Assistant ECE');
                            $mail->addAddress($username, 'Professeur');

                            // Contenu de l'e-mail
                            $subject = 'Récupération du mot de passe';
                            $mail->Subject = mb_encode_mimeheader($subject, "UTF-8");
                            $mail->Body = "Voici votre nouveau mot de passe : $passwordRandom";

                            // Envoi de l'e-mail
                            $mail->send();
                        } catch (Exception $e) {
                            echo 'Erreur lors de l\'envoi de l\'e-mail : ' . $mail->ErrorInfo;
                            header('Location: forgotPassword.php?erreur=5'); // Erreur lors de l'envoie de l'email
                            exit();
                        }

                        header('Location: forgotPassword.php?erreur=2'); // Email envoyé avec succès
                        exit();
                    } else {
                        header('Location: forgotPassword.php?erreur=4'); // Compte suspendu
                    }
                }
            } else {
                // Aucun résultat pour cet utilisateur
                header('Location: forgotPassword.php?erreur=1'); // Utilisateur inconnu
                exit();
            }
        } else {
            // Erreur dans la requête SQL
            echo "Erreur dans la requête : " . mysqli_error($db_handle);
        }
    } else {
        header('Location: forgotPassword.php?erreur=2'); // utilisateur non saisis
        exit();
    }
} else if (!isset($_POST["accountType"])) {
    header('Location: forgotPassword.php?erreur=3');
    exit();
}
