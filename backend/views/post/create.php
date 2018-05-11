<?php

$form = \yii\widgets\ActiveForm::begin();
echo $form ->field($model, "author");
echo $form ->field($model, "title");
echo $form ->field($model, "slug");
echo $form ->field($model, "description");
echo $form ->field($model, "content");
echo "<br>";
echo \yii\helpers\Html::submitButton("Add to DB");
\yii\widgets\ActiveForm::end();