<?php
$form=\yii\bootstrap\ActiveForm::begin();
echo $form->field($model,'name')->textInput();
echo $form->field($model,'price')->textInput();
echo \yii\bootstrap\Html::submitButton('提交',['class'=>'btn btn-info btn-access']);
\yii\bootstrap\ActiveForm::end();