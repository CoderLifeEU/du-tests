<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use yii\helpers\VarDumper;
use \yii\helpers\Url;
/**
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 */
$this->title = 'Update Test';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-4 col-md-offset-4">
    <h1><?php echo Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to create test:</p>

    <?php $form = ActiveForm::begin([
        'id' => 'test-create-form',
        'options' => ['class' => 'form-horizontal','enctype'=>'multipart/form-data'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-12\">{input}</div>\n<div class=\"col-lg-12\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

    <?php echo $form->field($model, 'name') ?>

    <?php echo $form->field($model, 'isactive', [
        'template' => "<div class=\"col-lg-12\">{input}</div>\n<div class=\"col-lg-12\">{error}</div>",
    ])->checkbox() ?>
    
    <?php echo Html::activeHiddenInput($model, 'id') ?>

    <div class="form-group">
        <div class="col-lg-12">
            <?= Html::submitButton('Update', ['class' => 'btn btn-primary', 'name' => 'test-update-button']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
    </div>

</div>

 <div class="row">
        <div class="col-md-1 col-md-offset-11">
            <a href="<?php echo Url::to(array('test/createquestion','testid'=>$model->id)); ?>" class="btn btn-success">New</a>
        </div>
        
        <div class="col-md-12" style="margin-top:20px;">
            <table id="tests" class="table table-bordered table-striped dataTable" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Question Name</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                 <tbody>
                    <tr>
                    </tr>
                 </tbody>
            </table>
        </div>
     
     <div class="col-md-1 col-md-offset-11">
            <a href="<?php echo Url::to(array('test/createresult','testid'=>$model->id)); ?>" class="btn btn-success">New</a>
        </div>
     <div class="col-md-12" style="margin-top:20px;">
            <table id="testresults" class="table table-bordered table-striped dataTable" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Result</th>
                        <th>MinScore</th>
                        <th>MaxScore</th>
                        <th>IsActive</th>
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

<?php
if (YII_ENV_DEV) 
{
    $this->registerJsFile( 
        'du-tests/web/js/updatetest.js', 
        ['depends'=>'app\assets\AppAsset']
    );
}
else
{
    $this->registerJsFile( 
        'du-tests/js/updatetest.js', 
        ['depends'=>'app\assets\AppAsset']
    );
}
/*
 * if (YII_ENV_DEV) 
{
    $this->registerJsFile( 
        '/web/js/updatetest.js', 
        ['depends'=>'app\assets\AppAsset']
    );
    $this->registerJsFile( 
        '/web/libs/DataTables-1.10.0/media/js/jquery.dataTables.overrides.js', 
        ['depends'=>'app\assets\AppAsset']
    );
}
else
{
    $this->registerJsFile( 
        'js/updatetest.js', 
        ['depends'=>'app\assets\AppAsset']
    );
    $this->registerJsFile( 
        'libs/DataTables-1.10.0/media/js/jquery.dataTables.overrides.js', 
        ['depends'=>'app\assets\AppAsset']
    );
}
 */
?>
