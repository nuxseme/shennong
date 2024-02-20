<?php


namespace application\handle;


use domain\value\setting\DefaultSetting;

class DefaultHandle
{
    private $value;
    private DefaultSetting $defaultSetting;
    public function __construct($value,$defaultSetting)
    {
    }
}