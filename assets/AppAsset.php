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
        'libs/font-awesome-4.1.0/css/font-awesome.css',
        'libs/DataTables-1.10.0/media/css/jquery.dataTables.css',
        'libs/DataTables-1.10.0/examples/resources/syntax/shCore.css',
        'css/site.css',
    ];
    public $js = [
            'libs/DataTables-1.10.0/media/js/jquery.dataTables.js',
            'libs/handlebars-v1.3.0.js',
            'js/dutests.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}
