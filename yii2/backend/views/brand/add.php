<?php
use yii\web\JsExpression;
$form=\yii\bootstrap\ActiveForm::begin();
/*'name'=>$this->string(50)->comment('商品名称'),
            'intro'=>$this->text()->comment('简介'),
            'logo'=>$this->string(255)->comment('图片'),
            'sort'=>$this->smallInteger(11)->comment('排序'),
            'status'=>$this->integer()->comment('状态'),*/

echo $form->field($model,'name');
echo $form->field($model,'intro')->textarea();
echo $form->field($model,'logo')->hiddenInput();


//Remove Events Auto Convert



//外部TAG
echo \yii\bootstrap\Html::fileInput('test', NULL, ['id' => 'test']);
echo \flyok666\uploadifive\Uploadifive::widget([
    'url' => yii\helpers\Url::to(['s-upload']),
    'id' => 'test',
    'csrf' => true,
    'renderTag' => false,
    'jsOptions' => [
        'formData'=>['someKey' => 'someValue'],
        'width' => 120,
        'height' => 40,
        'onError' => new JsExpression(<<<EOF
function(file, errorCode, errorMsg, errorString) {
    console.log('The file ' + file.name + ' could not be uploaded: ' + errorString + errorCode + errorMsg);
}
EOF
        ),
        'onUploadComplete' => new JsExpression(<<<EOF
function(file, data, response) {
    data = JSON.parse(data);
    if (data.error) {
        console.log(data.msg);
    } else {
        console.log(data.fileUrl);
        //将图片地址赋值给LOGO字段
        $("#brand-logo").val(data.fileUrl);
        console.debug($("#brand-logo").val(data.fileUrl));
         $("#img").attr('src',data.fileUrl);
    }
}
EOF
        ),
    ]
]);
echo \yii\bootstrap\Html::img($model->logo?$model->logo:false,['id'=>'img','height'=>50]);
echo $form->field($model,'sort')->textInput(['type'=>'number']);
echo $form->field($model,'status',['inline'=>true])->radioList(\backend\models\Brand::getStatusOptions());
echo \yii\bootstrap\Html::submitButton('提交',['class'=>'btn btn-info']);
\yii\bootstrap\ActiveForm::end();