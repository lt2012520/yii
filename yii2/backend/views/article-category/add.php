<?php
$form=\yii\bootstrap\ActiveForm::begin();
/*'name'=>$this->string(50)->comment('商品名称'),
            'intro'=>$this->text()->comment('简介'),
            'logo'=>$this->string(255)->comment('图片'),
            'sort'=>$this->smallInteger(11)->comment('排序'),
            'status'=>$this->integer()->comment('状态'),*/

echo $form->field($model,'name');
echo $form->field($model,'intro')->textarea();
echo $form->field($model,'sort')->textInput(['type'=>'number']);
echo $form->field($model,'status',['inline'=>true])->radioList(\backend\models\Brand::getStatusOptions());
echo \yii\bootstrap\Html::submitButton('提交',['class'=>'btn btn-info']);
\yii\bootstrap\ActiveForm::end();