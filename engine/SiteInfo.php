<?php
namespace engine;

class SiteInfo
{
    public $flags;

    public function __construct()
    {
        global $config_flags;
        $this->flags = $config_flags;
    }

    public function getName()
    {
        return $this->flags->sitename;
    }

    public function getVersion()
    {
        return $this->flags->siteversion;
    }

    public function getAuthor()
    {
        return $this->flags->siteauthor;
    }

    public function getLaunchYear()
    {
        return $this->flags->launchyear;
    }

    public function getCopyright()
    {
        if ($this->getLaunchYear() >= date('Y')) {
            $copyright = $this->getLaunchYear().' '.$this->getAuthor();
        } else {
            $copyright = $this->getLaunchYear().' - '.date('Y').' '.$this->getAuthor();
        }
        return $copyright;
    }
}
