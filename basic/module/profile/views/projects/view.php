<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\module\profile\models\Projects */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Projects', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="projects-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'name:ntext',
            'date_post:datetime',
            'date_update:datetime',
        ],
    ]) ?>

    <p>
        <?= Html::a('Добавить рекламную кампанию', ['/profile/campaigns/create_own', 'id'=> $model->id], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'id',
            'name:ntext',
            'about:ntext',
            'link:ntext',
             //'unique_link:ntext',
            'date_begin:datetime',
            'date_end:datetime',
            'date_post:datetime',
            'date_update:datetime',
            [
                'attribute' => 'spheres',
                'value' => 'spheres.name',
                'label' => 'Название сферы деятельности',
            ],
            ['class' => 'yii\grid\ActionColumn', 'template' => '{view} {update} {delete}',
                'buttons'=>[
                    'view'=>function ($url, $model) {
                        $customurl=Yii::$app->getUrlManager()->createUrl(['profile/campaigns/view','id'=> $model->id]); //$model->id для AR
                        return \yii\helpers\Html::a( '<span class="glyphicon glyphicon-eye-open"></span>', $customurl,
                        ['title' => "Просмотреть"]);
                    },
                    'update'=>function ($url, $model) {
                        $customurl=Yii::$app->getUrlManager()->createUrl(['profile/campaigns/update','id'=> $model->id]); //$model->id для AR
                        return \yii\helpers\Html::a( '<span class="glyphicon glyphicon-pencil"></span>', $customurl,
                        ['title' => "Обновить"]);
                    },
                    'delete'=>function ($url, $model) {
                        $customurl=Yii::$app->getUrlManager()->createUrl(['profile/campaigns/delete','id'=> $model->id],['data-method' => 'post']); //$model->id для AR
                        return \yii\helpers\Html::a( '<span class="glyphicon glyphicon-trash"></span>', $customurl,
                        ['data'=>[
                               'method' => 'post',
                               'confirm' => 'Вы уверены что хотите удалить эту запись ?',
                            ]
                        ]
                        );
                    }
                ],
            ],
            
        ],
    ]); ?>

</div>