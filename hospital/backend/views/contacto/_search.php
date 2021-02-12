<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ContactoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contacto-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'nome') ?>

    <?= $form->field($model, 'assunto') ?>

    <?= $form->field($model, 'corpo') ?>

    <?= $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'id_Categoria') ?>

    <?php // echo $form->field($model, 'id_Utente') ?>

    <?php // echo $form->field($model, 'data_envio') ?>

    <?php // echo $form->field($model, 'data_respondido') ?>

    <?php // echo $form->field($model, 'respondido') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
