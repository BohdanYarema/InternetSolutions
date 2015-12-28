<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\ModuleAsset_profile;

ModuleAsset_profile::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
     <link rel="shortcut icon" href="/basic/web/favicon.ico" type="image/x-icon">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
    
<div id="wrapper">
  <header class="navbar" role="banner">
    <div class="container">
      <div class="navbar-header">
        <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="sr-only">Toggle navigation</span>
          <i class="fa fa-cog"></i>
        </button>
        <? $url = Url::toRoute(['/profile']);?>
        <a href="<?=$url;?>" class="navbar-brand navbar-brand-img">
          <img src="themes_profile/img/logo.png" alt="MVP Ready">
        </a>
      </div> <!-- /.navbar-header -->
      <nav class="collapse navbar-collapse" role="navigation">
        <ul class="nav navbar-nav navbar-right">        
          <li class="dropdown navbar-profile">
            <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:;">
              <img src="themes_profile/global/img/avatars/avatar-4-sm.jpg" class="navbar-profile-avatar" alt="">
              <span class="visible-xs-inline">@peterlandt &nbsp;</span>
              <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu" role="menu">
              <li>
                <? $url = Url::toRoute(['user/view']);?>
                <a href="<?=$url;?>">
                  <i class="fa fa-user"></i> 
                  &nbsp;&nbsp;Профиль
                </a>
              </li>
              <li>
                <? $url = Url::toRoute(['user/update']);?>
                <a href="<?=$url;?>">
                  <i class="fa fa-cogs"></i> 
                  &nbsp;&nbsp;Настройки профиля
                </a>
              </li>
              <li>
                <? $url = Url::toRoute(['user/password']);?>
                <a href="<?=$url;?>">
                  <i class="fa fa-cogs"></i> 
                  &nbsp;&nbsp;Настройки пароля
                </a>
              </li>
              <li class="divider"></li>
              <li>
                <a href="./account-login.html">
                  <i class="fa fa-sign-out"></i> 
                  &nbsp;&nbsp;Logout
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
        </div> <!-- /.container -->
    </header>
    <div class="mainnav ">
        <div class="container">
            <a class="mainnav-toggle" data-toggle="collapse" data-target=".mainnav-collapse">
                <span class="sr-only">Toggle navigation</span>
                <i class="fa fa-bars"></i>
            </a>
            <nav class="collapse mainnav-collapse" role="navigation">
            <!-- <form class="mainnav-form" role="search">
              <input type="text" class="form-control input-md mainnav-search-query" placeholder="Search">
              <button class="btn btn-sm mainnav-form-btn"><i class="fa fa-search"></i></button>
            </form> -->
            <ul class="mainnav-menu">
                <li class="dropdown active">
                    <a href="./index.html" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown">
                        Панель управления
                        <i class="mainnav-caret"></i>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <li>
                            <? $url = Url::toRoute(['projects/index']);?>
                            <a href="<?=$url;?>">
                            <i class="fa fa-dashboard dropdown-icon "></i> 
                            Проекты
                            </a>
                        </li>
                        <li>
                            <? $url = Url::toRoute(['compaings/index']);?>
                            <a href="<?=$url;?>">
                            <i class="fa fa-dashboard dropdown-icon "></i> 
                            Компании
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div> <!-- /.container -->
</div> <!-- /.mainnav -->
    

<div class="content">
        <div class="container">
            <?= $content ?>
        </div> <!-- /.container -->
    </div> <!-- .content -->
</div> <!-- /#wrapper -->

<footer class="footer">
    <div class="container">
        <p class="pull-left">Copyright &copy; 2013-15 Jumpstart Themes.</p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
