<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\module\profile\models\ProjectsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Проэкты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="projects-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить проэкт', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'name:ntext',
            [
                'attribute' => 'date_post',
                'format' =>  ['date', 'Y:m:s H:i:s'],
                'filter' => false,
            ],
            [
                'attribute' => 'date_update',
                'format' =>  ['date', 'Y:m:s H:i:s'],
                'filter' => false,
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
