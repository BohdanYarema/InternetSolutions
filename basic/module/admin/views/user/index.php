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

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => [
            'class' => 'table table-striped table-bordered'
        ],
        'columns' => [
            'id',
            'username:ntext',
            [
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
            ],
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
            [
                'attribute' => 'date_post',
                'format' =>  ['date', 'Y:m:s H:i:s'],
                'filter' => false,
            ],
            [
                'attribute' => 'activate_post',
                'format' =>  ['date', 'Y:m:s H:i:s'],
                'filter' => false,
            ],
            /*'update_post',*/
            /*'u_activation_link:ntext',*/
            /*'u_time_link:datetime',*/
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
