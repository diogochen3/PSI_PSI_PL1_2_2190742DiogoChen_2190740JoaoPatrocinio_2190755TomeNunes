<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Receitas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="receitas-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Nome_medicamento')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'quantidade')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
