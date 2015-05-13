<?php

use yii\helpers\Html;
use Jeff\beyond\ActiveForm;

/* @var $this yii\web\View */
/* @var $model Jeff\auth\models\PermissionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="permission-search">

    <?php $form = ActiveForm::begin([
        'layout' => 'inline',
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

        <?= $form->field($model, 'name') ?>
        <?= $form->field($model, 'description') ?>
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Reset'), ['index'], ['class' => 'btn btn-default']) ?>

    <?php ActiveForm::end(); ?>

</div>
