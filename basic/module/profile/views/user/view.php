<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\module\admin\models\User */

$this->title = $model->u_snp;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <!-- <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить данные', ['update'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Изменить пароль', ['password'], ['class' => 'btn btn-primary']) ?>
    </p>
 -->

<div class="row">
  <div class="col-md-3 col-sm-5">
    <div class="profile-avatar">
      <img src="/basic/web/themes/images/admiral.jpg" class="profile-avatar-img img-responsive thumbnail" alt="Profile Image">
    </div> <!-- /.profile-avatar -->
    <div class="list-group"> 
      <? $url = Url::toRoute(['projects/index']);?>
      <a href="<?=$url?>" class="list-group-item">
        <i class="fa fa-asterisk text-primary"></i> &nbsp;&nbsp;Projects
        <i class="fa fa-chevron-right list-group-chevron"></i>
      </a> 
      <? $url = Url::toRoute(['compaings/index']);?>
      <a href="<?=$url?>" class="list-group-item">
        <i class="fa fa-book text-primary"></i> &nbsp;&nbsp;Compaings
        <i class="fa fa-chevron-right list-group-chevron"></i>
      </a> 
      <? $url = Url::toRoute(['user/view']);?>
      <a href="<?=$url?>" class="list-group-item">
        <i class="fa fa-envelope text-primary"></i> &nbsp;&nbsp;Profile
        <i class="fa fa-chevron-right list-group-chevron"></i>
      </a> 
      <? $url = Url::toRoute(['user/update']);?>
      <a href="<?=$url?>" class="list-group-item">
        <i class="fa fa-group text-primary"></i> &nbsp;&nbsp;Settings profile
        <i class="fa fa-chevron-right list-group-chevron"></i>
      </a> 
      <? $url = Url::toRoute(['user/password']);?>
      <a href="<?=$url?>" class="list-group-item">
        <i class="fa fa-cog text-primary"></i> &nbsp;&nbsp;Settings password
        <i class="fa fa-chevron-right list-group-chevron"></i>
      </a> 
    </div> <!-- /.list-group -->
  </div> <!-- /.col -->

  <div class="col-md-6 col-sm-7">
    <br class="visible-xs">
    <h3><?echo Yii::$app->user->identity['u_snp'];?></h3>
    <h5 class="text-muted"><?echo Yii::$app->user->identity['u_company'];?></h5>
    <hr>  
    <ul class="icons-list">
      <li><i class="icon-li fa fa-envelope"></i><?echo Yii::$app->user->identity['username'];?></li>
    </ul>    
    <br>
    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec.</p>
    <hr>
    <br><br>
  </div> <!-- /.col -->
  <div class="col-md-3">
    <div class="heading-block">
      <h5>
        Social Stats
      </h5>
    </div> <!-- /.heading-block -->
    <div class="list-group">  

      <a href="javascript:;" class="list-group-item">
          <h3 class="pull-right"><i class="fa fa-eye text-primary"></i></h3>
          <h4 class="list-group-item-heading">38,847</h4>
          <p class="list-group-item-text">Profile Views</p>                  
        </a>

      <a href="javascript:;" class="list-group-item">
        <h3 class="pull-right"><i class="fa fa-facebook-square  text-primary"></i></h3>
        <h4 class="list-group-item-heading">3,482</h4>
        <p class="list-group-item-text">Facebook Likes</p>
      </a>

      <a href="javascript:;" class="list-group-item">
        <h3 class="pull-right"><i class="fa fa-twitter-square  text-primary"></i></h3>
        <h4 class="list-group-item-heading">5,845</h4>
        <p class="list-group-item-text">Twitter Followers</p>
      </a>
    </div> <!-- /.list-group -->
    <br>
  </div> <!-- /.col -->
</div> <!-- /.row -->
<br><br>
</div>
