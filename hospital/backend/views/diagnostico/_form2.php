<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Diagnostico */
/* @var $form yii\widgets\ActiveForm */
/* @var $utente array */
?>

<div class="diagnostico-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'descricao')->textInput(['maxlength' => true]) ?>


    <?= $form->field($model, 'situacao')->textInput(['maxlength' => true]) ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
