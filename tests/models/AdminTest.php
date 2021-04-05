<?php

use PHPUnit\Framework\TestCase;

final class AdminTest extends TestCase
{

    public function testGetUser(): void
    {
        $mock = $this->createMock(\models\Admin::class);

        $mock->method('getUser')->willReturn(true);

        $result = $mock->getUser('admin', '1234');

        $this->assertTrue($result);
    }

}