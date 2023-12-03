<?php
//Déclarations de la base de données 
session_start();
$database = "assistant_ece";

//Connexion à la base de données
$db_handle = mysqli_connect("localhost", "root", "123456789");
$db_found = mysqli_select_db($db_handle, $database);

if (!isset($_SESSION['utilisateur_ID'])) {
    header('Location: index.php');
}
?>

<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8" />
    <title>Assistant ECE</title>
</head>

<body>
    <div>
        <form method="post" action="addTeacherProcessing.php">
            <h2>Ajouter un professeur : </h2>
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
        </form>
    </div>
</body>

</html>