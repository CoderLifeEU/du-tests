<?php
use yii\helpers\Html;
use \yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use kartik\widgets\FileInput;

?>


 <?php $form = ActiveForm::begin(array('options' => array('class' => '', 'id' => 'question-form','enctype'=>'multipart/form-data'))); ?>
            
<?php echo $form->field($model, 'name')->textInput(); ?>

<?php echo $form->field($model, 'description')->textArea(['rows' => 6]); ?>


 <?php 
        echo $form->field($model, 'image')->widget(\kartik\widgets\FileInput::classname(), [
                'options' => ['accept' => 'image/*'],
                'pluginOptions' => [
                    'initialPreview'=>[
                        Html::img(Url::to(array('image/showquestionimage','name' => $model->image )), ['class'=>'file-preview-image', 'alt'=>'Image', 'title'=>'Image']),
                    ],
                    'initialCaption'=>"Image",
                    'overwriteInitial'=>true,
                    'showRemove'=>false,
                ]
        ]); 
        ?>
<?php echo $form->field($model, 'requiredanswercount')->textInput(); ?>

<?php echo  $form->field($model, 'controltype')
        ->dropDownList(
            $model->controltypes,           // Flat array ('id'=>'label')
            ['prompt'=>'']    // options
        )
    ?>

<?php echo Html::activeHiddenInput($model, 'test_id') ?>
<?php echo Html::activeHiddenInput($model, 'id') ?>
            
            
            
<div class="form-actions text-center">
    <?php echo Html::submitButton('Update', array('class' => 'btn btn-primary')); ?>
</div>
            
<?php ActiveForm::end(); ?>

<div class="row">
        <div class="col-md-1 col-md-offset-11">
            <a href="<?php echo Url::to(array('test/createanswer','questionid'=>$model->id)); ?>" class="btn btn-success">New</a>
        </div>
        
        <div class="col-md-12" style="margin-top:20px;">
        <table id="tests" class="table table-bordered table-striped dataTable" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Answer</th>
                    <th>Is valid</th>
                    <th>Score</th>
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
        '/web/js/updatequestion.js', 
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
        'js/updatequestion.js', 
        ['depends'=>'app\assets\AppAsset']
    );
    $this->registerJsFile( 
        'libs/DataTables-1.10.0/media/js/jquery.dataTables.overrides.js', 
        ['depends'=>'app\assets\AppAsset']
    );
}
?>