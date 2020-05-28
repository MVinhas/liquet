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
        return trim($this->flags->sitename);
    }

    public function getVersion()
    {
        return trim($this->flags->siteversion);
    }

    public function getAuthor()
    {
        return trim($this->flags->siteauthor);
    }

    public function getLaunchYear()
    {
        return trim($this->flags->launchyear);
    }

    public function getCopyright()
    {
        if ($this->getLaunchYear() >= date('Y')) {
            $copyright = trim($this->getLaunchYear().' '.$this->getAuthor());
        } else {
            $copyright = trim($this->getLaunchYear().' - '.date('Y').' '.$this->getAuthor());
        }
        return $copyright;
    }
}
