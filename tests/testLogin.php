<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class RecoveryTest extends TestCase
{
    public function testCanBeCreatedFromValidEmailAddress(): void
    {
      $this->assertEquals(Recovery::sendEmail("td.janiak@gmail.com"),true);
    }

   
}





