<?php
//Déclarations de la base de données 
session_start();
$database = "assistant_ece";

//Connexion à la base de données
$db_handle = mysqli_connect("localhost", "root", "123456789");
$db_found = mysqli_select_db($db_handle, $database);

if (!isset($_SESSION['utilisateur_ID'])) {
    header('Location : index.php');
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
        <a href='connexionProcessing.php?deconnexion=true'><span>Déconnexion</span></a>
        <a href='addSession.php'><span>Ajouter une séance</span></a>
        <a href='addAssistant.php'><span>Ajouter un assistant</span></a>
        <a href='addTeacher.php'><span>Ajouter un professeur</span></a>
    </div>
</body>

</html>