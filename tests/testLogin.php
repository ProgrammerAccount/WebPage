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


}

?>