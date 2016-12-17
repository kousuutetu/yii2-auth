<?php

use yii\helpers\Html;
use maple\beyond\Panel;
use yii\widgets\DetailView;
use maple\auth\models\User;

/* @var $this yii\web\View */
/* @var $model maple\auth\models\User */

$this->title = Yii::t('app', 'View');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <?php Panel::begin([
        'headerOptions' => [
            'class'     => 'bordered-bottom bordered-teal',
            'caption'   => Html::encode($this->title),
            'buttonsOptions' => ['class' => 'buttons-bordered'],
            'buttons' => [
                Html::a(Yii::t('app', 'List'), ['index'], ['class' => 'btn btn-primary btn-sm']),
                Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-warning btn-sm']),
                Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                        'method' => 'post',
                    ],
                ]),
            ]
        ],
        'bodyOptions' => [
            'class' => 'no-padding'
        ],
    ]) ?>

        <?= DetailView::widget([
            'options' => ['class' => 'table detail-view'],
            'model' => $model,
            'attributes' => [
               'id',
               'username',
               'email:email',
               'access_token',
               [
                    'attribute'  => 'status',
                    'value'  => User::getStatus($model->status)
                ],
               'created_at:datetime',
               'updated_at:datetime',
            ],
        ]) ?>

    <?php Panel::end() ?>

</div>
