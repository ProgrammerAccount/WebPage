
<?php session_start();

if (isset($_POST['AdminEmail']) && isset($_POST['AdminPass']) && isset($_POST['email']) && isset($_POST['pass']) && isset($_POST['passv2'])) {
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
        <link href="../css/cmsLogin.css" rel="stylesheet"/>
    </head>
    <body>
        <form id="login" action="" method="POST">
            <input type="text" name="AdminEmail" placeholder="E-mail Admnistratora" /> </br>
            <input type="password" name="AdminPass" placeholder="Hasło Administratora"/> </br>
            <input type="text" name="email" placeholder="E-mail"/> </br>
            <input type="password" name="pass" placeholder="Hasło"/> </br>
            <input type="password" name="passv2" placeholder="Hasło"/> </br>
            <input type="submit" value="Dodaj Konto"/></br>
            <?php
if (isset($_SESSION["error"])) {
    echo $_SESSION["error"];
    unset($_SESSION["error"]);
}
?>
        </form>
    </body>
</html>
