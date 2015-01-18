<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \yii\helpers\Url;
/**
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 */
$this->title = 'Create Test';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-4 col-md-offset-4">
    <h1><?php echo Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to create test:</p>

    <?php $form = ActiveForm::begin([
        'id' => 'test-create-form',
        'options' => ['class' => 'form-horizontal'],
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
         <a href="<?php echo Url::to(array('test/showtests')); ?>" class="btn btn-success">Back</a>
            <?= Html::submitButton('Create', ['class' => 'btn btn-primary', 'name' => 'test-create-button']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
    </div>
</div>
