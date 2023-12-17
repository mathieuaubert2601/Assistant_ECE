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
if (!isset($_SESSION['accountType'])) {
    if ($_SESSION['accountType'] != 'administrator') {
        header('Location: index.php');
        exit();
    }
}

$_SESSION["lastPage"] = "assistantManagment.php";
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
                <li>
                    <a href="adminDashboard.php"><span class="fa fa-home"> </span><span>
                            Accueil</span></a>
                </li>
                <li>
                    <a href="addSession.php"><span class="fa fa-plus-circle"> </span><span> Ajout Séance</span></a>
                </li>
                <li>
                    <a href="addAssistant.php"><span class="fa fa-user-plus"> </span><span> Ajout Assistant</span></a>
                </li>
                <li>
                    <a href="addTeacher.php"><span class="fa fa-user-plus"> </span><span> Ajout Professeur</span></a>
                </li>
                <li>
                    <a href="sessionHistory.php"><span class="fa fa-history"> </span><span> Historique des
                            séances</span></a>
                </li>
                <li>
                    <a href="teacherManagment.php "><span class="fa fa-user-times"> </span><span> Gestion
                            Professeurs</span></a>
                </li>
                <li>
                    <a href="assistantManagment.php " class="active"><span class="fa fa-user-times"> </span><span>
                            Gestion Assistants</span></a>
                </li>
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
                        if ($_SESSION['accountType'] == 'administrator') {
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
                        <h2>Assistant(s)</h2>
                    </div>
                    <div class="body-case">
                        <div class="tableau">
                            <table width="100%">
                                <thead>
                                    <tr>
                                        <td>ID</td>
                                        <td>Prénom</td>
                                        <td>Nom</td>
                                        <td>Email</td>
                                        <td>Status</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = "SELECT * from assistant";
                                    $exec_requete = mysqli_query($db_handle, $query);

                                    if ($exec_requete) {
                                        $num_rows = mysqli_num_rows($exec_requete);
                                        if ($num_rows > 0) {
                                            while (($data = mysqli_fetch_assoc($exec_requete))) {
                                                $idAssistant = $data['IDAssistant'];
                                                $firstName = $data['FirstName'];
                                                $lastName = $data['LastName'];
                                                $email = $data['Email'];
                                                $status = $data['statusCompte'];
                                                $idSession = $idAssistant;

                                                echo "<tr>";
                                                echo "<td>$idAssistant</td>";
                                                echo "<td>$firstName</td>";
                                                echo "<td>$lastName</td>";
                                                echo "<td>$email</td>";
                                                if ($status == 0) {
                                                    echo '<td><span class="status-seance color-three"></span>';
                                                    echo '<form method="GET" action="deleteAssistantProcessing.php" class="apercuHeureAValider">';
                                                    echo '<button type="submit" name="idSession" value="' . htmlspecialchars($idSession) . '"><span class="fa fa-times-circle fa-3x"></span></button>';
                                                    echo "</form>";
                                                    echo "</td>";
                                                } else if ($status == 1) {
                                                    echo '<td><span class="status-seance color-one"></span>';
                                                    echo '<form method="GET" action="validateAssistantProcessing.php" class="apercuHeureAValider">';
                                                    echo '<button type="submit" name="idSession" value="' . htmlspecialchars($idSession) . '"><span class="fa fa-check-circle fa-3x"></span></button>';
                                                    echo "</form>";
                                                    echo "</td>";
                                                }
                                                echo "</tr>";
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