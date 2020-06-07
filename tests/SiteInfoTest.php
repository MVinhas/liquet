<?php

use PHPUnit\Framework\TestCase;

class SiteInfoTest extends TestCase
{

    public function testConfigFlagsIsObject()
    {
        $siteInfo = new \engine\SiteInfo;
        $this->assertIsObject($siteInfo->flags);
        return $siteInfo;
    }

    /**
     * @depends testConfigFlagsIsObject
     */
    public function testReturnsAlwaysASiteName(\engine\SiteInfo $siteInfo): void
    {
        $this->assertNotEquals('', $siteInfo->getName());
    }

    /**
     * @depends testConfigFlagsIsObject
     */
    public function testReturnsAlwaysASiteVersion(\engine\SiteInfo $siteInfo): void
    {
        $this->assertNotEquals('', $siteInfo->getVersion());
    }

    /**
     * @depends testConfigFlagsIsObject
     */
    public function testReturnsAlwaysASiteAuthor(\engine\SiteInfo $siteInfo): void
    {
        $this->assertNotEquals('', $siteInfo->getAuthor());
    }

    /**
     * @depends testConfigFlagsIsObject
     */
    public function testReturnsAlwaysASiteLaunchYear(\engine\SiteInfo $siteInfo): void
    {
        $this->assertNotEquals('', $siteInfo->getLaunchYear());
    }

    /**
     * @depends testConfigFlagsIsObject
     */
    public function testCopyrightNotEmpty(\engine\SiteInfo $siteInfo): void
    {
        $this->assertNotEquals('', $siteInfo->getCopyright());
        $this->assertNotEquals('-', $siteInfo->getCopyright());
    }

}