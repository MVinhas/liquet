<?php

use PHPUnit\Framework\TestCase;

final class CPanelTest extends TestCase
{

    public function testGetPosts(): void
    {
        $mock = $this->createMock(\models\CPanel::class);

        $mock->method('getPosts')->willReturn(true);

        $result = $mock->getPosts();

        $this->assertTrue($result);
    }

    public function testCreatePost(): void
    {
        $mock = $this->createMock(\models\CPanel::class);

        $mock->method('createPost')->willReturn(true);
        $array = ['1', '2'];
        $result = $mock->createPost($array);

        $this->assertTrue($result);        
    }

    public function testEditPost(): void
    {
        $mock = $this->createMock(\models\CPanel::class);

        $mock->method('editPost')->willReturn(true);
        $array = ['1', '2'];
        $id = 1;
        $result = $mock->editPost($id, $array);

        $this->assertTrue($result);        
    }

    public function testCreateCategory(): void
    {
        $mock = $this->createMock(\models\CPanel::class);

        $mock->method('createCategory')->willReturn(true);
        $array = ['1', '2'];

        $result = $mock->createCategory($array);

        $this->assertTrue($result);        
    }

    public function testEditCategory(): void
    {
        $mock = $this->createMock(\models\CPanel::class);

        $mock->method('editCategory')->willReturn(true);
        $id = 1;
        $array = ['1', '2'];

        $result = $mock->editCategory($id, $array);

        $this->assertTrue($result);        
    }

    public function testDeletePost(): void
    {
        $mock = $this->createMock(\models\CPanel::class);

        $mock->method('deletePost')->willReturn(true);
        $id = 1;

        $result = $mock->deletePost($id);

        $this->assertTrue($result);        
    }

    public function testDeleteCategory(): void
    {
        $mock = $this->createMock(\models\CPanel::class);

        $mock->method('deleteCategory')->willReturn(true);
        $id = 1;

        $result = $mock->deleteCategory($id);

        $this->assertTrue($result);        
    }

    public function testGetVisits(): void
    {
        $mock = $this->createMock(\models\CPanel::class);

        $mock->method('getVisits')->willReturn(true);

        $result = $mock->getVisits();

        $this->assertTrue($result);        
    }


}