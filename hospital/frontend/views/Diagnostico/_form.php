<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Diagnostico */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="diagnostico-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'descricao')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date')->textInput() ?>

    <?= $form->field($model, 'situacao')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_medico')->textInput() ?>

    <?= $form->field($model, 'id_utente')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
