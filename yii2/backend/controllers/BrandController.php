<?php
namespace backend\controllers;

use backend\models\Brand;
use yii\web\Controller;

class BrandController extends Controller{
    public function actionIndex(){

    }
    public function actionAdd(){
        $model=new Brand();
        return $this->render('add',['model'=>$model]);
    }
}