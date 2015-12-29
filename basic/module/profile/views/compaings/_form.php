<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\module\profile\models\Projects;
use app\module\profile\models\Spheres;
use yii\helpers\ArrayHelper;
use yii\jui\DatePicker;
use kartik\datetime\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model app\module\profile\models\Compaings */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="compaings-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php 
		$list_projects = ArrayHelper::map($projects,'id','name');
		
		echo $form->field($model, 'id_project')->dropDownList(
			$list_projects, 
			['prompt'=>'Выберите из списка']
		);
	?>

    <?= $form->field($model, 'name')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'about')->textarea(['rows' => 6]) ?>
    
    <?php 
		$sphere=Spheres::find()->all();
		$list_sphere = ArrayHelper::map($sphere,'id','name');
		
		echo $form->field($model, 'id_sphere')->dropDownList(
			$list_sphere, 
			['prompt'=>'Выберите из списка']
		);
	?>

	<?
		echo '<label class="control-label">Event Time</label>';
		echo DateTimePicker::widget([
			'name' => 'date_end',
			'value' => date('Y-m-d H:i:s'),
			'pluginOptions' => [
				'autoclose' => true,
				'format' => 'yyyy-mm-dd hh:ii:ss'
			]
		]);
	?>

    <?= $form->field($model, 'link')->textinput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
