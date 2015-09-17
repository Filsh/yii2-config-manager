<?php

namespace filsh\config\rule;

use filsh\config\Rule;

class DummyRule extends Rule
{
    public function isValid()
    {
        return true;
    }
}