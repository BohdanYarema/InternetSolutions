<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\module\admin\models\Analytics */

$this->title = $model->id_campaigns;
$this->params['breadcrumbs'][] = ['label' => 'Analytics', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="analytics-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'date_post',
            'date_update',
            'id_user',
        ],
    ]) ?>

</div>
