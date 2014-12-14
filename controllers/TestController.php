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
    
    public function actionCreatequestion($testid)
    {
        $model = new \app\models\QuestionForm();
        $model->test_id = $testid;
        $model->controltypes = \app\models\Question::getControlTypes();
        $filename = '';
        
      
        if ($model->load(Yii::$app->request->post())&& $model->validate(null, false)) 
        {
            $dir = Yii::getAlias('@app/uploads/questions');
            $uploaded = false;
            $file = \yii\web\UploadedFile::getInstance($model,'image');
            $type = $file->type;
            

            if($file->size!=0 && ($type=='image/png' || $type=='image/jpeg'))
            {
            $filetype='';
            if($type=='image/png')
            {
                $filetype='.png';
            }
            else if($type=='image/jpeg')
            {
                $filetype='.jpg';
            }

            $filename =  uniqid().$filetype;
            $uploaded = $file->saveAs($dir.'/'.$filename);

            $model->image = $filename;
            
            }
            $domainmodel = new \app\models\Question();
            $domainmodel->test_id = $model->test_id;
            $domainmodel->name = $model->name;
            $domainmodel->description = $model->description;
            $domainmodel->requiredanswercount = $model->requiredanswercount;
            
            if($filename!='')
            {
                $domainmodel->image = $filename;
            }
            $domainmodel->controltype = $model->controltype;
            
            $domainmodel->save();
            
            
            return $this->redirect(array('test/updatetest','id'=>$model->test_id)); 
        }
        return $this->render('createquestion', array(
                        'model' => $model,
            ));
        
    }
    
	
    public function actionCreateanswer($questionid)
    {
        $model = new \app\models\QuestionForm();
        $model->question_id = $questionid;
        
      
        if ($model->load(Yii::$app->request->post())&& $model->validate(null, false)) 
        {
            $dir = Yii::getAlias('@app/uploads/answers');
            $uploaded = false;
            $file = \yii\web\UploadedFile::getInstance($model,'image');
            $type = $file->type;
            

            if($file->size!=0 && ($type=='image/png' || $type=='image/jpeg'))
            {
            $filetype='';
            if($type=='image/png')
            {
                $filetype='.png';
            }
            else if($type=='image/jpeg')
            {
                $filetype='.jpg';
            }

            $filename =  uniqid().$filetype;
            $uploaded = $file->saveAs($dir.'/'.$filename);

            $model->image = $filename.$filetype;
            
            $domainmodel = new \app\models\Answer();
            $domainmodel->question_id = $model->question_id;
            $domainmodel->name = $model->name;
            $domainmodel->description = $model->description;
            $domainmodel->image = $model->image;
            
            $domainmodel->save();
            
            
            return $this->redirect(array('question/updateanswer','id'=>$model->answer_id)); 
            }
        }
        return $this->render('createanswer', array(
                        'model' => $model,
            ));
        
    }//actionCreateanswer
	
	
	
    public function actionUpdatequestion($id)
    {
        $model = new \app\models\QuestionForm();
        $domainmodel = new \app\models\Question();
        $domainmodel = \app\models\Question::getQuestion($id);
        
        $model->test_id = $domainmodel->test_id;
        $model->name = $domainmodel->name;
        $model->description = $domainmodel->description;
        $model->id = $domainmodel->id;
        $model->image = $domainmodel->image;
        $model->controltype = $domainmodel->controltype;
        $model->controltypes = \app\models\Question::getControlTypes();
        $model->requiredanswercount = $domainmodel->requiredanswercount;
        

        if ($model->load(Yii::$app->request->post()) && $model->validate(null, false)) 
        {
            $dir = Yii::getAlias('@app/uploads/questions');
            $uploaded = false;
            $file = \yii\web\UploadedFile::getInstance($model,'image');
            $type = $file->type;
            

            if($file->size!=0 && ($type=='image/png' || $type=='image/jpeg'))
            {
            $filetype='';
            if($type=='image/png')
            {
                $filetype='.png';
            }
            else if($type=='image/jpeg')
            {
                $filetype='.jpg';
            }

            $filename =  uniqid().$filetype;
            $uploaded = $file->saveAs($dir.'/'.$filename);

            $model->image = $filename;
            
            }
            $domainmodel = new \app\models\Question();
            $domainmodel = \app\models\Question::getQuestion($model->id);
            $domainmodel->test_id = $model->test_id;
            $domainmodel->name = $model->name;
            $domainmodel->description = $model->description;
            $domainmodel->requiredanswercount = $model->requiredanswercount;
            if($filename!='')
            {
                $domainmodel->image = $filename;
            }
            $domainmodel->controltype = $model->controltype;
            
            $domainmodel->save();
            
            return $this->redirect(array('test/updatetest','id'=>$model->test_id)); 
        }
        return $this->render('updatequestion', array(
                        'model' => $model,
            ));
    }//actionUpdatequestion
	
	
	public function actionPreparetest($id)
        {
            $success = true;
            
            $obj = \app\models\Test::prepareTest($id);
            $questions = $obj['questions'];
            for($i=0;$i<count($questions);$i++)
            {
                $questions[$i]['answers'] = \app\models\Answer::getQuestionAnswersAsArray($questions[$i]['id']);
                $questions[$i]['step'] = $i+1;
                if($questions[$i]['controltype']=='radio' || $questions[$i]['controltype']=='') $questions[$i]['radio'] = true;
                else if($questions[$i]['controltype']=='checkbox' || $questions[$i]['controltype']=='') $questions[$i]['checkbox'] = true;
                else if($questions[$i]['controltype']=='input' || $questions[$i]['controltype']=='') $questions[$i]['input'] = true;
            }
            $result = array("success"=>$success,"data"=>$questions,'testid'=>$obj['id'],'questioncount'=>count($questions));
            
            return json_encode($result);
        }
	
	
	
        public function actionUpdateanswer($id)
        {
            $model = \app\models\Answer::getAnswer($id);


            if ($model->load(Yii::$app->request->post()) && $model->validate(null, false)) 
            {
                $model->save();

                return $this->redirect(array('test/showtests')); 
            }

            return $this->render('updateanswer', array(
                            'model' => $model,
                ));
        }//actionUpdateanswer
	
	
	
	
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
    
    public function actionGetquestionsfeed($id)
    {
        $questions = \app\models\Question::getTestQuestionsAsArray($id);
        
        $success=true;
        
        $questioncount = count($questions);
        
        if($questioncount<1)
        {
            $success = false;
        }
        
        $i=0;
        
        while($i<$questioncount)
        {
                $questions[$i]['actions']='<div class="text-center"><div class="btn-group btn-group-sm">'.
                                        '<a type="button" href="updatequestion?id='.$questions[$i]['id'].'"class="btn btn-default btn-update-relationship" data-id="'.$questions[$i]['id'].'">Update</a>'.
                                        '<a type="button" class="btn disabled btn-danger btn-delete-relationship" data-id="'.$questions[$i]['id'].'">Delete</a>'.
                                      '</div></div>';
                $i++;
        }
            
        
        $response = array("success"=>$success,"data"=>$questions);
            
        return json_encode($response);
        
        
    }

    
    public function actionPasstest()
    {
        return $this->render('passtest'
            );
    }
    
    
}
