<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\module\profile\models\Compaings */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Compaings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="compaings-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name:ntext',
            'about:ntext',
            'link:ntext',
            //'unique_link:ntext',
            [
                'attribute' => 'date_post',
                'format' =>  ['datetime'],
            ],
            [
                'attribute' => 'date_end',
                'format' =>  ['datetime'],
            ],
            [
                'attribute' => 'date_update',
                'format' =>  ['datetime'],
            ],
            [
                'attribute' => 'id_project',
                'format' => 'text',
                'value' => $model->projects->name,
            ],
            [
                'attribute' => 'id_spheres',
                'format' => 'text',
                'value' => $model->spheres->name,
            ],
        ],
    ]) ?>

</div>
