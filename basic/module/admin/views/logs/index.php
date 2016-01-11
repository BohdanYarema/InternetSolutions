<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\module\admin\models\LogsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Логи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="logs-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'user_name',
            'user_id',
            [
                'attribute' => 'operation',
                'format' => 'html',
                'filter' => [
                    'registration' => 'Регистрация',
                    'login' => 'Логин на сайте',
                    'activate' => 'Активация',
                ],
                'value' => function ($data) {
                    if ($data->operation == 'login' || $data->operation == 'registration' || $data->operation == 'activate') {
                        return '<span class="label label-success" style="background-color:#3F51B5;">'.$data->operation.'</span>';
                    } else {
                        return '<span class="label label-danger">.$data->operation.</span>';
                    }
                    return $data->operation;
                },
                'label' => 'operation',
            ],
            //'sql:ntext',
            //'path_operation_text:ntext',
            // 'path_operation_link:ntext',
             'message:ntext',
            // 'email:ntext',
            // 'files:ntext',
            // 'date_post',
            'user_role:ntext',

            ['class' => 'yii\grid\ActionColumn', 'template' => '<div class="col-sm-5">{view}</div>',
                'buttons'=>[
                    'view'=>function ($url, $model) {
                        $customurl=Yii::$app->getUrlManager()->createUrl(['admin/logs/view','id'=> $model->id]); //$model->id для AR
                        return \yii\helpers\Html::a( '<button type="button" class="btn btn-icon btn-info command-edit"><span class="glyphicon glyphicon-eye-open"></span></button>', $customurl,
                        ['title' => "Просмотреть"]);
                    }
                ],
            ],
    ],
    ]); ?>

</div>
