<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\module\profile\models\Campaigns */

$this->title = 'Создать рекламную компанию';
$this->params['breadcrumbs'][] = ['label' => 'Campaigns', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="spheres-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'projects' => $projects,
        'spheres' => $spheres,
        'time_begin' => $time_begin,
        'time_end' => $time_end,
    ]) ?>

</div>
