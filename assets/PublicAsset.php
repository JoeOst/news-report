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
class PublicAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'public/css/bootstrap.css',
        'public/css/book-main.css',
        'public/ui/jquery-ui.css',
    ];
    public $js = [
        "assets/73d6f996/jquery.js",
        "public/js/bootstrap.js",
        'public/ui/jquery-ui.js',
        "public/js/blog-home.js",
        "public/js/search.js",
        "public/js/subscribe.js",
        "public/js/closePage.js",
        "public/js/plus_minus.js",
        "public/js/forViewed.js",
    ];
    public $depends = [

    ];
}