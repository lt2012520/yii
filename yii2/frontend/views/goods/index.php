<table class="table table-condensed table-bordered">
    <tr>
        <td>ID</td>
        <td>商品名称</td>
        <td>售价</td>
        <td>图片</td>
        <td>操作</td>
    </tr>
    <?php foreach ($models as $model):?>
    <tr>
        <td><?= $model->id?></td>
        <td><?= $model->name?></td>
        <td><?= $model->price?></td>
        <td><?= \yii\bootstrap\Html::img($model->img,['height'=>50])?></td>
        <td>
            <?= \yii\bootstrap\Html::a('修改',['goods/edit','id'=>$model->id],['class'=>'btn btn-danger']);?>
            <?= \yii\bootstrap\Html::a('删除',['goods/delete','id'=>$model->id],['class'=>'btn btn-danger'])?>
        </td>
    </tr>
    <?php endforeach;?>
</table>
<?php
echo \yii\widgets\LinkPager::widget(['pagination'=>$pager]);