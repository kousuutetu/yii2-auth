<?php

use yii\helpers\Html;
use Jeff\beyond\ActiveForm;
use Jeff\auth\models\User;
use Jeff\auth\models\Role;

/* @var $this yii\web\View */
/* @var $model Jeff\auth\models\Assignment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="assignment-form">

    <?php $form = ActiveForm::begin([
        'layout' => 'horizontal'
    ]); ?>

        <?= $form->field($model, 'user_id')->dropDownList(User::getUsers(), ['prompt' => '']) ?>
		<?= $form->field($model, 'item_name')->checkboxList(Role::getRoles()) ?>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => 'btn btn-primary']) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
echo Html::tag('link', '', ['id' => 'current', 'href' => \yii\helpers\Url::current(['userId' => null])]);
$js = <<<EOF
$('#assignment-user_id').change(function(){
    var url = $('#current').attr('href') + '?userId=' + $(this).val();
    window.location.href = url;
});
EOF;
$this->registerJs($js);