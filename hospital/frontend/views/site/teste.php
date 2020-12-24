<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

foreach ($model as $item) {
   echo $item->id;?><br> <?php
    foreach ($item->receitas as $value) {
       echo $value->Name;
    }
     // \yii\helpers\VarDumper::dump($item->receitas);
  //  \yii\helpers\VarDumper::dump($item->receitasConsultas);
}

?>

