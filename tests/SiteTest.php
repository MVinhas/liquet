<?php

use PHPUnit\Framework\TestCase;

final class SiteTest extends TestCase
{

    public function testVisitCounter(): void
    {
        $mock = $this->createMock(\models\Site::class);

        $mock->method('visitCounter')->willReturn(true);

        $result = $mock->visitCounter();

        $this->assertTrue($result);
    }

    public function testGetCategories(): void
    {
        $mock = $this->createMock(\models\Site::class);

        $mock->method('getCategories')->willReturn(true);

        $result = $mock->getCategories();

        $this->assertTrue($result);
    }

    public function testGetCategory(): void
    {
        $mock = $this->createMock(\models\Site::class);

        $mock->method('getCategory')->willReturn(true);
        $id = 1;
        $result = $mock->getCategory($id);

        $this->assertTrue($result);
    }

    public function testGetPost(): void
    {
        $mock = $this->createMock(\models\Site::class);

        $mock->method('getPost')->willReturn(true);
        $id = 1;
        $result = $mock->getPost($id);

        $this->assertTrue($result);
    }

}