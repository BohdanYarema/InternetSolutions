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
class ModuleAsset extends AssetBundle
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
        "themes/assets/css/dashboard.css",
    ];
    public $js = [
        /*bootstrap js*/
        'themes/assets/bootstrap/js/bootstrap.min.js',
        /*viewport*/
        /*assets bootstrap*/
        'themes/assets/js/docs.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
