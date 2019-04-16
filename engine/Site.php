<?php
namespace engine;

class Site
{
    public function getName()
    {
        global $sitename;
        return $sitename;
    }

    public function getVersion()
    {
        global $siteversion;
        return $siteversion;
    }

    public function getAuthor()
    {
        global $siteauthor;
        return $siteauthor;
    }

    public function getLaunchYear()
    {
        global $launchyear;
        return $launchyear;
    }
}