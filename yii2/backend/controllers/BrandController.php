<?php
namespace backend\controllers;

use backend\models\Brand;
use flyok666\qiniu\Qiniu;
use yii\data\Pagination;
use yii\web\Controller;
use yii\web\Request;
use yii\web\UploadedFile;
use flyok666\uploadifive\UploadAction;

class BrandController extends Controller{
    public function actionIndex(){
        $rs=Brand::find()->where('status>=0')->orderBy('sort desc');
        $total=$rs->count();
        $pagesize=3;
        $pager=new Pagination(['defaultPageSize'=>$pagesize,'totalCount'=>$total]);
        $models=$rs->limit($pager->limit)->offset($pager->offset)->all();
        
        return $this->render('index',['models'=>$models,'pager'=>$pager]);
    }
    public function actionAdd()
    {
        $model = new Brand();
        if($model->load(\Yii::$app->request->post())){
            //var_dump(\Yii::$app->request->post());exit;
            //$model->imgFile = UploadedFile::getInstance($model,'imgFile');
            if($model->validate()){
                /*if($model->imgFile){
                    $fileName = '/images/brand/'.uniqid().'.'.$model->imgFile->extension;
                    $model->imgFile->saveAs(\Yii::getAlias('@webroot').$fileName,false);
                    $model->logo = $fileName;
                }*/
                $model->save();
                \Yii::$app->session->setFlash('success','商品添加成功');
                return $this->redirect(['brand/index']);
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

    public function actions() {
        return [
            's-upload' => [
                'class' => UploadAction::className(),
                'basePath' => '@webroot/upload',
                'baseUrl' => '@web/upload',
                'enableCsrf' => true, // default
                'postFieldName' => 'Filedata', // default
                //BEGIN METHOD
               // 'format' => [$this, 'methodName'],
                //END METHOD
                //BEGIN CLOSURE BY-HASH
                'overwriteIfExist' => true,
               /* 'format' => function (UploadAction $action) {
                    $fileext = $action->uploadfile->getExtension();
                    $filename = sha1_file($action->uploadfile->tempName);
                    return "{$filename}.{$fileext}";
                },*/
                //END CLOSURE BY-HASH
                //BEGIN CLOSURE BY TIME
                'format' => function (UploadAction $action) {
                    $fileext = $action->uploadfile->getExtension();
                    $filehash = sha1(uniqid() . time());
                    $p1 = substr($filehash, 0, 2);
                    $p2 = substr($filehash, 2, 2);
                    return "{$p1}/{$p2}/{$filehash}.{$fileext}";
                },
                //END CLOSURE BY TIME
                'validateOptions' => [
                    'extensions' => ['jpg', 'png'],
                    'maxSize' => 1 * 1024 * 1024, //file size
                ],
                'beforeValidate' => function (UploadAction $action) {
                    //throw new Exception('test error');
                },
                'afterValidate' => function (UploadAction $action) {},
                'beforeSave' => function (UploadAction $action) {},
                'afterSave' => function (UploadAction $action) {
                    //$action->output['fileUrl'] = $action->getWebUrl();
                   // $action->getFilename(); // "image/yyyymmddtimerand.jpg"
                   // $action->getWebUrl(); //  "baseUrl + filename, /upload/image/yyyymmddtimerand.jpg"
                    //$action->getSavePath(); // "/var/www/htdocs/upload/image/yyyymmddtimerand.jpg"
                    $qiniu=new Qiniu(\Yii::$app->params['qiniu']);
                    $qiniu->uploadFile(
                        $action->getSavePath(), $action->getWebUrl()
                    );
                    $url=$qiniu->getLink($action->getWebUrl());
                    $action->output['fileUrl']=$url;
                },
            ],
        ];
    }
}