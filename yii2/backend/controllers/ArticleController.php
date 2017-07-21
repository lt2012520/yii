<?php
namespace backend\controllers;

use backend\models\Article;
use backend\models\ArticleDetail;
use yii\data\Pagination;
use yii\web\Controller;
use yii\web\Request;

class ArticleController extends Controller{
    public function actionAdd(){
        $model=new Article();
        $request=new Request();
        if($request->isPost){
            $model->load($request->post());
            if($model->validate()){
                $model->create_time=time();
                $model->save();
                $detail=new ArticleDetail();
               $detail->article_id=$model->id;
                $detail->content=$model->intro;
                $detail->save();
                return $this->redirect('index');
            }else{
                var_dump($model->getErrors());exit;
            }
        }
        return $this->render('add',['model'=>$model]);
    }
    public function actionEdit($id){
        $model=Article::findOne(['id'=>$id]);
        $request=new Request();
        if($request->isPost){
            $model->load($request->post());
            if($model->validate()){
                $model->create_time=time();
                $model->save();

                return $this->redirect('index');
            }else{
                var_dump($model->getErrors());exit;
            }
        }
        return $this->render('add',['model'=>$model]);
    }
    public function actionIndex(){
        $rs=Article::find()->where('status>=0')->orderBy('sort desc');
        $total=$rs->count();
        $pagesize=3;
        $pager=new Pagination(['defaultPageSize'=>$pagesize,'totalCount'=>$total]);
        $models=$rs->limit($pager->limit)->offset($pager->offset)->all();
        return $this->render('index',['models'=>$models,'pager'=>$pager]);
    }
    public function actionDelete($id){
    $model=Article::findOne(['id'=>$id]);
    $model->status=-1;
    $model->save();
    return $this->redirect('index');
}
    public function actionRmfile(){
        $rs=Article::find()->where('status<0')->orderBy('sort desc');
        $total=$rs->count();
        $pagesize=3;
        $pager=new Pagination(['defaultPageSize'=>$pagesize,'totalCount'=>$total]);
        $models=$rs->limit($pager->limit)->offset($pager->offset)->all();
        return $this->render('rmfile',['models'=>$models,'pager'=>$pager]);
    }
    public function actionRecover($id){
        $model=Article::findOne(['id'=>$id]);
        $model->status=0;
        $model->save();
        return $this->redirect('rmfile');
    }
    public function actionDetail($id){
        $model=ArticleDetail::findOne(['article_id'=>$id]);
        return $this->render('detail',['model'=>$model]);
    }
}