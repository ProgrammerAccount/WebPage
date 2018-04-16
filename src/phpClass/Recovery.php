<?php

class Recovery
{
    private $pdo;
    private $token;
    public function __construct()
    {
        try{            
            require_once 'connect_data.php';
            $dsn="mysql:host=$SERVER;dbname=$DB_NAME";
            $this->pdo = new POD($dsn,$USER_NAME,$PASSWORD);
        }catch(Exeption $e){
            print "Chwilowy brak dostępu do bazy danych<br/>";
            die();
        
        }
    
    }
public function generateToken()
{
    $this->token = MD5(date());
}
public function sendEmail($emailAdress)
{
$link= $_SERVER['HTTP_HOST']."/cms/recovery.php?email=$emailAdress&token=".$this->token;


    mail($emailAdress,"Odzyskiwanie hasła Liskowiak","Wysłano żądanie zmiany hasła, w celu zmiany kliknij poniższy link"
    .$link);
    
}
public change password
public validation Token
}
?>