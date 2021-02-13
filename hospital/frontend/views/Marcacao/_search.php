<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\MarcacaoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="marcacao-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'Aceitar') ?>

    <?= $form->field($model, 'id_especialidade') ?>

    <?= $form->field($model, 'id_Utente') ?>

    <?= $form->field($model, 'id_Medico') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
