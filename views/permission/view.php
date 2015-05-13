<?php

use yii\helpers\Html;
use Jeff\beyond\Panel;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model Jeff\auth\models\Permission */

$this->title = Yii::t('app', 'View');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Permissions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permission-view">

    <?php Panel::begin([
        'headerOptions' => [
            'class'     => 'bordered-bottom bordered-teal',
            'caption'   => Html::encode($this->title),
            'buttonsOptions' => ['class' => 'buttons-bordered'],
            'buttons' => [
                Html::a(Yii::t('app', 'List'), ['index'], ['class' => 'btn btn-primary btn-sm']),
                // Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->name], ['class' => 'btn btn-warning btn-sm']),
                Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->name], [
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
               'name',
               'description:ntext',
               'created_at:datetime',
               'updated_at:datetime',
            ],
        ]) ?>

    <?php Panel::end() ?>
    
</div>
