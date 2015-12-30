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
            //['class' => 'yii\grid\SerialColumn'],
            'name:ntext',
            'about:ntext',
            'link:ntext',
            [
                'attribute' => 'date_end',
                'format' =>  ['date', 'Y:m:d H:i:s'],
                'filter' => false,
            ],
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
