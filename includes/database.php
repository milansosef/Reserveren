<?php
//Database connectie

//$host     = 'localhost';
//$username = 'root';
//$password = '';
//$database = 'coachkamer';

$host     = 'localhost';
$username = 'alettawubben';
$password = 'Lpo21h#9';
$database = 'alettawubben';

$db = mysqli_connect ($host, $username, $password, $database)
or die('Error: '.mysqli_connect_error());

if (!$db){
    echo'Error: not connected to the database';
}

if (!mysqli_select_db($db, $database)){
    echo'Error: Database not selected';
}
