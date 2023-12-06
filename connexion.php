<?php
//Déclarations de la base de données 
session_start();
$database = "id21625993_assistante_ece";

//Connexion à la base de données
$db_handle = mysqli_connect("localhost", "id21625993_adminece", "123456789aA@");
$db_found = mysqli_select_db($db_handle, $database);

if(isset($_SESSION['utilisateur_ID'])) {
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8" />
    <title>Assistant ECE</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css" media="screen" type="text/css" />
</head>

<body class="pageFormulaire">
    <div class="connexionSection">
        <form class="connexionForm" action="connexionProcessing.php" method="post">
            <h2>Connexion</h2>
            <table>
                <tr>
                    <td>Type de compte : </td>
                    <td><input type="radio" name="accountType" value="teacher" class="teacherRadio" /> Professeur
                        <input type="radio" name="accountType" value="student" class="studentRadio" /> Assistant
                        <input type="radio" name="accountType" value="administrator" class="adminRadio" />
                        Administrateur
                    </td>
                </tr>
                <tr>
                    <td>Email :</td>
                    <td><input type="email" name="accountUsername" required></td>
                </tr>
                <tr>
                    <td>Mot de passe :</td>
                    <td><input type="password" name="accountPassword" required></td>
                </tr>
            </table>
            <input type="submit" name="connexionButton" value="Connexion">
            <?php
            if(isset($_GET['erreur'])) {
                $err = $_GET['erreur'];
                if($err == 1)
                    echo "<p style='color:red'>Utilisateur ou mot de passe incorrect</p>";
                else if($err == 2)
                    echo "<p style='color:red'>Utilisateur ou mot de passe non saisis</p>";
                else if($err == 3)
                    echo "<p style='color:red'>Aucun type de compte sélectionné</p>";
            }
            ?>
        </form>
    </div>
</body>

</html>