<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use yii\helpers\VarDumper;
use \yii\helpers\Url;
$this->title = 'Test Results';
?>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">



    <!-- Portfolio Grid Section -->
    <section class="related-items">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Find out test results below</h2>
                    <hr class="star-primary">
                </div>
            </div>
            
            
            
                
            <div class="row">
                <div class="col-lg-12 text-center">
                    <a href="<?php echo Url::to(array('test/showresults')); ?>" class="btn btn-lg btn-outline-red fadeInUp wow animated" >
                        Back to Result List
                    </a>
                </div>
            </div>
            
            </div>
        
        
        </div>
    </section>
    

    <!-- About Section -->
    <section class="success" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center fadeInDown wow">
                    <h2><?php echo $test->name ?></h2>
                    <hr class="star-light">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-2 col-lg-offset-4">
                    <p class="fadeInLeft wow">Result:</p>
                </div>
                <div class="col-lg-4">
                    <p class="fadeInRight wow"><?php if(isset($result->name) && !is_null($result->name) &&$result->name!="")echo $result->name; else echo "-"; ?></p>
                </div>
            </div>
            
             <div class="row">
                <div class="col-lg-2 col-lg-offset-4">
                    <p class="fadeInLeft wow">Description:</p>
                </div>
                <div class="col-lg-4">
                    <p class="fadeInRight wow"><?php if(isset($result->description) && !is_null($result->description) &&$result->description!="")echo $result->description; else echo "-"; ?></p>
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-2 col-lg-offset-4">
                    <p class="fadeInLeft wow">Score:</p>
                </div>
                <div class="col-lg-4">
                    <p class="fadeInRight wow"><?php echo $score; ?></p>
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-2 col-lg-offset-4">
                    <p class="fadeInLeft wow">Completed:</p>
                </div>
                <div class="col-lg-4">
                    <p class="fadeInRight wow"><?php if(isset($result->created) && !is_null($result->created) &&$result->created!="")echo $result->created; else echo "-"; ?></p>
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <a href="<?php echo Url::to(array('test/passtest')); ?>" class="btn btn-lg btn-outline fadeInUp wow">
                        <i class="fa fa-graduation-cap"></i> Pass again
                    </a>
                </div>
            </div>
        </div>
    </section>
    
    

    <!-- Contact Section -->
    

    
    
    <!-- Footer -->
    

    <!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
    <div class="scroll-top page-scroll visible-xs visble-sm">
        <a class="btn btn-primary" href="#page-top">
            <i class="fa fa-chevron-up"></i>
        </a>
    </div>

    
   
    
   
    
    
<?php

if (YII_ENV_DEV) {
    $this->registerCssFile( 
        'du-tests/web/libs/hover-css/css/hover-min.css', 
        ['depends'=>'app\assets\AppAsset']
    );
    $this->registerCssFile( 
        'du-tests/web/libs/freelancer/css/animate.css', 
        ['depends'=>'app\assets\AppAsset']
    );
    $this->registerCssFile( 
        'du-tests/web/libs/freelancer/css/freelancer.css', 
        ['depends'=>'app\assets\AppAsset']
    );
    /*$this->registerCssFile( 
        'web/libs/freelancer/css/font.css', 
        ['depends'=>'app\assets\AppAsset']
    );*/
    $this->registerJsFile( 
        'du-tests/web/libs/freelancer/js/jquery.easing.min.js', 
        ['depends'=>'app\assets\AppAsset']
    );
    $this->registerJsFile( 
        'du-tests/web/libs/freelancer/js/classie.js', 
        ['depends'=>'app\assets\AppAsset']
    );
    $this->registerJsFile( 
        'du-tests/web/libs/freelancer/js/cbpAnimatedHeader.js', 
        ['depends'=>'app\assets\AppAsset']
    );
    $this->registerJsFile( 
        'du-tests/web/libs/freelancer/js/jqBootstrapValidation.js', 
        ['depends'=>'app\assets\AppAsset']
    );
    $this->registerJsFile( 
        'du-tests/web/libs/freelancer/js/wow/wow.min.js', 
        ['depends'=>'app\assets\AppAsset']
    );
    $this->registerJsFile( 
        'du-tests/web/libs/freelancer/js/freelancer.js', 
        ['depends'=>'app\assets\AppAsset']
    );
    $this->registerJsFile( 
        'du-tests/web/libs/freelancer/js/freelancer.js', 
        ['depends'=>'app\assets\AppAsset']
    );
}
if(YII_ENV_PROD)
{
    $this->registerCssFile( 
        'libs/hover-css/css/hover-min.css', 
        ['depends'=>'app\assets\AppAsset']
    );
    $this->registerCssFile( 
        'libs/freelancer/css/animate.css', 
        ['depends'=>'app\assets\AppAsset']
    );
    $this->registerCssFile( 
        'libs/freelancer/css/freelancer.css', 
        ['depends'=>'app\assets\AppAsset']
    );
    /*$this->registerCssFile( 
        'web/libs/freelancer/css/font.css', 
        ['depends'=>'app\assets\AppAsset']
    );*/
    $this->registerJsFile( 
        'libs/freelancer/js/jquery.easing.min.js', 
        ['depends'=>'app\assets\AppAsset']
    );
    $this->registerJsFile( 
        'libs/freelancer/js/classie.js', 
        ['depends'=>'app\assets\AppAsset']
    );
    $this->registerJsFile( 
        'libs/freelancer/js/cbpAnimatedHeader.js', 
        ['depends'=>'app\assets\AppAsset']
    );
    $this->registerJsFile( 
        'libs/freelancer/js/jqBootstrapValidation.js', 
        ['depends'=>'app\assets\AppAsset']
    );
    $this->registerJsFile( 
        'web/libs/freelancer/js/wow/wow.min.js', 
        ['depends'=>'app\assets\AppAsset']
    );
    $this->registerJsFile( 
        'libs/freelancer/js/freelancer.js', 
        ['depends'=>'app\assets\AppAsset']
    );
    $this->registerJsFile( 
        'libs/freelancer/js/freelancer.js', 
        ['depends'=>'app\assets\AppAsset']
    );
}

?>