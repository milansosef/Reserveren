<?php
require_once "../includes/database.php";

$appointmentId = $_GET['id'];

$query = "DELETE FROM appointment
          WHERE ID = $appointmentId";

if(mysqli_query($db, $query)){
    $message = 'De boeking is succesvol geannuleerd.';
}


mysqli_close($db);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Title</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="">
</head>
<body>
<div>
    <?= $message ?> <br>
    <a href="admin_overzicht.php">Terug naar het overzicht</a>
</div>
</body>
</html>