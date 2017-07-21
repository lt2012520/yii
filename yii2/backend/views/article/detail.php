.<a href="<?=\yii\helpers\Url::to(['article/index'])?>"class="btn btn-warning">返回</a>
<table class="table table-bordered table-condensed">
    <tr>
        <td>文章名称</td>
        <td>文章分类</td>
        <td>状态</td>
        <td>创建时间</td>
    </tr>
    <tr>
        <td><?=$model->article->name?></td>
        <td><?=$model->article->articleCategory->name?></td>
        <td><?=$model->article->status>0?'正常':'隐藏'?></td>
        <td><?=date('Y-m-d H:i:s',$model->article->create_time)?></td>
    </tr>
</table>
<?php
$form=\yii\bootstrap\ActiveForm::begin();
echo $form->field($model,'content')->textarea(['readonly'=>'readonly','value'=>$model->content]);
\yii\bootstrap\ActiveForm::end();
?>