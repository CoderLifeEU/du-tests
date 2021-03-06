<?php
use yii\helpers\Html;
use \yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use kartik\widgets\FileInput;
use yii\bootstrap\NavBar;

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
<?php echo Html::activeHiddenInput($model, 'id') ?>

<?php echo Html::activeHiddenInput($model, 'test_id') ?>
            
            
            
<div class="form-actions text-center">
 <a href="<?php echo Url::to(array('test/updatetest','id'=>$model->test_id)); ?>" class="btn btn-success">Back</a>
    <?php echo Html::submitButton('Create', array('class' => 'btn btn-primary')); ?>
</div>
            
<?php ActiveForm::end(); ?>
