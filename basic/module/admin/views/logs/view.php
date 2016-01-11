<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\module\admin\models\Logs */

$this->title = 'Лог №'.$model->id;
$this->params['breadcrumbs'][] = ['label' => 'Logs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="logs-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'user_name',
            'id',
            'user_id',
            'operation:ntext',
            'sql:ntext',
            'path_operation_text:ntext',
            'path_operation_link:ntext',
            'message:ntext',
            'email:ntext',
            'files:ntext',
            'date_post:datetime',
            'user_role:ntext',
        ],
    ]) ?>

</div>
