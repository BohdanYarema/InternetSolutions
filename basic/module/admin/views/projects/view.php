<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\module\admin\models\Projects */

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
            'id',
            'name:ntext',
            [
                'attribute' => 'date_post',
                'format' =>  ['datetime'],
            ],
            [
                'attribute' => 'date_update',
                'format' =>  ['datetime'],
            ],
            //'id_user',
            [
                'attribute' => 'id_user',
                'format' => 'text',
                'value' => $model->author->username,
            ],
        ],
    ]) ?>
    <br>
    <h1>Рекламные кампании</h1>
    <br>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'layout'=>"{items}\n
            <div id='data-table-command-footer' class='bootgrid-footer container-fluid' style='margin:0;'>
                <div class='row'>
                    <div class='col-sm-6'>
                        {pager}
                    </div>
                    <div class='col-sm-6 infoBar'>
                        <div class='infos'>{summary}</div>
                    </div>
                </div>
            </div>",
        'tableOptions' => [
            'class' => 'table table-bordered table-vmiddle bootgrid-table'
        ],
        'columns' => [
            //'id',
            'name:ntext',
            //'about:ntext',
            //'link:ntext',
            [
                'attribute' => 'date_end',
                'format' =>  ['datetime'],
            ],
            [
                'attribute' => 'date_post',
                'format' =>  ['datetime'],
            ],
            [
                'attribute' => 'date_update',
                'format' =>  ['datetime'],
            ],
            [
                'attribute' => 'spheres',
                'value' => 'spheres.name',
                'label' => 'Название сферы деятельности',
            ],
            [
                'attribute' => 'author',
                'value' => 'author.username',
                'label' => 'Автор',
            ],
            ['class' => 'yii\grid\ActionColumn', 'template' => '{view} {update}',
                'buttons'=>[
                    'view'=>function ($url, $model) {
                        $customurl=Yii::$app->getUrlManager()->createUrl(['admin/compaings/view','id'=> $model->id]); //$model->id для AR
                        return \yii\helpers\Html::a( '<button type="button" class="btn btn-icon btn-info command-edit"><span class="glyphicon glyphicon-eye-open"></span></button>', $customurl,
                        ['title' => "Просмотреть"]);
                    },
                    'update'=>function ($url, $model) {
                        $customurl=Yii::$app->getUrlManager()->createUrl(['admin/compaings/update','id'=> $model->id]); //$model->id для AR
                        return \yii\helpers\Html::a( '<button type="button" class="btn btn-icon btn-info command-edit"><span class="zmdi zmdi-edit"></span></button>', $customurl,
                        ['title' => "Обновить"]);
                    },
                ],
            ],
            
        ],
    ]); ?>

</div>