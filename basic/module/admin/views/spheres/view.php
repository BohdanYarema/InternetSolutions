<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\module\admin\models\Spheres */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Spheres', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="spheres-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name:ntext',
            'date_post',
            'date_update',
        ],
    ]) ?>

</div>
