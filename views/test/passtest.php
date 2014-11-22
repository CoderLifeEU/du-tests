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
$this->title = 'Pass test';
?>
<div class="row">

    <div class="col-md-6">
        
        <div class="dutests"></div>
        
    </div>
    
    
</div>

<?php
if (YII_ENV_DEV) {

    $this->registerJsFile( 
        'js/passtest.js', 
        ['depends'=>'app\assets\AppAsset']
    );
}
?>