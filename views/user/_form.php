<?php

use yii\helpers\Html;
use maple\beyond\ActiveForm;
use maple\auth\models\User;

/* @var $this yii\web\View */
/* @var $model maple\auth\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin([
        'layout' => 'horizontal'
    ]); ?>

		<?= $form->field($model, 'username')->textInput(['maxlength' => 128]) ?>
		<?= $form->field($model, 'password_hash')->passwordInput(['maxlength' => 60]) ?>
		<?= $form->field($model, 'email')->textInput(['maxlength' => 32]) ?>
		<?= $form->field($model, 'status')->dropDownList(User::getStatus()) ?>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => 'btn btn-primary']) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>

</div>
