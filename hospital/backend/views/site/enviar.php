<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Receitas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="receitas-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'opening_date')->Input("datetime-local",["min"=> $datenow]); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>