<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Вход на сайт';
?>

<div id="page-content">
            
            <div id="page-header">  
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            
                            <h4>Вход на сайт</h4>
                            
                        </div><!-- col -->
                    </div><!-- row -->
                </div><!-- container -->    
            </div><!-- page-header -->
            
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="headline">
                            <p>Введите ваши данные для входа</p>
                        </div><!-- headline -->
                    </div><!-- col -->
                </div><!-- row -->
            </div><!-- container -->
                
            <div class="container">
                <div class="row">
                    <div class="col-sm-4">
                    </div>
                    <div class="col-sm-4">
                        <?php $form = ActiveForm::begin([
                            'id' => 'login-form',
                            'options' => ['class' => 'form-horizontal'],
                        ]); ?>

                            <?= $form->field($model, 'username') ?>

                            <?= $form->field($model, 'password')->passwordInput() ?>

                            <?= $form->field($model, 'rememberMe')->checkbox() ?>

                            <div class="form-group">
                                <div class="">
                                    <?= Html::submitButton('Вход', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                                </div>
                            </div>

                        <?php ActiveForm::end(); ?>
                    </div><!-- col -->
                    <div class="col-sm-4">
                    </div>
                </div><!-- row -->
            </div><!-- container -->
        </div>