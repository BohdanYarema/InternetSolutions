<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\module\admin\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Клиенты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <!--  <h1><?= Html::encode($this->title) ?></h1> -->

    <h3><?= Html::encode($this->title) ?></h3>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <div class="tile">

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
                'username:ntext',
                /*[
                    'attribute' => 'password',
                    'format' => 'text',
                    'filter' => false,
                    'value' => function ($data) {
                        $col = strlen($data->password);
                        for ($i=0; $i < $col; $i++) { 
                            $dotted .= '*';
                        }

                        return $dotted;
                    },
                    'label' => 'Пароль',
                ],*/
                /*'auth_key:ntext',*/
                'u_snp:ntext',
                'u_company:ntext',
                [
                    'attribute' => 'u_status',
                    'format' => 'html',
                    'filter' => [
                        '1' => 'Активирован',
                        '2' => 'Не активирован'
                    ],
                    'value' => function ($data) {
                        if ($data->u_status == 1) {
                            return '<span class="label label-success">Activated</span>';
                        } else {
                            return '<span class="label label-danger">Not activated</span>';
                        }
                        return (int)$data->u_status;
                    },
                    'label' => 'Статус',
                ],
                /*[
                    'attribute' => 'date_post',
                    'format' =>  ['date', 'Y:m:s H:i:s'],
                    'filter' => false,
                ],*/
                /*[
                    'attribute' => 'activate_post',
                    'format' =>  ['date', 'Y:m:s H:i:s'],
                    'filter' => false,
                ],*/
                ['class' => 'yii\grid\ActionColumn', 'template' => '<div class="col-sm-3">{view}{update}{delete}</div>',
                    'buttons'=>[
                        'view'=>function ($url, $model) {
                            $customurl=Yii::$app->getUrlManager()->createUrl(['admin/user/view','id'=> $model->id]); //$model->id для AR
                            return \yii\helpers\Html::a( '<button type="button" class="btn btn-icon btn-info command-edit"><span class="glyphicon glyphicon-eye-open"></span></button>', $customurl,
                            ['title' => "Просмотреть"]);
                        },
                        'update'=>function ($url, $model) {
                            $customurl=Yii::$app->getUrlManager()->createUrl(['admin/user/update','id'=> $model->id]); //$model->id для AR
                            return \yii\helpers\Html::a( '<button type="button" class="btn btn-icon btn-info command-edit"><span class="zmdi zmdi-edit"></span></button>', $customurl,
                            ['title' => "Обновить"]);
                        },
                        'delete'=>function ($url, $model) {
                            $customurl=Yii::$app->getUrlManager()->createUrl(['admin/user/delete','id'=> $model->id],['data-method' => 'post']); //$model->id для AR
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
</div>