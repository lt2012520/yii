<?php
$form=\yii\bootstrap\ActiveForm::begin();
echo $form->field($model,'name')->textInput();
echo $form->field($model,'age')->textInput();
$rs=\frontend\models\Classroom::find()->all();
$cate = yii\helpers\ArrayHelper::map($rs, 'id', 'class');
echo $form->field($model,'class_id')->dropDownList($cate);
echo$form->field($model,'imgFile')->fileInput();
echo$form->field($model,'code')->widget(\yii\captcha\Captcha::className(),['captchaAction'=>'student/captcha',
    'template'=>'<div class="row"><div class="col-lg-1">{image}</div><div class="col-lg-1">{input}</div></div>'])->label('验证码');

echo \yii\bootstrap\Html::submitButton('提交',['class'=>'btn btn-info btn-success']);
\yii\bootstrap\ActiveForm::end();
