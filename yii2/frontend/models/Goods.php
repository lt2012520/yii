<?php
namespace frontend\models;

use yii\db\ActiveRecord;

class Goods extends ActiveRecord{
    public $imgFile;
    public $code;
    public function rules()
    {
        return[
            [['name','price'],'required'],
            ['price','integer'],
           ['code','captcha','captchaAction'=>'goods/captcha'],
            ['imgFile','file','extensions'=>['jpg','png','gif'],'skipOnEmpty'=>false]
        ];
    }
    public function attributeLabels()
    {
        return[
            'name'=>'商品名称',
            'price'=>'价格',
            'imgFile'=>'上传文件',
        ];
    }
}