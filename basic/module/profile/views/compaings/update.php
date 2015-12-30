<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\module\profile\models\Compaings */

$this->title = 'Обновить информацию о компании: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Compaings', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="compaings-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_update', [
        'model' => $model,
        'projects' => $projects,
        'spheres' => $spheres,
    ]) ?>

</div>
