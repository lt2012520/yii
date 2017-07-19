<?php
namespace backend\controllers;

use backend\models\Brand;
use yii\data\Pagination;
use yii\web\Controller;
use yii\web\Request;
use yii\web\UploadedFile;

class BrandController extends Controller{
    public function actionIndex(){
        $rs=Brand::find()->where('status>=0')->orderBy('sort desc');
        $total=$rs->count();
        $pagesize=3;
        $pager=new Pagination(['defaultPageSize'=>$pagesize,'totalCount'=>$total]);
        $models=$rs->limit($pager->limit)->offset($pager->offset)->all();
        
        return $this->render('index',['models'=>$models,'pager'=>$pager]);
    }
    public function actionAdd(){
        $model=new Brand();
        $request=new Request();
        if($request->isPost){
            $model->load($request->post());
            $model->imgFile=UploadedFile::getInstance($model,'imgFile');
            if($model->validate()){
                if($model->imgFile){
                    $d=\Yii::getAlias('@webroot').'/Upload'.'/'.date('Ymd');
                    if (!is_dir($d)){
                        mkdir($d);
                    }
                    $filename='/Upload'.'/'.date('Ymd').'/'.uniqid().'.'.$model->imgFile->extension;
                    $model->imgFile->saveAs(\Yii::getAlias('@webroot').$filename,false);
                    $model->logo=$filename;
                }
                $model->save();
                return $this->redirect('index');
            }else{
                var_dump($model->getErrors());exit;
            }
        }
        return $this->render('add',['model'=>$model]);
    }
    public function actionEdit($id){
        $model=Brand::findOne(['id'=>$id]);
        $request=new Request();
        if($request->isPost){
            $model->load($request->post());
            $model->imgFile=UploadedFile::getInstance($model,'imgFile');
            if($model->validate()){
                if($model->imgFile){
                    $d=\Yii::getAlias('@webroot').'/Upload'.'/'.date('Ymd');
                    if (!is_dir($d)){
                        mkdir($d);
                    }
                    $filename='/Upload'.'/'.date('Ymd').'/'.uniqid().'.'.$model->imgFile->extension;
                    $model->imgFile->saveAs(\Yii::getAlias('@webroot').$filename,false);
                    $model->logo=$filename;
                }
                $model->save();
                return $this->redirect('index');
            }else{
                var_dump($model->getErrors());exit;
            }
        }
        return $this->render('add',['model'=>$model]);
    }
    public function actionDelete($id){
        $model=Brand::findOne(['id'=>$id]);
        $model->status=-1;
        $model->save();
        return $this->redirect('index');
    }
    public function actionRmfile(){
        $rs=Brand::find()->where('status<0')->orderBy('sort desc');
        $total=$rs->count();
        $pagesize=3;
        $pager=new Pagination(['defaultPageSize'=>$pagesize,'totalCount'=>$total]);
        $models=$rs->limit($pager->limit)->offset($pager->offset)->all();
        return $this->render('rmfile',['models'=>$models,'pager'=>$pager]);
    }
    public function actionRecover($id){
        $model=Brand::findOne(['id'=>$id]);
        $model->status=0;
        $model->save();
        return $this->redirect('rmfile');
    }
}