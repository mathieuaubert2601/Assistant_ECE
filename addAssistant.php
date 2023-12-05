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
    <link rel="stylesheet" href="style.css" media="screen" type="text/css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <div class="addAssistantSection">
        <form method="post" action="addAssistantProcessing.php">
            <h2>Ajouter un assistant </h2>
            <table>
                <tr>
                    <td>Prénom : </td>
                    <td><input name="firstNameAssistant" type="text" required></td>
                </tr>
                <tr>
                    <td>Nom : </td>
                    <td><input name="lastNameAssistant" type="text" required></td>
                </tr>
                <tr>
                    <td>Email : </td>
                    <td><input name="emailAssistant" type="email" required></td>
                </tr>
                <tr>
                    <td>Mot de passe : </td>
                    <td><input name="passwordAssistant" type="password" required></td>
                </tr>
                <tr>
                    <td>Confirmer mot de passe : </td>
                    <td><input name="confirmationPasswordAssistant" type="password" required></td>
                </tr>
            </table>
            <input type="submit" name="addAssistantButton" value="Ajouter">
        </form>
    </div>
</body>

</html>