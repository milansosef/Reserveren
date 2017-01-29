<?php
require_once '../includes/database.php';
session_start();

if(!isset($_SESSION['name'])){
    header('Location: login.php');
    exit;
}

//$query = "SELECT *, tijden.tijd
//          FROM appointment
//          INNER JOIN tijden
//          INNER JOIN appointment_tijden
//          WHERE appointment.tijden_id = appointment_tijden.appointment_id AND
//                tijden.id = appointment_tijden.tijden_id";

//Switch tussen oplopend en aflopend
switch($_GET['dir']){

    case "asc":
        $orderBy = " ORDER BY datum ASC";
    break;

    case "desc":
        $orderBy = " ORDER BY datum DESC";
    break;

    default:
        $orderBy = " ORDER BY datum DESC";
    break;
}

//Voer de query uit op de database
$query = "SELECT * FROM appointment" . $orderBy;

$result = mysqli_query($db, $query);

//Zet de resulataten in een array
$appointments = [];
while ($row = mysqli_fetch_assoc($result)) {
    $appointments[] = $row;
}

//Close connection
mysqli_close($db);

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/admin_overzicht.css">
    <title>Document</title>
</head>
<body>
<div>

</div>
<div class="container">
    <table>
        <thead>
        <tr>
            <th>#</th>
            <th>Voornaam</th>
            <th>Achternaam</th>
            <th>E-mail</th>
            <th>Telefoonnummer</th>
            <th>Datum<a href="admin_overzicht.php?dir=asc">ASC</a>/<a href="admin_overzicht.php?dir=desc">DESC</a></th>
            <th>Tijd</th>
            <th colspan="2"></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($appointments as $appointment) { ?>
            <tr>
                <td><?= $appointment['ID']; ?></td>
                <td><?= $appointment['voornaam']; ?></td>
                <td><?= $appointment['achternaam']; ?></td>
                <td><?= $appointment['email']; ?></td>
                <td><?= $appointment['telefoonnummer']; ?></td>
                <td><?= $appointment['datum']; ?></td>
                <td><?= $appointment['tijd']; ?></td>
                <td><a href="annuleer.php?id=<?= $appointment['ID']; ?>">Annuleer</a></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
</body>
</html>