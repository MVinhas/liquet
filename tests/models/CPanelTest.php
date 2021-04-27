<?php

use PHPUnit\Framework\TestCase;

final class CPanelTest extends TestCase
{

    public function testGetArticles(): void
    {
        $mock = $this->createMock(\models\CPanel::class);

        $mock->method('getArticles')->willReturn(true);

        $result = $mock->getArticles();

        $this->assertTrue($result);
    }

    public function testCreateArticle(): void
    {
        $mock = $this->createMock(\models\CPanel::class);

        $mock->method('createArticle')->willReturn(true);
        $array = ['1', '2'];
        $result = $mock->createArticle($array);

        $this->assertTrue($result);        
    }

    public function testEditArticle(): void
    {
        $mock = $this->createMock(\models\CPanel::class);

        $mock->method('editArticle')->willReturn(true);
        $array = ['1', '2'];
        $id = 1;
        $result = $mock->editArticle($id, $array);

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

    public function testEditConfig(): void
    {
        $mock = $this->createMock(\models\CPanel::class);

        $mock->method('editConfig')->willReturn(true);
        $array = ['1', '2'];
        $result = $mock->editConfig($array);

        $this->assertTrue($result);        
    }

    public function testDeleteArticle(): void
    {
        $mock = $this->createMock(\models\CPanel::class);

        $mock->method('deleteArticle')->willReturn(true);
        $id = 1;

        $result = $mock->deleteArticle($id);

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