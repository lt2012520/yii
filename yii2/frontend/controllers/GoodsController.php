<?php
namespace frontend\controllers;

use frontend\models\Goods;
use yii\captcha\CaptchaAction;
use yii\data\Pagination;
use yii\web\Controller;
use yii\web\Request;
use yii\web\UploadedFile;

class GoodsController extends Controller{
    public $enableCsrfValidation=false;
    public $layout='mime';
    public function actionIndex(){
        $rs=Goods::find();
        $total=$rs->count();
        $pagesize=3;
        $pager=new Pagination(['totalCount'=>$total,'defaultPageSize'=>$pagesize]);
        $models=$rs->limit($pager->limit)->offset($pager->offset)->all();
        return $this->render('index',['models'=>$models,'pager'=>$pager]);
    }
    public function actions()
    {
        return[
            'captcha'=>[
                'class'=>CaptchaAction::className(),
                'minLength'=>3,
                'maxLength'=>3
            ]
        ];
    }
    public function actionAdd(){
        $model=new Goods();
        $request=new Request();
        if($request->isPost){
            $model->load($request->post());
            $model->imgFile=UploadedFile::getInstance($model,'imgFile');
            if($model->validate()){
                $d=\Yii::getAlias('@webroot').'/Upload'.'/'.date('Ymd');
                if(!is_dir($d)){
                    mkdir($d);
                }
                if($model->imgFile){
                    $filename='/Upload/'.date('Ymd').'/'.uniqid().'.'.$model->imgFile->extension;
                    $model->imgFile->saveAs(\Yii::getAlias('@webroot').$filename,false);
                    $model->img=$filename;
                }
                $model->load($request->post());
                $model->save(false);
                return $this->redirect('index');
                }else{
                        var_dump($model->getErrors());exit;
                    }
            }
        return $this->render('add',['model'=>$model]);
        }

    public function actionEdit($id){
        $model=Goods::findOne(['id'=>$id]);
        $request=new Request();
        if($request->isPost){
            $model->load($request->post());
            $model->imgFile=UploadedFile::getInstance($model,'imgFile');
            if($model->validate()){
                $d=\Yii::getAlias('@webroot').'/Upload'.'/'.date('Ymd');
                if(!is_dir($d)){
                    mkdir($d);
                }
                if($model->imgFile){
                    $filename='/Upload/'.date('Ymd').'/'.uniqid().'.'.$model->imgFile->extension;
                    $model->imgFile->saveAs(\Yii::getAlias('@webroot').$filename,false);
                    $model->img=$filename;
                }
                $model->load($request->post());
                $model->save(false);
                return $this->redirect('index');
            }else{
                var_dump($model->getErrors());exit;
            }
        }
        return $this->render('add',['model'=>$model]);
    }
}