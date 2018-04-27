<?php
require "/var/www/html/liskowiak/tests/HTML5Validate.php";
use PHPUnit\Framework\TestCase;

class testcontact extends TestCase
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
    public function test_getContacts_html5Validation()
    {
        $contact = new Contact($this->getPdoMock(array("name" => "name", "phoneNumber" => "phoneNumber", "email" => "email")));

        $validator = new HTML5Validate();
        $result = $validator->Assert($contact->getContacts());
        $this->assertTrue($result, true);
    }

    public function test_getContactsCMS_html5Validation()
    {
        $contact = new Contact($this->getPdoMock(array("id"=>"id","name" => "name", "phoneNumber" => "phoneNumber", "email" => "email")));

        $validator = new HTML5Validate();
        $result = $validator->Assert($contact->getContactsCMS());
        print $validator->message;
        $this->assertTrue($result, true);
    }
    //public function test_removeImg()
    // {
    // $this->assertTrue(contact::removeImg("Screenshotfrom2018-03-2915-09-17.png","../img/"));
    //}

    public function test_addContact()
    {
        $contact = new Contact($this->getPdoMock(array()));
        $this->assertEquals($contact->addContact("name", "123123123", "email.email@eleil.com"), true);
    }
    public function test_removeContact()
    {
        $contact=new Contact($this->getPdoMock(array()));
        $this->assertEquals($contact->removeContact("1", "name", "123123123", "email.email@eleil.com"), true);
    }
    public function test_editContact()
    {
        $contact=new Contact($this->getPdoMock(array()));
        $this->assertEquals($contact->editContact("1", "name", "123123123", "email.email@eleil.com"), true);
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
// $this->assertEquals(gettype(contact::addImg($_FILES['test'],$src)),gettype("asd"));
$this->assertEquals((contact::addImg($_FILES['test'],$src)),true);
}*/
}
