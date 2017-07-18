<?php
namespace frontend\controllers;

use frontend\models\Admin;
use yii\captcha\CaptchaAction;
use yii\web\Controller;
use yii\web\Request;
use yii\web\UploadedFile;

class AdminController extends Controller{
    public function actionIndex(){
        $rs=Admin::find();
        $models=$rs->all();
        return $this->render('index',['models'=>$models]);
    }
    public function actions()
    {
        return[
            'captcha'=>[
                'class'=>CaptchaAction::className(),
                'maxLength'=>4,
                'minLength'=>4
            ]
        ];
    }

    public function actionAdd(){
        $model = new Admin();
        $request = new Request();
        if($request->isPost){
            $model->load($request->post());
            $model->imgFile=UploadedFile::getInstance($model,'imgFile');
            if($model->validate()){
                $d=\Yii::getAlias('@webroot').'/Upload'.'/'.date('Ymd');
                if(!is_dir($d)){
                    mkdir($d);
                }
                $filename='/Upload'.'/'.date('Ymd')/uniqid().'.'.$model->imgFile->extension;
                $model->imgFile->saveAs(\Yii::getAlias('@webroot'.$filename),false);
                $model->img=$filename;
                $model->save(false);
                return $this->redirect(['admin/index']);
            }else{
                var_dump($model->getErrors());exit;
            }
        }
        return $this->render('add',['model'=>$model]);
    }
}