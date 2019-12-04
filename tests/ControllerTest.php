<?php
use PHPUnit\Framework\TestCase;

final class ControllerTest extends TestCase
{
    public function testFilePathHasCorrectFormat(): void
    {
        $this->assertEquals(
            'teste/teste.php',
            \controllers\Controller::getFile('teste','teste.php')
        );
    }
}