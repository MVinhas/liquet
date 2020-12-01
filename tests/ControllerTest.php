<?php

use PHPUnit\Framework\TestCase;

final class ControllerTest extends TestCase
{

    protected $controller;
    
    protected function setUp(): void
    {
        $this->controller = new controllers\Controller;
    }
    
    public function testFilePathHasCorrectFormat(): void
    {

        $this->assertEquals(
            'teste/teste.php',
            $this->controller->getFile('teste', 'teste.php')
        );
    }

    public function testDirectoryExists(): void
    {
        $this->assertDirectoryExists('views/cpanel');
        $this->assertEquals('cpanel', $this->controller->getDirectory('CPanelController'));
    }
}
