<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\module\admin\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?//= $form->field($model, 'username')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'password')->textInput(['type' => 'password']) ?>

    <?//= $form->field($model, 'auth_key')->textarea(['rows' => 6]) ?>

    <?//= $form->field($model, 'u_snp')->textarea(['rows' => 6]) ?>

    <?//= $form->field($model, 'u_company')->textarea(['rows' => 6]) ?>

    <?//= $form->field($model, 'u_status')->textInput() ?>

    <?//= $form->field($model, 'u_activation_link')->textarea(['rows' => 6]) ?>

    <?//= $form->field($model, 'u_time_link')->textInput() ?>

    <?//= $form->field($model, 'date_post')->textInput() ?>

    <?//= $form->field($model, 'update_post')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
