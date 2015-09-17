<?php

namespace filsh\config;

use Yii;
use bupy7\config\components\ConfigManager as BaseConfigManager;

class ConfigManager extends BaseConfigManager
{
    public $rules = [];
    
    protected $target = null;
    
    /**
     * @inheritdoc
     */
    public function get($name)
    {
        $target = $this->detectTarget();
        return parent::get($target, $name);
    }
    
    protected function detectTarget()
    {
        if($this->target === null) {
            foreach($this->rules as $target => $config) {
                /* @var $rule Rule */
                $rule = Yii::createObject($config);
                if($rule->isValid()) {
                    $this->target = $target;
                    break;
                }
            }
            
            if($this->target === null) {
                throw new \yii\base\Exception('Config target not detected.');
            }
        }
        return $this->target;
    }
}