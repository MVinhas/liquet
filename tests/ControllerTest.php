<?php

use PHPUnit\Framework\TestCase;

final class ControllerTest extends TestCase
{

    public function testFilePathHasCorrectFormat(): void
    {
        $controller = new \controllers\Controller;
        $this->assertEquals(
            'teste/teste.php',
            $controller->getFile('teste', 'teste.php')
        );
    }

    public function testDirectoryExists(): void
    {
        $controller = new \controllers\Controller;
        $this->assertDirectoryExists('views/cpanel');
        $this->assertEquals('cpanel', $controller->getDirectory('CPanelController'));
    }
}
