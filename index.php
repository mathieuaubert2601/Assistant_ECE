<?php
session_start();
$database = "id21625993_assistante_ece";
$db_handle = mysqli_connect("localhost", "id21625993_adminece", "123456789aA@");
$db_found = mysqli_select_db($db_handle, $database);

if(isset($_SESSION['utilisateur_ID'])) {
  if(isset($_SESSION['accountType'])) {
    if($_SESSION['accountType'] == 'administrator') {
      header("Location: adminFirstPage.php");
      exit;
    } else if($_SESSION["accountType"] == "teacher") {
      header("Location: teacherFirstPage.php");
      exit;
    } elseif($_SESSION["accountType"] == "student") {
      header("Location: assistantFirstPage.php");
      exit;
    }
  }
} else {
  header("Location: connexion.php");
  exit;
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <title>Assistant ECE</title>
</head>

<body>
  <!-- Contenu de la page -->
</body>

</html>