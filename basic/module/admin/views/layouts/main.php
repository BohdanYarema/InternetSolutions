<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\ModuleAsset_admin;
use app\components\FlashWidget;

ModuleAsset_admin::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="/basic/web/favicon.ico" type="image/x-icon">
    <?= Html::csrfMetaTags() ?><?php $this->beginPage() ?><?php $this->beginPage() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
 <style type="text/css">
        .bootgrid-table th {
            overflow: hidden;
            -ms-text-overflow: ellipsis;
            -o-text-overflow: ellipsis;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
    </style>
<body>
<?php $this->beginBody() ?>
    <header id="header" class="clearfix" data-spy="affix" data-offset-top="65">
        <ul class="header-inner">
            
            <!-- Logo -->
            <li class="logo">
                <a href=""><img src="/themes_admin/img/logo.png" alt=""></a>
                <div id="menu-trigger"><i class="zmdi zmdi-menu"></i></div>
            </li>

            <!-- Time -->
            <li class="pull-right hidden-xs">
                <div id="time">
                    <span id="t-hours"></span>
                    <span id="t-min"></span>
                    <span id="t-sec"></span>
                </div>
            </li>
        </ul>
    </header>

    <aside id="sidebar">
        <!--| MAIN MENU |-->
        <ul class="side-menu">
            <li class="sm-sub sms-profile">
                <a class="clearfix" href="">
                    <img src="/themes/images/admiral.jpg" alt="">
    
                    <span class="f-11">
                        <span class="d-block"><?echo Yii::$app->user->identity['u_snp'];?></span>
                        <small class="text-lowercase"><?echo Yii::$app->user->identity['username'];?></small>
                    </span>
                </a>
            </li>
            <? $url = Url::toRoute(['/admin/default']);?>
            <li>
                <a href="<?=$url;?>">
                    <i class="zmdi zmdi-home"></i>
                    <span>Home</span>
                </a>
            </li>
            <? $url = Url::toRoute(['user/index']);?>
            <li>
                <a href="<?=$url;?>">
                    <i class="zmdi zmdi-accounts zmdi-hc-fw"></i>
                    <span>Клиенты</span>
                </a>
            </li>
            <? $url = Url::toRoute(['projects/index']);?>
            <li>
                <a href="<?=$url;?>">
                    <i class="zmdi zmdi-folder-person zmdi-hc-fw"></i>
                    <span>Проекты</span>
                </a>
            </li>
            <? $url = Url::toRoute(['campaigns/index']);?>
            <li>
                <a href="<?=$url;?>">
                    <i class="zmdi zmdi-folder-person zmdi-hc-fw"></i>
                    <span>Кампании</span>
                </a>
            </li>
            <? $url = Url::toRoute(['spheres/index']);?>
            <li>
                <a href="<?=$url;?>">
                    <i class="zmdi zmdi-arrows zmdi-hc-fw"></i>
                    <span>Сферы деятельности</span>
                </a>
            </li>
            <? $url = Url::toRoute(['auth_assignment/index']);?>
            <li>
                <a href="<?=$url;?>">
                    <i class="zmdi zmdi-account-box zmdi-hc-fw"></i>
                    <span>Установка прав доступа</span>
                </a>
            </li>
            <? $url = Url::toRoute(['logs/index']);?>
            <li>
                <a href="<?=$url;?>">
                    <i class="zmdi zmdi-desktop-mac zmdi-hc-fw"></i>
                    <span>Логи</span>
                </a>
            </li>
            <? $url = Url::toRoute(['analytics/index']);?>
            <li>
                <a href="<?=$url;?>">
                    <i class="zmdi zmdi-trending-up"></i>
                    <span>Аналитика</span>
                </a>
            </li>
        </ul>
    </aside>

    <section id="content">
        <div class="container">
            <?= $content ?>
            <?
              $data = Yii::$app->session->getAllFlashes();    
              if ($data) {
                  echo FlashWidget::widget(['data' => $data]);
              }
            ?>
        </div>        
    </section>

    <footer id="footer">
        Copyright © 2015 SuperFlat Admin
        
        <ul class="f-menu">
            <li><a href="">Home</a></li>
            <li><a href="">Dashboard</a></li>
            <li><a href="">Reports</a></li>
            <li><a href="">Support</a></li>
            <li><a href="">Contact</a></li>
        </ul>
    </footer>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
