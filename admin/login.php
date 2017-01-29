<?php

require_once '../includes/database.php';

session_start();
//gegevens invullen
//Is het formulier verzonden? (isset)
if (isset($_POST['submit'])) {
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password = mysqli_real_escape_string($db, $_POST['password']);


    //Data valide?
    $errors = [];
    if ($email == '') {
        $errors['email'] = 'E-mail mag niet leeg zijn.';
    }

    if (empty($errors)) {
        //query opbouwen
        $sql = "SELECT password, name
                FROM login
                WHERE email = '$email'";

        //query uitvoeren
        $result = mysqli_query($db, $sql);

        $user = mysqli_fetch_assoc($result);

        if ($user) {
            if (password_verify($password, $user['password'])) {
                $_SESSION['name'] = $user['name'];
                header("location: admin_overzicht.php");
                exit;
            } else {
                $message = 'Combinatie e-mail en wachtwoord klopt niet.';
            }
        } else {
            $message = 'Combinatie e-mail en wachtwoord klopt niet.';
        }
    }
}


    // Ja
        //Zijn alle velden correct ingevoerd?
            //Ja
                //In database invoeren
            //Nee
                // Foutmelding
                // Data terugschrijven in form
    //Nee
        // gegevens in kunnen vullen
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" >
        <link rel="stylesheet" href="../css/bootstrap/bootstrap.css">
        <link rel="stylesheet" href="../css/login.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href='http://fonts.googleapis.com/css?family=Economica' rel='stylesheet' type='text/css'>
        <title>Document</title>
    </head>
    <body>
        <div class="container">
            <i class="fa fa-user-circle fa-5x" aria-hidden="true"></i>
            <p>Administratie coachkamer</p>

            <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
                <div class="form-input">
                    <input type="text" name="email" id="email" placeholder="E-mailadres" required>
                </div>
                <div class="form-input">
                    <input type="password" name="password" id="password" placeholder="Wachtwoord" required>
                </div>
                <div>
                    <input type="submit" name="submit" value="Log in" class="btn btn-login">
                </div>
            </form>

            <?php if(isset($message)){ ?>
                <div><?= $message ?></div>
            <?php } ?>

        </div>

        <div class="footer">
            <img id="logo" src="../img/logo.jpg">
            <span></span>
        </div>
    </body>
</html>