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
/*public function sendEmail($emailAdress)
{
  //$link= $_SERVER['HTTP_HOST']."/cms/recovery.php?email=$emailAdress&token=".$this->token;
$link= "localhost/src/cms/recovery.php?email=$emailAdress&token=";

$headers = 'From: register@mrgarretto.com' . "\r\n" .
'Reply-To: register@mrgarretto.com' . "\r\n" .
'X-Mailer: PHP/' . phpversion();
    return   mail($emailAdress,"Odzyskiwanie hasła Liskowiak","Wysłano żądanie zmiany hasła, w celu zmiany kliknij poniższy link"
    .$link,$headers);
    
}*/
public function sendEmail($emailAdress)
{
   // $link= $_SERVER['HTTP_HOST']."/cms/recovery.php?email=$emailAdress&token=".$this->token;
    $to =$emailAdress;
    $subject = "Technical Support Request";
    $message = "We received a support ticket from mydomain.com:\n\n";
    $from = "calendar@mydomain.com";
    $headers = "From: ";
    return mail($to,$subject,$message,$headers);
}
//public change password
//public validation Token
}
use PHPUnit\Framework\TestCase;
class RecoveryTest extends TestCase{

public function testsendEmail()
{
  $this->assertEquals(Recovery::sendEmail("tymek.janiak@onet.pl"),true);
}


}

?>