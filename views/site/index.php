<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use yii\helpers\VarDumper;
use \yii\helpers\Url;

/**
 * @var \yii\web\View $this
 * @var string $content
 */
app\assets\AppAsset::register($this);
$this->title = 'Du Tests';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Du Tests!</h1>

        <p class="lead">Du test application</p>

       
    </div>

    <div class="row">
        <div class="col-md-3 text-center">
            <a href="<?php echo Url::to(array('test/showtests')); ?>" class="btn btn-success">Show tests</a>
        </div>
        
        <div class="col-md-3 text-center">
            <a href="<?php echo Url::to(array('test/passtest')); ?>" class="btn btn-success">Pass test</a>
        </div>
        
    </div>
</div>
