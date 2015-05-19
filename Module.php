<?php

namespace Jeff\auth;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'Jeff\auth\controllers';

    public $defaultRoute = 'permission';

    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
