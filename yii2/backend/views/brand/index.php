<a href="<?php echo \yii\helpers\Url::to(['brand/add'])?>"class="btn btn-warning">添加</a>
<a href="<?=\yii\helpers\Url::to(['brand/rmfile'])?>" class="btn btn-danger">已删除商品</a>
<table class="table table-bordered table-condensed">
    <tr>
        <td>商品名称</td>
        <td>简介</td>
        <td>图片</td>
        <td>排序</td>
        <td>状态</td>
        <td>操作</td>
    </tr>
    <?php foreach ($models as $model):?>
    <tr>
        <td><?=$model->name?></td>
        <td><?=$model->intro?></td>
        <td><?=\yii\bootstrap\Html::img($model->logo,['height'=>40])?></td>
        <td><?=$model->sort?></td>
        <td><?=$model->status>0?'正常':'隐藏'?></td>
        <td>
            <?=\yii\bootstrap\Html::a('修改',['brand/edit','id'=>$model->id],['class'=>'btn btn-success'])?>
            <?=\yii\bootstrap\Html::a('删除',['brand/delete','id'=>$model->id],['class'=>'btn btn-danger'])?>
        </td>
    </tr>
    <?php endforeach;?>
</table>
<?php echo \yii\widgets\LinkPager::widget(['pagination'=>$pager])?>