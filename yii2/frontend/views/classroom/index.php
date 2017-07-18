<table class="table table-bordered table-condensed">
    <tr>
        <td>ID</td>
        <td>班级</td>
        <td>操作</td>
    </tr>
    <?php foreach ($models as $model):?>
    <tr>
        <td><?=$model->id?></td>
        <td><?=$model->class?></td>
        <td>
            <?=\yii\bootstrap\Html::a('修改',['classroom/edit','id'=>$model->id],['class'=>'btn btn-danger']);?>
            <?=\yii\bootstrap\Html::a('删除',['classroom/delete','id'=>$model->id],['class'=>'btn btn-success']);?>
        </td>
    </tr>
    <?php endforeach;?>
</table>