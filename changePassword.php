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
                        echo '<a href="sessionHistory" ><span class="fa fa-history"> </span><span> Historique des séances</span></a>';
                        echo "</li>";
                    } else if ($_SESSION['accountType'] == "student") {
                        echo "<li>";
                        echo '<a href="adminDashboard.php"><span class="fa fa-home"> </span><span> Accueil</span></a>';
                        echo "</li>";

                        echo "<li>";
                        echo '<a href="addSession.php"><span class="fa fa-plus-circle"> </span><span> Ajout Séance</span></a>';
                        echo "</li>";

                        echo "<li>";
                        echo '<a href="sessionHistory" ><span class="fa fa-history"> </span><span> Historique des séances</span></a>';
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
                        echo '<a href="sessionHistory" ><span class="fa fa-history"> </span><span> Historique des séances</span></a>';
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

        <main class="body-formulaire">
            <div class="input-form">
                <div class="title">
                    <h2>Changement du mot de passe</h2>
                </div>
                <form method="POST" action="changePasswordProcessing.php">
                    <div class="user-details">
                        <div class="input-box">
                            <span class="details">Nouveau mot de passe</span>
                            <input name="newPassword" type="password" placeholder="Entrer le nouveau mot de passe" required>
                        </div>
                        <div class="input-box">
                            <span class="details">Confirmer le mot de passe</span>
                            <input name="confirmationNewPassword" type="password" placeholder="Confirmer le mot de passe" required>
                        </div>
                        <div class="input-box">
                            <span class="details">Ancien mot de passe</span>
                            <input name="currentPassword" type="password" placeholder="Entrer le mot de passe actuel" required>
                        </div>


                    </div>
                    <div class="button-formulaire">
                        <input type="submit" name="passwordUpdate" value="Mettre à jour le mot de passe">
                    </div>
                    <?php
                    if (isset($_GET['erreur'])) {
                        $err = $_GET['erreur'];
                        if ($err == 1)
                            echo "<p style='color:red'>Tous les champs de saisis n'ont pas été complétés</p>";
                        else if ($err == 2)
                            echo "<p style='color:red'>Certains champs de saisis sont vides</p>";
                        else if ($err == 3)
                            echo "<p style='color:red'>Les deux mot de passe ne sont pas identiques</p>";
                        else if ($err == 4)
                            echo "<p style='color:red'>L utilisateur inconnu veuillez vous reconnecter</p>";
                        else if ($err == 5)
                            echo "<p style='color:red'>Mot de passe incorrect</p>";
                        else if ($err == 6)
                            echo "<p style='color:green'>Changement de mot de passe validé</p>";
                    }
                    ?>

                </form>
            </div>
        </main>
    </div>
</body>

</html>