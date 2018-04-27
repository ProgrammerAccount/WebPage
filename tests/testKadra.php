<?php
require "/var/www/html/liskowiak/tests/HTML5Validate.php";
use PHPUnit\Framework\TestCase;
class testKadra extends TestCase
{
    public function getPdoMock($fetchArray)
    {
        $pdoSTMT = $this->createMock('PDOStatement');
        $pdoSTMT->expects($this->at(0))->method('fetch')->will($this->returnValue($fetchArray));
        $pdoSTMT->expects($this->at(1))->method('fetch')->willReturn(false);
        $pdoSTMT->expects($this->any())->method('execute')->willReturn(true);
        $pdoSTMT->expects($this->any())->method('rowCount')->willReturn(0);

        $pdo = $this->createMock('PDO');
        $pdo->expects($this->any())->method('query')->will($this->returnValue($pdoSTMT));
        $pdo->expects($this->any())->method('prepare')->will($this->returnValue($pdoSTMT));

        return $pdo;
    }
public function test_getSquadAsTable_htmlValidation(){

$kadra = new Kadra("aa",$this->getPdoMock(array("name"=>"name","role"=>"role")));
$validation = new HTML5Validate();
$result= $validation->Assert($kadra->getSquadAsTable());
print $validation->message;

$this->assertEquals($result,true);

}
public function test_getSquadOfPentaqueAsTable_htmlValidation(){
    $kadra = new Kadra("aa",$this->getPdoMock(array("name"=>"name","role"=>"role")));
    $validation = new HTML5Validate();
    $result= $validation->Assert($kadra->getSquadOfPentaqueAsTable());
    print $validation->message;

    $this->assertEquals($result,true);
    
    }
    public function test_getSquadCMS_htmlValidation(){
        $kadra = new Kadra("aa",$this->getPdoMock(array("id"=>"6","name"=>"name","role"=>"role")));

        $validation = new HTML5Validate();
        
        $result= $validation->Assert($kadra->getSquadCMS());
        print $validation->message;
        $this->assertEquals($result,true);
        
        }

        public function test_getSquadOfPetanqueCMS_htmlValidation(){
            
            $kadra = new Kadra("aa",$this->getPdoMock(array("id"=>"6","name"=>"name","role"=>"role")));

            $validation = new HTML5Validate();
            
            $result= $validation->Assert($kadra->getSquadOfPetanqueCMS());
            print $validation->message;
            $this->assertEquals($result,true);
            
            }
            public function test_addPlayer()
            {   $kadra = new Kadra("aa",$this->getPdoMock(array("id"=>"6","name"=>"name","role"=>"role")));
                $this->assertEquals($kadra->addPlayer("aa","aa"),true);
            }
            public function test_removePlayer()
            {
                $kadra = new Kadra("aa",$this->getPdoMock(array("id"=>"6","name"=>"name","role"=>"role")));

                $this->assertEquals($kadra->addPlayer('2',"aa","aa"),true);
            }
            public function test_editPlayer()
            {

                $kadra = new Kadra("aa",$this->getPdoMock(array("id"=>"6","name"=>"name","role"=>"role")));


                $this->assertEquals($kadra->addPlayer('3',"aa","aa"),true);
            }
    


}