<?php

use PHPUnit\Framework\TestCase;

class SiteInfoTest extends TestCase
{

    protected $siteInfo;

    protected function setUp(): void
    {
        $this->siteInfo = new \engine\SiteInfo;
    }
    
    public function testConfigFlagsIsObject(): void
    {
        $this->assertIsObject($this->siteInfo->flags);
    }

    public function testReturnsAlwaysASiteName(): void
    {
        $this->assertNotEquals('', $this->siteInfo->getName());
    }

    public function testReturnsAlwaysASiteVersion(): void
    {
        $this->assertNotEquals('', $this->siteInfo->getVersion());
    }

    public function testReturnsAlwaysASiteAuthor(): void
    {
        $this->assertNotEquals('', $this->siteInfo->getAuthor());
    }

    public function testReturnsAlwaysASiteLaunchYear(): void
    {
        $this->assertNotEquals('', $this->siteInfo->getLaunchYear());
    }

    public function testCopyrightNotEmpty(): void
    {
        $this->assertNotEquals('', $this->siteInfo->getCopyright());
        $this->assertNotEquals('-', $this->siteInfo->getCopyright());
    }

}