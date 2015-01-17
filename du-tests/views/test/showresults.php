<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use yii\helpers\VarDumper;
use \yii\helpers\Url;
$this->title = 'My results';
?>
<div class="site-index">

    <div class="row">
        
        <div class="col-md-12" style="margin-top:20px;">
        <table id="tests" class="table table-bordered table-striped dataTable" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Test Name</th>
                    <th>Is Active</th>
                    <th>Completed</th>
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
        'du-tests/web/js/showresults.js', 
        ['depends'=>'app\assets\AppAsset']
    );
}
else
{
    $this->registerJsFile( 
        'du-tests/web/js/showresults.js', 
        ['depends'=>'app\assets\AppAsset']
    );
}
/*
 * if (YII_ENV_DEV) {

    $this->registerJsFile( 
        '/web/js/showtests.js', 
        ['depends'=>'app\assets\AppAsset']
    );
}
 */
?>