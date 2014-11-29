<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace yii\web;

class GiftBoogleAsset extends AssetBundle
{
    public $sourcePath = '@vendor/yiisoft';
    public $js = [
        'facebookGrid.js',
        'giftboogle.js',
    ];
    public $css = [
        'css/site.css',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
    
}
