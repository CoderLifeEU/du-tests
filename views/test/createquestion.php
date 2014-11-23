<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

?>


 <?php $form = ActiveForm::begin(array('options' => array('class' => '', 'id' => 'question-form'))); ?>
            
<?php echo $form->field($model, 'name')->textInput(); ?>

<?php echo $form->field($model, 'description')->textArea(['rows' => 6]); ?>



<?php echo Html::activeHiddenInput($model, 'test_id') ?>
            
            
            
            
<div class="form-actions text-center">
    <?php echo Html::submitButton('Create', array('class' => 'btn btn-primary')); ?>
</div>
            
<?php ActiveForm::end(); ?>
