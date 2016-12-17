<?php

use yii\helpers\Html;
use maple\beyond\Panel;
use maple\beyond\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Assignments');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="assignment-index">

    <?php Panel::begin([
        'headerOptions' => [
            'class'     => 'bordered-bottom bordered-teal',
            'caption'   => Html::encode($this->title),
            'buttonsOptions' => ['class' => 'buttons-bordered'],
            'buttons' => [
                // Html::a(Yii::t('app', 'List'), ['index'], ['class' => 'btn btn-primary btn-sm'])
            ]
        ],
    ]) ?>

        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>

    <?php Panel::end() ?>

</div>
