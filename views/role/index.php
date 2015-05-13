<?php

use yii\helpers\Html;
use Jeff\beyond\Panel;
use Jeff\beyond\GridView;

/* @var $this yii\web\View */
/* @var $searchModel Jeff\auth\models\RoleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Roles');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="role-index">


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
                ['class' => 'yii\grid\SerialColumn', 'options' => ['width' => 45]],

                'name',
                'description:ntext',

                ['class' => 'yii\grid\ActionColumn', 'header' => Yii::t('app', 'Operations'), 'options' => ['width' => 85]],
                ['class' => 'yii\grid\CheckboxColumn'],
            ],
        ]); ?>
    <?php Panel::end() ?>

</div>
