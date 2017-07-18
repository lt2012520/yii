<table class="table table-bordered table-condensed">
    <tr>
        <td>ID</td>
        <td>姓名</td>
        <td>年龄</td>
        <td>班级</td>
        <td>头像</td>
        <td>操作</td>
    </tr>
    <?php foreach ($models as $model):?>
    <tr>
        <td><?=$model->id?></td>
        <td><?=$model->name?></td>
        <td><?=$model->age?></td>
        <td><?=$model->classroom->class?></td>
        <td><?=\yii\bootstrap\Html::img($model->img,['height'=>50])?></td>
        <td>
            <?=\yii\bootstrap\Html::a('修改',['student/edit','id'=>$model->id],['class'=>'btn btn-danger'])?>
            <?=\yii\bootstrap\Html::a('删除',['student/delete','id'=>$model->id],['class'=>'btn btn-danger'])?>
        </td>
    </tr>
    <?php endforeach;?>
</table>
<?php
echo \yii\widgets\LinkPager::widget(['pagination'=>$pager]);
