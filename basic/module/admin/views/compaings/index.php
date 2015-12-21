<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\module\admin\models\CompaingsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Compaings';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="compaings-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Compaings', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name:ntext',
            'about:ntext',
            'link:ntext',
            'date_post',
            // 'date_end',
            // 'date_update',
            // 'id_project',
            // 'id_user',
            // 'id_sphere',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
