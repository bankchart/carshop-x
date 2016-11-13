<?php
/**
 * Created by PhpStorm.
 * User: bankchart
 * Date: 6/10/2559
 * Time: 20:11 น.
 */

namespace frontend\assets;

use yii\web\AssetBundle;
class Carshop extends AssetBundle
{
    public $sourcePath = '@vendor/car-shop';
//    public $basePath = '@webroot';
//    public $baseUrl = '@web';
    public $css = [
        'custom.css',
        'themes/bootshop/bootstrap.min.css',
        'themes/css/base.css',
        'themes/css/bootstrap-responsive.min.css',
        'themes/css/font-awesome.css',
        'themes/js/google-code-prettify/prettify.css',
        'themes/switch/themeswitch.css'
    ];
    public $js = [
       // 'themes/js/jquery.js',
        'themes/js/bootstrap.min.js',
        'themes/js/google-code-prettify/prettify.js',
        'themes/js/bootshop.js',
        'themes/js/jquery.lightbox-0.5.js',
        'themes/switch/theamswitcher.js',
        'themes/js/script.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
//        'yii\bootstrap\BootstrapAsset',
    ];
}