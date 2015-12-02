<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';


    public $css = [
        /*'css/site.css',*/
        /*FONTS*/
        "http://fonts.googleapis.com/css?family=Roboto:400,400italic,300italic,300,500,500italic,700,700italic",
        /*BOOTSTRAP CSS*/
        "themes/assets/bootstrap/css/bootstrap.min.css",
        /*bootstrap dashboard*/
        //"themes/assets/css/dashboard.css",
        /* MT ICONS FONT */
        "themes/assets/fonts/mt-icons/mt-icons.css",
        /* FANCYBOX */
        "themes/assets/plugins/fancybox/jquery.fancybox.css",
        /* REVOLUTION SLIDER */
        "themes/assets/plugins/revolutionslider/css/settings.css",
        /* OWL Carousel */
        "themes/assets/plugins/owl-carousel/owl.carousel.css",
        "themes/assets/plugins/owl-carousel/owl.transitions.css",
        /* YOUTUBE PLAYER */
        "themes/assets/plugins/ytplayer/css/jquery.mb.YTPlayer.min.css",
        /* ANIMATIONS */
        "themes/assets/plugins/animations/animate.min.css",
        /* CUSTOM & PAGES STYLE */
        "themes/assets/css/custom.css",
        "themes/assets/css/pages-style.css",
    ];
    public $js = [
        /*jquery*/
        'themes/assets/plugins/jquery/jquery-2.1.4.min.js',
        /*bootstrap js*/
        'themes/assets/bootstrap/js/bootstrap.min.js',
        /*viewport*/
        'themes/assets/plugins/viewport/jquery.viewport.js',
        /*menu*/
        'themes/assets/plugins/menu/hoverIntent.js',
        'themes/assets/plugins/menu/superfish.js',
        /*fancybox js*/
        'themes/assets/plugins/fancybox/jquery.fancybox.pack.js',
        /*resolution slider*/
        'themes/assets/plugins/revolutionslider/js/jquery.themepunch.tools.min.js',
        'themes/assets/plugins/revolutionslider/js/jquery.themepunch.revolution.min.js',
        /*owl carousel*/
        'themes/assets/plugins/owl-carousel/owl.carousel.min.js',
        /*paralax*/
        'themes/assets/plugins/parallax/jquery.stellar.min.js',
        /*isotope*/
        'themes/assets/plugins/isotope/imagesloaded.pkgd.min.js',
        'themes/assets/plugins/isotope/isotope.pkgd.min.js',
        /*placeholder*/
        'themes/assets/plugins/placeholders/jquery.placeholder.min.js',
        /*CONTACT FORM VALIDATE & SUBMIT*/
        'themes/assets/plugins/validate/jquery.validate.min.js',
        'themes/assets/plugins/submit/jquery.form.min.js',
        /*google maps*/
        'http://maps.google.com/maps/api/js?sensor=false',
        'themes/assets/plugins/googlemaps/gmap3.min.js',
        /*charts*/
        'themes/assets/plugins/charts/jquery.easypiechart.min.js',
        /*counter*/
        'themes/assets/plugins/counter/jQuerySimpleCounter.js',
        /*statistic*/
        'themes/assets/plugins/statistics/chart.min.js',
        /*youtube player*/
        'themes/assets/plugins/ytplayer/jquery.mb.YTPlayer.min.js',
        /*instafeed*/
        'themes/assets/plugins/instafeed/instafeed.min.js',
        /*animations*/
        'themes/assets/plugins/animations/wow.min.js',
        /*countdown*/
        'themes/assets/plugins/countdown/jquery.countdown.min.js',
        /*custom js*/
        'themes/assets/js/custom.js',
        /*assets bootstrap*/
        'themes/assets/js/docs.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        //'yii\bootstrap\BootstrapAsset',
    ];
}
