<?php
namespace frontend\controllers;
use frontend\models\Boss;
use yii\web\Controller;

class BossController extends Controller{
    public function actionAdd(){
        $model=Boss::findOne(['id'=>2]);
      /*  var_dump($model);exit;*/
        var_dump($model->employers);
    }
}