<?php
namespace application\handle;

use domain\value\setting\MaskSetting;

class MaskHandle
{
    private $value;
    private MaskSetting $maskSetting;
    public function __construct(MaskSetting $maskSetting,$value = null)
    {
        $this->maskSetting = $maskSetting;
        $this->value = $value;
    }

    public function process()
    {
        $len = strlen($this->value);

        if($len<=3)
            return $this->value;

        $value = (string)$this->value;
        $codeLen = ceil($len/2);
        $start = ceil($codeLen/2);
        $codeStr = str_repeat($this->maskSetting->getEncryptCode(),$codeLen);

        return substr_replace($value,$codeStr,$start,$codeLen);
    }
}