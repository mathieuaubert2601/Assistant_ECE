<?php
//Déclarations de la base de données 
session_start();
$database = "id21625993_assistante_ece";

//Connexion à la base de données
$db_handle = mysqli_connect("localhost", "id21625993_adminece", "123456789aA@");
$db_found = mysqli_select_db($db_handle, $database);

if (!isset($_SESSION['utilisateur_ID'])) {

    header('Location: index.php');
    exit();
}

$_SESSION["lastPage"] = "sessionHistory.php";
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Assistant ECE</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="style2.css" />
    <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css" />
</head>

<body>
    <input type="checkbox" name="" id="menu" />
    <div class="sidebar">
        <div class="sidebar-brand">
            <h2><span class="fa fa-user-o"></span>Assistant ECE</h2>
        </div>
        <div class="sidebar-menu">
            <ul>
                <?php
                if (isset($_SESSION['accountType'])) {
                    if ($_SESSION['accountType'] == "teacher") {
                        echo "<li>";
                        echo '<a href="adminDashboard.php"><span class="fa fa-home"> </span><span> Accueil</span></a>';
                        echo "</li>";

                        echo "<li>";
                        echo '<a href="addSession.php"><span class="fa fa-plus-circle"> </span><span> Ajout Séance</span></a>';
                        echo "</li>";

                        echo "<li>";
                        echo '<a href="sessionHistory" class="active"><span class="fa fa-history"> </span><span> Historique des séances</span></a>';
                        echo "</li>";
                    } else if ($_SESSION['accountType'] == "student") {
                        echo "<li>";
                        echo '<a href="adminDashboard.php"><span class="fa fa-home"> </span><span> Accueil</span></a>';
                        echo "</li>";

                        echo "<li>";
                        echo '<a href="addSession.php"><span class="fa fa-plus-circle"> </span><span> Ajout Séance</span></a>';
                        echo "</li>";

                        echo "<li>";
                        echo '<a href="sessionHistory" class="active"><span class="fa fa-history"> </span><span> Historique des séances</span></a>';
                        echo "</li>";
                    } else if ($_SESSION['accountType'] == "administrator") {
                        echo "<li>";
                        echo '<a href="adminDashboard.php"><span class="fa fa-home"> </span><span> Accueil</span></a>';
                        echo "</li>";

                        echo "<li>";
                        echo '<a href="addSession.php"><span class="fa fa-plus-circle"> </span><span> Ajout Séance</span></a>';
                        echo "</li>";

                        echo "<li>";
                        echo '<a href="addAssistant.php"><span class="fa fa-user-plus"> </span><span> Ajout Assistant</span></a>';
                        echo "</li>";

                        echo "<li>";
                        echo '<a href="addTeacher.php"><span class="fa fa-user-plus"> </span><span> Ajout Professeur</span></a>';
                        echo "</li>";

                        echo "<li>";
                        echo '<a href="sessionHistory" class="active" ><span class="fa fa-history"> </span><span> Historique des séances</span></a>';
                        echo "</li>";

                        echo "<li>";
                        echo '<a href="teacherManagment.php"><span class="fa fa-user-times"> </span><span> Gestion Professeurs</span></a>';
                        echo "</li>";

                        echo "<li>";
                        echo '<a href="assistantManagment.php"><span class="fa fa-user-times"> </span><span> Gestion Assistants</span></a>';
                        echo "</li>";
                    }
                }
                ?>
            </ul>
        </div>
    </div>
    <div class="content">
        <header>
            <p>
                <label for="menu"><span class="fa fa-bars"></span></label><span class="accueil">Accueil</span>
            </p>

            <div id="dropdown" class="user-wrapp">
                <div>
                    <?php
                    if (isset($_SESSION['utilisateur_ID']) && isset($_SESSION['accountType'])) {
                        if ($_SESSION['accountType'] == 'teacher') {
                            $query = "SELECT FirstName FROM professeur WHERE IDProfesseur = '" . $_SESSION['utilisateur_ID'] . "' ";
                            $exec_requete = mysqli_query($db_handle, $query);

                            if ($exec_requete) {
                                $num_rows = mysqli_num_rows($exec_requete);

                                if ($num_rows > 0) {
                                    $data = mysqli_fetch_assoc($exec_requete);
                                    $FirstName = $data["FirstName"];
                                    echo "<h4>$FirstName</h4>";
                                    $type = $_SESSION["accountType"];

                                    echo "<small>Professeur</small>";
                                }
                            }
                        } else if ($_SESSION["accountType"] == "student") {
                            $query = "SELECT FirstName FROM assistant WHERE IDAssistant = '" . $_SESSION['utilisateur_ID'] . "' ";
                            $exec_requete = mysqli_query($db_handle, $query);

                            if ($exec_requete) {
                                $num_rows = mysqli_num_rows($exec_requete);

                                if ($num_rows > 0) {
                                    $data = mysqli_fetch_assoc($exec_requete);
                                    $FirstName = $data["FirstName"];
                                    echo "<h4>$FirstName</h4>";
                                    echo "<small>Assistant</small>";
                                }
                            }
                        } else if ($_SESSION["accountType"] == "administrator") {
                            $query = "SELECT FirstName FROM administrateur WHERE idAdministrateur = '" . $_SESSION['utilisateur_ID'] . "' ";
                            $exec_requete = mysqli_query($db_handle, $query);

                            if ($exec_requete) {
                                $num_rows = mysqli_num_rows($exec_requete);

                                if ($num_rows > 0) {
                                    $data = mysqli_fetch_assoc($exec_requete);
                                    $FirstName = $data["FirstName"];
                                    echo "<h4>$FirstName</h4>";
                                    echo "<small>Admin</small>";
                                }
                            }
                        }
                    }

                    ?>

                </div>
                <img decoding="async" src="images/icone_utilisateur.png" width="30" height="30" class="logo-admin" />
                <div class="dropdown-content">
                    <p><a href="changePassword.php">Changer le mot de passe</a></p>
                    <p><a href='connexionProcessing.php?deconnexion=true'><span>Déconnexion</span></a></p>
                </div>
            </div>
        </header>

        <main>
            <div class="composant">
                <div class="case">
                    <div class="header-case">
                        <h2>Historique des sessions</h2>
                    </div>
                    <div class="body-case">
                        <div class="tableau">
                            <table width="100%">
                                <thead>
                                    <tr>
                                        <td>Assistant</td>
                                        <td>Professeur</td>
                                        <td>Promo</td>
                                        <td>TD</td>
                                        <td>Debut</td>
                                        <td>Fin</td>
                                        <td>Status</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                        if (isset($_SESSION["accountType"])) {
                                            if ($_SESSION["accountType"] == "teacher") {
                                                $query = "SELECT * from tp where IDProfesseur = '" . $_SESSION['utilisateur_ID'] . "'";
                                                $exec_requete = mysqli_query($db_handle, $query);

                                                if ($exec_requete) {
                                                    $num_rows = mysqli_num_rows($exec_requete);

                                                    if ($num_rows > 0) {
                                                        while (($data = mysqli_fetch_assoc($exec_requete))) {
                                                            $idAssistant = $data['IDAssistant'];
                                                            $idProfesseur = $data['IDProfesseur'];
                                                            $promo = $data['promoTP'];
                                                            $status = $data['StatusSession'];
                                                            $idSession = $data['IDTp'];
                                                            $groupeTD = $data['groupTP'];
                                                            $debut = $data['DateDebut'];
                                                            $fin = $data['DateFin'];

                                                            $queryEmailAssistant = "SELECT Email FROM assistant WHERE IDAssistant = '" . $idAssistant . "'";
                                                            $exec_requete_Email_Assistant = mysqli_query($db_handle, $queryEmailAssistant);

                                                            if ($exec_requete_Email_Assistant) {
                                                                $num_rows_email_assistant = mysqli_num_rows($exec_requete_Email_Assistant);
                                                                if ($num_rows_email_assistant > 0) {
                                                                    $dataEmailAssistant = mysqli_fetch_assoc($exec_requete_Email_Assistant);
                                                                    $emailAssistant = $dataEmailAssistant["Email"];

                                                                    $queryEmailProfesseur = "SELECT Email FROM professeur WHERE IDProfesseur  = '" . $idProfesseur . "'";
                                                                    $exec_requete_Email_Professeur = mysqli_query($db_handle, $queryEmailProfesseur);

                                                                    if ($exec_requete_Email_Professeur) {
                                                                        $num_rows_email_professeur = mysqli_num_rows($exec_requete_Email_Professeur);

                                                                        if ($num_rows_email_professeur > 0) {
                                                                            $dataEmailProfesseur = mysqli_fetch_assoc($exec_requete_Email_Professeur);
                                                                            $emailProfesseur = $dataEmailProfesseur["Email"];

                                                                            echo "<tr>";
                                                                            echo "<td>$emailAssistant</td>";
                                                                            echo "<td>$emailProfesseur</td>";
                                                                            echo "<td>$promo</td>";
                                                                            echo "<td>$groupeTD</td>";
                                                                            echo "<td>$debut</td>";
                                                                            echo "<td>$fin</td>";
                                                                            if ($status == 0) {
                                                                                echo "<td class='validateSessionButton'>";
                                                                                echo '<form method="GET" action="validerSessionProcessing.php" class="apercuHeureAValider">';
                                                                                echo '<button type="submit" name="idSession" value="' . htmlspecialchars($idSession) . '"><span class="fa fa-check-circle fa-3x"></span></button>';
                                                                                echo "</form>";
                                                                                echo '<form method="GET" action="deleteSessionProcessing.php" class="apercuHeureAValider">';
                                                                                echo '<button type="submit" name="idSession" value="' . htmlspecialchars($idSession) . '"><span class="fa fa-times-circle fa-3x"></span></button>';
                                                                                echo "</form>";
                                                                                echo "</td>";
                                                                            } else if ($status == 1) {
                                                                                echo '<td><span class="status-seance color-three"></span>';
                                                                                echo '<form method="GET" action="deleteSessionProcessing.php" class="apercuHeureAValider">';
                                                                                echo '<button type="submit" name="idSession" value="' . htmlspecialchars($idSession) . '"><span class="fa fa-times-circle fa-3x"></span></button>';
                                                                                echo "</form>";
                                                                                echo "</td>";
                                                                            } else if ($status == 2) {
                                                                                echo '<td><span class="status-seance color-one"></span>';
                                                                                echo '<form method="GET" action="validerSessionProcessing.php" class="apercuHeureAValider">';
                                                                                echo '<button type="submit" name="idSession" value="' . htmlspecialchars($idSession) . '"><span class="fa fa-check-circle fa-3x"></span></button>';
                                                                                echo "</form>";
                                                                                echo "</td>";
                                                                            }

                                                                            echo "</tr>";
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            } else if ($_SESSION["accountType"] == "student") {
                                                $query = "SELECT * from tp where IDAssistant = '" . $_SESSION['utilisateur_ID'] . "'";
                                                $exec_requete = mysqli_query($db_handle, $query);

                                                if ($exec_requete) {
                                                    $num_rows = mysqli_num_rows($exec_requete);

                                                    if ($num_rows > 0) {
                                                        while (($data = mysqli_fetch_assoc($exec_requete))) {
                                                            $idAssistant = $data['IDAssistant'];
                                                            $idProfesseur = $data['IDProfesseur'];
                                                            $statusSession = $data['StatusSession'];
                                                            $promo = $data['promoTP'];
                                                            $idSession = $data['IDTp'];
                                                            $groupeTD = $data['groupTP'];
                                                            $debut = $data['DateDebut'];
                                                            $fin = $data['DateFin'];

                                                            $queryEmailAssistant = "SELECT Email FROM assistant WHERE IDAssistant = '" . $idAssistant . "'";
                                                            $exec_requete_Email_Assistant = mysqli_query($db_handle, $queryEmailAssistant);

                                                            if ($exec_requete_Email_Assistant) {
                                                                $num_rows_email_assistant = mysqli_num_rows($exec_requete_Email_Assistant);
                                                                if ($num_rows_email_assistant > 0) {
                                                                    $dataEmailAssistant = mysqli_fetch_assoc($exec_requete_Email_Assistant);
                                                                    $emailAssistant = $dataEmailAssistant["Email"];

                                                                    $queryEmailProfesseur = "SELECT Email FROM professeur WHERE IDProfesseur  = '" . $idProfesseur . "'";
                                                                    $exec_requete_Email_Professeur = mysqli_query($db_handle, $queryEmailProfesseur);

                                                                    if ($exec_requete_Email_Professeur) {
                                                                        $num_rows_email_professeur = mysqli_num_rows($exec_requete_Email_Professeur);

                                                                        if ($num_rows_email_professeur > 0) {
                                                                            $dataEmailProfesseur = mysqli_fetch_assoc($exec_requete_Email_Professeur);
                                                                            $emailProfesseur = $dataEmailProfesseur["Email"];

                                                                            echo "<tr>";
                                                                            echo "<td>$emailAssistant</td>";
                                                                            echo "<td>$emailProfesseur</td>";
                                                                            echo "<td>$promo</td>";
                                                                            echo "<td>$groupeTD</td>";
                                                                            echo "<td>$debut</td>";
                                                                            echo "<td>$fin</td>";
                                                                            if ($statusSession == 0) {
                                                                                echo '<td><span class="status-seance color-two"></span></td>';
                                                                            }
                                                                            if ($statusSession == 1) {
                                                                                echo '<td><span class="status-seance color-three"></span></td>';
                                                                            }
                                                                            if ($statusSession == 2) {
                                                                                echo '<td><span class="status-seance color-one"></span></td>';
                                                                            }
                                                                            echo "</tr>";
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            } else if ($_SESSION["accountType"] == "administrator") {
                                                $query = "SELECT * from tp";
                                                $exec_requete = mysqli_query($db_handle, $query);

                                                if ($exec_requete) {
                                                    $num_rows = mysqli_num_rows($exec_requete);
                                                    if ($num_rows > 0) {
                                                        while (($data = mysqli_fetch_assoc($exec_requete))) {
                                                            $idAssistant = $data['IDAssistant'];
                                                            $idProfesseur = $data['IDProfesseur'];
                                                            $promo = $data['promoTP'];
                                                            $idSession = $data['IDTp'];
                                                            $status = $data['StatusSession'];
                                                            $groupeTD = $data['groupTP'];
                                                            $debut = $data['DateDebut'];
                                                            $fin = $data['DateFin'];

                                                            $queryEmailAssistant = "SELECT Email FROM assistant WHERE IDAssistant = '" . $idAssistant . "'";
                                                            $exec_requete_Email_Assistant = mysqli_query($db_handle, $queryEmailAssistant);

                                                            if ($exec_requete_Email_Assistant) {
                                                                $num_rows_email_assistant = mysqli_num_rows($exec_requete_Email_Assistant);
                                                                if ($num_rows_email_assistant > 0) {
                                                                    $dataEmailAssistant = mysqli_fetch_assoc($exec_requete_Email_Assistant);
                                                                    $emailAssistant = $dataEmailAssistant["Email"];

                                                                    $queryEmailProfesseur = "SELECT Email FROM professeur WHERE IDProfesseur  = '" . $idProfesseur . "'";
                                                                    $exec_requete_Email_Professeur = mysqli_query($db_handle, $queryEmailProfesseur);

                                                                    if ($exec_requete_Email_Professeur) {
                                                                        $num_rows_email_professeur = mysqli_num_rows($exec_requete_Email_Professeur);

                                                                        if ($num_rows_email_professeur > 0) {
                                                                            $dataEmailProfesseur = mysqli_fetch_assoc($exec_requete_Email_Professeur);
                                                                            $emailProfesseur = $dataEmailProfesseur["Email"];

                                                                            echo "<tr>";
                                                                            echo "<td>$emailAssistant</td>";
                                                                            echo "<td>$emailProfesseur</td>";
                                                                            echo "<td>$promo</td>";
                                                                            echo "<td>$groupeTD</td>";
                                                                            echo "<td>$debut</td>";
                                                                            if ($status == 0) {
                                                                                echo "<td class='validateSessionButton'>";
                                                                                echo '<form method="GET" action="validerSessionProcessing.php" class="apercuHeureAValider">';
                                                                                echo '<button type="submit" name="idSession" value="' . htmlspecialchars($idSession) . '"><span class="fa fa-check-circle fa-3x"></span></button>';
                                                                                echo "</form>";
                                                                                echo '<form method="GET" action="deleteSessionProcessing.php" class="apercuHeureAValider">';
                                                                                echo '<button type="submit" name="idSession" value="' . htmlspecialchars($idSession) . '"><span class="fa fa-times-circle fa-3x"></span></button>';
                                                                                echo "</form>";
                                                                                echo "</td>";
                                                                            } else if ($status == 1) {
                                                                                echo '<td><span class="status-seance color-three"></span>';
                                                                                echo '<form method="GET" action="deleteSessionProcessing.php" class="apercuHeureAValider">';
                                                                                echo '<button type="submit" name="idSession" value="' . htmlspecialchars($idSession) . '"><span class="fa fa-times-circle fa-3x"></span></button>';
                                                                                echo "</form>";
                                                                                echo "</td>";
                                                                            } else if ($status == 2) {
                                                                                echo '<td><span class="status-seance color-one"></span>';
                                                                                echo '<form method="GET" action="validerSessionProcessing.php" class="apercuHeureAValider">';
                                                                                echo '<button type="submit" name="idSession" value="' . htmlspecialchars($idSession) . '"><span class="fa fa-check-circle fa-3x"></span></button>';
                                                                                echo "</form>";
                                                                                echo "</td>";
                                                                            }
                                                                            echo "</tr>";
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }



                                        ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>

</html>