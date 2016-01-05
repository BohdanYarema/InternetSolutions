<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\module\admin\models\Logs */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="logs-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'operation')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sql')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'path_operation_text')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'path_operation_link')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'message')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'email')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'files')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'date_post')->textInput() ?>

    <?= $form->field($model, 'user_role')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
