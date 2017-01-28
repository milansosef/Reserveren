<?php
require_once 'includes/database.php';
//Haal de geselecteerde datum op
$datumClick = mysqli_real_escape_string($db, $_GET['date']);

//De tijden die bij de geselecteerde datum horen worden opgehaald
$query = "SELECT tijd 
          FROM appointment
          WHERE datum = '$datumClick'
          ";

$result = mysqli_query($db, $query);

$times = [];
//De opgehaalde tijden worden in een array geplaatst
while($row = mysqli_fetch_assoc($result)){
    //De ',' worden weggehaald
    $allTimes = explode(',', $row['tijd']);
    foreach($allTimes as $time){
        $times[] = $time;
    }
}

//De array met tijden wordt als json gecodeerd en geëchood
header("Content-Type: application/json");
echo json_encode($times);
