<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\module\admin\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<!-- <div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'u_snp')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'u_company')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div> -->

<div class="layout layout-main-right layout-stack-sm">
    <div class="col-md-3 col-sm-4 layout-sidebar">
        <div class="nav-layout-sidebar-skip">
            <strong>Tab Navigation</strong> / <a href="#settings-content">Skip to Content</a>   
        </div>
        <ul id="myTab" class="nav nav-layout-sidebar nav-stacked">
            <li class="active">
                <a href="#profile-tab" data-toggle="tab">
                    <i class="fa fa-user"></i> 
                    &nbsp;&nbsp;Настройки профиля
                </a>
            </li>
        </ul>
    </div> <!-- /.col -->
    <div class="col-md-9 col-sm-8 layout-main">
        <div id="settings-content" class="tab-content stacked-content">
            <div class="tab-pane fade in active" id="profile-tab">

	            <div class="heading-block">
	              <h3>
	                Редактирование профиля
	              </h3>
	            </div> <!-- /.heading-block -->
		        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes. Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</p>
		        <br><br>
		        <div class="user-form">
				    <?php $form = ActiveForm::begin(); ?>
				    <?= $form->field($model, 'u_snp')->textinput() ?>
				    <?= $form->field($model, 'u_company')->textinput() ?>
				    <div class="form-group">
				        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
				    </div>
				    <?php ActiveForm::end(); ?>
				</div>
            </div> <!-- /.tab-pane -->
        </div> <!-- /.tab-content -->
    </div> <!-- /.col -->
</div> <!-- /.row -->