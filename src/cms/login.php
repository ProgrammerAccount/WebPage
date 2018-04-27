<?php
session_start();
if(isset($_POST['g-recaptcha-response']))
{
    $secretKey="6LdvXlMUAAAAAMzv21EeVmcN26QWgRPn_CHwksv0";
    $captchaResponse = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$_POST['g-recaptcha-response'].""); 
    $captchaResponse =  json_decode($captchaResponse);
    if($captchaResponse->success===true)
    {
        require '../phpClass/Login.php';
        require '../phpClass/connect_data.php';

        $email = $_POST['email'];
        $password = $_POST['pass'];
        $login = new Login($pdo);
        if ($login->validation_email($email)) {
            $user = $login->getUser($email);
            if ($user !== false) {
                if ($login->comparePassword($password, $user['password'])) {
                    $_SESSION['login'] = true;
                    $_SESSION['username'] = $email;
                    header("Location: panel.php");
                } else {
                    $_SESSION['error'] = "Niepoprawne hasło";
                    header("Location: index.php");
                }
            } else {
                $_SESSION['error'] = "Niepoprawne emamil";
                header("Location: index.php");
            }
        } else {
            $_SESSION['error'] = "Niepoprawne dane";
            header("Location: index.php");
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

?>