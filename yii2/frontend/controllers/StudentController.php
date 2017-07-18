<?php
namespace frontend\controllers;

use frontend\models\Student;
use yii\captcha\Captcha;
use yii\captcha\CaptchaAction;
use yii\data\Pagination;
use yii\web\Controller;
use frontend\models\Classroom;
use yii\web\UploadedFile;

class StudentController extends Controller{
    public $enableCsrfValidation = false;
    public $layout='mime';
    public function actionIndex(){
        $rs=Student::find();
        $total=$rs->count();
        $pagesize=3;
        $pager=new Pagination(['totalCount'=>$total,'defaultPageSize'=>$pagesize]);
        $models=$rs->limit($pager->limit)->offset($pager->offset)->all();
        return $this->render('index',['models'=>$models,'pager'=>$pager]);
    }
    public function actionAdd(){
        $model=new Student();
        $request=new \yii\web\Request();
       if($request->isPost){
           $model->load($request->post());
           $model->imgFile=UploadedFile::getInstance($model,'imgFile');
           /*var_dump($model);exit;*/
           if($model->validate()){
              $d=\Yii::getAlias('@webroot').'/Upload'.'/'.date('Ymd');
               if(!is_dir($d)){
                   mkdir($d);
               }
               if($model->imgFile){
                   $fileName='/Upload/'.date('Ymd').'/'.uniqid().'.'.$model->imgFile->extension;
                   $model->imgFile->saveAs(\Yii::getAlias('@webroot').$fileName,false);
                   $model->img=$fileName;
               }
                $model->load($request->post());
               $model->save(false);
               return $this->redirect(['student/index']);
           }else{
               var_dump($model->getErrors());exit;
           }
       }
      /* $class=Classroom::find()->all();
        /*var_dump($class);exit;*/
        return $this->render('add',['model'=>$model/*,'class'=>$class*/]);
    }
    public function actions()
    {
        return[
            'captcha'=>[
                'class'=>CaptchaAction::className(),
                'minLength'=>4,
                'maxLength'=>4
            ]
        ];
    }

    public function actionEdit($id){
       $model=Student::findOne(['id'=>$id]);
        $request=new \yii\web\Request();
        if($request->isPost){
            $model->load($request->post());
            $model->imgFile=UploadedFile::getInstance($model,'imgFile');
            /*var_dump($model);exit;*/
            if($model->validate()){
                $d=\Yii::getAlias('@webroot').'/Upload'.'/'.date('Ymd');
                if(!is_dir($d)){
                    mkdir($d);
                }
                if($model->imgFile){
                    $fileName='/Upload/'.date('Ymd').'/'.uniqid().'.'.$model->imgFile->extension;
                    $model->imgFile->saveAs(\Yii::getAlias('@webroot').$fileName,false);
                    $model->img=$fileName;
                }
                $model->load($request->post());
                $model->save(false);
                return $this->redirect(['student/index']);
            }else{
                var_dump($model->getErrors());exit;
            }
        }
        /* $class=Classroom::find()->all();
          /*var_dump($class);exit;*/
        return $this->render('add',['model'=>$model/*,'class'=>$class*/]);
    }
    public function actionDelete($id){
        $model=Student::findOne(['id'=>$id]);
        $model->delete();
        $this->redirect(['student/index']);
    }

}