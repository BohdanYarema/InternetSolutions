<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\module\profile\models\Projects */

$this->title = 'Создать проект';
$this->params['breadcrumbs'][] = ['label' => 'Projects', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="spheres-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
