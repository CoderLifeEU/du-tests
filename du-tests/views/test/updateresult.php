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
$this->title = 'Update Test Result';
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
    
    <?php echo $form->field($model, 'description')->textArea(['rows' => 6]); ?>
    
    <?php echo $form->field($model, 'min_score')->textInput(); ?>
    
    <?php echo $form->field($model, 'max_score')->textInput(); ?>

    <?php echo $form->field($model, 'isactive', [
        'template' => "<div class=\"col-lg-12\">{input}</div>\n<div class=\"col-lg-12\">{error}</div>",
    ])->checkbox() ?>
    
    <?php echo Html::activeHiddenInput($model, 'id') ?>
    <?php echo Html::activeHiddenInput($model, 'test_id') ?>

    <div class="form-group">
        <div class="col-lg-12">
        <a href="<?php echo Url::to(array('test/updatetest','id'=>$model->test_id)); ?>" class="btn btn-success">Back</a>
            <?= Html::submitButton('Update', ['class' => 'btn btn-primary', 'name' => 'test-result-update-button']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
    </div>

</div>

