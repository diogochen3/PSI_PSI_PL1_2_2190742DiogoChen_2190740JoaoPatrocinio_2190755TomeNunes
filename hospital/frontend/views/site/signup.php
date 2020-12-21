<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\jui\DatePicker;


?>
<div>

</div>
<section class="clean-block clean-form dark">
    <div class="container">
        <div class="block-heading">
            <h2 class="text-info" style="width: 159px;margin: 4px;padding: 10px;height: 54px;">Registar</h2>
        </div>
        <form style="width: 1000px;margin: 0px;border-radius: 0px;padding: 40px;max-width: 1000px;">
            <div class="form-row">
                <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
                <div class="col-xl-4">
                    <div class="form-group"><?= $form->field($model, 'username')->textInput()->label("Primeiro Nome") ?></div>
                </div>
                <div class="col-xl-4">
                    <div class="form-group"><?= $form->field($model, 'lname')->textInput()->label("Ultimo Nome") ?></div>
                </div>
                <div class="col">
                    <div class="form-group"><?= $form->field($model, 'email')->textInput()->label("Endereço de email") ?></div>
                </div>
            </div>
            <div class="form-row">
                <div class="col-xl-9">
                    <div class="form-group"><?= $form->field($model, 'Address')->textInput()->label("Morada") ?></div>
                </div>
                <div class="col">
                    <div class="form-group"><?= $form->field($model, 'postal_code')->textInput()->label("Codigo Postal") ?></div>
                </div>
            </div>
            <div class="form-row">
                <div class="col-xl-3">
                    <div class="form-group"> <?= $form->field($model, 'NIF')->textInput()->label("Numero de Identificação Fiscal") ?></div>
                </div>
                <div class="col-xl-3">
                    <div class="form-group">



                           <?= $form->field($model, 'gender')->dropDownList(
            ['M' => 'Masculino', 'F' => 'Feminino', 'O' =>'Outro']
      // options
                        )->label("Genero");?>


                    </div>
                </div>
                <div class="col-xl-3">
                    <div class="form-group"><?= $form->field($model, 'phone_number')->label("Numero de Telefone")?></div>
                </div>
                <div class="col">
                    <div class="form-group"><?= $form->field($model, 'Birth_date')->label("Data de Nascimento")->input("date"); ?></div>
                </div>
            </div>
            <div class="form-group"> <?= $form->field($model, 'password')->textInput() ?></div>
            <?= Html::submitButton('Registar', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
        </form>
        <?php ActiveForm::end(); ?>
    </div>

</section>