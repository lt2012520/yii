.<a href="<?=\yii\helpers\Url::to(['article/index'])?>"class="btn btn-warning">返回</a>
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
            <td><?=$model->status<0?'已删除':'已删除'?></td>
            <td><?=$model->articleCategory->name?></td>
            <td><?=date('Y-m-d H:i:s',$model->create_time)?></td>
            <td>
                <?=\yii\bootstrap\Html::a('恢复',['article/recover','id'=>$model->id],['class'=>'btn btn-success'])?>
            </td>
        </tr>
    <?php endforeach;?>
</table>
<?php echo \yii\widgets\LinkPager::widget(['pagination'=>$pager])?>