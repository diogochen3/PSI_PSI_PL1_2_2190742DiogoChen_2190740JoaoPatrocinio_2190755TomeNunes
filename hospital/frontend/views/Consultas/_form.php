<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Consultas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="consultas-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'id_marcacao')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Pedir Marcação', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
