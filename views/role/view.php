<?php

use yii\helpers\Html;
use Jeff\beyond\Panel;
use yii\widgets\DetailView;
use Jeff\auth\models\Permission;

/* @var $this yii\web\View */
/* @var $model Jeff\auth\models\Role */

$this->title = Yii::t('app', 'View');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Roles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="role-view">

    <?php Panel::begin([
        'headerOptions' => [
            'class'     => 'bordered-bottom bordered-teal',
            'caption'   => Html::encode($this->title),
            'buttonsOptions' => ['class' => 'buttons-bordered'],
            'buttons' => [
                Html::a(Yii::t('app', 'List'), ['index'], ['class' => 'btn btn-primary btn-sm']),
                Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->name], ['class' => 'btn btn-warning btn-sm']),
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
                [
                    'label'  => Yii::t('app', 'Permission'),
                    'format' => 'raw',
                    'value'  => '<code>'.implode('</code>, <code>', Permission::getPermissionsByRole($model->name)).'</code>'
                ],
                'created_at:datetime',
                'updated_at:datetime',
            ],
        ]) ?>

    <?php Panel::end() ?>

</div>
