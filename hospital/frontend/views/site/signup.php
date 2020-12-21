<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;


?>
<div>

</div>
<section class="clean-block clean-form dark">
    <div class="container">
        <div class="block-heading">
            <h2 class="text-info" style="width: 159px;margin: 4px;padding: 10px;height: 54px;">Registar</h2>
        </div>


                <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                <div class="col-xl-4">
                    <?= $form->field($model, 'fname')->textInput()->label("Primeiro Nome") ?>


                    <?= $form->field($model, 'lname')->textInput()->label("Ultimo Nome") ?>
                </div>
                <div class="col">
                    <?= $form->field($model, 'email')->input("email")->label("Endereço de email") ?>
                </div>

            <div class="form-row">
                <div class="col-xl-9">
                    <?= $form->field($model, 'Address')->textInput()->label("Morada") ?>
                </div>
                <div class="col">
                   <?= $form->field($model, 'postal_code')->textInput()->label("Codigo Postal") ?>
                </div>
            </div>
            <div class="form-row">
                <div class="col-xl-3">
                   <?= $form->field($model, 'NIF')->textInput()->label("Numero de Identificação Fiscal") ?>
                </div>
                <div class="col-xl-3">




                           <?= $form->field($model, 'gender')->dropDownList(
            ['Male' => 'Masculino', 'Female' => 'Feminino', 'Other' =>'Outro']

                        )->label("Genero");?>



                </div>
                <div class="col-xl-3">
                   <?= $form->field($model, 'phone_number')->label("Numero de Telefone")?>
                </div>
             
            </div>
            <?= $form->field($model, 'password')->passwordInput() ?>

            <div class="form-group">
                <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
            </div>
            <?php ActiveForm::end(); ?>

</div>

</section>