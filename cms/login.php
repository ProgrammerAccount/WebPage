<?php
session_start();
require '../phpClass/Login.php';
$email = $_POST['email'];
$password = $_POST['pass'];
$login = new Login();
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

?>