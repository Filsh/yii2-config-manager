<?php

namespace filsh\config\rule;

use filsh\config\Rule;

class HostRegexp extends Rule
{
    public $include;
    
    public $exclude;
    
    public function isValid()
    {
        $value = $this->getValue();
        if (!$value || !is_string($value)) {
            throw new \yii\base\InvalidParamException('Invalid value given or host is not detecting.');
        }
        if(!$this->include || !is_string($this->include)) {
            throw new \yii\base\InvalidParamException('Invalid value given, include pattern should be valid regular expression.');
        }
        if($this->exclude !== null && !is_string($this->exclude)) {
            throw new \yii\base\InvalidParamException('Invalid value given, exclude pattern should be null or a valid regular expression.');
        }
        
        $status = preg_match($this->include, $value);
        if($this->exclude !== null) {
            $status = $status && !preg_match($this->exclude, $value);
        }
        
        return (bool) $status;
    }
    
    protected function getValue()
    {
        if (!isset($_SERVER['HTTP_HOST'])) {
            return false;
        }
        $host = $_SERVER['HTTP_HOST'];
        if (substr($host, 0, 4) == 'www.') {
            $host = substr($host, 4);
        }
        return $host;
    }
}