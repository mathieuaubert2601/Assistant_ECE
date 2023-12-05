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

<body class="pageFormulaire">
    <div class="addSessionSection">
        <form method="POST" action="addSessionProcessing.php" class="addSessionForm">
            <h2>Ajout d'une séance de TP</h2>
            <table>
                <tr>
                    <td>Entrer la date et l'heure du début de la séance : </td>
                    <td><input type="datetime-local" name="dateHeureStart" required></td>
                </tr>
                <tr>
                    <td>Entrer la date et l'heure de la fin de la séance : </td>
                    <td><input type="datetime-local" name="dateHeureEnd" required></td>
                </tr>
                <tr>
                    <td>Entrer la promotion de la séance : </td>
                    <td><input type="text" name="promoGroupSession" required></td>
                </tr>
                <tr>
                    <td>Entrer le groupe de TD de la séance : </td>
                    <td><input type="text" name="TDGroupSession" required></td>
                </tr>

                <?php
                if ($_SESSION["accountType"] == "administrator") {
                    echo "<tr>";
                    echo "<td>Entrer l'email de l'assistant</td>";
                    echo "<td><input type='email' name='assistantEmail' required></td>";
                    echo "</tr>";

                    echo "<tr>";
                    echo "<td>Entrer l'email du professeur : </td>";
                    echo "<td><input type='email' name='teacherEmail' required></td>";
                    echo "</tr>";
                } else if ($_SESSION["accountType"] == "student") {
                    echo "<tr>";
                    echo "<td>Entrer l'email du professeur : </td>";
                    echo "<td><input type='email' name='teacherEmail' required></td>";
                    echo "</tr>";
                } else if ($_SESSION["accountType"] == "teacher") {
                    echo "<tr>";
                    echo "<td>Entrer l'email de l'assistant</td>";
                    echo "<td><input type='email' name='assistantEmail' required></td>";
                    echo "</tr>";
                }
                ?>
            </table>
            <input type="submit" name="addSessionButton" value="Soumettre">

        </form>
    </div>
</body>

</html>