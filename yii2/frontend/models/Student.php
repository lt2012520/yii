<?php
namespace frontend\models;

use yii\db\ActiveRecord;
class Student extends ActiveRecord{
    public $imgFile;
    public $code;
    public function getClassroom(){
        return $this->hasOne(Classroom::className(),['id'=>'class_id']);
    }
    public function rules()
    {
        return [
            [['name','age','class_id'],'required'],
            [['age','class_id'],'integer'],
            ['imgFile','file','extensions'=>['jpg','png','gif'],'skipOnEmpty'=>false],
            ['code','captcha','captchaAction'=>'student/captcha']
        ];
    }

    public function attributeLabels()
    {
       return [
           'name'=>'姓名',
         'age'=>'年龄',
           'class_id'=>'班级',
           'imgFile'=>'头像',
          
       ];
    }

}