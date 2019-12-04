<?php
use PHPUnit\Framework\TestCase;

final class EmailTest extends TestCase
{
    public function filePathHasCorrectFormat(): void
    {
        $this->assertEquals(
            'teste/teste.php',
            Controller::getFile('teste','teste.php')
        );
    }
}