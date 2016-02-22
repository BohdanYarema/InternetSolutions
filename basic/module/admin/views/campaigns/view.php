<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\module\admin\models\campaigns */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Campaigns', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="campaigns-view">

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
             [
                'attribute' => 'date_post',
                'format' =>  ['datetime'],
            ],
            [
                'attribute' => 'date_begin',
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
                'label' => 'Сфера деятельности',
            ],
            [
                'attribute' => 'id_user',
                'format' => 'text',
                'value' => $model->author->username,
            ],
        ],
    ]) ?>

</div>
