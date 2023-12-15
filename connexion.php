<?php
//Déclarations de la base de données 
session_start();
$database = "id21625993_assistante_ece";

//Connexion à la base de données
$db_handle = mysqli_connect("localhost", "id21625993_adminece", "123456789aA@");
$db_found = mysqli_select_db($db_handle, $database);

if (isset($_SESSION['utilisateur_ID'])) {
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
    <div class="connexion-content">
        <div class="imgBox"></div>
        <div class="contentBox">
            <div class="formBox">
                <form action="connexionProcessing.php" method="post">
                    <h2>Connexion</h2>
                    <div class="inputBox-title">
                        <span>Type de compte</span>
                    </div>

                    <div class="inputBox">
                        <label class="radioLabel">
                            <input type="radio" name="accountType" value="teacher" class="teacherRadio" />
                            Professeur
                        </label>
                        <label class="radioLabel">
                            <input type="radio" name="accountType" value="student" class="studentRadio" />
                            Assistant
                        </label>
                        <label class="radioLabel">
                            <input type="radio" name="accountType" value="administrator" class="adminRadio" />
                            Administrateur
                        </label>
                    </div>
                    <div class="inputBox">
                        <span>Email</span>
                        <input type="email" name="accountUsername" required>
                    </div>
                    <div class="inputBox">
                        <span>Mot de passe</span>
                        <input type="password" name="accountPassword" required>
                    </div>
                    <div class="inputBox">
                        <input type="submit" name="connexionButton" value="Connexion">
                        <a href="forgotPassword.php" class="forgotPassword">Mot de passe oublié</a>
                    </div>

                    <?php
                    if (isset($_GET['erreur'])) {
                        $err = $_GET['erreur'];
                        if ($err == 1)
                            echo "<p style='color:red'>Utilisateur ou mot de passe incorrect</p>";
                        else if ($err == 2)
                            echo "<p style='color:red'>Utilisateur ou mot de passe non saisis</p>";
                        else if ($err == 3)
                            echo "<p style='color:red'>Aucun type de compte sélectionné</p>";
                        else if ($err == 4)
                            echo "<p style='color:red'>Votre compte a été suspendu</p>";
                    }
                    ?>
                </form>
            </div>
        </div>

    </div>
</body>

</html>