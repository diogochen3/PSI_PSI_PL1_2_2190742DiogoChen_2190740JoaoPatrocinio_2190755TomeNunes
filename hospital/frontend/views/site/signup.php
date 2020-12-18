<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;


?>
<div class="site-signup">

    <p>Please fill out the following fields to signup:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>


            <?= $form->field($model, 'username')->textInput()->label('') ?>

            <?= $form->field($model, 'fname')->textInput()->label('') ?>

            <?= $form->field($model, 'lname')->textInput() ?>


            <?= $form->field($model, 'email') ?>


            <?= $form->field($model, 'phone_number')->textInput() ?>

            <?= $form->field($model, 'NIF')->textInput() ?>


            <?= $form->field($model, 'password')->passwordInput() ?>

                <div class="form-group">
                    <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
