<?php
namespace backend\controllers;

use backend\models\ArticleCategory;
use yii\web\Controller;
use yii\data\Pagination;
use yii\web\Request;

class ArticleCategoryController extends Controller{
    public function actionIndex(){
        $rs=ArticleCategory::find();
        $total=$rs->where('status>=0')->count();
        $pagesize=3;
        $pager=new Pagination(['defaultPageSize'=>$pagesize,'totalCount'=>$total]);
        $models=$rs->limit($pager->limit)->offset($pager->offset)->all();

        return $this->render('index',['models'=>$models,'pager'=>$pager]);
    }
    public function actionAdd(){
        $model = new ArticleCategory();
        $request=new Request();
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
        $model=ArticleCategory::findOne(['id'=>$id]);
        $request=new Request();
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
        $model=ArticleCategory::findOne(['id'=>$id]);
        $model->status=-1;
        $model->save();
        return $this->redirect('index');
    }
    public function actionRmfile(){
        $rs=ArticleCategory::find()->where('status<0');
        $total=$rs->count();
        $pagesize=3;
        $pager=new Pagination(['defaultPageSize'=>$pagesize,'totalCount'=>$total]);
        $models=$rs->limit($pager->limit)->offset($pager->offset)->all();
        return $this->render('rmfile',['models'=>$models,'pager'=>$pager]);
    }
    public function actionRecover($id){
        $model=ArticleCategory::findOne(['id'=>$id]);
        $model->status=0;
        $model->save();
        return $this->redirect('rmfile');
    }
}