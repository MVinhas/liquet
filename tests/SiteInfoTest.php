<?php

use PHPUnit\Framework\TestCase;

class SiteInfoTest extends TestCase
{

    public function testConfigFlagsIsObject()
    {
        $siteInfo = new \engine\SiteInfo;
        $this->assertIsObject($siteInfo->flags);
    }
    public function testReturnsAlwaysASiteName()
    {
        $siteInfo = new \engine\SiteInfo;
        $this->assertNotEquals('', $siteInfo->getName());
    }

    public function testReturnsAlwaysASiteVersion()
    {
        $siteInfo = new \engine\SiteInfo;
        $this->assertNotEquals('', $siteInfo->getVersion());
    }

    public function testReturnsAlwaysASiteAuthor()
    {
        $siteInfo = new \engine\SiteInfo;
        $this->assertNotEquals('', $siteInfo->getAuthor());
    }

    public function testReturnsAlwaysASiteLaunchYear()
    {
        $siteInfo = new \engine\SiteInfo;
        $this->assertNotEquals('', $siteInfo->getLaunchYear());
    }

    public function testCopyrightNotEmpty()
    {
        $siteInfo = new \engine\SiteInfo;
        $this->assertNotEquals('', $siteInfo->getCopyright());
        $this->assertNotEquals('-', $siteInfo->getCopyright());
    }

}