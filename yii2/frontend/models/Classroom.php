<?php
namespace frontend\models;

use yii\db\ActiveRecord;

class Classroom extends ActiveRecord{
    public function getStudent(){
        return $this->hasMany(Student::className(),['class_id'=>'id']);
    }
    public function rules()
    {
        return[
          ['class','required'],
            ['class','integer']
        ];
    }
    public function attributeLabels(){
     return[
         'class'=>'班级'
     ];
    }

}