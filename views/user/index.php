<?php

use yii\helpers\Html;
use Jeff\beyond\Panel;
use Jeff\beyond\GridView;
use Jeff\auth\models\User;

/* @var $this yii\web\View */
/* @var $searchModel Jeff\auth\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">


    <?php Panel::begin([
        'headerOptions' => [
            'class'     => 'bordered-bottom bordered-teal',
            'caption'    => Html::encode($this->title),
            'buttonsOptions' => ['class' => 'buttons-bordered'],
            'buttons' => [Html::a(Yii::t('app', 'Create'), ['create'], ['class' => 'btn btn-primary btn-sm'])]
        ],
        'bodyOptions' => [
            'class' => 'no-padding',
        ]
    ]) ?>
        <?php echo $this->render('_search', ['model' => $searchModel]); ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                // ['class' => 'yii\grid\SerialColumn'],

                'id',
                'username',
                'email:email',
                // 'access_token',
                // 'auth_key',
                [
                    'attribute' => 'status',
                    'value'     => function($model, $key, $index) {
                        return User::getStatus($model->status);
                    }
                ],
                // 'created_at',
                'updated_at:datetime',

                ['class' => 'yii\grid\ActionColumn', 'header' => Yii::t('app', 'Operations'), 'options' => ['width' => 85]],
                ['class' => 'yii\grid\CheckboxColumn', 'options' => ['width' => 40]],
            ],
        ]); ?>
    <?php Panel::end() ?>

</div>
