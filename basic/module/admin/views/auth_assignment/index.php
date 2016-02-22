<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\module\admin\models\Auth_assignmentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Разспределения прав пользователей';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-assignment-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать права', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'item_name',
            [
                'attribute' => 'item_name',
                'format' => 'html',
                'filter' => [
                    'admin' => 'Администратор',
                    'moderator' => 'Модератор',
                    'user' => 'Пользователь',
                ],
                'value' => function ($data) {
                    if ($data->item_name == 'admin') {
                        return '<span class="label label-danger">Администратор</span>';
                    } elseif ($data->item_name == 'moderator') {
                        return '<span class="label label-success">Модератор</span>';
                    } else {
                        return '<span class="label label-primary">Пользователь</span>';
                    }
                    return (int)$data->item_name;
                },
                'label' => 'Права',
            ],

            //'user_id',

            [
                'attribute' => 'user_id',
                'value' => 'author.u_snp',
                'label' => 'Пользователь'
            ],

            'created_at:datetime',
            ['class' => 'yii\grid\ActionColumn', 'template' => '{view} {update} {delete}',
                'buttons'=>[
                    'view'=>function ($url, $model) {
                        $customurl=Yii::$app->getUrlManager()->createUrl(['admin/auth_assignment/view','item_name'=> $model->item_name,'user_id'=> $model->user_id]); //$model->id для AR
                        return \yii\helpers\Html::a( '<button type="button" class="btn btn-icon btn-info command-edit"><span class="glyphicon glyphicon-eye-open"></span></button>', $customurl,
                        ['title' => "Просмотреть"]);
                    },
                    'update'=>function ($url, $model) {
                        $customurl=Yii::$app->getUrlManager()->createUrl(['admin/auth_assignment/update','item_name'=> $model->item_name,'user_id'=> $model->user_id]); //$model->id для AR
                        return \yii\helpers\Html::a( '<button type="button" class="btn btn-icon btn-info command-edit"><span class="zmdi zmdi-edit"></span></button>', $customurl,
                        ['title' => "Обновить"]);
                    },
                    'delete'=>function ($url, $model) {
                        $customurl=Yii::$app->getUrlManager()->createUrl(['admin/auth_assignment/delete','item_name'=> $model->item_name,'user_id'=> $model->user_id]); //$model->id для AR
                        return \yii\helpers\Html::a( '<button type="button" class="btn btn-icon btn-info command-edit"><span class="zmdi zmdi-delete"></span></button>', $customurl,
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
