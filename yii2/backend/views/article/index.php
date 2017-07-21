<a href="<?php echo \yii\helpers\Url::to(['article/add'])?>"class="btn btn-warning">添加</a>
<a href="<?=\yii\helpers\Url::to(['article/rmfile'])?>" class="btn btn-danger">已删除文章</a>
<table class="table table-bordered table-condensed">
    <tr>
        <td>文章名称</td>
        <td>简介</td>
        <td>排序</td>
        <td>状态</td>
        <td>文章分类</td>
        <td>创建时间</td>
        <td>操作</td>
    </tr>
    <?php foreach ($models as $model):?>
    <tr>
        <td><?=$model->name?></td>
        <td><?=$model->intro?></td>
        <td><?=$model->sort?></td>
        <td><?=$model->status>0?'正常':'隐藏'?></td>
        <td><?=$model->articleCategory->name?></td>
        <td><?=date('Y-m-d H:i:s',$model->create_time)?></td>
        <td>
            <?=\yii\bootstrap\Html::a('修改',['article/edit','id'=>$model->id],['class'=>'btn btn-success'])?>
            <?=\yii\bootstrap\Html::a('删除',['article/delete','id'=>$model->id],['class'=>'btn btn-danger'])?>
            <?=\yii\bootstrap\Html::a('查看简介',['article/detail','id'=>$model->id],['class'=>'btn btn-warning'])?>
        </td>
    </tr>
    <?php endforeach;?>
</table>
<?php echo \yii\widgets\LinkPager::widget(['pagination'=>$pager])?>