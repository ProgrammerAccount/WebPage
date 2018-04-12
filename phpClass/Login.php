<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ClassLogin
 *
 * @author janiak
 */
class Login
{
    public function __construct()
    {
        require_once 'connect_data.php';
        $dsn = "mysql:host=$SERVER;dbname=$DB_NAME";
        try
        {
            $this->pdo = new PDO($dsn, $USER_NAME, $PASSWORD);
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            die();
        }
    }

    public function validation_email($email)
    {
        if (empty($email)) {
            return false;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        return true;
    }

    public function getUser($email)
    {
        $query = $this->pdo->prepare("SELECT * FROM Admin WHERE email= :email ");
        $query->bindParam(":email", $email);
        $query->execute();
        if ($query->rowCount() > 0) {
            return $query->fetch();
        } else {
            return false;
        }

    }
    public function addUser($email, $password)
    {

        if ($this->getUser($email) === false) {
            $pass = password_hash($password, PASSWORD_DEFAULT);
            $query = $this->pdo->prepare("INSERT INTO Admin VALUES(NULL, :email, '" . $pass . "' )");
            $query->bindParam(":email", $email);
            $query->execute();
            return true;
        }

        return false;

    }
    public function comparePassword($password, $hash)
    {
        if (password_verify($password, $hash)) {
            return true;
        }

        return false;
    }

}
