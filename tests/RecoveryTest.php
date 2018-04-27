<?php
use PHPUnit\Framework\TestCase;
class RecoveryLogin extends TestCase{
  public function getPdoMock($fetchArray)
  {
      $pdoSTMT = $this->createMock('PDOStatement');
      $pdoSTMT->expects($this->at(0))->method('fetch')->will($this->returnValue($fetchArray));
      $pdoSTMT->expects($this->at(1))->method('fetch')->willReturn(false);
      $pdoSTMT->expects($this->any())->method('execute')->willReturn(true);
      $pdoSTMT->expects($this->any())->method('rowCount')->willReturn(0);
      
      $pdo=$this->createMock('PDO');
      $pdo->expects($this->any())->method('query')->will($this->returnValue($pdoSTMT));
      $pdo->expects($this->any())->method('prepare')->will($this->returnValue($pdoSTMT));
      
      return $pdo;
  }
public function test_SendEmail()
{
  $this->assertEquals((new Recovery(""))->sendEmail("td.janiak@gmail.com"),true);
}

public function test_AddTokenToDB()
{

  $recovery = new Recovery($this->getPdoMock(""));
  $this->assertEquals($recovery->AddTokenToDB("token"),true);
}
public function test_changePassword()
{
  $recovery = new Recovery($this->getPdoMock(""));
  $this->assertEquals($recovery->changePassword("email","pass"),true);
}
public function test_updateToken()
{
  $recovery = new Recovery($this->getPdoMock(""));
  $this->assertEquals($recovery->updateToken("token"),true);
}
public function test_validationToken()
{

  $PDO_STMT= $this->createMock('PDOStatement');
  $PDO_STMT->expects($this->any())->method('execute')->willReturn('true');
  $PDO_STMT->expects($this->any())->method('rowCount')->willReturn(1);
  $PDO=$this->createMock('PDO');
  $PDO->expects($this->any())->method('prepare')->will($this->returnValue($PDO_STMT));
  $recovery= new Recovery($PDO);
  $this->assertEquals($recovery->validationToken("email","pass"),true);
}
}
?>