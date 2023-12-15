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
} else if (isset($_SESSION['accountType'])) {
    if ($_SESSION['accountType'] != "administrator") {
        header('Location: index.php');
        exit();
    }
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
                    <a href="addTeacher.php" class="active"><span class="fa fa-user-plus"> </span><span> Ajout
                            Professeur</span></a>
                </li>
                <li>
                    <a href="sessionHistory.php"><span class="fa fa-history"> </span><span> Historique des
                            séances</span></a>
                </li>
                <li>
                    <a href="teacherManagment.php"><span class="fa fa-user-times"> </span><span> Gestion
                            Professeurs</span></a>
                </li>
                <li>
                    <a href="assistantManagment.php"><span class="fa fa-user-times"> </span><span> Gestion
                            Assistants</span></a>
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
                        if ($_SESSION["accountType"] == "administrator") {
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
                    <h2>Ajout d'un professeur</h2>
                </div>
                <form method="POST" action="addTeacherProcessing.php">
                    <div class="user-details">
                        <div class="input-box">
                            <span class="details">Prénom</span>
                            <input name="firstNameTeacher" type="text" placeholder="Entrer le prénom du professeur" required>
                        </div>
                        <div class="input-box">
                            <span class="details">Nom</span>
                            <input name="lastNameTeacher" type="text" placeholder="Entrer le nom du professeur" required>
                        </div>
                        <div class="input-box">
                            <span class="details">Email</span>
                            <input name="emailTeacher" type="email" placeholder="Entrer l email du professeur" required>
                        </div>
                        <div class="input-box">
                            <span class="details">Mot de passe</span>
                            <input name="passwordTeacher" type="password" placeholder="Entrer un mot de passe" required>
                        </div>
                        <div class="input-box">
                            <span class="details">Confirmer mot de passe</span>
                            <input name="confirmationPasswordTeacher" type="password" placeholder="Confirmer le mot de passe" required>
                        </div>

                    </div>
                    <div class="button-formulaire">
                        <input type="submit" name="addTeacherButton" value="Ajouter">
                    </div>
                    <?php
                    if (isset($_GET['erreur'])) {
                        $err = $_GET['erreur'];
                        if ($err == 1 || $err == 2)
                            echo "<p style='color:red'>Certains champs n'ont pas été complétés</p>";
                        else if ($err == 3)
                            echo "<p style='color:red'>Les deux mots de passe ne sont pas identiques</p>";
                        else if ($err == 4)
                            echo "<p style='color:red'>Cet email est déja existant</p>";
                    }
                    ?>
                </form>
            </div>
        </main>
    </div>
</body>

</html>