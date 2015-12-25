<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\ModuleAsset;

ModuleAsset::register($this);
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
    <body>

    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <? $url = Url::toRoute(['/profile']);?>
                <a class="navbar-brand" href="<?=$url;?>">Кабинет(<?echo Yii::$app->user->identity['u_company'];?>)</a>
                <? $url = Url::toRoute(['/site/index']);?>
                <a class="navbar-brand" href="<?=$url;?>" target="_blank">На главную сайта</a>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-3 col-md-2 sidebar">
                <div class="placeholder">
                    <img src="/basic/web/themes/images/admiral.jpg" class="img-responsive" alt="200x200">
                    <h4><? echo Yii::$app->user->identity->u_snp; ?></h4>
                    <h5 style="word-wrap: break-word;" class="text-muted"><?echo Yii::$app->user->identity['username'];?></h5>
                </div>
                <div class="clearfix"></div>
                <ul class="nav nav-sidebar">
                    <? $url = Url::toRoute(['projects/index']);?>
                    <li class="clicks"><a href="<?=$url;?>">Проэкты</a></li>
                    <? $url = Url::toRoute(['compaings/index']);?>
                    <!-- <li class="clicks"><a href="<?=$url;?>">Компании</a></li>
                    <? $url = Url::toRoute(['spheres/index']);?> -->
                </ul>
            </div>
            <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                <?= $content ?>
            </div>
        </div>
    </div>
</body>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
