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
    <script src="connexion.js"></script>
</head>

<body>
    <div class="connexionSection">
        <form class="connexionForm" action="connexionProcessing.php" method="post">
            <h2>Connexion</h2>
            <table>
                <tr>
                    <td>Type de compte : </td>
                    <td><input type="radio" name="accountType" value="teacher" class="teacherRadio" /> Professeur</td>
                    <td><input type="radio" name="accountType" value="student" class="studentRadio" /> Assistant</td>
                    <td><input type="radio" name="accountType" value="administrator" class="adminRadio" />
                        Administrateur
                    </td>
                </tr>
                <tr>
                    <td>Email :</td>
                    <td><input type="email" name="accountUsername" required></td>
                </tr>
                <tr>
                    <td>Mot de passe :</td>
                    <td><input type="passsword" name="accountPassword" required></td>
                </tr>
            </table>
            <input type="submit" name="connexionButton" value="Connexion" onsubmit="connexionCheck()">
            <p style="visibility: hidden;" class="errorMessageConnexion">Vous n'avez pas sélectionné un type de compte
            </p>
        </form>
    </div>
</body>

</html>