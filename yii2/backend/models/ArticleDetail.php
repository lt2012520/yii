<?php
namespace backend\models;

use yii\db\ActiveRecord;

class ArticleDetail extends ActiveRecord{
    public function getArticle(){
        return $this->hasOne(Article::className(),['id'=>'article_id']);
    }
    public function attributeLabels()
    {
        return[
            'content'=>'详情信息',
        ];
    }
}