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
class ModuleAsset_profile extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';


    public $css = [
        "https://fonts.googleapis.com/css?family=Open+Sans:400,400italic,600,600italic,800,800italic",
        "https://fonts.googleapis.com/css?family=Oswald:400,300,700",
        "themes_profile/bower_components/fontawesome/css/font-awesome.min.css",
        "themes_profile/bower_components/bootstrap/dist/css/bootstrap.min.css",
        "themes_profile/css/mvpready-admin.css"
    ];
    public $js = [
        "themes_profile/bower_components/bootstrap/dist/js/bootstrap.min.js",
        "themes_profile/bower_components/slimscroll/jquery.slimscroll.min.js",
        "themes_profile/bower_components/flot/excanvas.min.js",
        /*"themes_profile/bower_components/flot/jquery.flot.js",
        "themes_profile/bower_components/flot/jquery.flot.pie.js",
        "themes_profile/bower_components/flot/jquery.flot.resize.js",
        "themes_profile/bower_components/flot/jquery.flot.time.js",
        "themes_profile/bower_components/flot.tooltip/js/jquery.flot.tooltip.js",
        "themes_profile/global/js/mvpready-core.js",
        "themes_profile/global/js/mvpready-helpers.js",
        "themes_profile/js/mvpready-admin.js",
        "themes_profile/global/js/demos/flot/line.js",
        "themes_profile/global/js/demos/flot/pie.js",
        "themes_profile/global/js/demos/flot/auto.js"*/
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
