<?php
require "/var/www/html/liskowiak/tests/HTML5Validate.php";
use PHPUnit\Framework\TestCase;
class testNews extends TestCase
{
    public function test_getContacts_html5Validation()
    {
        $pdoSTMT = $this->createMock('PDOStatement');
        $pdoSTMT->expects($this->at(0))->method('fetch')->will($this->returnValue(array("name"=>"name","phoneNumber"=>"phoneNumber","email"=>"email")));
        $pdoSTMT->expects($this->any(1))->method('fetch')->willReturn(false);

        $pdo=$this->createMock('PDO');
        $pdo->expects($this->any())->method('query')->will($this->returnValue($pdoSTMT));

        $news=new Contact();
        $news->setDB($pdo);

        $validator=new HTML5Validate();
        $result=$validator->Assert($news->getContacts());
        $this->assertTrue($result, true);
    }

    public function test_getContactsCMS_html5Validation()
    {
        $pdoSTMT = $this->createMock('PDOStatement');
        $pdoSTMT->expects($this->at(0))->method('fetch')->will($this->returnValue(array("id"=>"6","name"=>"name","phoneNumber"=>"phoneNumber","email"=>"email")));
        $pdoSTMT->expects($this->any(1))->method('fetch')->willReturn(false);

        $pdo=$this->createMock('PDO');
        $pdo->expects($this->any())->method('query')->will($this->returnValue($pdoSTMT));

        $news=new Contact();
        $news->setDB($pdo);

        $validator=new HTML5Validate();
        $result=$validator->Assert($news->getContactsCMS());
        print $validator->message;
        $this->assertTrue($result, true);
    }
    //public function test_removeImg()
   // {
       // $this->assertTrue(News::removeImg("Screenshotfrom2018-03-2915-09-17.png","../img/"));
    //}

    public function test_addContact(){
    //$recovery= new Recovery();
    $pdoSTMT = $this->createMock('PDOStatement');
    $pdoSTMT->expects($this->any())->method('execute')->willReturn(true);
    $pdo=$this->createMock('PDO');
    $pdo->expects($this->any())->method('prepare')->will($this->returnValue($pdoSTMT));
    $recovery =  new Contact();
    $recovery->setDB($pdo);
    $this->assertEquals($recovery->addContact("name","123123123","email.email@eleil.com"),true);
    }
    public function test_removeContact(){
        //$recovery= new Recovery();
        $pdoSTMT = $this->createMock('PDOStatement');
        $pdoSTMT->expects($this->any())->method('execute')->willReturn(true);
        $pdo=$this->createMock('PDO');
        $pdo->expects($this->any())->method('prepare')->will($this->returnValue($pdoSTMT));
        $recovery =  new Contact();
        $recovery->setDB($pdo);
        $this->assertEquals($recovery->removeContact("1","name","123123123","email.email@eleil.com"),true);
        }
        public function test_editContact(){
            //$recovery= new Recovery();
            $pdoSTMT = $this->createMock('PDOStatement');
            $pdoSTMT->expects($this->any())->method('execute')->willReturn(true);
            $pdo=$this->createMock('PDO');
            $pdo->expects($this->any())->method('prepare')->will($this->returnValue($pdoSTMT));
            $recovery =  new Contact();
            $recovery->setDB($pdo);
            $this->assertEquals($recovery->editContact("1","name","123123123","email.email@eleil.com"),true);
            }
   /* public function test_addImg()
    {
        $_FILES = array(
            'test' => array(
                'name' => 'test.jpg',
                'type' => 'image/jpeg',
                'size' => 542,
                'tmp_name' => __DIR__ . '/source-test.jpg',
                'error' => 0
            )
        );
        echo __DIR__ . '/source-test.jpg';
        $src= "/var/www/html/liskowiak/src/img";
       // $this->assertEquals(gettype(News::addImg($_FILES['test'],$src)),gettype("asd"));
       $this->assertEquals((News::addImg($_FILES['test'],$src)),true);
    }*/
}
?>