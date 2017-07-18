<?php
namespace frontend\controllers;

use frontend\models\Classroom;
use yii\web\Controller;
use yii\web\Request;

class ClassroomController extends Controller{
    public $enableCsrfValidation = false;
    public function actionIndex(){
        $models=Classroom::find()->all();
        return $this->render('index',['models'=>$models]);
    }
    public function actionAdd(){
        $model=new Classroom();
        $request= new Request();
        if($request->isPost){
            $model->load($request->post());
            if($model->validate()){
                $model->save();
                return $this->redirect('index');
                }else{
                    var_dump($model->getErrors());exit;
                }
            }
        return $this->render('add',['model'=>$model]);
    }
    public function actionEdit($id){
        $model=Classroom::findOne(['id'=>$id]);
        $request= new Request();
        if($request->isPost){
            $model->load($request->post());
            if($model->validate()){
                $model->save();
                return $this->redirect('index');
            }else{
                var_dump($model->getErrors());exit;
            }
        }
        return $this->render('add',['model'=>$model]);
    }
    public function actionDelete($id){
        $model=Classroom::findOne(['id'=>$id]);
        $model->delete();
        return $this->redirect('index');
    }
}