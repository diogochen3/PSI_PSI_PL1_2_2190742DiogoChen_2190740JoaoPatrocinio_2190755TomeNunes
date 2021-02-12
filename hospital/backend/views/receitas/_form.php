<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use unclead\multipleinput\MultipleInput;

/* @var $this yii\web\View */
/* @var $model common\models\Receitas */
/* @var $form yii\widgets\ActiveForm */
/* @var $medicamentos array */
?>

<div class="receitas-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'cod_acesso')->input("number") ?>

    <?= $form->field($model, 'cod_dispensa')->input("number") ?>

    <?= $form->field($model, 'id_medicamento')->dropDownList($medicamentos,[

    ]) ?>

    <?= $form->field($model, 'quantidade')->input("number") ?>

    <?= $form->field($model, 'posologia')->textInput()  ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
