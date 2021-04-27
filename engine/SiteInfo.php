<?php
namespace engine;

class SiteInfo
{
    public $flags;

    public function __construct()
    {
        global $config_flags;
        return $this->flags ?? new \StdClass;
    }

    public function getName()
    {
        return $this->flags() ?? trim($this->flags->sitename) ?? '(no name found)';
    }

    public function getVersion()
    {
        return $this->flags() ?? trim($this->flags->siteversion) ?? '(no version found)';
    }

    public function getAuthor()
    {
        return $this->flags() ?? trim($this->flags->siteauthor) ?? '(no author found)';
    }

    public function getLaunchYear()
    {
        return $this->flags() ?? trim($this->flags->launchyear) ?? date('Y');
    }

    public function getCopyright()
    {
        if ($this->getLaunchYear() >= date('Y')) {
            return $this->flags() ?? trim($this->getLaunchYear().' '.$this->getAuthor());
        }

        return $this->flags() ?? trim($this->getLaunchYear().' - '.date('Y').' '.$this->getAuthor());
    }
}
