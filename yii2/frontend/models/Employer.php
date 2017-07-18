<?php
namespace frontend\models;
use yii\db\ActiveRecord;

class Employer extends ActiveRecord{
    public function getBosss(){
        return $this->hasMany(Boss::className(),['id'=>'boss_id'])->viaTable('boss_employer',['employer_id'=>'id']);
    }
}