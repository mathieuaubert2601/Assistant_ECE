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
        <form method="post" action="addAssistantProcessing.php">
            <h2>Ajouter un assistant : </h2>
            <table>
                <tr>
                    <td>Entrer le prenom de l'assistant : </td>
                    <td><input name="firstNameAssistant" type="text" required></td>
                </tr>
                <tr>
                    <td>Entrer le nom de l'assistant : </td>
                    <td><input name="lastNameAssistant" type="text" required></td>
                </tr>
                <tr>
                    <td>Entrer l'email de l'assistant : </td>
                    <td><input name="emailAssistant" type="email" required></td>
                </tr>
                <tr>
                    <td>Entrer le mot de passe de l'assistant : </td>
                    <td><input name="passwordAssistant" type="password" required></td>
                </tr>
                <tr>
                    <td>Confirmer le mot de passe de l'assistant : </td>
                    <td><input name="confirmationPasswordAssistant" type="password" required></td>
                </tr>
            </table>
            <input type="submit" name="addAssistantButton" value="Ajouter">
        </form>
    </div>
</body>

</html>