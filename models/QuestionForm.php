<?php
namespace app\models;

use Yii;
use yii\base\Model;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of QuestionForm
 *
 * @author user
 */
class QuestionForm extends Model{
    //put your code here

    public $name;
    public $test_id;
    public $description;
    public $image;
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'test_id'], 'required'],
            [['test_id'], 'integer'],
            [['name'], 'string', 'max' => 245],
            [['description'], 'string', 'max' => 550],
            ['image', 'file', 'extensions' => ['png','jpg','jpeg','gif']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'image' => 'Image',
            'test_id' => 'Test ID',
        ];
    }

}
