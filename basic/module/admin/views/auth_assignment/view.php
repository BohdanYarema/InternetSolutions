<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\module\admin\models\Auth_assignment */

$this->title = $user->u_snp;
$this->params['breadcrumbs'][] = ['label' => 'Auth Assignments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$result = Yii::$app->session->hasFlash('assigment_create');
//
?>

<div class="auth-assignment-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Обновить', ['update', 'item_name' => $model->item_name, 'user_id' => $model->user_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'item_name' => $model->item_name, 'user_id' => $model->user_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'method' => 'post',
                'confirm' => 'Вы уверены что хотите удалить эту запись ?',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'item_name',
            [
                'attribute' => 'id_user',
                'format' => 'text',
                'value' => $model->author->u_snp,
                'label' => 'Имя пользователя'
            ],
            'created_at:datetime',
        ],
    ]) ?>

</div>

<script type="text/javascript">
    var name = '<? echo Yii::$app->session->getFlash("assigment_create");?>';
    var result = '<? echo $result;?>';
</script>
<?
$this->registerJs(
    '$("document").ready(function(){
        if (result == 1 || result == true) {
            notify("top", "center", "", "inverse", "animated fadeIn", "animated fadeOut", "" , name);  
        }
    });'
);
?>
