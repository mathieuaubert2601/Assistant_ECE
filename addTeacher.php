<?php
//Déclarations de la base de données 
session_start();
$database = "id21625993_assistante_ece";

//Connexion à la base de données
$db_handle = mysqli_connect("localhost", "id21625993_adminece", "123456789aA@");
$db_found = mysqli_select_db($db_handle, $database);

if(!isset($_SESSION['utilisateur_ID'])) {
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8" />
    <title>Assistant ECE</title>
    <link rel="stylesheet" href="style.css" media="screen" type="text/css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body class="pageFormulaire">
    <div class="addTeacherSection">
        <form method="post" action="addTeacherProcessing.php" class="addTeacherForm">
            <h2>Ajouter un professeur</h2>
            <table>
                <tr>
                    <td>Entrer le prenom du professeur : </td>
                    <td><input name="firstNameTeacher" type="text" required></td>
                </tr>
                <tr>
                    <td>Entrer le nom du professeur : </td>
                    <td><input name="lastNameTeacher" type="text" required></td>
                </tr>
                <tr>
                    <td>Entrer l'email du professeur : </td>
                    <td><input name="emailTeacher" type="email" required></td>
                </tr>
                <tr>
                    <td>Entrer le mot de passe du professeur : </td>
                    <td><input name="passwordTeacher" type="password" required></td>
                </tr>
                <tr>
                    <td>Confirmer le mot de passe du professeur : </td>
                    <td><input name="confirmationPasswordTeacher" type="password" required></td>
                </tr>
            </table>
            <input type="submit" name="addTeacherButton" value="Ajouter">
            <?php
            if(isset($_GET['erreur'])) {
                $err = $_GET['erreur'];
                if($err == 1 || $err == 2)
                    echo "<p style='color:red'>Certains champs n'ont pas été complétés</p>";
                else if($err == 3)
                    echo "<p style='color:red'>Les deux mots de passe ne sont pas identiques</p>";
                else if($err == 4)
                    echo "<p style='color:red'>Cet email est déja existant</p>";
            }
            ?>
        </form>
    </div>
</body>

</html>