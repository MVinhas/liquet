<?php

use PHPUnit\Framework\TestCase;

final class ControllerTest extends TestCase
{

    public function testFilePathHasCorrectFormat()
    {
        $controller = new \controllers\Controller;
        $this->assertEquals(
            'teste/teste.php',
            $controller->getFile('teste', 'teste.php')
        );
        return $controller;
    }

    /**
     * @depends testFilePathHasCorrectFormat
     */
    public function testDirectoryExists(\controllers\Controller $controller): void
    {
        $this->assertDirectoryExists('views/cpanel');
        $this->assertEquals('cpanel', $controller->getDirectory('CPanelController'));
    }
}
