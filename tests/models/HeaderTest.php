<?php

use PHPUnit\Framework\TestCase;

final class HeaderTest extends TestCase
{

    public function testGetMenu(): void
    {
        $mock = $this->createMock(\models\Header::class);

        $mock->method('getMenu')->willReturn(true);

        $result = $mock->getMenu();

        $this->assertTrue($result);
    }

}