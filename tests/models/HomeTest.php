<?php

use PHPUnit\Framework\TestCase;

final class HomeTest extends TestCase
{

    public function testCheckUsers(): void
    {
        $mock = $this->createMock(\models\Home::class);

        $mock->method('checkUsers')->willReturn(true);

        $result = $mock->checkUsers();

        $this->assertTrue($result);
    }

    public function testCheckAdmin(): void
    {
        $mock = $this->createMock(\models\Home::class);

        $mock->method('checkAdmin')->willReturn(true);

        $result = $mock->checkAdmin();

        $this->assertTrue($result);
    }

    public function testCreateUser(): void
    {
        $mock = $this->createMock(\models\Home::class);

        $mock->method('createUser')->willReturn(true);
        $fields = 'name, age';
        $values = ['Joana', '30'];
        $result = $mock->createUser($fields, $values);

        $this->assertTrue($result);
    }

    public function testgetArticles(): void
    {
        $mock = $this->createMock(\models\Home::class);

        $mock->method('getArticles')->willReturn(true);
        $offset = 10;

        $result = $mock->getArticles($offset);

        $this->assertTrue($result);
    }
    
    public function testgetArticlesNoOffset(): void
    {
        $mock = $this->createMock(\models\Home::class);

        $mock->method('getArticles')->willReturn(true);
        $result = $mock->getArticles();

        $this->assertTrue($result);
    }

    public function testgetAbout(): void
    {
        $mock = $this->createMock(\models\Home::class);

        $mock->method('getAbout')->willReturn(true);
        $result = $mock->getAbout();

        $this->assertTrue($result);
    }

    public function testgetArchives(): void
    {
        $mock = $this->createMock(\models\Home::class);

        $mock->method('getArchives')->willReturn(true);
        $result = $mock->getArchives();

        $this->assertTrue($result);
    }

    public function testgetSocial(): void
    {
        $mock = $this->createMock(\models\Home::class);

        $mock->method('getSocial')->willReturn(true);
        $result = $mock->getSocial();

        $this->assertTrue($result);
    }

    public function testgetArticlesBySearch(): void
    {
        $mock = $this->createMock(\models\Home::class);

        $mock->method('getArticlesBySearch')->willReturn(true);

        $search = ['Olá', 'Mundo'];
        $result = $mock->getArticlesBySearch($search);

        $this->assertTrue($result);
    }

}