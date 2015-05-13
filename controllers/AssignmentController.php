<?php

namespace Jeff\auth\controllers;

use Yii;
use Jeff\auth\models\Assignment;
use Jeff\auth\models\Role;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AssignmentController implements the CRUD actions for Assignment model.
 */
class AssignmentController extends Controller
{

    /**
     * Lists all Assignment models.
     * @return mixed
     */
    public function actionIndex($userId = null)
    {
        if ($userId !== null) {
            $model = new Assignment(['user_id' => $userId, 'item_name' => Assignment::getAssignments($userId)]);
        } else {
            $model = new Assignment();
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->assignments();
        }

        return $this->render('index', [
            'model' => $model,
        ]);
    }
}
