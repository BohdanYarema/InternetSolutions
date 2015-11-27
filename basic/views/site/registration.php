<?php
	use yii\helpers\Html;
	use yii\widgets\ActiveForm;
	use yii\helpers\Url;
?>
  	<!-- CONTENT -->
        <div id="page-content">
            
            <div id="page-header">  
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            
                            <h4>Регистрация</h4>
                            
                        </div><!-- col -->
                    </div><!-- row -->
                </div><!-- container -->    
            </div><!-- page-header -->
			
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<div class="headline">
							<h3>Регистрация</h3>
							<p>Для того чтоб приступить к использованию услуги и заказать интернет-рекламу пройдите, <br>пожалуйста, процедуру регистрации.</p>
						</div><!-- headline -->
					</div><!-- col -->
				</div><!-- row -->
			</div><!-- container -->
				
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						
					</div><!-- col -->
					<div class="col-sm-4">
						<?php 
							$form = ActiveForm::begin([
							    'options' => ['class' => 'form-horizontal'],
							]);
						?>
						    <div class="form-group">
								<div class="col-sm-12">
									<?= $form->field($model, 'name')->label(false)->textInput(array('placeholder' => 'ФИО')); ?>
								</div>
							</div>
						    <div class="form-group">
								<div class="col-sm-12">
									<?= $form->field($model, 'email')->label(false)->textInput(array('placeholder' => 'E-mail')); ?>
								</div>
							</div>
						    <div class="form-group">
								<div class="col-sm-12">
									<?= $form->field($model, 'company')->label(false)->textInput(array('placeholder' => 'Название вашей компании')); ?>
								</div>
							</div>
						    <div class="form-group">
						    	<div class="col-sm-12">
						        	<?= Html::submitButton('ЗАРЕГИСТРИРОВАТЬСЯ', ['class' => 'btn btn-default col-sm-12']) ?>
						    	</div>
						    </div>
						<?php ActiveForm::end(); ?>
					</div><!-- col -->
					<div class="col-sm-4">
						
					</div><!-- col -->
				</div><!-- row -->
			</div><!-- container -->

        </div><!-- PAGE CONTENT -->