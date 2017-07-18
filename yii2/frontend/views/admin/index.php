<table class="table table-bordered table-condensed">
    <tr>
        <td>ID</td>
        <td>姓名</td>
        <td>年龄</td>
        <td>性别</td>
        <td>头像</td>
    </tr>
    <?php foreach ($models as $model):?>
    <tr>
        <td><?=$model->id?></td>
        <td><?=$model->name?></td>
        <td><?=$model->age?></td>
        <td><?=$model->sex?></td>
        <td><?=\yii\bootstrap\Html::img($model->img,['height'=>50])?></td>
    </tr>
    <?php endforeach;?>
</table>