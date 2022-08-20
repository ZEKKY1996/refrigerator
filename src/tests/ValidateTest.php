<?php

use PHPUnit\Framework\TestCase;

class ValidateTest extends TestCase
{
    public function testValidate()
    {
        require_once(__DIR__ . '/../class/Validate.php');
        $this->assertSame(validateUserInfo());
    }
}
