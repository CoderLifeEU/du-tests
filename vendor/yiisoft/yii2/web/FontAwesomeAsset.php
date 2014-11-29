<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace yii\web;

class FontAwesomeAsset extends AssetBundle
{
    public $sourcePath = '@vendor/yiisoft';
    public $css = [
        'font-awesome.css',
    ];
    /*public $depends = [
        'yii\web\JqueryAsset',
    ];*/
    
}