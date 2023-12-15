<?php
session_start();
$database = "id21625993_assistante_ece";
//Connexion à la base de données
$db_handle = mysqli_connect("localhost", "id21625993_adminece", "123456789aA@", $database);

if (!isset($_SESSION["utilisateur_ID"])) {
    header("Location: index.php");
    exit();
}

if (isset($_SESSION["accountType"])) {

    if (isset($_POST["newPassword"]) && isset($_POST["confirmationNewPassword"]) && isset($_POST["currentPassword"])) {
        if ($_POST["newPassword"] != "" && $_POST["confirmationNewPassword"] != "" && $_POST["currentPassword"] != "") {
            if ($_POST["confirmationNewPassword"] != $_POST["currentPassword"]) {
                $username = $_SESSION["utilisateur_ID"];
                $newPassword = $_POST["newPassword"];
                $currentPassword = $_POST["currentPassword"];

                if ($_SESSION["accountType"] == "administrator") {
                    $query = "SELECT PasswordAccount FROM administrateur WHERE idAdministrateur = '" . $username . "'";
                    $exec_requete = mysqli_query($db_handle, $query);

                    if ($exec_requete) {
                        $row = mysqli_fetch_assoc($exec_requete);
                        $num_rows = mysqli_num_rows($exec_requete);
                        if ($num_rows > 0) {
                            $hashedPasswordFromDB = $row['PasswordAccount'];
                            if (password_verify($currentPassword, $hashedPasswordFromDB)) {
                                $passwordAdmin = password_hash($newPassword, PASSWORD_DEFAULT, ['cost' => 14]);

                                $query = 'UPDATE administrateur SET PasswordAccount = "' . $passwordAdmin . '" WHERE idAdministrateur = "' . $username . '"';
                                $exec_requete = mysqli_query($db_handle, $query);

                                if ($exec_requete) {
                                    header("Location: changePassword.php?erreur=6"); //Changement de mot de passe validé
                                    exit();
                                }
                            } else {
                                header('Location: changePassword.php?erreur=5'); // Erreur dans le mot de passe actuel  
                                exit();
                            }
                        } else {
                            header('Location: changePassword.php?erreur=4'); // Compte non trouvé dans la base de donnée 
                            exit();
                        }
                    } else {
                        header('Location: changePassword.php?erreur=4'); // Compte non trouvé dans la base de donnée 
                        exit();
                    }
                } else if ($_SESSION["accountType"] == "teacher") {
                    $query = "SELECT PasswordAccount FROM professeur WHERE IDProfesseur = '" . $username . "'";
                    $exec_requete = mysqli_query($db_handle, $query);

                    if ($exec_requete) {
                        $row = mysqli_fetch_assoc($exec_requete);
                        $num_rows = mysqli_num_rows($exec_requete);
                        if ($num_rows > 0) {
                            $hashedPasswordFromDB = $row['PasswordAccount'];
                            if (password_verify($currentPassword, $hashedPasswordFromDB)) {
                                $passwordTeacher = password_hash($newPassword, PASSWORD_DEFAULT, ['cost' => 14]);

                                $query = 'UPDATE professeur SET PasswordAccount = "' . $passwordTeacher . '" WHERE IDProfesseur = "' . $username . '"';
                                $exec_requete = mysqli_query($db_handle, $query);

                                if ($exec_requete) {
                                    header("Location: changePassword.php?erreur=6"); //Changement de mot de passe validé
                                    exit();
                                }
                            } else {
                                header('Location: changePassword.php?erreur=5'); // Erreur dans le mot de passe actuel  
                                exit();
                            }
                        } else {
                            header('Location: changePassword.php?erreur=4'); // Compte non trouvé dans la base de donnée 
                            exit();
                        }
                    } else {
                        header('Location: changePassword.php?erreur=4'); // Compte non trouvé dans la base de donnée 
                        exit();
                    }
                } else if ($_SESSION["accountType"] == "student") {
                    $query = "SELECT PasswordAccount FROM assistant WHERE IDAssistant = '" . $username . "'";
                    $exec_requete = mysqli_query($db_handle, $query);

                    if ($exec_requete) {
                        $row = mysqli_fetch_assoc($exec_requete);
                        $num_rows = mysqli_num_rows($exec_requete);
                        if ($num_rows > 0) {
                            $hashedPasswordFromDB = $row['PasswordAccount'];
                            if (password_verify($currentPassword, $hashedPasswordFromDB)) {
                                $passwordStudent = password_hash($newPassword, PASSWORD_DEFAULT, ['cost' => 14]);

                                $query = 'UPDATE assistant SET PasswordAccount = "' . $passwordStudent . '" WHERE IDAssistant = "' . $username . '"';
                                $exec_requete = mysqli_query($db_handle, $query);

                                if ($exec_requete) {
                                    header("Location: changePassword.php?erreur=6"); //Changement de mot de passe validé
                                    exit();
                                }
                            } else {
                                header('Location: changePassword.php?erreur=5'); // Erreur dans le mot de passe actuel  
                                exit();
                            }
                        } else {
                            header('Location: changePassword.php?erreur=4'); // Compte non trouvé dans la base de donnée 
                            exit();
                        }
                    } else {
                        header('Location: changePassword.php?erreur=4'); // Compte non trouvé dans la base de donnée 
                        exit();
                    }
                }
            } else {
                header('Location: changePassword.php?erreur=3'); // Les deux mots de passes ne sont pas identiques 
                exit();
            }
        } else {
            header('Location: changePassword.php?erreur=2'); // Champs de saisis vides
            exit();
        }
    } else {
        header('Location: changePassword.php?erreur=1'); // Tous les champs de saisis n'ont pas été remplis
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}
