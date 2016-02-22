<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\module\admin\models\Auth_assignment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="auth-assignment-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php 
        $users = ArrayHelper::map($users,'id','u_snp');
        
        echo $form->field($model, 'user_id')->dropDownList(
            $users, 
            ['prompt'=>'Выберите из списка']
        );
    ?>

    <?
        $items = [
            'admin'     => 'Администратор',
            'moderator' => 'Модератор',
            'user'      => 'Пользователь'
        ];
        echo $form->field($model, 'item_name')->dropDownList(
            $items, 
            ['prompt'=>'Выберите из списка']
        );
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
