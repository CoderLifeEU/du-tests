<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class TestController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionShowtests()
    {
        return $this->render('showtests');
    }
    
    public function actionCreatetest()
    {
        $model = new \app\models\Test();
        
        $model->load(Yii::$app->request->post());

        if ($model->load(Yii::$app->request->post()) && $model->validate(null, false)) 
        {
            $model->save();
            
            return $this->redirect(array('test/showtests')); 
        }
        
        return $this->render('createtest', array(
                        'model' => $model,
            ));
    }
    
    public function actionUpdatetest($id)
    {
        $model = \app\models\Test::getTest($id);
        

        if ($model->load(Yii::$app->request->post()) && $model->validate(null, false)) 
        {
            $model->save();
            
            return $this->redirect(array('test/showtests')); 
        }
        
        return $this->render('updatetest', array(
                        'model' => $model,
            ));
    }
    
    public function actionGettestsfeed()
    {
        $tests = \app\models\Test::getTestsAsArray();
        
        $success=true;
        
        $testcount = count($tests);
        
        if($testcount<1)
        {
            $success = false;
        }
        
        $i=0;
        
        while($i<$testcount)
        {
                $tests[$i]['actions']='<div class="text-center"><div class="btn-group btn-group-sm">'.
                                        '<a type="button" href="updatetest?id='.$tests[$i]['id'].'"class="btn btn-default btn-update-relationship" data-id="'.$tests[$i]['id'].'">Update</a>'.
                                        '<a type="button" class="btn disabled btn-danger btn-delete-relationship" data-id="'.$tests[$i]['id'].'">Delete</a>'.
                                      '</div></div>';
                $i++;
        }
            
        
        $response = array("success"=>$success,"data"=>$tests);
            
        return json_encode($response);
        
    }

    
    public function actionPasstest()
    {
        return $this->render('passtest'
            );
    }
    
    
}
