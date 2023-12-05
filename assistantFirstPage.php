<?php
//Déclarations de la base de données 
session_start();
$database = "id21625993_assistante_ece";

//Connexion à la base de données
$db_handle = mysqli_connect("localhost", "id21625993_adminece", "123456789aA@");
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

<body class="firstPage">
    <div class="assistantFirstPageSection">
        <a href='connexionProcessing.php?deconnexion=true'><span>Déconnexion</span></a>
        <a href='addSession.php'><span>Ajouter une séance</span></a>
        <a href='validateSession.php'><span>Séance en cours de validation</span></a>
        <a href='sessionHistory.php'><span>Historique des séances</span></a>
    </div>
</body>

</html>