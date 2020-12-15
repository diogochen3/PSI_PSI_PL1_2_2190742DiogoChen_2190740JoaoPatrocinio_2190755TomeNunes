<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MedicoEspecialidade */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="medico-especialidade-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_medico')->textInput() ?>

    <?= $form->field($model, 'id_especialidade')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
