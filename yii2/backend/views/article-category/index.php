<a href="<?php echo \yii\helpers\Url::to(['article-category/add'])?>"class="btn btn-warning">添加</a>
<a href="<?=\yii\helpers\Url::to(['article-category/rmfile'])?>" class="btn btn-danger">已删除商品</a>
<table class="table table-bordered table-condensed">
    <tr>
        <td>商品名称</td>
        <td>简介</td>
        <td>排序</td>
        <td>状态</td>
        <td>操作</td>
    </tr>
    <?php foreach ($models as $model):?>
    <tr>
        <td><?=$model->name?></td>
        <td><?=$model->intro?></td>
        <td><?=$model->sort?></td>
        <td><?=$model->status>0?'正常':'隐藏'?></td>
        <td>
            <?=\yii\bootstrap\Html::a('修改',['article-category/edit','id'=>$model->id],['class'=>'btn btn-success'])?>
            <?=\yii\bootstrap\Html::a('删除',['article-category/delete','id'=>$model->id],['class'=>'btn btn-danger'])?>
        </td>
    </tr>
    <?php endforeach;?>
</table>
<?php echo \yii\widgets\LinkPager::widget(['pagination'=>$pager])?>