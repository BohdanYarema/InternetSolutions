<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\module\admin\models\Spheres */

$this->title = 'Create Spheres';
$this->params['breadcrumbs'][] = ['label' => 'Spheres', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="spheres-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
