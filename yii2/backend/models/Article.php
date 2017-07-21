<?php
namespace backend\models;

use yii\db\ActiveRecord;

class Article extends ActiveRecord{
    public function getArticleCategory(){
        return $this->hasOne(ArticleCategory::className(),['id'=>'article_category_id']);
    }
    public function attributeLabels()
    {
        return[
            'name'=>'文章名称',
            'intro'=>'简介',
            'article_category_id'=>'文章分类',
            'sort'=>'排序',
            'status'=>'状态'
        ];
    }
    public function rules()
    {
        return[
          [['name','intro','sort','status','article_category_id'],'required'],
        ];
    }
}