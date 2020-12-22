<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Marcacao */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="marcacao-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'date')->Input("date") ?>

    <?= $form->field($model, 'tempo')->textInput() ?>

    <?= $form->field($model, 'Aceitar')->textInput() ?>

    <?= $form->field($model, 'id_especialidade')->textInput() ?>

    <?= $form->field($model, 'id_Utente')->textInput() ?>

    <?= $form->field($model, 'id_Medico')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
