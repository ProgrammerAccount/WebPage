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
class Recovery
{
    private $pdo;
    private $token;
    public function __construct()
    {
        try{            
            require_once 'connect_data.php';
            $dsn="mysql:host=$SERVER;dbname=$DB_NAME";
            $this->pdo = new PDO($dsn,$USER_NAME,$PASSWORD);
        }catch(Exeption $e){
            print "Chwilowy brak dostępu do bazy danych<br/>";
            die();
        
        }
    
    }
public function generateToken()
{
    $this->token = MD5(date('l jS F Y h:i:s A'));
}
public function sendEmail($emailAdress)
{
$to =$emailAdress;
$subject = "Odzyskiwanie hasła Liskowiak";
$message = "Wysłano żądanie zmiany hasła, oto jednorazowy token $this->token";

$headers = "From: TestLis@testlis.cba.pl";
return mail($to,$subject,$message,$headers);
}
public function AddTokenToDB($emailAdress)
{
    
    $statment = $this->pdo->prepare("UPDATE Admin SET token='".$this->token."' WHERE email=:email");
    $statment->bindParam(":email", $emailAdress, PDO::PARAM_STR);
    $statment->execute();
}
public function changePassword($emailAdress,$password)
{
    
    $statment = $this->pdo->prepare("UPDATE Admin SET password='".password_hash($password,PASSWORD_DEFAULT)."' WHERE email=:email");
    $statment->bindParam(":email", $emailAdress, PDO::PARAM_STR);
    $statment->execute();
}
public function updateToken($emailAdress)
{
    
    $statment = $this->pdo->prepare("UPDATE Admin SET token='' WHERE email=:email");
    $statment->bindParam(":email", $emailAdress, PDO::PARAM_STR);
    $statment->execute();
}
public function validationToken($emailAdress,$token)
{
    $statment = $this->pdo->prepare("SELECT * FROM Admin WHERE email=:email AND token=:token");
    $statment->bindParam(':email',$emailAdress);
    $statment->bindParam(':token',$token);
    $statment->execute();
    if($statment!=false && $statment->rowCount()===1) return true;
    return false;
 
}
}