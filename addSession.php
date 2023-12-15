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
                        echo '<a href="addSession.php" class="active"><span class="fa fa-plus-circle"> </span><span> Ajout Séance</span></a>';
                        echo "</li>";

                        echo "<li>";
                        echo '<a href="sessionHistory" ><span class="fa fa-history"> </span><span> Historique des séances</span></a>';
                        echo "</li>";
                    } else if ($_SESSION['accountType'] == "student") {
                        echo "<li>";
                        echo '<a href="adminDashboard.php"><span class="fa fa-home"> </span><span> Accueil</span></a>';
                        echo "</li>";

                        echo "<li>";
                        echo '<a href="addSession.php" class="active"><span class="fa fa-plus-circle"> </span><span> Ajout Séance</span></a>';
                        echo "</li>";

                        echo "<li>";
                        echo '<a href="sessionHistory" ><span class="fa fa-history"> </span><span> Historique des séances</span></a>';
                        echo "</li>";
                    } else if ($_SESSION['accountType'] == "administrator") {
                        echo "<li>";
                        echo '<a href="adminDashboard.php"><span class="fa fa-home"> </span><span> Accueil</span></a>';
                        echo "</li>";

                        echo "<li>";
                        echo '<a href="addSession.php" class="active"><span class="fa fa-plus-circle"> </span><span> Ajout Séance</span></a>';
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
                    <h2>Ajout d'une séance de TP</h2>
                </div>
                <form method="POST" action="addSessionProcessing.php">
                    <div class="user-details">
                        <div class="input-box">
                            <span class="details">Date/Heure début</span>
                            <input type="datetime-local" name="dateHeureStart" required>
                        </div>
                        <div class="input-box">
                            <span class="details">Date/Heure fin</span>
                            <input type="datetime-local" name="dateHeureEnd" required>
                        </div>
                        <div class="input-box">
                            <span class="details">Promotion</span>
                            <input type="text" name="promoGroupSession" placeholder="Promotion du groupe de TD" required>
                        </div>
                        <div class="input-box">
                            <span class="details">Groupe de TD</span>
                            <input type="text" name="TDGroupSession" placeholder="Numéro du groupe de TD" required>
                        </div>



                        <?php
                        if ($_SESSION["accountType"] == "administrator") {
                            echo "<div class='input-box'>";
                            echo "<span class='details'>Email assistant</span>";
                            echo "<input type='email' name='assistantEmail' placeholder='Entrer l email de l assistant'required>";
                            echo "</div>";

                            echo "<div class='input-box'>";
                            echo "<span class='details'>Email professeur</span>";
                            echo "<input type='email' name='teacherEmail' placeholder='Entrer l email du professeur'required>";
                            echo "</div>";
                        } else if ($_SESSION["accountType"] == "student") {
                            echo "<div class='input-box'>";
                            echo "<span class='details'>Email professeur</span>";
                            echo "<input type='email' name='teacherEmail' placeholder='Entrer l email du professeur'required>";
                            echo "</div>";
                        } else if ($_SESSION["accountType"] == "teacher") {
                            echo "<div class='input-box'>";
                            echo "<span class='details'>Email assistant</span>";
                            echo "<input type='email' name='assistantEmail' placeholder='Entrer l email de l assistant'required>";
                            echo "</div>";
                        }
                        ?>

                    </div>
                    <div class="button-formulaire">
                        <input type="submit" name="addSessionButton" value="Soumettre">
                    </div>
                    <?php
                    if (isset($_GET['erreur'])) {
                        $err = $_GET['erreur'];
                        if ($err == 1)
                            echo "<p style='color:red'>Email professeur inexistant ou incorrect</p>";
                        else if ($err == 2)
                            echo "<p style='color:red'>Email assistant inexistant ou incorrect</p>";
                    }
                    ?>
                </form>
            </div>
        </main>
    </div>
</body>

</html>