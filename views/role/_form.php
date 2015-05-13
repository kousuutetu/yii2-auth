<?php

use yii\helpers\Html;
use Jeff\beyond\ActiveForm;
use Jeff\auth\models\Permission;

/* @var $this yii\web\View */
/* @var $model Jeff\auth\models\Role */
/* @var $form yii\widgets\ActiveForm */
?>
<?php
$css = <<<EOF

#role-permission .checkbox {
    width: 50%;
    float: left;
}

EOF;
$this->registerCss($css);
?>
<div class="role-form">

    <?php $form = ActiveForm::begin([
        'layout' => 'horizontal'
    ]); ?>

		<?= $form->field($model, 'name')->textInput(['maxlength' => 64])->hint('<code>'.Yii::t('app', 'administrator').'</code>') ?>
        <?= $form->field($model, 'description')->textInput(['maxlength' => 64])->hint('<code>'.Yii::t('app', 'Admin').'</code>') ?>
        <?= $form->field($model, 'permission')->checkboxList(Permission::getPermissions()) ?>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => 'btn btn-primary']) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>

</div>
