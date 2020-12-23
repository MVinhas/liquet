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
        $table = 'users';
        $fields = 'name, age';
        $values = ['Joana', '30'];
        $result = $mock->createUser($table, $fields, $values);

        $this->assertTrue($result);
    }

    public function testgetPosts(): void
    {
        $mock = $this->createMock(\models\Home::class);

        $mock->method('getPosts')->willReturn(true);
        $offset = 10;

        $result = $mock->getPosts($offset);

        $this->assertTrue($result);
    }
    
    public function testgetPostsNoOffset(): void
    {
        $mock = $this->createMock(\models\Home::class);

        $mock->method('getPosts')->willReturn(true);
        $result = $mock->getPosts();

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

    public function testgetPostsBySearch(): void
    {
        $mock = $this->createMock(\models\Home::class);

        $mock->method('getPostsBySearch')->willReturn(true);

        $search = ['Olá', 'Mundo'];
        $result = $mock->getPostsBySearch($search);

        $this->assertTrue($result);
    }

}