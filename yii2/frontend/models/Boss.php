<?php
namespace frontend\models;
use yii\db\ActiveRecord;

class Boss extends ActiveRecord{
    public function getEmployers(){
        return $this->hasMany(Employer::className(),['id'=>'employer_id'])->viaTable('boss_employer',['boss_id'=>'id']);
    }
}