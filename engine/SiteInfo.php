<?php
namespace engine;

class SiteInfo
{
    public $flags;

    public function __construct()
    {
        global $config_flags;
        return $this->flags ?? is_object($config_flags) ?? new \StdClass;
    }

    public function getName()
    {
        return trim($this->flags->sitename) ?? '(no name found)';
    }

    public function getVersion()
    {
        return trim($this->flags->siteversion) ?? '(no version found)';
    }

    public function getAuthor()
    {
        return trim($this->flags->siteauthor) ?? '(no author found)';
    }

    public function getLaunchYear()
    {
        return trim($this->flags->launchyear) ?? date('Y');
    }

    public function getCopyright()
    {
        if ($this->getLaunchYear() >= date('Y')) {
            return trim($this->getLaunchYear().' '.$this->getAuthor());
        }

        return trim($this->getLaunchYear().' - '.date('Y').' '.$this->getAuthor());
    }
}
