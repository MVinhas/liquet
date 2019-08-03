<?php
namespace engine;

class Site
{
    protected $flags;

    public function __construct()
    {
        global $config_flags;
        $this->flags = $config_flags;
    }

    public function getName()
    {
        return $this->flags['sitename'];
    }

    public function getVersion()
    {
        return $this->flags['siteversion'];
    }

    public function getAuthor()
    {
        return $this->flags['siteauthor'];
    }

    public function getLaunchYear()
    {
        return $this->flags['launchyear'];
    }
}