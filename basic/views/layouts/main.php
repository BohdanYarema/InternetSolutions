<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
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

<div id="page-wrapper">
	<!-- HEADER -->
		<header>	
			<div id="header-top">
				<div class="container">
					<div class="row">
						<div class="col-sm-8">
							<div class="widget widget-contact">
								<ul>
									<li>    
										<i class="mt-icon-telephone1"></i>
										<span class="hidden-xs">+38(044) 578 20 24</span>
										<a class="visible-xs-inline" href="tel:+38(044) 578 20 24">+38(044) 578 20 24</a>
									</li>
									<li>
										<i class="mt-icon-mail"></i>
										<a href="mailto:info@insol.in.ua">info@insol.in.ua</a>
									</li>
								</ul>
							</div><!-- widget-contact -->
						</div><!-- col -->
						<div class="col-sm-4">
							<div class="widget widget-contact">
								<ul>
									<li>    
										<? $url = Url::toRoute(['site/login']);?>
										<a href="<?=$url;?>" data-method="post">ВХОД В КАБИНЕТ</a>
									</li>
									<li>    
										<? $url = Url::toRoute(['site/logout']);?>
										<a href="<?=$url;?>" data-method="post">ВЫХОД (<? echo Yii::$app->user->identity->username;?>)</a>
									</li>
									<li>
										<? $url = Url::toRoute(['site/registration']);?>
										<a href="<?=$url;?>">РЕГИСТРАЦИЯ</a>
									</li>
								</ul>
							</div><!-- widget-contact-registration -->
						</div><!-- col -->
					</div><!-- row -->
				</div><!-- container -->  	
			</div><!-- header-top -->
			<div id="header">
				<div class="container">
					<div class="row">
						<div class="col-sm-3">
							<!-- LOGO -->
							<div id="logo">
								<? $url = Url::toRoute(['site/index']);?>
								<a href="<?=$url;?>">
									<img src="/basic/web/themes/images/Insol_logo.png" alt="">
								</a>
							</div><!-- logo -->
						</div><!-- col -->
						<div class="col-sm-9">
							<!-- MENU --> 
							<nav>
								<a id="mobile-menu-button" href="#"><i class="mt-icon-menu"></i></a>
												 
								<ul class="menu clearfix" id="menu">
									<li class="active">
										<? $url = Url::toRoute(['site/index']);?>
										<a href="<?=$url;?>">Главная</a>
									</li>
									<li>
										<? $url = Url::toRoute(['site/index']);?>
										<a href="<?=$url;?>">Преимущества</a>
									</li>
									<li>
										<? $url = Url::toRoute(['site/index']);?>
										<a href="<?=$url;?>">Как это работает</a>
									</li>
									<li>
										<? $url = Url::toRoute(['site/index']);?>
										<a href="<?=$url;?>">FAQ</a>
									</li>
									<li>
										<? $url = Url::toRoute(['site/index']);?>
										<a href="<?=$url;?>">Написать нам</a>
									</li>
									<li>
										<? $url = Url::toRoute(['site/index']);?>
										<a href="<?=$url;?>">О проекте</a>
									</li>
								</ul>
							</nav>
						</div><!-- col -->
					</div><!-- row -->
				</div><!-- container -->    	
			</div><!-- header -->
	</header><!-- HEADER -->
        <?= $content ?>
        <!-- FOOTER -->
    <footer>
			<div id="footer-bottom">	
				<div class="container">
					<div class="row">
						<div class="col-sm-4">
							<div class="widget widget-text">	
								<div>
									<p>InSol &copy; 2015. Все права защищены</p>
								</div>
							</div><!-- widget-text -->
						</div><!-- col -->
						<div class="col-sm-8">
							<div class="widget widget-pages">
								<ul>
									<li><a href="#">Главная</a></li>
									<li><a href="#">Преимущества</a></li>
									<li><a href="#">Как это работает</a></li>
									<li><a href="#">Faq</a></li>
									<li><a href="#">Написать нам</a></li>
									<li><a href="#">О проекте</a></li>
								</ul>
							</div><!-- widget-pages -->	
						</div><!-- col -->
					</div><!-- row -->
				</div><!-- container -->
			</div><!-- footer-bottom -->
    </footer><!-- FOOTER -->
</div><!-- PAGE-WRAPPER -->
<!-- GO TOP -->
<a id="go-top"><i class="mt-icon-arrow-up2"></i></a>
 
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
