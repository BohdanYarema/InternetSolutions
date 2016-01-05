<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\module\admin\models\LogsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="logs-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'operation') ?>

    <?= $form->field($model, 'sql') ?>

    <?= $form->field($model, 'path_operation_text') ?>

    <?php // echo $form->field($model, 'path_operation_link') ?>

    <?php // echo $form->field($model, 'message') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'files') ?>

    <?php // echo $form->field($model, 'date_post') ?>

    <?php // echo $form->field($model, 'user_role') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
