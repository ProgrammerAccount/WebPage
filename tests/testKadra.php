<?php
require "/var/www/html/liskowiak/tests/HTML5Validate.php";
use PHPUnit\Framework\TestCase;
class testKadra extends TestCase
{
public function test_getSquadAsTable_htmlValidation(){
$PDOSTMT= $this->createMock('PDOStatement');
$PDOSTMT->expects($this->at(0))->method("fetch")->will($this->returnValue(array("name"=>"name","role"=>"role")));
$PDOSTMT->expects($this->at(1))->method("fetch")->will($this->returnValue(false));
$PDO=$this->createMock("PDO");
$PDO->expects($this->any())->method("query")->will($this->returnValue($PDOSTMT));
$kadra = new Kadra("aa",$PDO);
$validation = new HTML5Validate();
$result= $validation->Assert($kadra->getSquadAsTable());
print $validation->message;

$this->assertEquals($result,true);

}
public function test_getSquadOfPentaqueAsTable_htmlValidation(){
    $PDOSTMT= $this->createMock('PDOStatement');
    $PDOSTMT->expects($this->at(0))->method("fetch")->will($this->returnValue(array("name"=>"name","role"=>"role")));
    $PDOSTMT->expects($this->at(1))->method("fetch")->will($this->returnValue(false));
    $PDO=$this->createMock("PDO");
    $PDO->expects($this->any())->method("query")->will($this->returnValue($PDOSTMT));
    $kadra = new Kadra("aa",$PDO);
    $validation = new HTML5Validate();
    $result= $validation->Assert($kadra->getSquadOfPentaqueAsTable());
    print $validation->message;

    $this->assertEquals($result,true);
    
    }
    public function test_getSquadCMS_htmlValidation(){
        $PDOSTMT= $this->createMock('PDOStatement');
        $PDOSTMT->expects($this->at(0))->method("fetch")->will($this->returnValue(array("id"=>"6","name"=>"name","role"=>"role")));
        $PDOSTMT->expects($this->at(1))->method("fetch")->will($this->returnValue(false));
        $PDO=$this->createMock("PDO");
        $PDO->expects($this->any())->method("query")->will($this->returnValue($PDOSTMT));
        $kadra = new Kadra("aa",$PDO);
        $validation = new HTML5Validate();
        
        $result= $validation->Assert($kadra->getSquadCMS());
        print $validation->message;
        $this->assertEquals($result,true);
        
        }

        public function test_getSquadOfPetanqueCMS_htmlValidation(){
            $PDOSTMT= $this->createMock('PDOStatement');
            $PDOSTMT->expects($this->at(0))->method("fetch")->will($this->returnValue(array("id"=>"6","name"=>"name","role"=>"role")));
            $PDOSTMT->expects($this->at(1))->method("fetch")->will($this->returnValue(false));
            $PDO=$this->createMock("PDO");
            $PDO->expects($this->any())->method("query")->will($this->returnValue($PDOSTMT));
            $kadra = new Kadra("aa",$PDO);
            $validation = new HTML5Validate();
            
            $result= $validation->Assert($kadra->getSquadOfPetanqueCMS());
            print $validation->message;
            $this->assertEquals($result,true);
            
            }
            public function test_addPlayer()
            {
                $PDOSTMT = $this->createMock('PDOStatement');
                $PDOSTMT->expects($this->any())->method('execute')->willReturn(true);
                $PDO = $this->createMock('PDO');
                $PDO->expects($this->any())->method('prepare')->will($this->returnValue($PDOSTMT));
                $kadra = new Kadra("aa",$PDO);
                $this->assertEquals($kadra->addPlayer("aa","aa"),true);
            }
            public function test_removePlayer()
            {
                $PDOSTMT = $this->createMock('PDOStatement');
                $PDOSTMT->expects($this->any())->method('execute')->willReturn(true);
                $PDO = $this->createMock('PDO');
                $PDO->expects($this->any())->method('prepare')->will($this->returnValue($PDOSTMT));
                $kadra = new Kadra("aa",$PDO);
                $this->assertEquals($kadra->addPlayer('2',"aa","aa"),true);
            }
            public function test_editPlayer()
            {
                $PDOSTMT = $this->createMock('PDOStatement');
                $PDOSTMT->expects($this->any())->method('execute')->willReturn(true);
                $PDO = $this->createMock('PDO');
                $PDO->expects($this->any())->method('prepare')->will($this->returnValue($PDOSTMT));
                $kadra =new Kadra('aa',$PDO);
                $this->assertEquals($kadra->addPlayer('3',"aa","aa"),true);
            }
    


}