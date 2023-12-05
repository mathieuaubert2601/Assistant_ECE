<?php
//Déclarations de la base de données 
session_start();
$database = "assistant_ece";

//Connexion à la base de données
$db_handle = mysqli_connect("localhost", "root", "123456789");
$db_found = mysqli_select_db($db_handle, $database);

if (!isset($_SESSION['utilisateur_ID']) || ($_SESSION["accountType"] != "teacher" && $_SESSION["accountType"] != "student")) {
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
    <div class="validateSessionSection">
        <table class="validateSessionTable">
            <tr>
                <?php
                if (isset($_SESSION['accountType'])) {
                    if ($_SESSION['accountType'] == 'teacher') {
                        echo "<td>Email Assistant </td>";
                    } else if ($_SESSION["accountType"] == "student") {
                        echo "<td>Email Professeur </td>";
                    }
                }
                ?>

                <td>Groupe du TD </td>
                <td>Promo du TD </td>
                <td>Heure du début </td>
                <td>Heure de fin </td>
                <?php
                if (isset($_SESSION['accountType'])) {
                    if ($_SESSION['accountType'] == 'teacher') {
                        echo "<td>Validation de la séance </td>";
                    }
                }
                ?>
            </tr>
            <?php
            $database = "assistant_ece";

            //Connexion à la base de données
            $db_handle = mysqli_connect("localhost", "root", "123456789");
            $db_found = mysqli_select_db($db_handle, $database);

            if (isset($_SESSION["utilisateur_ID"])) {

                if ($_SESSION["accountType"] == "teacher") {
                    $idProfesseur = $_SESSION["utilisateur_ID"];
                    $query = "SELECT * from tp WHERE IDProfesseur = '" . $idProfesseur . "' AND StatusSession = 0";
                    $exec_requete = mysqli_query($db_handle, $query);

                    if ($exec_requete) {
                        $num_rows = mysqli_num_rows($exec_requete);

                        if ($num_rows > 0) {
                            while ($data = mysqli_fetch_assoc($exec_requete)) {

                                $idAssistant = $data['IDAssistant'];

                                $queryAssistant = "SELECT Email FROM assistant where IDAssistant = '" . $idAssistant . "'";
                                $exec_requete_Assistant = mysqli_query($db_handle, $queryAssistant);

                                if ($exec_requete_Assistant) {
                                    $num_rows_Assistant = mysqli_num_rows($exec_requete_Assistant);
                                    $data_Assistant = mysqli_fetch_assoc($exec_requete_Assistant);
                                    if ($num_rows_Assistant > 0) {
                                        $emailAssistant = $data_Assistant['Email'];
                                        $idSession = $data['IDTp'];
                                        $tdGroup = $data['groupTP'];
                                        $promoGroup = $data['promoTP'];
                                        $dateFin = $data['DateFin'];
                                        $dateDebut = $data['DateDebut'];
                                        echo "<tr>";
                                        echo "<td>$emailAssistant</td>";
                                        echo "<td>$tdGroup</td>";
                                        echo "<td>$promoGroup</td>";
                                        echo "<td>$dateFin</td>";
                                        echo "<td>$dateDebut</td>";
                                        echo "<td>";
                                        echo '<form method="GET" action="validerSessionProcessing.php">';
                                        echo '<button type="submit" name="idSession" value="' . htmlspecialchars($idSession) . '">valider</button>';
                                        echo "</form>";
                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                }
                            }
                        }
                    }
                } else if ($_SESSION["accountType"] == "student") {
                    $idAssistant = $_SESSION["utilisateur_ID"];
                    $query = "SELECT * from tp WHERE IDAssistant = '" . $idAssistant . "' AND StatusSession = 0";
                    $exec_requete = mysqli_query($db_handle, $query);

                    if ($exec_requete) {
                        $num_rows = mysqli_num_rows($exec_requete);

                        if ($num_rows > 0) {
                            while ($data = mysqli_fetch_assoc($exec_requete)) {

                                $idProfesseur = $data['IDProfesseur'];

                                $queryProfesseur = "SELECT Email FROM professeur where IDProfesseur = '" . $idProfesseur . "'";
                                $exec_requete_professeur = mysqli_query($db_handle, $queryProfesseur);

                                if ($exec_requete_professeur) {
                                    $num_rows_Professeur = mysqli_num_rows($exec_requete_professeur);
                                    $data_Professeur = mysqli_fetch_assoc($exec_requete_professeur);
                                    if ($num_rows_Professeur > 0) {
                                        $emailProfesseur = $data_Professeur['Email'];
                                        $idSession = $data['IDTp'];
                                        $tdGroup = $data['groupTP'];
                                        $promoGroup = $data['promoTP'];
                                        $dateFin = $data['DateFin'];
                                        $dateDebut = $data['DateDebut'];
                                        echo "<tr>";
                                        echo "<td>$emailProfesseur</td>";
                                        echo "<td>$tdGroup</td>";
                                        echo "<td>$promoGroup</td>";
                                        echo "<td>$dateFin</td>";
                                        echo "<td>$dateDebut</td>";
                                        echo "</tr>";
                                    }
                                }
                            }
                        }
                    }
                }

            }
            ?>
        </table>
    </div>
</body>

</html>