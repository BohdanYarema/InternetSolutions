<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
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
					<div class="col-sm-7">
						<div class="widget widget-contact">
							<ul>
								<li>    
									<i class="mt-icon-telephone1"></i>
									<span class="hidden-xs">208-290-4995</span>
									<a class="visible-xs-inline" href="tel:2082904995">208-290-4995</a>
								</li>
								<li>
									<i class="mt-icon-mail"></i>
									<a href="mailto:contact@dakota.com">contact@dakota.com</a>
								</li>
							</ul>
						</div><!-- widget-contact -->
					</div><!-- col -->
					<div class="col-sm-5">
						<div class="widget widget-social">		
								<div class="social-media">
									<a class="facebook" href="#"><i class="mt-icon-facebook"></i></a>
									<a class="twitter" href="#"><i class="mt-icon-twitter"></i></a>
									<a class="google" href="#"><i class="mt-icon-google-plus"></i></a>
									<a class="pinterest" href="#"><i class="mt-icon-pinterest"></i></a>
									<a class="youtube" href="#"><i class="mt-icon-youtube-play"></i></a>                                    
								</div><!-- social-media -->    
							</div><!-- widget-social -->
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
								<a href="index.html">
									<img src="/basic/web/themes/assets/images/logo.png" alt="">
								</a>
							</div><!-- logo -->
						</div><!-- col -->
						<div class="col-sm-9">
							<!-- MENU --> 
							<nav>
								<a id="mobile-menu-button" href="#"><i class="mt-icon-menu"></i></a>
												 
								<ul class="menu clearfix" id="menu">
									<li class="dropdown active">
										<a href="index.html">Home</a>
										<ul>
											<li><a href="index.html">Home version 1</a></li>
											<li><a href="index-2.html">Home version 2</a></li>
											<li><a href="index-3.html">Home version 3</a></li>
										</ul>
									</li>
									<li class="dropdown">
										<a href="#">Pages</a>
										<ul>
											<li><a href="about-us.html">About us</a></li>
											<li><a href="about-me.html">About me</a></li>
											<li><a href="services.html">Services</a></li>
											<li><a href="single-service.html">Single service</a></li>
											<li class="dropdown">
												<a href="#">Special pages</a>
												<ul>
													<li><a href="error-404.html">Error 404</a></li>
													<li><a href="maintenance.html">Maintenance</a></li>
													<li><a href="comming-soon.html">Comming soon</a></li>
													<li><a href="faq.html">FAQ</a></li>
												</ul>
											</li>
											<li class="dropdown">
												<a href="#">Samples pages</a>
												<ul>
													<li><a href="no-sidebar.html">No sidebar</a></li>
													<li><a href="right-sidebar.html">Right sidebar</a></li>
													<li><a href="left-sidebar.html">Left sidebar</a></li>
													<li><a href="fluid-page.html">Fluid page</a></li>
													<li><a href="boxed-page.html">Boxed page</a></li>
												</ul>
											</li>
										</ul>
									</li>
									<li class="dropdown">
										<a href="portfolio-classic.html">Portfolio</a>
										<ul>
											<li class="dropdown">
												<a href="#">Portfolio pagination</a>
												<ul>
													<li><a href="portfolio-pagination-3-cols-no-gutter.html">3 cols (no gutter)</a></li>
													<li><a href="portfolio-pagination-3-cols-gutter.html">3 cols (gutter)</a></li>
													<li><a href="portfolio-pagination-3-cols-titles.html">3 cols (titles)</a></li>
													<li><a href="portfolio-pagination-3-cols-gutter-titles.html">3 cols (gutter &amp; titles)</a></li>
													<li><a href="portfolio-pagination-4-cols-no-gutter.html">4 cols (no gutter)</a></li>
													<li><a href="portfolio-pagination-4-cols-gutter.html">4 cols (gutter)</a></li>
													<li><a href="portfolio-pagination-4-cols-titles.html">4 cols (titles)</a></li>
													<li><a href="portfolio-pagination-4-cols-gutter-titles.html">4 cols (gutter &amp; titles)</a></li>
												</ul>
											</li>
											<li class="dropdown">
												<a href="#">Portfolio filter</a>
												<ul>
													<li><a href="portfolio-filter-3-cols-no-gutter.html">3 cols (no gutter)</a></li>
													<li><a href="portfolio-filter-3-cols-gutter.html">3 cols (gutter)</a></li>
													<li><a href="portfolio-filter-3-cols-titles.html">3 cols (titles)</a></li>
													<li><a href="portfolio-filter-3-cols-gutter-titles.html">3 cols (gutter &amp; titles)</a></li>
													<li><a href="portfolio-filter-4-cols-no-gutter.html">4 cols (no gutter)</a></li>
													<li><a href="portfolio-filter-4-cols-gutter.html">4 cols (gutter)</a></li>
													<li><a href="portfolio-filter-4-cols-titles.html">4 cols (titles)</a></li>
													<li><a href="portfolio-filter-4-cols-gutter-titles.html">4 cols (gutter &amp; titles)</a></li>
												</ul>
											</li>
											<li class="dropdown">
												<a href="#">Portfolio fullwidth</a>
												<ul>
													<li><a href="portfolio-fullwidth-4-cols-no-gutter.html">4 cols (no gutter)</a></li>
													<li><a href="portfolio-fullwidth-4-cols-gutter.html">4 cols (gutter)</a></li>
													<li><a href="portfolio-fullwidth-4-cols-titles.html">4 cols (titles)</a></li>
													<li><a href="portfolio-fullwidth-4-cols-gutter-titles.html">4 cols (gutter &amp; titles)</a></li>
													<li><a href="portfolio-fullwidth-5-cols-no-gutter.html">5 cols (no gutter)</a></li>
													<li><a href="portfolio-fullwidth-5-cols-gutter.html">5 cols (gutter)</a></li>
													<li><a href="portfolio-fullwidth-5-cols-titles.html">5 cols (titles)</a></li>
													<li><a href="portfolio-fullwidth-5-cols-gutter-titles.html">5 cols (gutter &amp; titles)</a></li>
												</ul>
											</li>
											<li class="dropdown">
												<a href="#">Portfolio masonry</a>
												<ul>
													<li><a href="portfolio-masonry-3-cols-no-gutter.html">3 cols (no gutter)</a></li>
													<li><a href="portfolio-masonry-3-cols-gutter.html">3 cols (gutter)</a></li>
													<li><a href="portfolio-masonry-3-cols-titles.html">3 cols (titles)</a></li>
													<li><a href="portfolio-masonry-3-cols-gutter-titles.html">3 cols (gutter &amp; titles)</a></li>
													<li><a href="portfolio-masonry-4-cols-no-gutter.html">4 cols (no gutter)</a></li>
													<li><a href="portfolio-masonry-4-cols-gutter.html">4 cols (gutter)</a></li>
													<li><a href="portfolio-masonry-4-cols-titles.html">4 cols (titles)</a></li>
													<li><a href="portfolio-masonry-4-cols-gutter-titles.html">4 cols (gutter &amp; titles)</a></li>
												</ul>
											</li>
											<li class="dropdown">
												<a href="#">Portfolio fullwidth masonry</a>
												<ul>
													<li><a href="portfolio-fullwidth-masonry-4-cols-no-gutter.html">4 cols (no gutter)</a></li>
													<li><a href="portfolio-fullwidth-masonry-4-cols-gutter.html">4 cols (gutter)</a></li>
													<li><a href="portfolio-fullwidth-masonry-4-cols-titles.html">4 cols (titles)</a></li>
													<li><a href="portfolio-fullwidth-masonry-4-cols-gutter-titles.html">4 cols (gutter &amp; titles)</a></li>
													<li><a href="portfolio-fullwidth-masonry-5-cols-no-gutter.html">5 cols (no gutter)</a></li>
													<li><a href="portfolio-fullwidth-masonry-5-cols-gutter.html">5 cols (gutter)</a></li>
													<li><a href="portfolio-fullwidth-masonry-5-cols-titles.html">5 cols (titles)</a></li>
													<li><a href="portfolio-fullwidth-masonry-5-cols-gutter-titles.html">5 cols (gutter &amp; titles)</a></li>
												</ul>
											</li>
											<li><a href="portfolio-classic.html">Portfolio classic</a></li>
											<li><a href="portfolio-single.html">Portfolio single</a></li>
										</ul>
									</li>
									<li class="dropdown">
										<a href="#">Blog</a>
										<ul>
											<li class="dropdown">
												<a href="#">Blog 1 col</a>
												<ul>
													<li><a href="blog-1-col-right-sidebar.html">Blog right sidebar</a></li>
													<li><a href="blog-1-col-left-sidebar.html">Blog left sidebar</a></li>
													<li><a href="blog-1-col-no-sidebar.html">Blog no sidebar</a></li>
												</ul>
											</li>
											<li class="dropdown">
												<a href="#">Blog 2 cols</a>
												<ul>
													<li><a href="blog-2-cols-right-sidebar.html">Blog right sidebar</a></li>
													<li><a href="blog-2-cols-left-sidebar.html">Blog left sidebar</a></li>
													<li><a href="blog-2-cols-no-sidebar.html">Blog no sidebar</a></li>
												</ul>
											</li>
											<li class="dropdown">
												<a href="#">Blog masonry</a>
												<ul>
													<li><a href="blog-masonry-right-sidebar.html">Blog right sidebar</a></li>
													<li><a href="blog-masonry-left-sidebar.html">Blog left sidebar</a></li>
													<li><a href="blog-masonry-no-sidebar.html">Blog no sidebar</a></li>
												</ul>
											</li>
											<li class="dropdown">
												<a href="#">Blog post</a>
												<ul>
													<li><a href="blog-post-right-sidebar.html">Blog post right sidebar</a></li>
													<li><a href="blog-post-left-sidebar.html">Blog post left sidebar</a></li>
													<li><a href="blog-post-no-sidebar.html">Blog post no sidebar</a></li>
												</ul>
											</li>
										</ul>
									</li>
									<li class="dropdown">
										<a href="contact.html">Contact</a>
										<ul>
											<li><a href="contact.html">Contact 1</a></li>
											<li><a href="contact-2.html">Contact 2</a></li>
										</ul>
									</li>
									<li class="megamenu">
										<a href="#">Shortcodes</a>
										<div class="megamenu-container col-4">
											<div class="section">
												
												<ul>
													<li><a href="shortcodes-grid.html">Grid</a></li>
													<li><a href="shortcodes-typography.html">Typography</a></li>
													<li><a href="shortcodes-lists.html">Lists</a></li>
													<li><a href="shortcodes-headlines.html">Headlines</a></li>
													<li><a href="shortcodes-tables.html">Tables</a></li>
													<li><a href="shortcodes-forms.html">Forms</a></li>
													<li><a href="shortcodes-buttons.html">Buttons</a></li>
													<li><a href="shortcodes-dividers.html">Dividers</a></li>
													<li><a href="shortcodes-icons-pack.html">Icons pack</a></li>
												</ul>
												
											</div>
											<div class="section">
												
												<ul>
													<li><a href="shortcodes-alerts.html">Alerts</a></li>
													<li><a href="shortcodes-text-boxes.html">Text boxes</a></li>
													<li><a href="shortcodes-image-boxes.html">Image boxes</a></li>
													<li><a href="shortcodes-services-boxes.html">Services boxes</a></li>
													<li><a href="shortcodes-process-steps.html">Process steps</a></li>
													<li><a href="shortcodes-pricing-plans.html">Pricing plans</a></li>
													<li><a href="shortcodes-team.html">Team</a></li>
													<li><a href="shortcodes-testimonials.html">Testimonials</a></li>
													<li><a href="shortcodes-widgets.html">Widgets</a></li>
												</ul>
												
											</div>
											<div class="section">
												
												<ul>
													<li><a href="shortcodes-accordions.html">Accordions</a></li>
													<li><a href="shortcodes-tabs.html">Tabs</a></li>
													<li><a href="shortcodes-maps.html">Maps</a></li>
													<li><a href="shortcodes-clients.html">Clients</a></li>
													<li><a href="shortcodes-galleries.html">Galleries</a></li>
													<li><a href="shortcodes-media-content.html">Media content</a></li>
													<li><a href="shortcodes-social-media.html">Social media</a></li>
													<li><a href="shortcodes-filters.html">Filters</a></li>
													<li><a href="shortcodes-paginations.html">Paginations</a></li>
												</ul>
												
											</div>
											<div class="section">
												
												<ul>
													<li><a href="shortcodes-counters.html">Counters</a></li>
													<li><a href="shortcodes-pie-charts.html">Pie charts</a></li>
													<li><a href="shortcodes-progress-bars.html">Progress bars</a></li>
													<li><a href="shortcodes-comparition-bars.html">Comparison bars</a></li>
													<li><a href="shortcodes-statistics.html">Statistics</a></li>
													<li><a href="shortcodes-sliders.html">Sliders</a></li>
													<li><a href="shortcodes-full-sections.html">Full sections</a></li>
													<li><a href="shortcodes-parallax-backgrounds.html">Parallax backgrounds</a></li>
													<li><a href="shortcodes-video-backgrounds.html">Video backgrounds</a></li>
												</ul>
												
											</div>
										</div>
									</li>
									<li class="search">
										
										<a class="hidden-xs hidden-sm" href="#"><i class="mt-icon-search"></i></a>
										
										<div id="search-form-container">
                        
											<form id="search-form" action="#">
												<input id="search" type="search" name="search" placeholder="Enter keywords...">
												<input id="search-submit" type="submit" value="">
											</form>
											
										</div><!-- search-form-container -->
									
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
									<p>Dakota &copy; 2015. All Rights Reserved</p>
								</div>
							</div><!-- widget-text -->
						</div><!-- col -->
						<div class="col-sm-8">
							<div class="widget widget-pages">
								<ul>
									<li><a href="#">Home</a></li>
									<li><a href="#">About</a></li>
									<li><a href="#">Services</a></li>
									<li><a href="#">Portfolio</a></li>
									<li><a href="#">Blog</a></li>
									<li><a href="#">Contact</a></li>
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
