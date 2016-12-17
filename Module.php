<?php

namespace maple\auth;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'maple\auth\controllers';

    public $defaultRoute = 'permission';

    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
