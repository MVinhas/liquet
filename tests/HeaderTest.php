<?php

use PHPUnit\Framework\TestCase;

final class HeaderTest extends TestCase
{

    public function testCheckUsers(): void
    {
        $mock = $this->createMock(\models\Header::class);

        $mock->method('checkUsers')->willReturn(true);

        $result = $mock->checkUsers();

        $this->assertTrue($result);
    }

}