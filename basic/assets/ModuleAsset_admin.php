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
class ModuleAsset_admin extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';


    public $css = [
        //"themes_admin/",
        "themes_admin/css/app.min.css",
        "themes_admin/vendors/bower_components/animate.css/animate.min.css",
        "themes_admin/vendors/bower_components/material-design-iconic-font/dist/css/material-design-iconic-font.min.css",
        "themes_admin/vendors/bower_components/fullcalendar/dist/fullcalendar.min.css",
        "themes_admin/vendors/bower_components/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css",
    ];
    public $js = [
        "themes_admin/vendors/bower_components/jquery/dist/jquery.min.js",
        "themes_admin/vendors/bower_components/bootstrap/dist/js/bootstrap.min.js",
        
        "themes_admin/vendors/bower_components/flot/jquery.flot.js",
        "themes_admin/vendors/bower_components/flot/jquery.flot.resize.js",
        "themes_admin/vendors/bower_components/flot-orderBars/js/jquery.flot.orderBars.js",
        "themes_admin/vendors/bower_components/flot.curvedlines/curvedLines.js",                         
        "themes_admin/vendors/bower_components/flot-orderBars/js/jquery.flot.orderBars.js",
        "themes_admin/vendors/bower_components/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js",
        "themes_admin/vendors/sparklines/jquery.sparkline.min.js",
        "themes_admin/vendors/bower_components/jquery.easy-pie-chart/dist/jquery.easypiechart.min.js",

        "themes_admin/vendors/bootstrap-growl/bootstrap-growl.min.js",
        "themes_admin/vendors/bower_components/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js",
        "themes_admin/vendors/bower_components/moment/min/moment.min.js",
        "themes_admin/vendors/bower_components/fullcalendar/dist/fullcalendar.min.js ",

        "themes_admin/js/flot-charts/curved-line-chart.js",
        "themes_admin/js/flot-charts/bar-chart.js",
        "themes_admin/js/charts.js",    
        "themes_admin/js/functions.js",
        "themes_admin/js/demo.js",
    ];
    public $depends = [
        'yii\web\YiiAsset',
        //'yii\bootstrap\BootstrapAsset',
    ];
}
