<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use yii\helpers\VarDumper;
use \yii\helpers\Url;
$this->title = 'Existing tests';
?>
<div class="site-index">

    <div class="row">
        <div class="col-md-1 col-md-offset-11">
            <a href="<?php echo Url::to(array('test/createtest')); ?>" class="btn btn-success">New</a>
        </div>
        
        <div class="col-md-12" style="margin-top:20px;">
        <table id="tests" class="table table-bordered table-striped dataTable" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Test Name</th>
                    <th>Is Active</th>
                    <th>Created</th>
                    <th>Actions</th>
                </tr>
            </thead>

             <tbody>
                <tr>
                </tr>
             </tbody>
        </table>
    </div>
        
    </div>
</div>
<?php
if (YII_ENV_DEV) {

    $this->registerJsFile( 
        'js/showtests.js', 
        ['depends'=>'app\assets\AppAsset']
    );
}
?>