<?php

use PHPUnit\Framework\TestCase;

class TestLogin extends TestCase{

public function testvalidation_email()
{
  $this->assertEquals(Recovery::sendEmail("td.janiak@gmail.com"),true);
}
public function testInvalidvalidation_email()
{
  $this->assertEquals(Login::validation_email("InvalidEmail"),false);
}


}

?>