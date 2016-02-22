<?php

use yii\helpers\Html;
use yii\web\View;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use app\module\profile\models\Projects;
use app\module\profile\models\Spheres;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;
use kartik\date\DatePicker;


/* @var $this yii\web\View */
/* @var $model app\module\profile\models\Campaigns */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="campaigns-form">
	<?php $form = ActiveForm::begin(); ?>
		<?php 
			$list_projects = ArrayHelper::map($projects,'id','name');
			
			echo $form->field($model, 'id_project')->dropDownList(
				$list_projects, 
				['prompt'=>'Выберите из списка']
			);
		?>

	    <?= $form->field($model, 'name')->textinput() ?>

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
	    	// usage without model
			echo '<label>Дата старта кампании</label>';
			echo DatePicker::widget([
			    'name' => 'date_begin',
				'value' => $time_begin,
			    'pluginOptions' => [
			        'autoclose' => true,
					'format' => 'yyyy-mm-dd',
			        'todayHighlight' => true
			    ],
			    'pluginEvents' => [
				    "changeDate" => "function(e) {
				    	//console.log(e);
				    	senbox(e['date']);
				    }",
				],
			]);
	    ?>
		<br>

		<?Pjax::begin(['id'=>'secondtime']);?>
			<?
		    	// usage without model
				echo '<label class="control-label">Дата завершения кампании</label>';
				echo DatePicker::widget([
				    'name' => 'date_end',
					'value' => $time_end,
				    'pluginOptions' => [
				        'autoclose' => true,
						'format' => 'yyyy-mm-dd',
						'startDate' => $time_end,
				        'todayHighlight' => true
				    ],
				]);
		    ?>

		<?Pjax::end();?>


		<br>
	    <?= $form->field($model, 'link')->textinput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
<?
	$options2 = "function senbox(time) {
				$.pjax({
		            container: '#secondtime', 
		            timeout: 2000,
		            url: '".Url::toRoute(['campaigns/create'])."',
		            push: false,
		            data: {
				        analytics : time.getTime(),
				    },
		        });
			}";
	$this->registerJs($options2, View::POS_HEAD, 'my-options2');
?>	
