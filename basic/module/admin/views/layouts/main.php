<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\ModuleAsset_admin;

ModuleAsset_admin::register($this);
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
    <header id="header" class="clearfix" data-spy="affix" data-offset-top="65">
        <ul class="header-inner">
            
            <!-- Logo -->
            <li class="logo">
                <a href=""><img src="/basic/web/themes_admin/img/logo.png" alt=""></a>
                <div id="menu-trigger"><i class="zmdi zmdi-menu"></i></div>
            </li>
            
            <!-- Search -->
            <li class="top-search">
                <input class="ts-input" placeholder="Search..." type="text">
                
                <i class="ts-reset zmdi zmdi-close"></i>
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
                    <img src="/basic/web/themes/images/admiral.jpg" alt="">
    
                    <span class="f-11">
                        <span class="d-block"><?echo Yii::$app->user->identity['u_snp'];?></span>
                        <small class="text-lowercase"><?echo Yii::$app->user->identity['username'];?></small>
                    </span>
                </a>
                <!-- <ul>
                    <li><a href="">View Profile</a></li>
                    <li><a href="">Privacy Settings</a></li>
                    <li><a href="">Settings</a></li>
                    <li><a href="">Logout</a></li>
                </ul> -->
            </li>
            <? $url = Url::toRoute(['/admin']);?>
            <li class="active">
                <a href="<?=$url;?>">
                    <i class="zmdi zmdi-home"></i>
                    <span>Home</span>
                </a>
            </li>
            <? $url = Url::toRoute(['user/index']);?>
            <li>
                <a href="<?=$url;?>">
                    <i class="zmdi zmdi-format-underlined"></i>
                    <span>Клиенты</span>
                </a>
            </li>
            <? $url = Url::toRoute(['projects/index']);?>
            <li>
                <a href="<?=$url;?>">
                    <i class="zmdi zmdi-format-underlined"></i>
                    <span>Проэкты</span>
                </a>
            </li>
            <? $url = Url::toRoute(['compaings/index']);?>
            <li>
                <a href="<?=$url;?>">
                    <i class="zmdi zmdi-format-underlined"></i>
                    <span>Компании</span>
                </a>
            </li>
            <? $url = Url::toRoute(['spheres/index']);?>
            <li>
                <a href="<?=$url;?>">
                    <i class="zmdi zmdi-format-underlined"></i>
                    <span>Сферы деятельности</span>
                </a>
            </li>
            <? $url = Url::toRoute(['logs/index']);?>
            <li>
                <a href="<?=$url;?>">
                    <i class="zmdi zmdi-format-underlined"></i>
                    <span>Логи</span>
                </a>
            </li>
        </ul>
    </aside>

    <section id="content">
        <div class="container">
            <?= $content ?>
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
    
    <!-- Older IE Warning Message -->
    <!--[if lt IE 9]>
        <div class="ie-warning">
            <h1 class="c-white">Warning!!</h1>
            <p>You are using an outdated version of Internet Explorer, please upgrade <br/>to any of the following web browsers to access this website.</p>
            <div class="iew-container">
                <ul class="iew-download">
                    <li>
                        <a href="http://www.google.com/chrome/">
                            <img src="img/browsers/chrome.png" alt="">
                            <div>Chrome</div>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.mozilla.org/en-US/firefox/new/">
                            <img src="img/browsers/firefox.png" alt="">
                            <div>Firefox</div>
                        </a>
                    </li>
                    <li>
                        <a href="http://www.opera.com">
                            <img src="img/browsers/opera.png" alt="">
                            <div>Opera</div>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.apple.com/safari/">
                            <img src="img/browsers/safari.png" alt="">
                            <div>Safari</div>
                        </a>
                    </li>
                    <li>
                        <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                            <img src="img/browsers/ie.png" alt="">
                            <div>IE (New)</div>
                        </a>
                    </li>
                </ul>
            </div>
            <p>Sorry for the inconvenience!</p>
        </div>   
    <![endif]-->

    <!-- Placeholder for IE9 -->
    <!--[if IE 9 ]>
        <script src="vendors/bower_components/jquery-placeholder/jquery.placeholder.min.js"></script>
    <![endif]-->
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
