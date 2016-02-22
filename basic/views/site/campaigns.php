<?php
	use yii\helpers\Html;
	use yii\widgets\ActiveForm;
	use yii\helpers\Url;
    use yii\web\View;
?>

<?
    $options = '
        window.location.replace("http://'.$url.'");
    ';
    $this->registerJs($options, View::POS_HEAD, 'my-options');
?>