<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div class="block-heading">
    <h2 class="text-info" style="width: 159px;margin: 4px;padding: 10px;height: 54px;">Perfil</h2>
</div>
<?php $form = ActiveForm::begin(); ?>
    <div class="col">
        <div class="form-group"><?= Html::img("@web/".base64_decode($model->imagem));  ?></div>
    </div>
<div class="form-row">

    <div class="col-xl-4">
        <div class="form-group"><?= $form->field($model, 'First_name')->textInput(['maxlength' => true, 'disabled' => true]) ?></div>
    </div>
    <div class="col-xl-4">
        <div class="form-group"><?= $form->field($model, 'Last_name')->textInput(['maxlength' => true, 'disabled' => true]) ?></div>
    </div>
    <div class="col">
        <div class="form-group"><?= $form->field($model, 'Email')->textInput(['maxlength' => true, 'disabled' => true]) ?></div>
    </div>
</div>
<div class="form-row">
    <div class="col-xl-9">
        <div class="form-group"><?= $form->field($model, 'Address')->textarea(['maxlength' => true, 'disabled' => true]) ?></div>
    </div>
    <div class="col">
        <div class="form-group"><?= $form->field($model, 'postal_code')->textInput(['maxlength' => true, 'disabled' => true]) ?></div>
    </div>
</div>
<div class="form-row">
    <div class="col-xl-3">
        <div class="form-group"><?= $form->field($model, 'NIF')->textInput(['maxlength' => true, 'disabled' => true]) ?></div>
    </div>
    <div class="col-xl-3">
        <div class="form-group"><?= $form->field($model, 'gender')->textInput(['maxlength' => true, 'disabled' => true]) ?>
        </div>
    </div>
    <div class="col-xl-3">
        <div class="form-group"><?= $form->field($model, 'Birth_date')->textInput(['maxlength' => true, 'disabled' => true]) ?></div>
    </div>
    <div class="col">
        <div class="form-group"><?= $form->field($model, 'Phone_number')->textInput(['disabled' => true]) ?></div>
    </div>

</div>
<div class="form-group">
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
</div>
<?php ActiveForm::end(); ?>