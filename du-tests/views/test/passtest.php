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
<head><?= Html::csrfMetaTags() ?> </head>
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
        <div class="col-sm-6 col-md-3">
            <div class="thumbnail">
            <img src="http://sprayitaway.com/wp-content/uploads/2013/08/apple_by_grv422-d5554a4.jpg" alt="...">
                <div class="caption">
           
                    <p class="text-center">
                        <input tabindex="12" type="radio" id="square-radio-{{id}}" data-id="{{id}}" name="square-radio" class="icheck-radio icheck-control">
                        <label for="square-radio-{{id}}">{{name}}</label>        
                    </p>
    
                    <p class="answer-description">{{description}}</p>

                </div>
            </div>
        </div>


        {{/each}}
                
        {{/if}}
                
        {{#unless radio}}
            {{#if checkbox}}
                
                {{#each answers}}
                
        <div class="col-sm-6 col-md-3">
            <div class="thumbnail">
            <img src="http://sprayitaway.com/wp-content/uploads/2013/08/apple_by_grv422-d5554a4.jpg" alt="...">
                <div class="caption">
           
                    <p class="text-center">
                        <input tabindex="12" type="checkbox" id="square-checkbox-{{id}}" data-id="{{id}}" name="square-checkbox" class="icheck-checkbox icheck-control">
                        <label for="square-checkbox-{{id}}">{{name}}</label>        
                    </p>
    
                    <p class="answer-description">{{description}}</p>

                </div>
            </div>
        </div>
                
                {{/each}}
                
            {{/if}}
                    
            {{#unless checkbox}}
            <div class="col-md-12 text-center"><h2>There are not answers for this question</h2></div>
            {{/unless}}
                    
                    
        {{/unless}}
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
            <a class="btn btn-primary btn-complete-test">Complete test</a>
        </div>
    </div>
</script>

<?php
if (YII_ENV_DEV) {

    $this->registerJsFile( 
        'du-tests/web/js/passtest.js', 
        ['depends'=>'app\assets\AppAsset']
    );
}
else
{
    $this->registerJsFile( 
        'du-tests/js/passtest.js', 
        ['depends'=>'app\assets\AppAsset']
    );
}
/*
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
}*/
?>