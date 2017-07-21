<?php
namespace backend\models;
use yii\db\ActiveRecord;


class Brand extends ActiveRecord{
    public $imgFile;
    public static function getStatusOptions($s=1){
        $options=[
            -1=>'删除',
            0=>'隐藏',
            1=>'正常',
        ];
        if($s){
            unset($options[-1]);
        }
        return $options;
    }
    public function rules()
    {
        return[
            [['name','intro','sort','status'],'required'],
            ['logo','string','max'=>255]
        ];
    }
   public function attributeLabels()
   {
       return[
           'name'=>'商品名称',
           'intro'=>'简介',
           'sort'=>'排序',
           'status'=>'状态',
           'logo'=>'图片',
       ];
   }

}