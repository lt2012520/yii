<?php
$form=\yii\bootstrap\ActiveForm::begin();
echo $form->field($model,'name');
echo $form->field($model,'password')->passwordInput();
echo $form->field($model,'age');
echo $form->field($model,'sex');
echo $form->field($model,'imgFile')->fileInput();
echo $form->field($model,'code')->widget(\yii\captcha\Captcha::className(),['captchaAction'=>'admin/captcha']);
echo \yii\bootstrap\Html::submitButton('提交',['class'=>'btn btn-info btn-access']);
\yii\bootstrap\ActiveForm::end();