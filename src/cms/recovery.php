<?php session_start();

if (isset($_POST['email'])) {

    if (isset($_POST['g-recaptcha-response'])) {
        $secretKey = "6LdvXlMUAAAAAMzv21EeVmcN26QWgRPn_CHwksv0";
        $captchaResponse = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . $secretKey . "&response=" . $_POST['g-recaptcha-response'] . "");
        $captchaResponse = json_decode($captchaResponse);
        if ($captchaResponse->success === true) {
            require '../phpClass/Recovery.php';
            require '../phpClass/connect_data.php';

            $recovery = new Recovery($pdo);
            if (isset($_POST['email'])) {
                $recovery->generateToken();
                $recovery->AddTokenToDB($_POST['email']);
                $recovery->sendEmail($_POST['email']);
                header("Location: newPassword.php");
                exit();
            }

        }
    }
}
?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>

<head>

    <meta charset="UTF-8">
    <title>Liskowiak</title>
    <link href="../css/cmsLogin.css" rel="stylesheet" />
    <script src='https://www.google.com/recaptcha/api.js'></script>
</head>

<body>
    <form id="login" action="" method="POST">
        <input type="text" name="email" placeholder="E-mail" /> </br>

        <div class="g-recaptcha captcha"  data-sitekey="6LdvXlMUAAAAAKA2OoZktQwQeGSFT7Y5j_XYx_hW"></div>
        </br>
        <input type="submit" value="Dodaj Konto" />
        </br>
        <?php
if (isset($_SESSION["error"])) {
    echo $_SESSION["error"];
    unset($_SESSION["error"]);
}
?>
    </form>
</body>

</html>