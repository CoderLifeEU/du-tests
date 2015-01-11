<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "test_history".
 *
 * @property integer $id
 * @property string $user_id
 * @property integer $test_id
 * @property string $completed
 * @property integer $isactive
 *
 * @property Test $test
 * @property MdlUser $user
 * @property UserAnswer[] $userAnswers
 */
class testHistory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'test_history';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'test_id'], 'required'],
            [['user_id', 'test_id', 'isactive'], 'integer'],
            [['completed'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'test_id' => 'Test ID',
            'completed' => 'Completed',
            'isactive' => 'Isactive',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTest()
    {
        return $this->hasOne(Test::className(), ['id' => 'test_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(MdlUser::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserAnswers()
    {
        return $this->hasMany(UserAnswer::className(), ['test_history_id' => 'id']);
    }
    
    public static function getActiveTest($testid,$userid)
    {
        $obj = testHistory::find()->where('test_id = :testid and user_id = :userid and isactive=1', ['testid'=>$testid,'userid'=>$userid])->one();
        return $obj;
    }
    
}
