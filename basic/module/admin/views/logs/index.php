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
            //'id',
            'user_id',
            'operation',
            /*'sql:ntext',*/
            'path_operation_text:ntext',
            // 'path_operation_link:ntext',
            // 'message:ntext',
            // 'email:ntext',
            // 'files:ntext',
            'date_post',
            'user_role:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
