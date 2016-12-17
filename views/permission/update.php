<?php

use yii\helpers\Html;
use maple\beyond\Panel;

/* @var $this yii\web\View */
/* @var $model maple\auth\models\Permission */

$this->title = Yii::t('app', 'Update');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Permissions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="permission-update">

	<?php Panel::begin([
        'headerOptions' => [
            'class'     => 'bordered-bottom bordered-teal',
            'caption'   => Html::encode($this->title),
            'buttonsOptions' => ['class' => 'buttons-bordered'],
            'buttons' => [
            	Html::a(Yii::t('app', 'List'), ['index'], ['class' => 'btn btn-primary btn-sm']),
            	Html::a(Yii::t('app', 'View'), ['view', 'id' => $model->name], ['class' => 'btn btn-warning btn-sm'])
            ]
        ],
    ]) ?>

	    <?= $this->render('_form', [
	        'model' => $model,
	    ]) ?>
	    
	<?php Panel::end() ?>

</div>
