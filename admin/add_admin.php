<?php

//connect met db
require_once '../includes/database.php';

//User input
$email = 'msosef@yahoo.com';

//Wachtwoord hashen
$password = password_hash('test', PASSWORD_DEFAULT);
$name = 'Milan';

echo $password;

// query opbouwen
$sql = "INSERT INTO login (email, name, password)
        VALUES ('$email', '$name', '$password')";

echo $sql;
// Query uitvoeren
print_r( mysqli_query($db, $sql));


// connectie sluiten
mysqli_close($db);