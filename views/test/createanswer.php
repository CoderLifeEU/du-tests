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
                        Html::img(Url::to(array('image/showanswerimage','name' => $model->image )), ['class'=>'file-preview-image', 'alt'=>'Image', 'title'=>'Image']),
                    ],
                    'initialCaption'=>"Image",
                    'overwriteInitial'=>true,
                    'showRemove'=>false,
                ]
        ]); 
        ?>

 <?php echo $form->field($model, 'isvalid', [
        'template' => "<div class=\"col-lg-12\">{input}</div>\n<div class=\"col-lg-12\">{error}</div>",
    ])->checkbox() ?>
	
	<?php echo $form->field($model, 'score')->textInput(); ?>

<?php echo Html::activeHiddenInput($model, 'id') ?>

<?php echo Html::activeHiddenInput($model, 'question_id') ?>
            
            
            
            
<div class="form-actions text-center">
    <?php echo Html::submitButton('Create', array('class' => 'btn btn-primary')); ?>
</div>
            
<?php ActiveForm::end(); ?>
