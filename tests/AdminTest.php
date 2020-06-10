<?php

use PHPUnit\Framework\TestCase;

final class AdminTest extends TestCase
{

    protected $admin;

    protected function setUp(): void
    {
        $this->admin = new \controllers\AdminController;
    }

}