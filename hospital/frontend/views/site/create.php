<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Marcacao */
/* @var $form ActiveForm */

?>
<div class="create">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'date')->input('date') ?>
        <?= $form->field($model, 'tempo')->input('time') ?>
        <?= $form->field($model, 'Aceitar') ?>
    <?= $form->field($model, 'id_Medico')->dropDownList()->label("Genero");?>
        <?= $form->field($model, 'id_especialidade') ?>
        <?= $form->field($model, 'id_Utente') ?>
        <?= $form->field($model, 'id_Medico') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- create -->
