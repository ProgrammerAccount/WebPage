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
    public $dbTableName = "Admin";
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
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
        $statement = false;
        try {
            $statement = $this->pdo->prepare("SELECT * FROM $this->dbTableName WHERE email= :email ");
            $statement->bindParam(":email", $email);
            $statement->execute();
            if ($statement !== false && $statement->rowCount() > 0) {
                return $statement->fetch();
            } else {
                return false;
            }

        } catch (Exception $e) {}

    }
    public function addUser($email, $password)
    {

         if ($this->getUser($email) === false) {
        $pass = password_hash($password, PASSWORD_DEFAULT);
        $statement = $this->pdo->prepare("INSERT INTO $this->dbTableName VALUES(NULL, :email, '" . $pass . "',NULL )");
        $statement->bindParam(":email", $email);
        return $statement->execute();
}
        
        else return false;

    }
    public function comparePassword($password, $hash)
    {
        if (password_verify($password, $hash)) {
            return true;
        }

        return false;
    }
    public function __destruct()
    {
        $this->pdo = null;
    }

}
