<?php
require_once '../includes/database.php';
session_start();

if(!isset($_SESSION['name'])){
    header('Location: login.php');
    exit;
}

//Get the result set from the database with a SQL query
$query = "SELECT * FROM appointment";
$result = mysqli_query($db, $query);

//Loop through the result to create a custom array
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
            <th>Datum</th>
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