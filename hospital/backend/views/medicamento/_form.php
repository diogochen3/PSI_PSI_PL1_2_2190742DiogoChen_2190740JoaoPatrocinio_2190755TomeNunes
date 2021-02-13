<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Medicamento */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="medicamento-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nome_medicamento')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dosagem')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'forma_farmaceuta')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'embalagem')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CodigoOtico')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
