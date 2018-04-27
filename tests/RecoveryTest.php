<?php
use PHPUnit\Framework\TestCase;
class RecoveryLogin extends TestCase{
public function test_SendEmail()
{
  $this->assertEquals((new Recovery())->sendEmail("td.janiak@gmail.com"),true);
}

public function test_AddTokenToDB()
{
  $recovery= new Recovery();
  $pdoSTMT = $this->createMock('PDOStatement');
  $pdoSTMT->expects($this->any())->method('execute')->willReturn(true);
  $pdo=$this->createMock('PDO');
  $pdo->expects($this->any())->method('prepare')->will($this->returnValue($pdoSTMT));
  $recovery =  new Recovery();
  $recovery->setDB($pdo);
  $this->assertEquals($recovery->AddTokenToDB("token"),true);
}
public function test_changePassword()
{
  $recovery= new Recovery();
  $pdoSTMT = $this->createMock('PDOStatement');
  $pdoSTMT->expects($this->any())->method('execute')->willReturn(true);
  $pdo=$this->createMock('PDO');
  $pdo->expects($this->any())->method('prepare')->will($this->returnValue($pdoSTMT));
  $recovery =  new Recovery();
  $recovery->setDB($pdo);
  $this->assertEquals($recovery->changePassword("email","pass"),true);
}
public function test_updateToken()
{
  $recovery= new Recovery();
  $pdoSTMT = $this->createMock('PDOStatement');
  $pdoSTMT->expects($this->any())->method('execute')->willReturn(true);
  $pdo=$this->createMock('PDO');
  $pdo->expects($this->any())->method('prepare')->will($this->returnValue($pdoSTMT));
  $recovery =  new Recovery();
  $recovery->setDB($pdo);
  $this->assertEquals($recovery->updateToken("token"),true);
}
public function test_validationToken()
{
  $recovery= new Recovery();
  $PDO_STMT= $this->createMock('PDOStatement');
  $PDO_STMT->expects($this->any())->method('execute')->willReturn('true');
  $PDO_STMT->expects($this->any())->method('rowCount')->willReturn(1);
  $PDO=$this->createMock('PDO');
  $PDO->expects($this->any())->method('prepare')->will($this->returnValue($PDO_STMT));
  $recovery->setDB($PDO);
  $this->assertEquals($recovery->validationToken("email","pass"),true);
}
}
?>