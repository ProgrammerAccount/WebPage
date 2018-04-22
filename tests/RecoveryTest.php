<?php
use PHPUnit\Framework\TestCase;
class RecoveryLogin extends TestCase{
public function test_SendEmail()
{
  $this->assertEquals((new Recovery())->sendEmail("td.janiak@gmail.com"),true);
}

}
?>