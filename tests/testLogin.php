<?php
use PHPUnit\Framework\TestCase;
class TestLogin extends TestCase{
public function testvalidation_email()
{
  $this->assertEquals(Login::validation_email("example.of@email.com"),true);
}
public function testInvalidvalidation_email()
{
  $this->assertEquals(Login::validation_email("InvalidEmail"),false);
}

public function testComparePassword()
{
  $this->assertEquals(Login::comparePassword("$2y$10$/MWmBegsCI6Sln2Q1FwzdeMch28KsDtreTtg2X.1luB5CjYxW8DcK","admin"),false);
}
public function testaddUsers()
{
  $pdoSTMT = $this->createMock('PDOStatement');
  $pdoSTMT->expects($this->any())->method('fetch')->willReturn(false);
  $pdoSTMT->expects($this->any())->method('rowCount')->willReturn(0);
  $pdoSTMT->expects($this->any())->method('execute')->willReturn(true);
  $pdo=$this->createMock('PDO');
  $pdo->expects($this->any())->method('prepare')->will($this->returnValue($pdoSTMT));
  $login =  new Login();
  $login->setDB($pdo);
  $this->assertEquals($login->addUser("hfg","admin"),true);
}
public function testGetUsers()
{
  $pdoSTMT = $this->createMock('PDOStatement');
  $pdoSTMT->expects($this->any())->method('fetch')->willReturn(true);
  $pdo=$this->createMock('PDO');
  $pdo->expects($this->any())->method('prepare')->willReturn($pdoSTMT);
  $login =  new Login();
  $login->setDB($pdo);
  $this->assertEquals($login->getUser("admin"),true);
}


}
?>