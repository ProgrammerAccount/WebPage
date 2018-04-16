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
    public $dbTableName="Admin";
    public function __construct()
    {
        require_once 'connect_data.php';
        $dsn = "mysql:host=$SERVER;dbname=$DB_NAME";
        try
        {
            $this->pdo = new PDO($dsn, $USER_NAME, $PASSWORD);
        } catch (PDOException $exc) {
            print "Chwilowy brak dostępu do bazy danych<br/>";
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
        $statement=false;
        try{
        $statement = $this->pdo->prepare("SELECT * FROM $this->dbTableName WHERE email= :email ");
        $statement->bindParam(":email", $email);
        $statement->execute();
        }
        catch(Exception $e) {}
        if ($statement!==false && $statement->rowCount() > 0) {
            return $statement->fetch();
        } else {
            return false;
        }

    }
    public function addUser($email, $password)
    {

        if ($this->getUser($email) === false) {
            $pass = password_hash($password, PASSWORD_DEFAULT);
            try {
                $statement = $this->pdo->prepare("INSERT INTO $this->dbTableName VALUES(NULL, :email, '" . $pass . "' )");
                $statement->bindParam(":email", $email);
                $statement->execute();
                return true;
            } catch (Exception $e) {
                return false;
            }
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
    public function __destruct()
    {
        $this->pdo = null;
    }

}
