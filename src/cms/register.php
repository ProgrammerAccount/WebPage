<?php session_start();

if (isset($_POST['AdminEmail']) && isset($_POST['AdminPass']) && isset($_POST['email']) && isset($_POST['pass']) && isset($_POST['passv2'])) {
    
    if(isset($_POST['g-recaptcha-response']))
    {   
    $secretKey="6LdvXlMUAAAAAMzv21EeVmcN26QWgRPn_CHwksv0";
    $captchaResponse = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$_POST['g-recaptcha-response'].""); 
    $captchaResponse =  json_decode($captchaResponse);
    if($captchaResponse->success===true)
    {
    require '../phpClass/Login.php';
    $email = $_POST['AdminEmail'];
    $password = $_POST['AdminPass'];
    $login = new Login();
    if ($_POST['pass'] === $_POST['passv2']) {
        if ($login->validation_email($email)) {
            $user = $login->getUser($email);
            if ($user !== false) {
                if ($login->comparePassword($password, $user['password'])) {
                    if ($login->addUser($_POST['email'], $_POST['pass'])) {
                        $_SESSION['login'] = true;
                        $_SESSION['username'] = $_POST['email'];
                        header("Location: panel.php");
                        exit;
                    } else {
                        $_SESSION['error'] = "Ten E-mail jest w uzyciu";
                        header("Location: register.php");
                        exit;
                    }
                } else {
                    $_SESSION['error'] = "Niepoprawne hasło";
                    header("Location: register.php");
                    exit;
                }
            } else {
                $_SESSION['error'] = "Niepoprawne emamil";
                header("Location: register.php");
                exit;
            }
        } else {
            $_SESSION['error'] = "Niepoprawne dane";
            header("Location: register.php");
            exit;
        }
    } else {
        $_SESSION['error'] = "hasła muszą być takie same";
        header("Location: register.php");
        exit;
    }

}else 
{
    $_SESSION['error'] = "Pokaż że nie jesteś robotem";
    header("Location: index.php");
}
}else
{ 
$_SESSION['error'] = "Pokaż że nie jesteś robotem";
header("Location: index.php");
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
        <input type="text" name="AdminEmail" placeholder="E-mail Admnistratora" /> </br>
        <input type="password" name="AdminPass" placeholder="Hasło Administratora" /> </br>
        <input type="text" name="email" placeholder="E-mail" /> </br>
        <input type="password" name="pass" placeholder="Hasło" /> </br>
        <input type="password" name="passv2" placeholder="Hasło" /> </br>
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