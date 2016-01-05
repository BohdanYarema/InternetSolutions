<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\module\profile\models\Compaings */

$this->title = 'Создать рекламную компанию';
$this->params['breadcrumbs'][] = ['label' => 'Compaings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="spheres-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form_own', [
        'model' => $model,
        'projects' => $projects,
        'spheres' => $spheres,
    ]) ?>

</div>
