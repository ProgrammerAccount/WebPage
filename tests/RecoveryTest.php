<?php

use PHPUnit\Framework\TestCase;

class RecoveryTest extends TestCase{

public function testvalidation_email()
{
  $this->assertEquals(Recovery::sendEmail("td.janiak@gmail.com"),true);
}


}

?>