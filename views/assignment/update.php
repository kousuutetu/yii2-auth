<?php

use yii\helpers\Html;
use maple\beyond\Panel;

/* @var $this yii\web\View */
/* @var $model maple\auth\models\Assignment */

$this->title = Yii::t('app', 'Update');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Assignments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="assignment-update">

	<?php Panel::begin([
        'headerOptions' => [
            'class'     => 'bordered-bottom bordered-teal',
            'caption'   => Html::encode($this->title),
            'buttonsOptions' => ['class' => 'buttons-bordered'],
            'buttons' => [
            	Html::a(Yii::t('app', 'List'), ['index'], ['class' => 'btn btn-primary btn-sm']),
            	Html::a(Yii::t('app', 'View'), ['view', 'item_name' => $model->item_name, 'user_id' => $model->user_id], ['class' => 'btn btn-warning btn-sm'])
            ]
        ],
    ]) ?>

	    <?= $this->render('_form', [
	        'model' => $model,
	    ]) ?>
	    
	<?php Panel::end() ?>

</div>
