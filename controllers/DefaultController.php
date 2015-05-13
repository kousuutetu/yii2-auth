<?php

namespace Jeff\auth\controllers;

use yii\web\Controller;

class DefaultController extends Controller
{
    public function actionIndex()
    {
        $this->redirect(['/auth/assignment']);
    }
}
