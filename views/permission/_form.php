<?php

use yii\helpers\Html;
use maple\beyond\ActiveForm;

/* @var $this yii\web\View */
/* @var $model maple\auth\models\Permission */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="permission-form">

    <?php $form = ActiveForm::begin([
        'layout' => 'horizontal'
    ]); ?>

		<?= $form->field($model, 'name')->textInput(['maxlength' => 64])->hint('<code>'.Yii::t('app', '/site/dashboard').'</code>') ?>
        <?= $form->field($model, 'description')->textInput(['maxlength' => 64])->hint('<code>'.Yii::t('app', 'Dashboard').'</code>') ?>
        <?= $form->field($model, 'needCrud')->checkbox()->hint('<code>'.Yii::t('app', 'create/view/update/delete').'</code>') ?>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => 'btn btn-primary']) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>

</div>
