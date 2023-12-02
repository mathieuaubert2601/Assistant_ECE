<?php
//Déclarations de la base de données 
session_start();
$database = "assistant_ece";

//Connexion à la base de données
$db_handle = mysqli_connect("localhost", "root", "123456789");
$db_found = mysqli_select_db($db_handle, $database);
?>

<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8" />
    <title>Assistant ECE</title>
</head>

<body>
    <div>
        <?php
    if (isset($_SESSION['utilisateur_ID'])) {
      if (isset($_SESSION['accountType'])) {
        if ($_SESSION['accountType'] == 'administrator') {
          header("Location: adminFirstPage.php");
        } else if ($_SESSION["accountType"] == "teacher") {
          header("Location: teacherFirstPage.php");
        } elseif ($_SESSION["accountType"] == "student") {
          header("Location: assistantFirstPage.php");
        }
      }
    } else {
      header("Location: connexion.php");
    } ?>
    </div>
</body>

</html>