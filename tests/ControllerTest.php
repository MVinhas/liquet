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
}
