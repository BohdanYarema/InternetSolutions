<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\module\admin\models\CompaingsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Компании';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="compaings-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            'name:ntext',
            'about:ntext',
            'link:ntext',
            'date_post',
            'date_end',
            'date_update',
            [
                'attribute' => 'author',
                'label' => 'Автор',
                'value' => 'author.username'
            ],
            [
                'attribute' => 'spheres',
                'label' => 'Название сферы деятельности',
                'value' => 'spheres.name'
            ],
            [
                'attribute' => 'projects',
                'label' => 'Название проэкта',
                'value' => 'projects.name'
            ],
            ['class' => 'yii\grid\ActionColumn', 'template' => '{view} {update}'],
        ],
    ]); ?>

</div>