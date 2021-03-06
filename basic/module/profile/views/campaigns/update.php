<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\module\profile\models\Campaigns */

$this->title = 'Обновить информацию о кампании: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Campaigns', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="campaigns-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_update', [
        'model' => $model,
        'projects' => $projects,
        'spheres' => $spheres,
        'time_begin' => $time_begin,
        'time_end' => $time_end,
    ]) ?>

</div>
