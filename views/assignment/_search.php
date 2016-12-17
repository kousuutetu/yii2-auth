<?php

use yii\helpers\Html;
use maple\beyond\ActiveForm;

/* @var $this yii\web\View */
/* @var $model maple\auth\models\AssignmentSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="assignment-search">

    <?php $form = ActiveForm::begin([
        'layout' => 'inline',
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

        <?= $form->field($model, 'item_name') ?>
        <?= $form->field($model, 'user_id') ?>
        <?= $form->field($model, 'created_at') ?>
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Reset'), ['index'], ['class' => 'btn btn-default']) ?>

    <?php ActiveForm::end(); ?>

</div>
