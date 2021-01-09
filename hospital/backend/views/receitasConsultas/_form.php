<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ReceitasConsultas */
/* @var $form yii\widgets\ActiveForm */
/* @var $receitas array */
/* @var $consultas array */
?>

<div class="receitas-consultas-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_receitas')->dropDownList($receitas,
        ['prompt'=>'-Choose o medico-']
    ) ?>

    <?= $form->field($model, 'id_consultas')->dropDownList($consultas,
        ['prompt'=>'-Choose o medico-']
    ) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
