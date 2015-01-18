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
<?php if(isset($_COOKIE["moodleid"])) 
        {
            echo $_COOKIE["moodleid"];
        } 
        if(isset($_COOKIE["moodlerole"])) 
        {
            echo $_COOKIE["moodlerole"];
        } 
        ?>
        <p class="lead">Du test application</p>

       
    </div>

    
    <div class="row">
              <div class="col-md-4 text-center">
                  <a href="<?php echo Url::to(array('test/showtests')); ?>" class="icon-box float-shadow btn-main-nav">
                      <i class="fa fa-copy"></i>
                      <h2>Show tests</h2>
                      <p>Go to test administrative panel</p>
                  </a>
              </div>
              
              <div class="col-md-4 text-center">
                 <a href="<?php echo Url::to(array('test/passtest')); ?>" class="icon-box float-shadow btn-main-nav">
                      <i class="fa fa-graduation-cap"></i>
                      <h2>Pass test</h2>
                      <p>Try to pass tests</p>
                  </a>
              </div>
              
              <div class="col-md-4 text-center">
                <a href="<?php echo Url::to(array('test/showresults')); ?>" class="icon-box float-shadow btn-main-nav">
                    <i class="fa fa-area-chart"></i>
                    <h2>Show Results</h2>
                    <p>View tests results</p>
                </a>
              </div>
          </div>
</div>
<?php
if (YII_ENV_DEV) {

    $this->registerCssFile( 
        'du-tests/web/libs/hover-css/css/hover.css', 
        ['depends'=>'app\assets\AppAsset']
    );
}
else
{
    $this->registerCssFile( 
        'du-tests/web/libs/hover-css/css/hover.css', 
        ['depends'=>'app\assets\AppAsset']
    );
}
?>