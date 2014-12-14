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

    <div class="">
        
        <div class="dutests"></div>
        
    </div>
</div>

<script id="question-step-template" type="text/x-handlebars-template">  
    <div class="step-content selected" data-id="{{id}}">
        <div class="row">
        
        <div class="col-md-12 text-center">
        <h2>{{name}}</h2>
        </div>

        <div class="col-md-12">
            <h4>{{description}}<h4>
        </div>

        <div class="question-answers">
        {{#if radio}}
            
        {{#each answers}}
        <div class="col-md-12">
            <input type="radio" name="group1" value="{{id}}"> {{name}}
        </div>
        {{/each}}
                
        {{/if}}
        </div>
        
        </div>
    </div>
</script>
<script id="test-step-template" type="text/x-handlebars-template">
    {{#each items}}
    <li class="step selected inactive" data-step="{{step}}" data-id="{{id}}">
                    <a href="#">
                        Step
                        <span class="step-number">{{step}}</span>
                    </a>
                </li>
    {{/each}}
</script>
<script id="test-wizard-template" type="text/x-handlebars-template">
<div class="jumbotron">
    <div class="row text-center">
        <h2>Choose Test</h2>
    </div>
    <div class="row text-center">
        <input type="hidden" id="wizard-choose-test" style="">
    </div>
</div>
<div class="col-xs-12 steps-wizard">
        <div class="row steps">
            <div class="steps-arrow text-center">
                <a class="arrow arrow-left" href="#"><span class="fa fa-angle-left"></span></a>
            </div>
            <ul class="steps-scrollpane">
                
            </ul>
            <div class="steps-arrow text-center">
                <a class="arrow arrow-right" href="#"><span class="fa fa-angle-right"></span></a>
            </div>
        </div>
        <div class="steps-content">
        </div>
        <div class="step-buttons text-right">
            <button class="btn btn-primary">Save Step</button>
        </div>
    </div>
</script>

<?php
if (YII_ENV_DEV) {

    $this->registerJsFile( 
        'web/js/passtest.js', 
        ['depends'=>'app\assets\AppAsset']
    );
}
else
{
    $this->registerJsFile( 
        'js/passtest.js', 
        ['depends'=>'app\assets\AppAsset']
    );
}
?>