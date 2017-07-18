<?php
namespace frontend\models;

use yii\db\ActiveRecord;

class Admin extends ActiveRecord{
    public $imgFile;
    public $code;
    public function attributeLabels()
    {
        return[
            'name'=>'姓名',
            'age'=>'年龄',
            'sex'=>'性别',
            'imgFile'=>'头像',
            'password'=>'密码'
        ];
    }
    public function rules()
    {
        return[
            [['name','age','sex','password'],'required'],
            ['imgFile','file','skipOnEmpty'=>false,'extensions'=>['jpg','png','gif']],
            ['code','captcha','captchaAction'=>'admin/captcha']
        ];
    }
}