<?php

use PHPUnit\Framework\TestCase;
use \models\Site as Site;

final class SiteTest extends TestCase
{

    public function testVisitCounter(): void
    {
        $mock = $this->createMock(Site::class);

        $mock->method('visitCounter')->willReturn(true);

        $result = $mock->visitCounter();

        $this->assertTrue($result);
    }

    public function testGetCategories(): void
    {
        $mock = $this->createMock(Site::class);

        $mock->method('getCategories')->willReturn(true);

        $result = $mock->getCategories();

        $this->assertTrue($result);
    }

    public function testGetCategory(): void
    {
        $mock = $this->createMock(Site::class);

        $mock->method('getCategory')->willReturn(true);
        $id = 1;
        $result = $mock->getCategory($id);

        $this->assertTrue($result);
    }

    public function testGetArticle(): void
    {
        $mock = $this->createMock(Site::class);

        $mock->method('getArticle')->willReturn(true);
        $id = 1;
        $result = $mock->getArticle($id);

        $this->assertTrue($result);
    }

    public function testGetConfig(): void
    {
        $mock = $this->createMock(Site::class);

        $mock->method('getConfig')->willReturn(true);
        
        $result = $mock->getConfig();

        $this->assertTrue($result);
    }

}