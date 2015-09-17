<?php

namespace filsh\config;

abstract class Rule extends \yii\base\Object
{
    abstract function isValid();
}